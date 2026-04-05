<?php
namespace App\Http\Controllers\Administrator;

use App\Models\GameLoad;
use DB;
use Hash;
use Session;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Point;
use App\Models\Admin;
use App\Models\Market;
use App\Helpers\Helper;
use App\Models\UserCoin;
use App\Models\BlockUser;
use App\Models\PointTable;
use App\Models\DepositHistory;
use App\Models\BonusReport;
use Illuminate\Http\Request;
use App\Models\Walletreport;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use MongoDB\BSON\ObjectId;
use MongoDB\BSON\UTCDateTime;

class UserController extends Controller
{
    public function __construct()
    {
    }

    /**
     * Resolve user from admin URLs or form hidden ids (Mongo ObjectId hex, BSON ObjectId, numeric id, or user_id).
     *
     * Note: jenssegers converts 24-char hex in where('_id', ...) to ObjectId. If _id is stored as a string in BSON,
     * that query never matches — last resort uses the driver findOne with $or (string _id OR ObjectId).
     */
    private function findUserByAdminRouteId($id): ?User
    {
        if ($id === null || $id === '') {
            return null;
        }

        if ($id instanceof ObjectId) {
            return User::where('_id', $id)->first();
        }

        $id = preg_replace('/[\x{200B}-\x{200D}\x{FEFF}]/u', '', rawurldecode(trim((string) $id)));
        if ($id === '') {
            return null;
        }

        $user = User::find($id);
        if ($user) {
            return $user;
        }

        if (preg_match('/^[a-f\d]{24}$/i', $id)) {
            try {
                $oid = new ObjectId($id);
                $user = User::where('_id', $oid)->first();
                if ($user) {
                    return $user;
                }
            } catch (\Throwable $e) {
                // ignore invalid ObjectId
            }
        }

        if (ctype_digit($id)) {
            $byInt = User::where('id', (int) $id)->first();
            if ($byInt) {
                return $byInt;
            }
        }

        $user = User::where('user_id', $id)->first();
        if ($user) {
            return $user;
        }
        if (ctype_digit($id)) {
            $user = User::where('user_id', (int) $id)->first();
            if ($user) {
                return $user;
            }
        }

        $ors = [['_id' => $id]];
        if (preg_match('/^[a-f\d]{24}$/i', $id)) {
            try {
                $ors[] = ['_id' => new ObjectId($id)];
            } catch (\Throwable $e) {
                // keep string-only _id clause
            }
        }
        if (ctype_digit($id)) {
            $ors[] = ['user_id' => $id];
            $ors[] = ['user_id' => (int) $id];
        }

        $typeMap = ['root' => 'array', 'document' => 'array', 'array' => 'array'];

        return User::raw(function ($collection) use ($ors, $typeMap) {
            return $collection->findOne(['$or' => $ors], ['typeMap' => $typeMap]);
        });
    }

    /**
     * Match both string and ObjectId _id (MongoDB driver 2.x is strict).
     */
    private function userUpdateFilterFromMarketsId($marketsId): array
    {
        $marketsId = is_string($marketsId) ? trim($marketsId) : $marketsId;
        if ($marketsId === null || $marketsId === '') {
            return ['_id' => null];
        }
        if (preg_match('/^[a-f\d]{24}$/i', (string) $marketsId)) {
            $s = (string) $marketsId;
            try {
                return ['$or' => [
                    ['_id' => $s],
                    ['_id' => new ObjectId($s)],
                ]];
            } catch (\Throwable $e) {
                return ['_id' => $s];
            }
        }

        return ['_id' => $marketsId];
    }

    /*-------Show List Page ---------*/
    public function user_ip_list()
    {
        return view('administrator.user.user_ip');
    }
    public function unapprove_user()
    {
        return view('administrator.user.unapprove');
    }
    public function active_user()
    {
        return view('administrator.user.active');
    }
    public function Inactive_user()
    {
        return view('administrator.user.inactive');
    }
    public function playing_user()
    {
        return view('administrator.user.playing_user');
    }
    public function notplaying_user()
    {
        return view('administrator.user.notplaying_user');
    }
    public function online_user()
    {
        return view('administrator.user.online_user');
    }
    public function view_user(Request $request, $id)
    {
        $select = $this->findUserByAdminRouteId($id);
        if (!$select) {
            return redirect()->route('active_user')->with('error_message', 'User not found.');
        }
        return view('administrator.user.view', compact('select'));
    }
    public function add_user()
    {
        // $userData = User::where('ref_code', "00067")->select('_id')->get();
        // // print_r($userData);die;
        // foreach ($userData as $user) {
        //     // Generate a unique ref_code for each user
        //     do {
        //         $newRefCode = (string) rand(111111, 999999);
        //     } while (User::where('ref_code', $newRefCode)->exists());

        //     // Update that individual user
        //     User::where('_id', $user->_id)->update([
        //         'ref_code' => $newRefCode
        //     ]);
        // }
        return view('administrator.user.adduser');
    }

    public function UserGameReport()
    {
        // dd("comming soon");
        return view('administrator.user.usergameReport');
    }

    public function store_user(Request $request)
    {
        // Same business rules as before; only persistence uses insertOne (MongoDB ext 2.x + library 2.x BSON-safe).
        $credit = 0;
        $validator = Validator::make($request->all(), [
            'FullName' => 'required',
            'mob' => 'required',
            'us_gender' => 'required',
            'dob' => 'required',
            'us_pass' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('add_user')->withErrors($validator)->withInput();
        }

        $chk = User::where('ref_code', $request->ref_by)->count();
        $currentDateTime = Carbon::now();
        $newDateTime = $currentDateTime->addHours(5)->addMinutes(30);
        $formattedDateTime = $newDateTime->format('Y-m-d H:i:s');
        $date = date('d-m-Y');

        // Original logic: invalid only when refer code was sent but does not exist.
        if ($chk == 0 && $request->ref_by != null) {
            return redirect()->back()->with('error_message', 'Invalid Reffer Code !!');
        }
        // Else branch was: elseif ($chk > 0 || $request->ref_by == null) { ... insert ... }

        $mobileNum = $request->mob;
        $tr_id = substr($mobileNum, -5);
        $app_id = 'com.dubaiking';
        $nowMs = (int) floor(microtime(true) * 1000);
        $nowUtc = new UTCDateTime($nowMs);

        $doc = [
            'user_id' => $tr_id,
            'app_id' => $app_id,
            'FullName' => $request->FullName,
            'us_pass' => $request->us_pass,
            'mob' => $request->mob,
            'us_gender' => $request->us_gender,
            'dob' => $request->dob,
            'date' => $date,
            'date_time' => $formattedDateTime,
            'credit' => $credit,
            'ref_code' => $this->getNextOrderNumber(),
            'ref_by' => $request->ref_by,
            'is_ref_enabled' => 1,
            'user_status' => 1,
            'banned' => 0,
            'win_amount' => 0,
            'is_playstore' => 0,
            'created_at' => $nowUtc,
            'updated_at' => $nowUtc,
        ];

        $result = User::raw(function ($collection) use ($doc) {
            return $collection->insertOne($doc);
        });

        if ($result instanceof \MongoDB\InsertOneResult && $result->getInsertedCount() === 1) {
            return redirect()->route('active_user')->with('success_message', 'One New User has been created successfully.');
        }

        return redirect()->back()->with('error_message', 'Could not create user. Please try again.');
    }
    // public function getNextOrderNumber()
    // {
    //     // Get the last created order
    //     $lastOrder = User::orderBy('_id', 'desc')->first();
    //     if (!$lastOrder) {
    //         // dd('pppp');
    //         $number = 0;
    //         return sprintf('%05d', intval($number));
    //     } else {
    //         $number = $lastOrder->_id;
    //         return sprintf('%05d', intval($number));
    //     }
    // }
    public function getNextOrderNumber($length = 6)
    {
        do {
            $code = '';
            for ($i = 0; $i < $length; $i++) {
                $code .= mt_rand(0, 9); // Generate a random digit (0–9)
            }
        } while (User::where('ref_code', $code)->exists()); // Ensure uniqueness

        return $code;
    }


    public function getActiveUserData(Request $request)
    {
        // Must match column order in resources/views/administrator/user/active.blade.php (DataTables indices 0..13)
        $columns = [
            0 => 'created_at',
            1 => 'FullName',
            2 => 'us_pass',
            3 => 'mob',
            4 => 'credit',
            5 => 'win_amount',
            6 => 'credit',
            7 => 'created_at',
            8 => 'created_at',
            9 => 'ref_code',
            10 => 'ref_by',
            11 => 'created_at',
            12 => 'banned',
            13 => 'created_at',
        ];

        $requestData = $request->all();
        $total = User::where('user_status', 1)->count();

        $query = User::where('user_status', 1)
            ->select(['_id', 'user_id', 'app_id', 'FullName', 'mob', 'us_pass', 'credit', 'win_amount', 'ref_code', 'ref_by', 'banned', 'created_at']);

        if (!empty($requestData['search']['value'])) {
            $searchValue = $requestData['search']['value'];
            $query->where(function ($q) use ($searchValue) {
                $regex = new \MongoDB\BSON\Regex($searchValue, 'i');
                $q->orWhere('FullName', 'regex', $regex)
                    ->orWhere('ref_code', 'regex', $regex)
                    ->orWhere('mob', 'regex', $regex)
                    ->orWhere('user_id', 'regex', $regex);
            });
        }

        if (!empty($requestData['order'][0])) {
            $colIdx = (int) ($requestData['order'][0]['column'] ?? 0);
            $dir = strtolower((string) ($requestData['order'][0]['dir'] ?? 'desc'));
            $orderColumnDir = $dir === 'asc' ? 'asc' : 'desc';
            $orderColumn = $columns[$colIdx] ?? 'created_at';
            $query->orderBy($orderColumn, $orderColumnDir);
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $limit = !empty($requestData['length']) ? (int) $requestData['length'] : 10;
        $offset = !empty($requestData['start']) ? (int) $requestData['start'] : 0;

        $recordsFiltered = (clone $query)->count();
        $users = $query->skip($offset)->take($limit)->get();

        // Collect user IDs for batch processing
        $userIds = $users->pluck('user_id')->map(fn($id) => (string) $id)->toArray();


        $points = Point::raw(function ($collection) use ($userIds) {
            return $collection->aggregate([
                [
                    '$match' => [
                        'user_id' => ['$in' => $userIds],
                        'tr_nature' => ['$in' => ['TRDEPO002', 'TRWITH003', 'TRWIN005']],
                        'tr_status' => 'Success'
                    ]
                ],
                [
                    '$group' => [
                        '_id' => ['user_id' => '$user_id', 'tr_nature' => '$tr_nature'],
                        'total_value' => ['$sum' => '$tr_value']
                    ]
                ],
                [
                    '$project' => [
                        'user_id' => '$_id.user_id',
                        'tr_nature' => '$_id.tr_nature',
                        'total_value' => 1,
                        '_id' => 0
                    ]
                ]
            ]);
        });




        $pointsData = [];
        foreach ($points as $point) {
            $uid = (string) data_get($point, 'user_id');
            $nature = data_get($point, 'tr_nature');
            if ($uid !== '' && $nature !== null) {
                $pointsData[$uid][$nature] = data_get($point, 'total_value');
            }
        }




        // Process user data for DataTables response
        $data = [];
        $i = $offset;

        foreach ($users as $user) {
            $i++;
            $nestedData = [];
            $nestedData[] = $i;
            $nestedData[] = $user->FullName;
            $nestedData[] = $user->us_pass;
            $nestedData[] = $user->mob;
            $nestedData[] = $user->credit;

            // $deposit_point = $pointsData[$user->user_id]['TRDEPO002'] ?? 0;
            // $deposit_his = $depositPointsData[$user->user_id] ?? 0; // fixed this line
            $uidKey = (string) $user->user_id;
            $withdraw = $pointsData[$uidKey]['TRWITH003'] ?? $pointsData[$user->user_id]['TRWITH003'] ?? 0;
            // echo((string)$user->user_id);die;
            $deposit_point = Helper::userdepositamout($user->user_id);

            $nestedData[] = $user->win_amount;
            $nestedData[] = $user->credit + $user->win_amount;
            $nestedData[] = $withdraw;
            $nestedData[] = $deposit_point;
            $nestedData[] = $user->ref_code;
            $nestedData[] = $user->ref_by;
            $nestedData[] = $this->formatUserDateForTable($user->created_at);

            $uid = rawurlencode((string) $user->_id);
            if ($user->banned) {
                $message = "'Are you sure you want to Inactive the user?'";
                $nestedData[] = '<a href="' . url('/administrator/user/banned/status/' . $uid) . '" onclick="return confirm(' . $message . ')" title="Active"><i class="fa fa-toggle-on"></i></a>';
            } else {
                $message = "'Are you sure you want to Active the user?'";
                $nestedData[] = '<a href="' . url('/administrator/user/banned/status/' . $uid) . '" onclick="return confirm(' . $message . ')" title="Inactive"><i class="fa fa-toggle-off"></i></a>';
            }

            // Action Buttons
            $actionLinks =
                '<a href="' . url('/administrator/user/deposit/' . $uid) . '" title="Deposit"><button class="btn btn-success">Deposit</button></a> ' .
                '<a href="' . url('/administrator/user/withdraw/' . $uid) . '" title="Withdraw"><button class="btn btn-info">Withdraw</button></a> ' .
                '<a href="' . url('/administrator/user/view/' . $uid) . '" title="View"><button class="btn btn-primary"><i class="fa fa-eye"></i></button></a> ' .
                '<a href="' . url('/administrator/user/edit/' . $uid) . '" title="Edit"><button class="btn btn-warning"><i class="fa fa-pencil"></i></button></a> ' .
                '<a href="javascript:void(0);" onclick="deleteItem(' . "'" . (string) $user->_id . "'" . ', this)" title="Delete"><button class="btn btn-info"><i class="icon-trash"></i></button></a> ' .
                '<a href="' . url('/administrator/user/win-amount-withdrow/' . $uid) . '" title="Withdraw"><button class="btn btn-info">Win amount Withdraw</button></a> ' .
                '<a href="' . url('/administrator/user/wallet-history/' . $uid) . '" title="User Withdraw History"><button class="btn btn-info">history</button></a> ';

            $nestedData[] = $actionLinks;
            $data[] = $nestedData;
        }

        return response()->json([
            'data' => $data,
            'total' => $total,
            'recordsTotal' => $total,
            'recordsFiltered' => $recordsFiltered,
            'draw' => intval($requestData['draw'] ?? 0),
        ]);
    }

    private function formatUserDateForTable($value): string
    {
        if ($value instanceof UTCDateTime) {
            return $value->toDateTime()->format('d-m-Y h:i a');
        }
        if ($value instanceof \Carbon\Carbon) {
            return $value->format('d-m-Y h:i a');
        }
        if (is_string($value) && $value !== '') {
            $ts = strtotime($value);

            return $ts ? date('d-m-Y h:i a', $ts) : '';
        }

        return '';
    }


    public function today_user()
    {
        return view('administrator.user.today_user');
    }

    public function gettodayUserData(Request $request)
    {

        // $date = Carbon::now('UTC');
        $date = date('d-m-Y');
        // dd($date);
        $requestData = $_REQUEST;
        $total = User::where('user_status', 1)
            ->where('date', $date)
            ->count();

        $Market = User::select('id', 'FullName', 'mob', 'us_pass', 'ref_code', 'ref_by', 'last_seen', 'user_status', 'created_at', 'credit', 'user_id')
            ->where('date', $date)
            ->whereNotNull('_id')
            ->where('user_status', 1)
            ->orderBy('created_at', 'desc');
        // dd($startOfDay);

        if (!empty($requestData['search']['value'])) {
            $searchValue = $requestData['search']['value'];
            $Market->where(function ($q) use ($searchValue) {
                $regex = new \MongoDB\BSON\Regex($searchValue, 'i');
                $q->orWhere('FullName', 'regex', $regex)
                    ->orWhere('ref_code', 'regex', $regex)
                    ->orWhere('mob', 'regex', $regex)
                    ->orWhere('user_id', 'regex', $regex);
            });
        }
        if ($request->orderBy) {
            $Market = $Market->orderBy($request->orderBy, $request->ascending == 1 ? 'ASC' : 'DESC');
        }
        $Market = $Market->paginate($request->limit ? $request->limit : 20);
        $i = 0;
        $datas = [];
        foreach ($Market as $item) {
            $i++;
            $nestedData = array();
            $nestedData[] = $i;
            $nestedData[] = $item->FullName;
            $nestedData[] = $item->us_pass;
            $nestedData[] = $item->mob;
            // $nestedData[] = "<a href=' https://wa.me/$item->mob 'target='_blank'><button class='btn btn-success btn-icon-anim btn-circle'><i class='fa fa-whatsapp'></i></button></a>". '&nbsp&nbsp&nbsp'. '<input type="text" value="' . $item->mob . '" id="myInput_' . $item->id . '" style="display:none"><button class="bg-secondary refer-button cxy ml-2 d-flex" onclick="myFunction(' . $item->id . ')"> <span class="mr-2"></span>
            // <i class="fa fa-copy"></i>
            // </button>';
            $deposit = Point::where('user_id', $item->user_id)->where('tr_nature', 'TRDEPO002')->sum('tr_value');
            $withdraw = Point::where('user_id', $item->user_id)->where('tr_nature', 'TRWITH003')->sum('tr_value');
            $winnig = Point::where('user_id', $item->user_id)->where('tr_nature', 'TRWIN005')->sum('tr_value');
            $nestedData[] = $item->credit;
            $nestedData[] = $item->win_amount;
            $nestedData[] = $item->credit + $item->win_amount;
            $nestedData[] = $item->ref_code;
            $nestedData[] = $item->ref_by;
            $nestedData[] = date("d-m-Y h:i a", strtotime($item->created_at));
            // if ($item->status) {
            //     $message = "'Are you sure you want to Inactive the user?'";
            //     $nestedData[] = '<a href="' . url('/administrator/update-status/' . $item->id) . '" onclick="return confirm(' . $message . ')" title="Active"><i class="fa fa-toggle-on"></i></a>';
            // } else {
            //     $message = "'Are you sure you want to Active the user?'";
            //     $nestedData[] = '<a href="' . url('/administrator/update-status/' . $item->id) . '" onclick="return confirm(' . $message . ')" title="Inactive"><i class="fa fa-toggle-off"></i></a>';
            // }
            $result = '<a href="' . url('/administrator/result/' . $item->id) . '" title="Result"><button class="btn btn-primary ">Open Result</button></a>';
            $resultclose = '<a href="' . url('/administrator/result-close/' . $item->id) . '" title="Result"><button class="btn btn-primary ">Close Result</button></a>';
            $history = '<a href="' . url('/administrator/market/history/') . '" title="History"><button class="btn btn-warning ">History</button></a>';

            $editLink = '<a href="' . url('/administrator/user/edit/' . $item->_id) . '" title="Edit"><button class="btn btn-warning "><i class="fa fa-pencil"></i></button></a>';
            // $deleteLink = '<a href="' . url('/administrator/user/delete/' . $item->id) . ' " onclick="return confirm("Are you sure want to delete?")" title="Delete"><button class="btn btn-info "><i class="icon-trash"></i></button></a>';
            $deleteLink = '<a href="javascript:void(0);" onclick="deleteItem(' . $item->_id . ',this)" title="Delete"><button class="btn btn-info "><i class="icon-trash"></i></button></a>';
            $ViewLink = '<a href="' . url('/administrator/user/view/' . $item->_id) . ' " title="View"><button class="btn btn-primary"><i class="fa fa-eye"></i></button></a>';
            $depositLink = '<a href="' . url('/administrator/user/deposit/' . $item->_id) . '" title="Deposit"><button class="btn btn-success">Deposite</button></a>';
            $withdrawLink = '<a href="' . url('/administrator/user/withdraw/' . $item->_id) . '" title="Deposit"><button class="btn btn-info">Withdraw</button></a>';

            $nestedData[] = $depositLink . " " . $withdrawLink . " <br>" . $ViewLink . " " . $editLink . "  " . $deleteLink . "<br><br> ";
            // $nestedData[] = $ViewLink . " " . $editLink . "  " . $deleteLink . " " . $result . " " . $history;
            $datas[] = $nestedData;
        }
        ;

        return [
            'data' => $datas,
            'total' => intval($total),
            "recordsTotal" => intval($total),
            "recordsFiltered" => intval($total),
            'draw' => $request['draw']
        ];
    }

    public function deposit(Request $request, $id)
    {
        $select = $this->findUserByAdminRouteId($id);

        if (!$select) {
            return back()->with('error', 'User not found.');
        }

        return view('administrator.user.deposit', compact('select'));
    }

    public function withdrow(Request $request, $id)
    {
        $select = $this->findUserByAdminRouteId($id);
        if (!$select) {
            return redirect()->route('active_user')->with('error_message', 'User not found.');
        }
        return view('administrator.user.withdrow', compact('select'));
    }

    public function Win_withdrow(Request $request, $id)
    {
        $select = $this->findUserByAdminRouteId($id);
        if (!$select) {
            return redirect()->route('active_user')->with('error_message', 'User not found.');
        }
        return view('administrator.user.win_withdrow', compact('select'));
    }

    public function user_deposit(Request $request)
    {
        date_default_timezone_set("Asia/Calcutta");
        $this->validate(
            $request,
            [
                'deposit' => 'required',
            ]
        );
        // $balance=Helper::deposit_amount($request->id,$request->deposit);
        $all_user = $this->findUserByAdminRouteId($request->id);
        if (!$all_user) {
            return redirect()->route('active_user')->with('error_message', 'User not found.');
        }
        $date = date('d-m-Y');
        $total = $all_user->credit + $request->deposit;
        // dd($total);
        $all_user->update(['credit' => (int) $total]);
        $currentDateTime = Carbon::now();
        $newDateTime = $currentDateTime;
        $formattedDateTime = $newDateTime->format('Y-m-d H:i:s');

        $obj = new DepositHistory();
        $obj->user_id = $all_user->user_id;
        $obj->username = $all_user->FullName;
        $obj->mobile_number = $all_user->mob;
        $obj->app_id = 'com.dubaiking';
        $obj->transaction_id = rand('000000', '999999');
        $obj->admin_key = 'ADMIN0001';
        $obj->tr_nature = 'TRDEPO002';
        $obj->value_update_by = 'Deposit';
        $obj->tr_device = 'Deposit';
        $obj->transactionRef = 'Deposit-By-Admin';
        $obj->tr_value = (int) $request->deposit;
        $obj->tr_status = 'Success';
        $obj->date = $date;
        $obj->date_time = $formattedDateTime;
        if ($obj->save()) {

            $work = new Walletreport();
            $work->user_id = $all_user->user_id;
            $work->app_id = 'com.dubaiking';
            $work->transaction_id = rand('000000', '999999');
            $work->tr_value = $request->deposit;
            $work->tr_status = "Success";
            $work->type = "Credit";
            $work->tr_remark = "Deposit By Admin";
            $work->date = date('d-m-Y');
            $work->date_time = $formattedDateTime;
            $work->value_update_by = "Transfer";
            $work->tr_value_updated = (int) $total;
            $work->save();
        }

        return redirect()->route('active_user')->with('success_message', 'Deposit Amount has been  successfully.');
    }

    public function user_withdrow(Request $request)
    {

        $this->validate(
            $request,
            [
                'withdrow' => 'required',
            ]
        );
        $template = $this->findUserByAdminRouteId($request->id);
        if (!$template) {
            return redirect()->route('active_user')->with('error_message', 'User not found.');
        }
        // $all_user=User::where('id',$request->id)->first();

        if ($request->withdrow <= $template->credit) {
            // $balance=Helper::withdrow_amount($request->id,$request->withdrow);
            $total = $template->credit - $request->withdrow;
            // dd($total);
            $template->update(['credit' => $total]);

            // $obj=new Coins();
            // $obj->user_id = $request->id;
            // $obj->type = 'withdraw';
            // $obj->amount = $request->withdrow;
            // $obj->status = 'approve';
            // $obj->save();

            return redirect()->route('active_user')->with('success_message', 'Withdrow Amount has been  successfully.');
        } else {
            return redirect()->route('withdrow', ['id' => $request->id])->with('error_message', 'Your Amount has been  Insufficient.');
        }


    }

    public function user_win_withdrow(Request $request)
    {
        // dd($request->all());
        $this->validate(
            $request,
            [
                'withdrow' => 'required',
            ]
        );
        $template = $this->findUserByAdminRouteId($request->id);
        if (!$template) {
            return redirect()->route('active_user')->with('error_message', 'User not found.');
        }

        if ($request->withdrow <= $template->win_amount) {
            $total = $template->win_amount - $request->withdrow;
            $template->update(['win_amount' => $total]);

            return redirect()->route('active_user')->with('success_message', 'User Win Amount Withdraw Amount has been  successfully.');
        } else {
            return redirect()->route('win_withdrow', ['id' => $request->id])->with('error_message', 'Your Amount has been  Insufficient.');
        }

    }


    public function Edit(Request $request, $id)
    {
        $select = $this->findUserByAdminRouteId($id);
        if (!$select) {
            return redirect()->route('active_user')->with('error_message', 'User not found.');
        }
        return view('administrator.user.edit', compact('select'));
    }

    public function edit_store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'FullName' => 'required',
            'us_pass' => 'required',
            'markets_id' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = $this->findUserByAdminRouteId($request->markets_id);

        if (!$user) {
            return redirect()->back()->with('error_message', 'User not found.');
        }
        if ($request->ref_by) {
            $check_ref = User::where('ref_code', $request->ref_by)->count();
            if ($check_ref == 0) {
                return redirect()->back()->with('error_message', 'Invailid Reffer Code!');
            }

        }

        // Driver 2.x + library 2.x: avoid full model save() BSON re-serialization ("Expected integer or object, string given").
        $filter = $this->userUpdateFilterFromMarketsId($request->markets_id);
        $nowMs = (int) floor(microtime(true) * 1000);
        $set = [
            'FullName' => $request->FullName,
            'us_pass' => $request->us_pass,
            'ref_by' => $request->ref_by ?? '',
            'updated_at' => new UTCDateTime($nowMs),
        ];

        $result = User::raw(function ($collection) use ($filter, $set) {
            return $collection->updateOne($filter, ['$set' => $set]);
        });

        if (!$result instanceof \MongoDB\UpdateResult || $result->getMatchedCount() < 1) {
            return redirect()->back()->with('error_message', 'Could not update user. Please try again.');
        }

        return redirect()->route('active_user')->with('success_message', 'User updated successfully.');
    }

    // public function delete_user($id)
    // {
    //     //   dd('dasds');
    //     if ($select = User::find($id)) {

    //         $select->delete();
    //         Session::flash('success_message', 'One User has been deleted successfully!');
    //     } else {
    //         Session::flash('error_message', 'Please Try Again!');
    //     }
    //     return redirect()->back();
    // }



    public function delete_active_user($id)
    {
        // dd('dddd');
        $user = $this->findUserByAdminRouteId($id);
        if (!$user) {
            Session::flash('error_message', 'User not found.');
            return redirect()->back();
        }

        if (!empty($user->delete())) {

            Session::flash('success_message', 'User has been deleted successfully!');
        } else {
            Session::flash('error_message', 'Unable to delete the subadmin');
        }
    }



    public function getInactiveUserData(Request $request)
    {
        $requestData = $_REQUEST;
        // $total = User::count();
        // $Market = User::whereNotNull('id')->orderBy('id', 'desc')->where('user_status', 0);

        // $total = User::where('user_status', 0)->whereDate('last_seen','created_at')->count();
        // $Market = User::select('id','FullName','mob','us_pass','ref_code','ref_by','last_seen','user_status','created_at','credit','user_id')->whereDate('last_seen','created_at')->whereNotNull('id')->where('user_status', 0)->orderBy('created_at', 'desc');

        $total = User::where('user_status', 0)->whereDate('last_seen', '<', Carbon::now()->subDays(51)->toDateTimeString())->count();
        $Market = User::select('id', 'FullName', 'mob', 'note', 'us_pass', 'ref_code', 'ref_by', 'last_seen', 'user_status', 'is_kyc', 'created_at', 'credit', 'user_id')->whereDate('last_seen', '<', Carbon::now()->subDays(51)->toDateTimeString())->whereNotNull('id')->where('user_status', 0)->orderBy('created_at', 'desc');

        // dd($total);

        if (!empty($requestData['search']['value'])) {
            $searchValue = $requestData['search']['value'];
            $Market->where(function ($q) use ($searchValue) {
                $regex = new \MongoDB\BSON\Regex($searchValue, 'i');
                $q->orWhere('FullName', 'regex', $regex)
                    ->orWhere('ref_code', 'regex', $regex)
                    ->orWhere('mob', 'regex', $regex)
                    ->orWhere('user_id', 'regex', $regex);
            });
        }
        if ($request->orderBy) {
            $Market = $Market->orderBy($request->orderBy, $request->ascending == 1 ? 'ASC' : 'DESC');
        }
        $Market = $Market->paginate($request->limit ? $request->limit : 20);
        $i = 0;
        $datas = [];
        foreach ($Market as $item) {
            $i++;
            $nestedData = array();
            $nestedData[] = $i;
            $nestedData[] = $item->FullName;
            $nestedData[] = $item->us_pass;
            $nestedData[] = $item->mob;
            // $nestedData[] = "<a href=' https://wa.me/$item->mob 'target='_blank'><button class='btn btn-success btn-icon-anim btn-circle'><i class='fa fa-whatsapp'></i></button></a>". '&nbsp&nbsp&nbsp'. '<input type="text" value="' . $item->mob . '" id="myInput_' . $item->id . '" style="display:none"><button class="bg-secondary refer-button cxy ml-2 d-flex" onclick="myFunction(' . $item->id . ')"> <span class="mr-2"></span>
            // <i class="fa fa-copy"></i>
            // </button>';
            $deposit = Point::where('user_id', $item->user_id)->where('tr_nature', 'TRDEPO002')->sum('tr_value');
            $withdraw = Point::where('user_id', $item->user_id)->where('tr_nature', 'TRWITH003')->sum('tr_value');
            $winnig = Point::where('user_id', $item->user_id)->where('tr_nature', 'TRWIN005')->sum('tr_value');
            $nestedData[] = $item->credit;
            $nestedData[] = $item->win_amount;
            $nestedData[] = $item->credit + $item->win_amount;
            $nestedData[] = $item->ref_code;
            $nestedData[] = $item->ref_by;
            $nestedData[] = date("d-m-Y h:i a", strtotime($item->created_at));


            $editLink = '<a href="' . url('/administrator/user/edit/' . $item->id) . '" title="Edit"><button class="btn btn-warning "><i class="fa fa-pencil"></i></button></a>';
            $deleteLink = '<a href="' . url('/administrator/user/delete/' . $item->id) . ' " onclick="return confirm("Are you sure want to delete?")" title="Delete"><button class="btn btn-info "><i class="icon-trash"></i></button></a>';
            $ViewLink = '<a href="' . url('/administrator/user/view/' . $item->id) . ' " title="View"><button class="btn btn-primary"><i class="fa fa-eye"></i></button></a>';
            // $nestedData[] = $ViewLink . " " . $editLink . "  " . $deleteLink . "<br><br> ";
            // $nestedData[] = $ViewLink . " " . $editLink . "  " . $deleteLink . " " . $result . " " . $history;
            $datas[] = $nestedData;
        }
        ;

        return [
            'data' => $datas,
            'total' => intval($total),
            "recordsTotal" => intval($total),
            "recordsFiltered" => intval($total),
            'draw' => $request['draw']
        ];
    }

    public function getPlayingUserData(Request $request)
    {
        $requestData = $_REQUEST;
        $total = User::count();
        $Market = User::whereNotNull('id')->orderBy('id', 'desc')->where('is_play', 1);
        if ($requestData['search']['value']) {
            $Market = $Market->where('FullName', 'like', '%' . $requestData['search']['value'] . '%')->orWhere('mob', 'like', '%' . $requestData['search']['value'] . '%');
        }
        if ($request->orderBy) {
            $Market = $Market->orderBy($request->orderBy, $request->ascending == 1 ? 'ASC' : 'DESC');
        }
        $Market = $Market->paginate($request->limit ? $request->limit : 20);
        $i = 0;
        $datas = [];
        foreach ($Market as $item) {
            $i++;
            $nestedData = array();
            $nestedData[] = $i;
            $nestedData[] = "<a href='/administrator/user/view/$item->id'>$item->FullName</a>";
            $nestedData[] = $item->mob;
            $nestedData[] = "<a href=' https://wa.me/$item->mob 'target='_blank'><button class='btn btn-success btn-icon-anim btn-circle'><i class='fa fa-whatsapp'></i></button></a>" . '&nbsp&nbsp&nbsp' . '<input type="text" value="' . $item->mob . '" id="myInput_' . $item->id . '" style="display:none"><button class="bg-secondary refer-button cxy ml-2 d-flex" onclick="myFunction(' . $item->id . ')"> <span class="mr-2"></span>
            <i class="fa fa-copy"></i>
            </button>';
            $nestedData[] = $item->us_gender;
            $nestedData[] = $item->dob;
            // $nestedData[] = date("d-m-Y h:i a", strtotime($item->created_at));
            // if ($item->status) {
            //     $message = "'Are you sure you want to Inactive the user?'";
            //     $nestedData[] = '<a href="' . url('/administrator/update-status/' . $item->id) . '" onclick="return confirm(' . $message . ')" title="Active"><i class="fa fa-toggle-on"></i></a>';
            // } else {
            //     $message = "'Are you sure you want to Active the user?'";
            //     $nestedData[] = '<a href="' . url('/administrator/update-status/' . $item->id) . '" onclick="return confirm(' . $message . ')" title="Inactive"><i class="fa fa-toggle-off"></i></a>';
            // }
            // $changeLink = '<a href="' .url('/administrator/sub-admin/change-password/'.$item->id).'" title="Change Password"><button class="btn btn-primary btn-icon-anim btn-circle"><i class="fa fa-key"></i></button></a>';
            // $editLink = '<a href="' .url('/administrator/sub-admin/edit/'.$item->id).'" title="Edit"><button class="btn btn-warning btn-icon-anim btn-circle"><i class="fa fa-pencil"></i></button></a>';
            // $deleteLink = '<a href="' .url('/administrator/sub-admin/delete/'.$item->id).' " onclick="return confirm("Are you sure want to delete?")" title="Delete"><button class="btn btn-info btn-icon-anim btn-circle"><i class="icon-trash"></i></button></a>';
            $result = '<a href="' . url('/administrator/result/' . $item->id) . '" title="Result"><button class="btn btn-primary ">Open Result</button></a>';
            $resultclose = '<a href="' . url('/administrator/result-close/' . $item->id) . '" title="Result"><button class="btn btn-primary ">Close Result</button></a>';
            $history = '<a href="' . url('/administrator/market/history/') . '" title="History"><button class="btn btn-warning ">History</button></a>';

            $editLink = '<a href="' . url('/administrator/edit/' . $item->id) . '" title="Edit"><button class="btn btn-warning "><i class="fa fa-pencil"></i></button></a>';
            $deleteLink = '<a href="' . url('/administrator/delete/' . $item->id) . ' " onclick="return confirm("Are you sure want to delete?")" title="Delete"><button class="btn btn-info "><i class="icon-trash"></i></button></a>';
            $ViewLink = '<a href="' . url('/administrator/user/view/' . $item->id) . ' " title="View"><button class="btn btn-primary"><i class="fa fa-eye"></i></button></a>';
            $nestedData[] = $ViewLink . " " . $editLink . "  " . $deleteLink . "<br><br> ";
            // $nestedData[] = $ViewLink . " " . $editLink . "  " . $deleteLink . " " . $result . " " . $history;
            $datas[] = $nestedData;
        }
        ;

        return [
            'data' => $datas,
            'total' => intval($total),
            "recordsTotal" => intval($total),
            "recordsFiltered" => intval($total),
            'draw' => $request['draw']
        ];
    }
    public function getNotplayedUserData(Request $request)
    {
        $requestData = $_REQUEST;
        $total = User::count();
        $Market = User::whereNotNull('id')->orderBy('id', 'desc')->where('is_play', 0);
        if ($requestData['search']['value']) {
            $Market = $Market->where('FullName', 'like', '%' . $requestData['search']['value'] . '%')->orWhere('mob', 'like', '%' . $requestData['search']['value'] . '%');
        }
        if ($request->orderBy) {
            $Market = $Market->orderBy($request->orderBy, $request->ascending == 1 ? 'ASC' : 'DESC');
        }
        $Market = $Market->paginate($request->limit ? $request->limit : 20);
        $i = 0;
        $datas = [];
        foreach ($Market as $item) {
            $i++;
            $nestedData = array();
            $nestedData[] = $i;
            $nestedData[] = "<a href='/administrator/user/view/$item->id'>$item->FullName</a>";
            $nestedData[] = $item->mob;
            $nestedData[] = "<a href=' https://wa.me/$item->mob 'target='_blank'><button class='btn btn-success btn-icon-anim btn-circle'><i class='fa fa-whatsapp'></i></button></a>" . '&nbsp&nbsp&nbsp' . '<input type="text" value="' . $item->mob . '" id="myInput_' . $item->id . '" style="display:none"><button class="bg-secondary refer-button cxy ml-2 d-flex" onclick="myFunction(' . $item->id . ')"> <span class="mr-2"></span>
            <i class="fa fa-copy"></i>
            </button>';
            $nestedData[] = $item->us_gender;
            $nestedData[] = $item->dob;
            // $nestedData[] = date("d-m-Y h:i a", strtotime($item->created_at));
            // if ($item->status) {
            //     $message = "'Are you sure you want to Inactive the user?'";
            //     $nestedData[] = '<a href="' . url('/administrator/update-status/' . $item->id) . '" onclick="return confirm(' . $message . ')" title="Active"><i class="fa fa-toggle-on"></i></a>';
            // } else {
            //     $message = "'Are you sure you want to Active the user?'";
            //     $nestedData[] = '<a href="' . url('/administrator/update-status/' . $item->id) . '" onclick="return confirm(' . $message . ')" title="Inactive"><i class="fa fa-toggle-off"></i></a>';
            // }

            $editLink = '<a href="' . url('/administrator/user/notplaying-edit/' . $item->id) . '" title="Edit"><button class="btn btn-warning "><i class="fa fa-pencil"></i></button></a>';
            $deleteLink = '<a href="' . url('/administrator/delete/' . $item->id) . ' " onclick="return confirm("Are you sure want to delete?")" title="Delete"><button class="btn btn-info "><i class="icon-trash"></i></button></a>';
            $ViewLink = '<a href="' . url('/administrator/user/view/' . $item->id) . ' " title="View"><button class="btn btn-primary"><i class="fa fa-eye"></i></button></a>';
            $nestedData[] = $ViewLink . " " . $editLink . "  " . $deleteLink . "<br><br> ";
            // $nestedData[] = $ViewLink . " " . $editLink . "  " . $deleteLink . " " . $result . " " . $history;
            $datas[] = $nestedData;
        }
        ;

        return [
            'data' => $datas,
            'total' => intval($total),
            "recordsTotal" => intval($total),
            "recordsFiltered" => intval($total),
            'draw' => $request['draw']
        ];
    }

    public function notplaying_Edit(Request $request, $id)
    {
        $select = User::where('id', $id)->first();
        if (!$select) {
            return redirect()->route('Inactive_user')->with('error_message', 'User not found.');
        }
        return view('administrator.user.notplaying_edit', compact('select'));
    }

    public function notplaying_edit_store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'FullName' => 'required',
            'mob' => 'required',
            'dob' => 'required',
            'us_gender' => 'required',
        ]);

        if ($validator->fails()) {
            //    dd('ioo');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $insert['FullName'] = $request->FullName;
        $insert['mob'] = $request->mob;
        $insert['dob'] = $request->dob;
        $insert['us_gender'] = $request->us_gender;


        DB::table('us_reg_tbl')->where('id', $request->markets_id)->update($insert);
        return redirect()->route('notplaying_user')->with('success_message', 'User updated successfully.');

    }
    public function getOnlineUserData(Request $request)
    {
        $requestData = $_REQUEST;
        $total = User::count();
        $Market = User::whereNotNull('id')->orderBy('id', 'desc');
        if (!empty($requestData['search']['value'])) {
            $searchValue = $requestData['search']['value'];
            $Market->where(function ($q) use ($searchValue) {
                $regex = new \MongoDB\BSON\Regex($searchValue, 'i');
                $q->orWhere('FullName', 'regex', $regex)
                    ->orWhere('ref_code', 'regex', $regex)
                    ->orWhere('mob', 'regex', $regex)
                    ->orWhere('user_id', 'regex', $regex);
            });
        }
        if ($request->orderBy) {
            $Market = $Market->orderBy($request->orderBy, $request->ascending == 1 ? 'ASC' : 'DESC');
        }
        $Market = $Market->paginate($request->limit ? $request->limit : 20);
        $i = 0;
        $datas = [];
        foreach ($Market as $item) {
            $i++;
            $nestedData = array();
            $nestedData[] = $i;
            $nestedData[] = "<a href='/administrator/user/view/$item->_id'>$item->FullName</a>";
            $nestedData[] = $item->mob;
            $nestedData[] = "<a href=' https://wa.me/$item->mob 'target='_blank'><button class='btn btn-success btn-icon-anim btn-circle'><i class='fa fa-whatsapp'></i></button></a>" . '&nbsp&nbsp&nbsp' . '<input type="text" value="' . $item->mob . '" id="myInput_' . $item->id . '" style="display:none"><button class="bg-secondary refer-button cxy ml-2 d-flex" onclick="myFunction(' . $item->id . ')"> <span class="mr-2"></span>
            <i class="fa fa-copy"></i>
            </button>';
            $nestedData[] = $item->us_gender;
            $nestedData[] = $item->dob;
            // $nestedData[] = date("d-m-Y h:i a", strtotime($item->created_at));
            // if ($item->status) {
            //     $message = "'Are you sure you want to Inactive the user?'";
            //     $nestedData[] = '<a href="' . url('/administrator/update-status/' . $item->id) . '" onclick="return confirm(' . $message . ')" title="Active"><i class="fa fa-toggle-on"></i></a>';
            // } else {
            //     $message = "'Are you sure you want to Active the user?'";
            //     $nestedData[] = '<a href="' . url('/administrator/update-status/' . $item->id) . '" onclick="return confirm(' . $message . ')" title="Inactive"><i class="fa fa-toggle-off"></i></a>';
            // }
            // $changeLink = '<a href="' .url('/administrator/sub-admin/change-password/'.$item->id).'" title="Change Password"><button class="btn btn-primary btn-icon-anim btn-circle"><i class="fa fa-key"></i></button></a>';
            // $editLink = '<a href="' .url('/administrator/sub-admin/edit/'.$item->id).'" title="Edit"><button class="btn btn-warning btn-icon-anim btn-circle"><i class="fa fa-pencil"></i></button></a>';
            // $deleteLink = '<a href="' .url('/administrator/sub-admin/delete/'.$item->id).' " onclick="return confirm("Are you sure want to delete?")" title="Delete"><button class="btn btn-info btn-icon-anim btn-circle"><i class="icon-trash"></i></button></a>';
            $result = '<a href="' . url('/administrator/result/' . $item->id) . '" title="Result"><button class="btn btn-primary ">Open Result</button></a>';
            $resultclose = '<a href="' . url('/administrator/result-close/' . $item->id) . '" title="Result"><button class="btn btn-primary ">Close Result</button></a>';
            $history = '<a href="' . url('/administrator/market/history/') . '" title="History"><button class="btn btn-warning ">History</button></a>';

            $editLink = '<a href="' . url('/administrator/user/edit/' . $item->_id) . '" title="Edit"><button class="btn btn-warning "><i class="fa fa-pencil"></i></button></a>';
            $deleteLink = '<a href="' . url('/administrator/user/delete/' . $item->_id) . ' " onclick="return confirm("Are you sure want to delete?")" title="Delete"><button class="btn btn-info "><i class="icon-trash"></i></button></a>';
            $ViewLink = '<a href="' . url('/administrator/user/view/' . $item->_id) . ' " title="View"><button class="btn btn-primary"><i class="fa fa-eye"></i></button></a>';
            $nestedData[] = $ViewLink . " " . $editLink . "  " . $deleteLink . "<br><br> ";
            // $nestedData[] = $ViewLink . " " . $editLink . "  " . $deleteLink . " " . $result . " " . $history;
            $datas[] = $nestedData;
        }
        ;

        return [
            'data' => $datas,
            'total' => intval($total),
            "recordsTotal" => intval($total),
            "recordsFiltered" => intval($total),
            'draw' => $request['draw']
        ];
    }

    public function getUserIpData(Request $request)
    {
        $requestData = $_REQUEST;
        $total = User::get()->count();
        //$Market = User::whereNotNull('id')->orderBy('id', 'desc');
        //$Market = User::whereNotNull('id')->orderBy('id', 'desc')->groupBy('device_id');

        // $Market = User::select("*", DB::raw("count('device_id') as total"))
        // ->groupBy('device_id');
        $Market = User::groupBy('device_id');
        // dd($Market);

        if ($requestData['search']['value']) {
            $Market = $Market->where('FullName', 'like', '%' . $requestData['search']['value'] . '%')->orWhere('mob', 'like', '%' . $requestData['search']['value'] . '%');
        }
        if ($request->orderBy) {
            $Market = $Market->orderBy($request->orderBy, $request->ascending == 1 ? 'ASC' : 'DESC');
        }
        $Market = $Market->paginate($request->limit ? $request->limit : 20);
        $i = 0;
        $datas = [];
        foreach ($Market as $item) {
            $i++;
            $nestedData = array();
            $nestedData[] = $i;
            $ip = DB::table('us_reg_tbl')->where('device_id', $item->device_id)->get()->count();
            $nestedData[] = $item->device_id;
            $nestedData[] = $ip;
            // $nestedData[] = date("d-m-Y h:i a", strtotime($item->created_at));
            // if ($item->status) {
            //     $message = "'Are you sure you want to Inactive the user?'";
            //     $nestedData[] = '<a href="' . url('/administrator/update-status/' . $item->id) . '" onclick="return confirm(' . $message . ')" title="Active"><i class="fa fa-toggle-on"></i></a>';
            // } else {
            //     $message = "'Are you sure you want to Active the user?'";
            //     $nestedData[] = '<a href="' . url('/administrator/update-status/' . $item->id) . '" onclick="return confirm(' . $message . ')" title="Inactive"><i class="fa fa-toggle-off"></i></a>';
            // }

            $ViewLink = '<a href="' . url('/administrator/user/view-user-ip-data/' . $item->device_id) . ' " title="View"><button class="btn btn-primary"><i class="fa fa-eye"></i></button></a>';
            $nestedData[] = $ViewLink;
            // $nestedData[] = $ViewLink . " " . $editLink . "  " . $deleteLink . " " . $result . " " . $history;
            $datas[] = $nestedData;
        }
        ;

        return [
            'data' => $datas,
            'total' => intval($total),
            "recordsTotal" => intval($total),
            "recordsFiltered" => intval($total),
            'draw' => $request['draw']
        ];
    }

    public function userIpview(Request $request, $device_id)
    {
        // dd('Hello');
        // dd($request->device_id);
        $ip_user = User::where('device_id', $request->device_id)->get();
        return view('administrator.user.user_ip_view', compact('ip_user'));
    }


    public function TopTenUser(Request $request)
    {
        if (isset($_GET['mob'])) {
            $mob = $_GET['mob'];


            $array = User::where('mob', $mob)->orWhere('ref_by', $mob)->get();
            // dd($user);
            // if ($user) {
            // $array = User::where('ref_by', $user->ref_code)->get();

            // } else {

            //     $array = [];
            // }
            //  dd($get);

            return view('administrator.user.toptenuser', compact('array'));
        } else {
            $array = [];
            return view('administrator.user.toptenuser', compact('array'));
        }

    }


    public function User_commission_list(Request $request)
    {

    }
    public function User_report($id)
    {
        // dd($id);
        $report = PointTable::where('user_id', $id)->get();
        return view('administrator.user.user_report', compact('report'));
    }


    public function GetUserGameReportData(Request $request)
    {
        $columns = [
            0 => '_id',
            1 => 'tr_nature',
            2 => 'table_id',
            3 => 'status',
            4 => 'pred_num',
            5 => 'tr_value',
        ];

        $requestData = $request->all();
        $searchValue = $requestData['search']['value'] ?? null;
        $orderColumn = $columns[$requestData['order'][0]['column']] ?? 'date_time';
        $orderDirection = $requestData['order'][0]['dir'] === 'asc' ? 1 : -1;
        $limit = (int) ($requestData['length'] ?? 10);
        $offset = (int) ($requestData['start'] ?? 0);

        // **Step 1: Count Total Documents (Before Pagination)**
        $totalRecords = GameLoad::raw(function ($collection) use ($searchValue) {
            $pipeline = [
                [
                    '$lookup' => [
                        'from' => 'us_reg_tbl', // Users collection
                        'localField' => 'user_id',
                        'foreignField' => 'user_id',
                        'as' => 'user_data'
                    ]
                ],
                ['$match' => ['tr_nature' => 'TRGAME001']]
            ];

            if ($searchValue) {
                $pipeline[] = [
                    '$match' => [
                        '$or' => [
                            ['user_data.FullName' => ['$regex' => $searchValue, '$options' => 'i']],
                            ['user_data.mob' => ['$regex' => $searchValue, '$options' => 'i']],
                            ['user_id' => ['$regex' => $searchValue, '$options' => 'i']]
                        ]
                    ]
                ];
            }

            return $collection->aggregate($pipeline);
        });

        $total = iterator_count($totalRecords); // Get total count

        // **Step 2: Fetch Data with Pagination**
        $Market = GameLoad::raw(function ($collection) use ($searchValue, $orderColumn, $orderDirection, $offset, $limit) {
            $pipeline = [
                [
                    '$lookup' => [
                        'from' => 'us_reg_tbl',
                        'localField' => 'user_id',
                        'foreignField' => 'user_id',
                        'as' => 'user_data'
                    ]
                ],
                ['$match' => ['tr_nature' => 'TRGAME001']],
                ['$sort' => [$orderColumn => $orderDirection]],
                ['$skip' => $offset],
                ['$limit' => $limit]
            ];

            if ($searchValue) {
                $pipeline[] = [
                    '$match' => [
                        '$or' => [
                            ['user_data.FullName' => ['$regex' => $searchValue, '$options' => 'i']],
                            ['user_data.mob' => ['$regex' => $searchValue, '$options' => 'i']],
                            ['user_id' => ['$regex' => $searchValue, '$options' => 'i']]
                        ]
                    ]
                ];
            }

            return $collection->aggregate($pipeline);
        });

        // **Step 3: Convert MongoDB Cursor to Array**
        $Market = iterator_to_array($Market);

        // **Step 4: Process Data**
        $datas = [];
        $i = $offset;
        foreach ($Market as $item) {
            // $gameType = match ($item['game_type'] ?? 0) {
            //     1 => "Single Digit",
            //     2 => "Jodi Digit",
            //     3 => "Single Pana",
            //     4 => "Double Pana",
            //     5 => "Triple Pana",
            //     6 => "Half Sangam",
            //     7 => "Full Sangam",
            //     8 => "Jodi",
            //     9 => "Andar",
            //     10 => "Bahar",
            //     11 => "Crossing",
            //     12 => "Number To Number",
            //     default => "Unknown"
            // };

            $datas[] = [
                ++$i,
                $item['table_id'] ?? 'N/A',
                $gameType ?? 0,
                $item['pred_num'] ?? 'N/A',
                $item['tr_value'] ?? 'N/A',
                // $item['status'] ?? 'N/A',
                date("h:i A", strtotime($item['date_time'] ?? '')),
                $item['date'] ?? 'N/A'
            ];
        }

        // **Step 5: Return JSON Response**
        return [
            'data' => $datas,
            'total' => $total,
            "recordsTotal" => $total,
            "recordsFiltered" => $total,
            'draw' => (int) ($request['draw'] ?? 1)
        ];
    }



    public function User_Wallet_History($id)
    {

        $user = $this->findUserByAdminRouteId($id);
        if (!$user) {
            return redirect()->route('active_user')->with('error_message', 'User not found.');
        }

        $user_wallet = Walletreport::where('user_id', $user->user_id)->whereIn('tr_nature', ['TRWIN005', 'TRDEPO002'])->get();

        return view('administrator.user.userwallet_history', compact('user_wallet'));
    }

    public function UserBnned($id)
    {
        $user = $this->findUserByAdminRouteId($id);
        if ($user) {
            $user->banned = $user->banned == 1 ? 0 : 1;
            $user->save();

            Session::flash('success_message', 'User banned status updated successfully!');
        } else {
            Session::flash('error_message', 'User not found.');
        }

        return redirect()->back();
    }

    public function UserRefferReport(Request $request)
    {
        if (isset($_GET['mob'])) {
            if ($_GET['mob']) {
                $all_users = User::where('user_status', 1)->where('mob', $_GET['mob'])
                    ->select('ref_code', 'user_id', 'FullName', 'mob')
                    ->get();
            }
        } else {
            $all_users = User::where('user_status', 1)
                ->select('ref_code', 'user_id', 'FullName', 'mob')
                ->get();
        }


        $result = [];

        foreach ($all_users as $user) {
            $refCount = User::where('ref_by', $user->ref_code)->count();

            if ($refCount > 0) {
                $result[] = [
                    'user_id' => $user->user_id,
                    'user_name' => $user->FullName,
                    'user_mobile' => $user->mob,
                    'ref_code' => $user->ref_code,
                    'reffer_count' => $refCount,
                ];
            }
        }
        // print_r($result[0]['user_id']);die;
        $topUsers = collect($result)->sortByDesc('reffer_count')->values();

        return view('administrator.user.reffer_report', ['users' => $topUsers]);
    }


    public function reffer_report_view(Request $request,$ref_code)
    {
        // print_r($ref_code);die;
        $refferData = User::where('ref_by', (string)$ref_code)->get();
        
        return view('administrator.user.reffer_report_view', ['users' => $refferData]);
    }




}