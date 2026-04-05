<?php

namespace App\Http\Controllers\Administrator;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StarlineGameRate;
use App\Models\Result;
use App\Models\Point;
use App\Models\PointTable;
use App\Models\DepositHistory;
use App\Models\User;
use App\Models\Walletreport;
use App\Models\BonusReport;
use Session;
use Hash;
use DB;
use App\Helpers\Helper;
use Carbon\Carbon;
use MongoDB\BSON\Regex;

class DepositManagementController extends Controller
{
    public function __construct()
    {

    }

    /*-------Show List Page ---------*/
    public function index()
    {
        return view('administrator.galidisawar.index');
    }

    public function deposit_pending()
    {
        return view('administrator.deposit_management.pending');
    }
    public function deposit_success()
    {
        return view('administrator.deposit_management.success');
    }

    public function deposit_old()
    {
        return view('administrator.deposit_management.deposit_old');
    }

    public function deposit_cancelled()
    {
        return view('administrator.deposit_management.cancelled');
    }
    public function deposit_dateway_pending()
    {
        return view('administrator.deposit_management.datewaypending');
    }



    public function DateDepositManageData(Request $request)
    {

        $requestData = $_REQUEST;
        $columns = array(
            0 => 'deposit_history._id',
            1 => 'deposit_history.tr_value',
            2 => 'deposit_history.user_id',
            3 => 'deposit_history.tr_status',
            4 => 'deposit_history.date',
            5 => 'deposit_history.tr_nature',
        );

        $totalItems = DepositHistory::where('tr_status', 'Success')->where('tr_nature', 'TRDEPO002')->groupBy('date')->count();
        $totalFiltered = $totalItems;
        $items = DepositHistory::orderBy('id', 'desc')->where('tr_nature', 'TRDEPO002')->where('tr_status', 'Success')->groupBy("date");


        // new
        if (!empty($request->deposit_date)) {
            $format_date = date("d-m-Y", strtotime($request->deposit_date));
            $items = DepositHistory::where('date', $format_date)->where('tr_nature', 'TRDEPO002')->where('tr_status', 'Success')->groupBy("date");
        }

        if ($requestData['search']['value']) {
            $filtered = $requestData['search']['value'];
            $items = $items->where('date', 'Like', '%' . $filtered . '%')->whereHas('user_data', function ($q) use ($filtered) {
                $q->where('FullName', 'Like', '%' . $filtered . '%')->orwhere('mob', 'Like', '%' . $filtered . '%');
            });
        }

        if ($request->orderBy) {
            $point = $items->orderBy($request->orderBy, $request->ascending == 1 ? 'ASC' : 'DESC');
        }

        $orderColumn = $columns[$requestData['order'][0]['column']];
        $orderColumnDir = $requestData['order'][0]['dir'];
        $limit = $requestData['length'];
        $offset = $requestData['start'];

        $items = $items->offset($offset)->limit((int) $limit)->orderBy($orderColumn, $orderColumnDir)->get();
        $datas = array();
        $i = $offset;
        // new close

        foreach ($items as $item) {
            //PointTable::where('tr_status','Success')->groupBy("date")->sum('tr_value');
            $i++;
            $date = $item->date;
            $nestedData = array();
            $nestedData[] = $i;
            // $nestedData[] = is_null($item->user_data) ? "NA" : $item->user_data->FullName;
            // $nestedData[] = is_null($item->user_data) ? "NA" : $item->user_data->mob;
            $widthraw_amount = Helper::depositamout($date);
            $nestedData[] = $widthraw_amount;
            $widthraw_amount_count = Helper::depositamout_count($date);
            $nestedData[] = $widthraw_amount_count;
            // $nestedData[] = $item->tr_remark;
            $nestedData[] = date("d-m-Y", strtotime($item->date));
            // $nestedData[] = date("h:i:s a", strtotime($item->created_at));
            $nestedData[] = $item->tr_status;

            $ViewLink = '<a href="' . url('/administrator/game/deposit-success-view/' . date("Y-m-d", strtotime($item->date))) . ' " title="View"><button class="btn btn-primary">View</button></a>';
            $nestedData[] = $ViewLink;


            $datas[] = $nestedData;
        }
        ;

        $json_data = array(
            "draw" => intval($requestData['draw']),
            "recordsTotal" => intval($totalItems),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $datas
        );

        echo json_encode($json_data);
    }
    public function deposit_success_view($date)
    {
        $select = DepositHistory::where('tr_status', 'Success')->where('tr_nature', 'TRDEPO002')->where('date', date('d-m-Y', strtotime($date)))->get();
        return view('administrator.deposit_management.view', compact('select', 'date'));
    }
    public function depositManageData_pending(Request $request)
    {

        $requestData = $_REQUEST;
        $columns = array(
            0 => 'deposit_history._id',
            1 => 'deposit_history.tr_value',
            2 => 'deposit_history.user_id',
            3 => 'deposit_history.tr_status',
            4 => 'deposit_history.date',
            5 => 'deposit_history.tr_nature',
        );

        $totalItems = DepositHistory::where('tr_nature', 'TRDEPO002')->where('tr_status', 'Pending')->get()->count();
        $totalFiltered = $totalItems;
        $items = DepositHistory::where('tr_nature', 'TRDEPO002')->orderBy('created_at', 'desc')->where('tr_status', 'Pending');

        // Search Filter
        if (!empty($requestData['search']['value'])) {
            $filtered = $requestData['search']['value'];
            $items = $items->orWhere('username', 'like', '%' . $filtered . '%')->orWhere('mobile_number', 'like', '%' . $filtered . '%');
            
            // whereHas('user_data', function ($q) use ($filtered) {
            //     $q->where('FullName', 'like', '%' . $filtered . '%')
            //         ->orWhere('mob', 'like', '%' . $filtered . '%');
            // });
        }

        if (!empty($request->market_date)) {
            $date = date('d-m-Y', strtotime($request->market_date));
            $items = $items->where('date', $date);
        }

        if ($request->orderBy) {
            $point = $items->orderBy($request->orderBy, $request->ascending == 1 ? 'ASC' : 'DESC');
        }

        $orderColumn = $columns[$requestData['order'][0]['column']];
        $orderColumnDir = $requestData['order'][0]['dir'];
        $limit = $requestData['length'];
        $offset = $requestData['start'];

        $items = $items->offset($offset)->limit((int) $limit)->orderBy($orderColumn, $orderColumnDir)->get();
        $datas = array();

        $i = $offset;
        $datas = [];
        foreach ($items as $item) {
            $i++;
            $nestedData = array();
            // $nestedData[] = $i;

            $nestedData[] = '<input type="checkbox" id="' . $item->id . '" class="checkBoxClass table_check" name="DepositSelected[]" value="' . $item->id . '">' . '<span class="sr_no">' . $i . '</span>';

            // $nestedData[] = '<input type="checkbox" id="' . $item->user_id . '" date="' . $item->date . '" class="checkBoxClass" name="DepositSelected[]" value="' . $item->user_id . '|' . $item->date . '">' . $i;

            $nestedData[] = is_null($item->user_data) ? "NA" : $item->user_data->FullName;
            $nestedData[] = is_null($item->user_data) ? "NA" : $item->user_data->mob;
            $nestedData[] = $item->tr_value;
            $nestedData[] = $item->transactionRef;
            // $nestedData[] = is_null($item->order_id) ? "NA" : $item->order_id;
            $nestedData[] = is_null($item->image)
                ? '<span>NA</span>'
                : '<a href="' . asset("/backend/uploads/payment_reciept/" . $item->image) . '" target="_blank">
         <img src="' . asset("/backend/uploads/payment_reciept/" . $item->image) . '" alt="Receipt Image" style="width: 60px; border-radius: 4px;">
       </a>';

            $nestedData[] = $item->tr_status;
            $nestedData[] = date("H:i:s", strtotime($item->created_at));
            $nestedData[] = date("d-m-Y", strtotime($item->created_at));


            $editpending_data = '<a href="' . url('/administrator/edit-deposit-pending-data/' . $item->id) . '" title="Edit"><button class="btn btn-warning ">Edit</button></a>';
            $editLink = '<a href="' . url('/administrator/deposit-approve/' . $item->id) . '" title="Approve"><button class="btn btn-warning ">Approve</button></a>';
            // $deleteLink = '<a href="' . url('/administrator/delete/' . $item->id) . ' " onclick="return confirm("Are you sure want to delete?")" title="Delete"><button class="btn btn-info "><i class="icon-trash"></i></button></a>';
            $ViewLink = '<a href="' . url('/administrator/deposit-cancelled/' . $item->id) . ' " title="Cancelled"><button class="btn btn-primary">Cancelled</button></a>';

            // $getallUserSeletedIds = '<a href="javascript:void(0);" onclick="getallUserSeletedIds(' .$item->id . ',this)" title="checkbox"><input type="checkbox"></a>';

            $nestedData[] = $editpending_data;
            // $nestedData[] = $ViewLink . " " . $editLink . "  " . $deleteLink . " " . $result . " " . $history;
            $datas[] = $nestedData;
        }
        ;

        // $json_data = array(
        //     "draw" => intval($requestData['draw']),
        //     "recordsTotal" => intval($totalItems),
        //     "recordsFiltered" => intval($totalFiltered),
        //     "data" => $datas
        // );

        // echo json_encode($json_data);
        return [
            'data' => $datas,
            'total' => intval($i),
            "recordsTotal" => intval($i),
            "recordsFiltered" => intval($i),
            'draw' => $request['draw']
        ];
    }
    public function withdraw_cancel($id)
    {
        $dta = DepositHistory::where('id', $id)->first();
        $user = DB::table('us_reg_tbl')->where('user_id', $dta->user_id)->first();
        $amount = $user->credit + $dta->tr_value;
        DB::table('us_reg_tbl')->where('user_id', $dta->user_id)->update(['credit' => $amount]);
        DepositHistory::where('id', $id)->update(['tr_status' => 'Cancelled']);

        return redirect('administrator/game/withdraw-pending');
    }
    // public function deposit_approve(Request $request)
    // {   

    //     $user = $request->userIds;
    //     foreach ($user as $vs) {

    //         $point = DepositHistory::where('_id', $vs)->first();

    //         $user = User::where('user_id', $point->user_id)->first();

    //         $amt = $user->credit + $point->tr_value;
    //         $walletdata = [
    //             'user_id' => $point->user_id,
    //             'app_id' => 'com.dubaiking',
    //             'transaction_id' => $point->transaction_id,
    //             'tr_value' => $point->tr_value,
    //             'tr_status' => "Success",
    //             'tr_nature' => "TRDEPO002",
    //             'type' => "Credit",
    //             'tr_remark' => "Online",
    //             'date' => date('d-m-Y'),
    //             'date_time' => date('Y-m-d H:i:s',strtotime($point->date_time)),
    //             'value_update_by' => "Deposit",
    //             'tr_value_updated' => $amt,
    //         ];
    //         DB::table('wallet_reports')->insert($walletdata);

    //         $user = User::where('user_id', $point->user_id)->update(['credit' => $amt]);
    //         DepositHistory::where('id', $vs)->update(['tr_status' => 'Success']);
    //     }

    //     return redirect('administrator/game/deposit-pending');
    // }

    public function deposit_approve(Request $request)
    {
        // Check if userIds exist in the request
        if (!$request->has('userIds') || empty($request->userIds)) {
            return redirect()->back()->with('error_message', 'No users selected for deposit approval.');
        }

        foreach ($request->userIds as $vs) {
            $point = DepositHistory::where('_id', $vs)->first();
            if (!$point) {
                continue;
            }

            $user = User::where('user_id', $point->user_id)->first();
            if (!$user) {
                continue;
            }

            $amt = $user->credit + $point->tr_value;
            $user->update(['credit' => $amt]);

            $walletData = [
                'user_id' => $point->user_id,
                'app_id' => 'com.dubaiking',
                'transaction_id' => $point->transaction_id,
                'tr_value' => $point->tr_value,
                'tr_status' => "Success",
                'tr_nature' => "TRDEPO002",
                'type' => "Credit",
                'tr_remark' => "Online",
                'date' => Carbon::now()->format('d-m-Y'),
                'date_time' => Carbon::parse($point->date_time)->format('Y-m-d H:i:s'),
                'value_update_by' => "Deposit",
                'tr_value_updated' => $amt,
            ];

            Walletreport::create($walletData);
            DepositHistory::where('_id', $vs)->update(['tr_status' => 'Success']);
        }

        return redirect()->back()->with('success_message', 'Deposits approved successfully.');
    }

    public function deposit_cancel(Request $request)
    {
        
        // $point = Point::where('id', $id)->first();
        // $user = User::where('user_id', $point->user_id)->first();
        // $amt = $user->credit - $point->tr_value;
        // $user = User::where('user_id', $point->user_id)->update(['credit' => $amt]);
        $user = $request->userIds;
        foreach ($user as $vs) {
            
            $depositData = DepositHistory::where('_id', $vs)->first();
            // dd($depositData);
            $user = User::where('user_id', $depositData->user_id)->first();
            $walletData = [
                'user_id' => $depositData->user_id,
                'app_id' => 'com.dubaiking',
                'transaction_id' => $depositData->transaction_id,
                'tr_value' => $depositData->tr_value,
                'tr_status' => "Cancelled",
                'tr_nature' => "TRDEPO002",
                'type' => "Credit",
                'tr_remark' => "Online",
                'date' => Carbon::now()->format('d-m-Y'),
                'date_time' => Carbon::parse($depositData->date_time)->format('Y-m-d H:i:s'),
                'value_update_by' => "Deposit",
                'tr_value_updated' => $user->credit+$user->win_amount,
            ];
            DepositHistory::where('_id', $vs)->update(['tr_status' => 'Cancelled']);
            Walletreport::create($walletData);
        }
        return redirect()->back();
    }
    public function depositManageData_success(Request $request)
    {
        $requestData = $_REQUEST;
        $columns = array(
            0 => 'deposit_history._id',
            1 => 'deposit_history.user_id',
            2 => 'deposit_history.tr_status',
            3 => 'deposit_history.date',
            4 => 'deposit_history.tr_nature',
        );
        $date = date('d-m-Y');

        $totalItems = DepositHistory::where('date', $date)->where('tr_nature', 'TRDEPO002')->where('tr_status', 'Success')->get()->count();
        $totalFiltered = $totalItems;

        $items = DepositHistory::where('tr_nature', 'TRDEPO002')->where('date', $date)->orderBy('_id', 'desc')->where('tr_status', 'Success', 'Deposit_By_Admin');

        if ($requestData['search']['value']) {
            $filtered = $requestData['search']['value'];
             $items = $items->orWhere('username', 'like', '%' . $filtered . '%')->orWhere('mobile_number', 'like', '%' . $filtered . '%');
            // $items = $items->whereHas('user_data', function ($q) use ($filtered) {
            //     $q->where('FullName', 'Like', '%' . $filtered . '%')->orwhere('mob', 'Like', '%' . $filtered . '%');
            // });
        }
        if ($request->orderBy) {
            $point = $items->orderBy($request->orderBy, $request->ascending == 1 ? 'ASC' : 'DESC');
        }
        if (!empty($request->market_date)) {
            $market_date = date('d-m-Y', strtotime($request->market_date));

            $items = DepositHistory::where('tr_nature', 'TRDEPO002')->orderBy('created_at', 'desc')->where('tr_status', 'Success')->where('date', $market_date);
        }
        $orderColumn = $columns[$requestData['order'][0]['column']];
        $orderColumnDir = $requestData['order'][0]['dir'];
        $limit = $requestData['length'];
        $offset = $requestData['start'];

        $items = $items->offset($offset)->limit((int) $limit)->orderBy($orderColumn, $orderColumnDir)->get();
        $datas = array();
        $i = $offset;
        foreach ($items as $item) {
            $i++;
            $nestedData = array();
            // $nestedData[] = $i;
            $nestedData[] = '<input type="checkbox" id="' . $item->id . '" class="checkBoxClass table_check" name="DepositSelected[]" value="' . $item->id . '">' . '<span class="sr_no">' . $i . '</span>';
            $nestedData[] = is_null($item->user_data) ? "NA" : $item->user_data->FullName;
            $nestedData[] = is_null($item->user_data) ? "NA" : $item->user_data->mob;
            // $nestedData[] = is_null($item->user_id)?"NA":$item->user_id;
            $nestedData[] = $item->tr_value;
            $nestedData[] = $item->transactionRef;
            // $nestedData[] = date("h:i:s", strtotime($item->created_at));
            $nestedData[] = date("H:i:s", strtotime($item->created_at));
            $nestedData[] = date("d-m-Y", strtotime($item->created_at));
            // $nestedData[] = $item->status;
            $nestedData[] = $item->tr_status;

            // $approve = '<a href="' . url('/administrator/deposit-approve/' . $item->id) . '" title="Approve"><button class="btn btn-warning ">Approve</button></a>';
            // $deleteLink = '<a href="' . url('/administrator/delete/' . $item->id) . ' " onclick="return confirm("Are you sure want to delete?")" title="Delete"><button class="btn btn-info "><i class="icon-trash"></i></button></a>';
            $candelled = '<a href="' . url('/administrator/success-deposit-cancelled/' . $item->id) . ' " title="Cancelled"><button class="btn btn-primary">Cancelled</button></a>';
            // $nestedData[] = $candelled;
            $datas[] = $nestedData;
        }
        ;

        $json_data = array(
            "draw" => intval($requestData['draw']),
            "recordsTotal" => intval($totalItems),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $datas
        );

        echo json_encode($json_data);
    }

    // public function depositManageData_cancelled(Request $request)
    // {
    //     $requestData = $_REQUEST;
    //     $columns = array(
    //         0 => 'deposit_history._id',
    //         1 => 'deposit_history.tr_value',
    //         2 => 'deposit_history.user_id',
    //         3 => 'deposit_history.tr_status',
    //         4 => 'deposit_history.date',
    //         5 => 'deposit_history.tr_nature',
    //     );
    //     $totalItems = DepositHistory::where('tr_nature', 'TRDEPO002')->where('tr_status', 'Cancelled')->get()->count();
    //     $totalFiltered = $totalItems;
    //     $items = DepositHistory::where('tr_nature', 'TRDEPO002')->orderBy('created_at', 'desc')->where('tr_status', 'Cancelled');

    //     if (!empty($requestData['search']['value'])) {
    //         $filtered = $requestData['search']['value'];

    //         $items = DepositHistory::raw(function ($collection) use ($filtered) {
    //             return $collection->aggregate([
    //                 [
    //                     '$lookup' => [
    //                         'from' => 'users',
    //                         'localField' => 'user_id',
    //                         'foreignField' => 'user_id',
    //                         'as' => 'user_data'
    //                     ]
    //                 ],
    //                 [
    //                     '$match' => [
    //                         '$or' => [
    //                             ['user_data.FullName' => new Regex($filtered, 'i')],
    //                             ['user_data.mob' => new Regex($filtered, 'i')]
    //                         ]
    //                     ]
    //                 ]
    //             ]);
    //         });
    //     }


    //     if (!empty($request->market_date)) {
    //         $market_date = date('d-m-Y', strtotime($request->market_date));
    //         $items = DepositHistory::where('tr_nature', 'TRDEPO002')->orderBy('created_at', 'desc')->where('tr_status', 'Cancelled')->where('date', $market_date);
    //     }

    //     if ($request->orderBy) {
    //         $items = $items->orderBy($request->orderBy, $request->ascending == 1 ? 'ASC' : 'DESC');
    //     }
    //     $orderColumn = $columns[$requestData['order'][0]['column']];
    //     $orderColumnDir = $requestData['order'][0]['dir'];
    //     $limit = $requestData['length'];
    //     $offset = $requestData['start'];

    //     $items = $items->offset($offset)->limit($limit)->orderBy($orderColumn, $orderColumnDir)->get();
    //     $datas = array();
    //     $i = $offset;

    //     foreach ($items as $item) {
    //         $i++;
    //         $nestedData = array();
    //         // $nestedData[] = $i;
    //         $nestedData[] = '<input type="checkbox" id="' . $item->id . '" class="checkBoxClass table_check" name="DepositSelected[]" value="' . $item->id . '">' . '<span class="sr_no">' . $i . '</span>';
    //         $nestedData[] = is_null($item->user_data) ? "NA" : $item->user_data->FullName;
    //         $nestedData[] = is_null($item->user_data) ? "NA" : $item->user_data->mob;
    //         // $nestedData[] = is_null($item->user_id)?"NA":$item->user_id;
    //         $nestedData[] = $item->tr_value;
    //         $nestedData[] = $item->transactionRef;
    //         $nestedData[] = $item->tr_status;
    //         $nestedData[] = date("H:i:s", strtotime($item->created_at));
    //         $nestedData[] = date("d-m-Y", strtotime($item->created_at));

    //         // if ($item->status) {
    //         //     $message = "'Are you sure you want to Inactive the user?'";
    //         //     $nestedData[] = '<a href="' . url('/administrator/update-status/' . $item->id) . '" onclick="return confirm(' . $message . ')" title="Active"><i class="fa fa-toggle-on"></i></a>';
    //         // } else {
    //         //     $message = "'Are you sure you want to Active the user?'";
    //         //     $nestedData[] = '<a href="' . url('/administrator/update-status/' . $item->id) . '" onclick="return confirm(' . $message . ')" title="Inactive"><i class="fa fa-toggle-off"></i></a>';
    //         // }


    //         // $editLink = '<a href="' . url('/administrator/approve/' . $item->id) . '" title="Edit"><button class="btn btn-warning ">Approve</button></a>';
    //         // $deleteLink = '<a href="' . url('/administrator/delete/' . $item->id) . ' " onclick="return confirm("Are you sure want to delete?")" title="Delete"><button class="btn btn-info "><i class="icon-trash"></i></button></a>';
    //         // $ViewLink = '<a href="' . url('/administrator/cancelled/' . $item->id) . ' " title="View"><button class="btn btn-primary">Cancelled</button></a>';
    //         $approve = '<a href="' . url('/administrator/deposit-approve/' . $item->id) . '" title="Approve"><button class="btn btn-warning ">Approve</button></a>';
    //         // $nestedData[] = $approve;
    //         // $nestedData[] = $ViewLink . " " . $editLink . "  " . $deleteLink . " " . $result . " " . $history;
    //         $datas[] = $nestedData;
    //     }
    //     ;

    //     $json_data = array(
    //         "draw" => intval($requestData['draw']),
    //         "recordsTotal" => intval($totalItems),
    //         "recordsFiltered" => intval($totalFiltered),
    //         "data" => $datas
    //     );
    //     echo json_encode($json_data);
    // }

    public function depositManageData_cancelled(Request $request)
    {
        $requestData = $request->all();
        $columns = [
            0 => 'deposit_history._id',
            1 => 'deposit_history.tr_value',
            2 => 'deposit_history.user_id',
            3 => 'deposit_history.tr_status',
            4 => 'deposit_history.date',
            5 => 'deposit_history.tr_nature',
        ];

        $query = DepositHistory::where('tr_nature', 'TRDEPO002')->where('tr_status', 'Cancelled');

        if (!empty($requestData['search']['value'])) {
            $filtered = $requestData['search']['value'];
            // $query = $query->where(function ($q) use ($filtered) {
            //     $q->orWhere('user_data.FullName', 'like', "%$filtered%")
            //         ->orWhere('user_data.mob', 'like', "%$filtered%");
            // });
             $query = $query->orWhere('username', 'like', '%' . $filtered . '%')->orWhere('mobile_number', 'like', '%' . $filtered . '%');
        }

        if (!empty($request->market_date)) {
            $market_date = date('d-m-Y', strtotime($request->market_date));
            $query = $query->where('date', $market_date);
        }

        if ($request->orderBy) {
            $query = $query->orderBy($request->orderBy, $request->ascending == 1 ? 'ASC' : 'DESC');
        }

        $totalItems = $query->count();
        $totalFiltered = $totalItems;

        $orderColumn = $columns[$requestData['order'][0]['column']] ?? 'created_at';
        $orderColumnDir = $requestData['order'][0]['dir'] ?? 'desc';
        $limit = $requestData['length'] ?? 10;
        $offset = $requestData['start'] ?? 0;

        $items = $query->offset($offset)->limit((int) $limit)->orderBy($orderColumn, $orderColumnDir)->get();

        $datas = [];
        foreach ($items as $index => $item) {
            $datas[] = [
                '<input type="checkbox" id="' . $item->_id . '" class="checkBoxClass table_check" name="DepositSelected[]" value="' . $item->_id . '">' . '<span class="sr_no">' . ($offset + $index + 1) . '</span>',
                optional($item->user_data)->FullName ?? 'NA',
                optional($item->user_data)->mob ?? 'NA',
                $item->tr_value,
                $item->transactionRef,
                $item->tr_status,
                date('H:i:s', strtotime($item->created_at)),
                date('d-m-Y', strtotime($item->created_at)),
                '<a href="' . url('/administrator/deposit-approve/' . $item->_id) . '" title="Approve"><button class="btn btn-warning">Approve</button></a>'
            ];
        }

        return response()->json([
            "draw" => intval($requestData['draw'] ?? 1),
            "recordsTotal" => intval($totalItems),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $datas
        ]);
    }

    public function success_deposit_cancel(Request $request)
    {
        $user = $request->userIds;
        foreach ($user as $vs) {

            $point = DepositHistory::where('_id', $vs)->first();
            $user = User::where('user_id', $point->user_id)->first();
            $amt = $user->credit - $point->tr_value;
            $user = User::where('user_id', $point->user_id)->update(['credit' => (int) $amt]);
            DepositHistory::where('_id', $vs)->update(['tr_status' => 'Cancelled']);
        }
        Session::flash('success_message', 'Request Cancelled successfully!');
        return redirect()->back();
    }

    public function Edit_Deposit_Pending_Data(Request $request, $id)
    {
        $point = DepositHistory::where('_id', $id)->first();
        return view('administrator.deposit_management.edit', compact('point'));
    }

    public function Update_Deposit_Pending_Data(Request $request)
    {

        $response = DepositHistory::where('_id', $request->id)->update(['tr_value' => $request->amount]);
        if ($response) {
            Session::flash('success_message', 'Data Updated successfully!');
            return redirect('administrator/game/deposit-pending');
        } else {
            Session::flash('error_message', 'Please Try Again!');
            return redirect()->back();
        }
    }

    public function depositManageData_old(Request $request)
    {
        $requestData = $_REQUEST;
        $columns = array(
            0 => 'point_table.id',
            1 => 'point_table.user_id',
            2 => 'point_table.tr_status',
            3 => 'point_table.date',
            4 => 'point_table.tr_nature',
        );
        $totalItems = DB::table('point_table')->where('tr_nature', 'TRDEPO002')->where('tr_status', 'success')->get()->count();
        $totalFiltered = $totalItems;

        $items = PointTable::where('tr_nature', 'TRDEPO002')->whereNotNull('id')->orderBy('id', 'desc')->where('tr_status', 'success', 'Deposit_By_Admin');
        if ($requestData['search']['value']) {
            // $point = $items->where('FullName', 'like', '%' . $requestData['search']['value'] . '%')->orWhere('tr_remark', 'like', '%' . $requestData['search']['value'] . '%')->orWhere('date', 'like', '%' . $requestData['search']['value'] . '%');
            $filtered = $requestData['search']['value'];
            $items = $items->whereHas('user_data', function ($q) use ($filtered) {
                $q->where('FullName', 'Like', '%' . $filtered . '%')->orwhere('mob', 'Like', '%' . $filtered . '%');
            });
        }
        if ($request->orderBy) {
            $point = $items->orderBy($request->orderBy, $request->ascending == 1 ? 'ASC' : 'DESC');
        }
        if (!empty($request->market_date)) {
            $items = PointTable::where('tr_nature', 'TRDEPO002')->whereNotNull('id')->orderBy('created_at', 'desc')->where('tr_status', 'Success')->where(DB::raw("(DATE_FORMAT(created_at,'%Y-%m-%d'))"), $request->market_date);
        }
        $orderColumn = $columns[$requestData['order'][0]['column']];
        $orderColumnDir = $requestData['order'][0]['dir'];
        $limit = $requestData['length'];
        $offset = $requestData['start'];

        $items = $items->offset($offset)->limit((int) $limit)->orderBy($orderColumn, $orderColumnDir)->get();
        $datas = array();
        $i = $offset;
        foreach ($items as $item) {
            $i++;
            $nestedData = array();
            // $nestedData[] = $i;
            $nestedData[] = '<input type="checkbox" id="' . $item->id . '" class="checkBoxClass table_check" name="DepositSelected[]" value="' . $item->id . '">' . '<span class="sr_no">' . $i . '</span>';
            $nestedData[] = is_null($item->user_data) ? "NA" : $item->user_data->FullName;
            $nestedData[] = is_null($item->user_data) ? "NA" : $item->user_data->mob;
            // $nestedData[] = is_null($item->user_id)?"NA":$item->user_id;
            $nestedData[] = $item->tr_value;
            $nestedData[] = $item->transactionRef;
            // $nestedData[] = date("h:i:s", strtotime($item->created_at));
            $nestedData[] = date("H:i:s", strtotime($item->created_at));
            $nestedData[] = date("d-m-Y", strtotime($item->created_at));
            // $nestedData[] = $item->status;
            $nestedData[] = $item->tr_status;

            // $approve = '<a href="' . url('/administrator/deposit-approve/' . $item->id) . '" title="Approve"><button class="btn btn-warning ">Approve</button></a>';
            // $deleteLink = '<a href="' . url('/administrator/delete/' . $item->id) . ' " onclick="return confirm("Are you sure want to delete?")" title="Delete"><button class="btn btn-info "><i class="icon-trash"></i></button></a>';
            $candelled = '<a href="' . url('/administrator/success-deposit-cancelled/' . $item->id) . ' " title="Cancelled"><button class="btn btn-primary">Cancelled</button></a>';
            // $nestedData[] = $candelled;
            $datas[] = $nestedData;
        }
        ;

        $json_data = array(
            "draw" => intval($requestData['draw']),
            "recordsTotal" => intval($totalItems),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $datas
        );

        echo json_encode($json_data);
    }
}