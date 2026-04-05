<?php

namespace App\Http\Controllers\Administrator;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StarlineGameRate;
use App\Models\Result;
use App\Models\Point;
use App\Models\PointTable;
use App\Models\Market;
use App\Models\User;
use App\Models\BlockUser;
use App\Models\Tabletype;
use App\Models\GameLoad;
use Session;
use Hash;
use DB;
use App\Helpers\Helper;
use MongoDB\BSON\ObjectId;

class GaliDisawarController extends Controller
{
    public function __construct()
    {
    }

    /*-------Show List Page ---------*/
    public function index()
    {
        return view('administrator.galidisawar.index');
    }
    public function gd_game_rate()
    {
        $gd_game = StarlineGameRate::find(1);
        return view('administrator.galidisawar.game_rate', compact('gd_game'));
    }
    public function gd_bid_history()
    {
        $market_data = Market::where('market_type', 3)->get();
        return view('administrator.galidisawar.bid_history', compact('market_data'));
    }

    public function gd_declare_result()
    {
        return view('administrator.galidisawar.result_declare');
    }
    public function gd_result_history()
    {
        return view('administrator.galidisawar.result_history');
    }
    public function gd_sell_report()
    {
        return view('administrator.galidisawar.sell_report');
    }
    public function gd_winning_report()
    {
        $market_data = Market::where('market_type', 3)->get();

        return view('administrator.galidisawar.winning_report', compact('market_data'));
    }
    public function gd_winning_prediction()
    {
        return view('administrator.galidisawar.winning_prediction');
    }
    public function result_close($id)
    {
        return view('administrator.galidisawar.result_close', compact('id'));
    }
    public function result_open($id)
    {
        return view('administrator.galidisawar.result_open', compact('id'));
    }
    public function GaliDisawarGameData(Request $request)
    {
        $columns = array(
            0 => 'comx_appmarkets._id',
            1 => 'comx_appmarkets.market_name',
            2 => 'comx_appmarkets.market_view_time_open',
            3 => 'comx_appmarkets.market_sunday_time_open',
            4 => 'comx_appmarkets.market_view_time_close',
            5 => 'comx_appmarkets.app_id'
        );

        $requestData = $_REQUEST;
        $total = Market::whereNotNull('_id')->where('market_type', 3)->orderBy('_id', 'desc')->count();

        $Market = Market::whereNotNull('_id')->where('market_type', 3)->orderBy('_id', 'desc');
        if ($requestData['search']['value']) {
            $Market = $Market->where('market_name', 'like', '%' . $requestData['search']['value'] . '%')->orWhere('market_id', 'like', '%' . $requestData['search']['value'] . '%');
        }
        // if ($request->orderBy) {
        //     $Market = $Market->orderBy($request->orderBy, $request->ascending == 1 ? 'ASC' : 'DESC');
        // }
        $orderColumn = $columns[$requestData['order'][0]['column']];
        $orderColumnDir = $requestData['order'][0]['dir'];
        $limit = $requestData['length'];
        $offset = $requestData['start'];
        $Market = $Market->offset($offset)->limit((int)$limit)->orderBy($orderColumn, $orderColumnDir)->get();
        // $point = $point->paginate($request->limit ? $request->limit : 20);
        $i = $offset;
        $datas = [];
        foreach ($Market as $item) {
            $i++;
            $todayresult = Result::where('market_id', $item->market_id)->where('date', '=', date('d-m-Y'))->whereNotNull('_id')->first();
            $nestedData = array();
            $nestedData[] = $i;
            $nestedData[] = $item->market_name;
            $nestedData[] = $item->market_id;
            $nestedData[] = $item->market_view_time_open;
            $nestedData[] = $item->market_view_time_close;
            $nestedData[] = $item->market_saturday_time_open;
            $nestedData[] = $item->market_sunday_time_open;
            $nestedData[] = is_null($todayresult) ? "NA" : $todayresult->result;

            if ($item->status) {
                $message = "'Are you sure you want to Inactive the user?'";
                $nestedData[] = '<a href="' . url('/administrator/gali-disawar/update-status/' . $item->_id) . '" title="Active"><i class="fa fa-toggle-on"></i></a>';
            } else {
                $message = "'Are you sure you want to Active the user?'";
                $nestedData[] = '<a href="' . url('/administrator/gali-disawar/update-status/' . $item->_id) . '" title="Inactive"><i class="fa fa-toggle-off"></i></a>';
            }
            // $changeLink = '<a href="' .url('/administrator/sub-admin/change-password/'.$item->id).'" title="Change Password"><button class="btn btn-primary btn-icon-anim btn-circle"><i class="fa fa-key"></i></button></a>';
            $editLink = '<a href="' . url('/administrator/edit-gd-game/' . $item->_id) . '" title="Edit"><button class="btn btn-warning btn-icon-anim btn-circle"><i class="fa fa-pencil"></i></button></a>';
            // $deleteLink = '<a href="' .url('/administrator/sub-admin/delete/'.$item->id).' " onclick="return confirm("Are you sure want to delete?")" title="Delete"><button class="btn btn-info btn-icon-anim btn-circle"><i class="icon-trash"></i></button></a>';


            // $result = '<a href="' . url('/administrator/result-close/' . $item->_id) . '" title="Result-Close"><button class="btn btn-primary">Result</button></a>';
            // $deleteLink = '<a href="' . url('/administrator/delete/' . $item->id) . ' " onclick="return confirm("Are you sure want to delete?")" title="Delete"><button class="btn btn-info "><i class="icon-trash"></i></button></a>';
            $result = '';
            $ViewLink = '<a href="' . url('/administrator/view/' . $item->_id) . ' " title="View"><button class="btn btn-warning"><i class="fa fa-eye"></i></button></a>';
            $nestedData[] = $editLink . " " . $ViewLink . " " . $result;
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

    public function Add_Gdgame(Request $request)
    {
        return view('administrator.galidisawar.add_Gdgame');
    }

    public function store_Gdgame(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'market_name' => 'required',
            'market_view_time_open' => 'required',
            'market_view_time_close' => 'required',
            'market_sunday_time_open' => 'required',
            'is_holiday' => 'required',
            'market_sunday_off' => 'required',
            'is_time_limit_applied' => 'required',
            'is_no_limit_game' => 'required',
            'market_saturday_off' => 'required',
            'close_by_admin' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('add_gali_disawar_game')->withErrors($validator)->withInput();
        }
        $market_type = 3;
        $insert = new Market;
        $insert->market_name = $request->market_name;
        // $insert->slug = str_slug($request->title, "-");
        $insert->market_id = str_replace(' ', '', $request->market_name);
        $insert->market_view_time_open = $request->market_view_time_open;
        $insert->market_view_time_close = $request->market_view_time_close;
        $insert->market_sunday_time_open = $request->market_sunday_time_open;
        $insert->is_holiday = $request->is_holiday;
        $insert->market_sunday_off = $request->market_sunday_off;
        $insert->is_time_limit_applied = $request->is_time_limit_applied;
        $insert->is_no_limit_game = $request->is_no_limit_game;
        $insert->market_saturday_off = $request->market_saturday_off;
        $insert->close_by_admin = $request->close_by_admin;
        $insert->status = (int)$request->status;
        $insert->market_type = $market_type;

        $insert->save();

        return redirect()->route('gali_disawar_game_name_list')->with('success_message', 'One New Starline Market has been created successfully.');
    }

    /**
     * Gali Disawar markets use market_type 3. Match _id when stored as ObjectId or string in BSON.
     */
    private function findGdMarketByRouteId($id): ?Market
    {
        if ($id === null || $id === '') {
            return null;
        }

        $id = preg_replace('/[\x{200B}-\x{200D}\x{FEFF}]/u', '', rawurldecode(trim((string) $id)));
        if ($id === '') {
            return null;
        }

        $isGd = function (?Market $m): ?Market {
            if ($m === null) {
                return null;
            }
            if ((int) ($m->market_type ?? 0) !== 3) {
                return null;
            }
            return $m;
        };

        $select = $isGd(Market::find($id));
        if ($select) {
            return $select;
        }

        $select = $isGd(Market::where('_id', $id)->first());
        if ($select) {
            return $select;
        }

        if (preg_match('/^[a-f\d]{24}$/i', $id)) {
            try {
                $select = $isGd(Market::where('_id', new ObjectId($id))->first());
                if ($select) {
                    return $select;
                }
            } catch (\Throwable $e) {
                // invalid ObjectId
            }

            $doc = Market::raw(function ($collection) use ($id) {
                try {
                    return $collection->findOne(
                        [
                            'market_type' => 3,
                            '$or' => [
                                ['_id' => $id],
                                ['_id' => new ObjectId($id)],
                            ],
                        ],
                        ['typeMap' => ['root' => 'array', 'document' => 'array', 'array' => 'array']]
                    );
                } catch (\Throwable $e) {
                    return null;
                }
            });

            if ($doc !== null) {
                $attrs = is_array($doc) ? $doc : json_decode(json_encode($doc), true);
                if (is_array($attrs) && isset($attrs['_id'])) {
                    return $isGd((new Market)->newFromBuilder($attrs));
                }
            }
        }

        return null;
    }

    public function edit_Gdgame($id)
    {
        $select = $this->findGdMarketByRouteId($id);
        if (!$select) {
            abort(404, 'Game not found.');
        }

        return view('administrator.galidisawar.edit_Gdgame', compact('select'));
    }

    public function edit_store_Gdgame(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'market_name' => 'required',
            'market_view_time_open' => 'required',
            'market_view_time_close' => 'required',
            'market_sunday_time_open' => 'required',
            'is_holiday' => 'required',
            'market_position' => 'required|integer',
            'status' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
       
        $insert['market_name'] = $request->market_name;
        // $insert['market_id'] = strtoupper(substr($request->market_name, 0, 5));
        $insert['market_id'] = str_replace(' ', '', $request->market_name);
        $insert['market_sub_name'] = strtoupper(substr($request->market_name, 0, 3));
        $insert['market_view_time_open'] = date('H:i:s', strtotime($request->market_view_time_open));
        $insert['market_view_time_close'] = date('H:i:s', strtotime($request->market_view_time_close));
        $insert['market_sunday_time_close'] = date('H:i:s', strtotime($request->market_sunday_time_open));
        $insert['market_sunday_time_open'] = date('H:i:s', strtotime($request->market_sunday_time_open));
        $insert['is_holiday'] = $request->is_holiday;

        $insert['is_time_limit_applied'] = $request->is_time_limit_applied;

        $insert['is_no_limit_game'] = $request->is_no_limit_game;
        $insert['market_saturday_off'] = $request->market_saturday_off;
        $insert['close_by_admin'] = $request->close_by_admin;
        $insert['market_sunday_off'] = $request->market_sunday_off;
        $insert['market_status'] = (string)$request->status;
        $insert['market_position'] = (int)$request->market_position;
        $insert['status'] = (int)$request->status;

        $market = $this->findGdMarketByRouteId($request->markets_id);
        if (!$market) {
            return redirect()->route('gali_disawar_game_name_list')->with('error_message', 'Game not found.');
        }

        $updated = 0;
        if (!empty($market->id)) {
            $updated = Market::where('id', $market->id)->update($insert);
        }

        if (!$updated) {
            $mongoId = $market->getOriginal('_id') ?? $market->_id ?? $request->markets_id;

            if (is_object($mongoId)) {
                $updated = Market::where('_id', $mongoId)->update($insert);
            } elseif (is_string($mongoId) && preg_match('/^[a-f\d]{24}$/i', $mongoId)) {
                $updated = Market::raw(function ($collection) use ($mongoId, $insert) {
                    try {
                        return $collection->updateOne(
                            [
                                '$or' => [
                                    ['_id' => $mongoId],
                                    ['_id' => new ObjectId($mongoId)],
                                ],
                            ],
                            ['$set' => $insert]
                        );
                    } catch (\Throwable $e) {
                        return $collection->updateOne(['_id' => $mongoId], ['$set' => $insert]);
                    }
                });
            } else {
                $updated = Market::where('_id', $mongoId)->update($insert);
            }
        }

        if (!$updated) {
            foreach ($insert as $field => $value) {
                $market->{$field} = $value;
            }
            $market->save();
        }

        return redirect()->route('gali_disawar_game_name_list')->with('success_message', 'Market has been updated successfully.');
    }

    public function update_gd_status($id)
    {
        $market = $this->findGdMarketByRouteId($id);

        if (!$market) {
            return redirect()->route('gali_disawar_game_name_list')->with('error_message', 'Game not found.');
        }

        $newStatus = (int) (($market->status ?? 0) == 1 ? 0 : 1);
        $updated = 0;

        if (!empty($market->id)) {
            $updated = Market::where('id', $market->id)->update(['status' => $newStatus, 'market_status' => (string) $newStatus]);
        }

        if (!$updated) {
            $mongoId = $market->getOriginal('_id') ?? $market->_id ?? $id;

            if (is_object($mongoId)) {
                $updated = Market::where('_id', $mongoId)->update(['status' => $newStatus, 'market_status' => (string) $newStatus]);
            } elseif (is_string($mongoId) && preg_match('/^[a-f\d]{24}$/i', $mongoId)) {
                $result = Market::raw(function ($collection) use ($mongoId, $newStatus) {
                    try {
                        return $collection->updateOne(
                            [
                                '$or' => [
                                    ['_id' => $mongoId],
                                    ['_id' => new ObjectId($mongoId)],
                                ],
                            ],
                            ['$set' => ['status' => $newStatus, 'market_status' => (string) $newStatus]]
                        );
                    } catch (\Throwable $e) {
                        return $collection->updateOne(
                            ['_id' => $mongoId],
                            ['$set' => ['status' => $newStatus, 'market_status' => (string) $newStatus]]
                        );
                    }
                });

                $updated = method_exists($result, 'getModifiedCount')
                    ? ($result->getModifiedCount() > 0 || $result->getMatchedCount() > 0)
                    : (bool) $result;
            } else {
                $updated = Market::where('_id', $mongoId)->update(['status' => $newStatus, 'market_status' => (string) $newStatus]);
            }
        }

        if (!$updated) {
            $market->status = $newStatus;
            $market->market_status = (string) $newStatus;
            $market->save();
        }

        return redirect()->route('gali_disawar_game_name_list')->with('success_message', 'Status has been updated successfully!');
    }

    public function Gd_BidHistoryData(Request $request)
    {
        // dd("aaya");
        // ini_set('memory_limit', '1024M');
        $requestData = $_REQUEST;
        $columns = array(
            0 => 'game_load._id',
            1 => 'game_load.user_id',
            2 => 'game_load.tr_value',
            3 => 'game_load.table_id',
            4 => 'game_load.pred_num',
            5 => 'game_load.win_value',
            6 => 'game_load.is_win',
        );
        $totalItems = GameLoad::where('tr_nature', 'TRGAME001')->count();
        $totalFiltered = $totalItems;
        $items = GameLoad::where('tr_nature', 'TRGAME001')->orderBy('created_at', 'desc');
        if (!empty($request->market_date) && !empty($request->select_market)) {
            $format_date = date("d-m-Y", strtotime($request->market_date));
            $items = GameLoad::where('date', $format_date)->where('table_id', $request->select_market)->where('tr_nature', 'TRGAME001');
            // $amenities = GameLoad::where(DB::raw("(DATE_FORMAT(created_at,'%Y-%m-%d'))"),$request->market_date)->whereDate('table_id', '=', $request->select_market)->get();
        }

        if ($requestData['search']['value']) {
            $filtered = $requestData['search']['value'];
            $items = $items->whereHas('user_data', function ($q) use ($filtered) {
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

        $items = $items->offset($offset)->limit((int)$limit)->orderBy($orderColumn, $orderColumnDir)->get();
        $datas = array();
        $i = $offset;


        foreach ($items as $item) {
            $i++;
            $nestedData = array();
            $nestedData[] = '<input type="checkbox" class="select_row" data-id="' . $item->_id . '" />';
            $nestedData[] = $i;
            // $nestedData[] = $item->user_id;
            $nestedData[] = is_null($item->user_data) ? "NA" : $item->user_data->FullName;
            $nestedData[] = is_null($item->user_data) ? "NA" : $item->user_data->mob;
            if ((int)$item->game_type == 8) {
                $nestedData[] = 'Jodi';
            } elseif ((int)$item->game_type == 9) {
                $nestedData[] = 'Andar';
            } elseif ((int)$item->game_type == 10) {
                $nestedData[] = 'Bahar';
            }
            $nestedData[] = $item->table_id;
            $nestedData[] = $item->tr_value;
            $nestedData[] = $item->pred_num;
            // $nestedData[] = $item->win_value;
            // $nestedData[] = $item->status;
            // $nestedData[] = $item->close_sangam;
            $nestedData[] = date("d-m-Y h:i a", strtotime($item->created_at));

            // if ($item->status) {
            //     $message = "'Are you sure you want to Inactive the user?'";
            //     $nestedData[] = '<a href="' . url('/administrator/update-status/' . $item->id) . '" onclick="return confirm(' . $message . ')" title="Active"><i class="fa fa-toggle-on"></i></a>';
            // } else {
            //     $message = "'Are you sure you want to Active the user?'";
            //     $nestedData[] = '<a href="' . url('/administrator/update-status/' . $item->id) . '" onclick="return confirm(' . $message . ')" title="Inactive"><i class="fa fa-toggle-off"></i></a>';
            // }


            // $editLink = '<a href="' . url('/administrator/edit/' . $item->id) . '" title="Edit"><button class="btn btn-warning "><i class="fa fa-pencil"></i></button></a>';
            // $deleteLink = '<a href="' . url('/administrator/bets-delete/' . $item->id) . ' " onclick="return confirm("Are you sure want to delete?")" title="Delete"><button class="btn btn-info "><i class="icon-trash"></i></button></a>';
            // $ViewLink = '<a href="' . url('/administrator/view/' . $item->id) . ' " title="View"><button class="btn btn-primary"><i class="fa fa-eye"></i></button></a>';
            // $nestedData[] = $deleteLink;
            // $nestedData[] = $ViewLink . " " . $editLink . "  " . $deleteLink;
            // $nestedData[] = $ViewLink . " " . $editLink . "  " . $deleteLink . " " . $result . " " . $history;
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


    public function betsDelete(Request $request)
    {
        $betIds = $request->input('bet_ids');

        if (empty($betIds)) {
            return response()->json([
                'status' => 'error',
                'message' => 'No bets selected for deletion.'
            ]);
        }

        try {
            foreach ($betIds as $betId) {

                $betDetail = GameLoad::where('_id', $betId)->first();

                if ($betDetail) {
                    $userData = User::where('user_id',$betDetail->user_id)->first();
                    if ($userData) {
                        User::where('user_id', $userData->user_id)
                            ->update(['credit' => $userData->credit + $betDetail->tr_value]);
                    }
                    Point::where('uniquid', $betDetail->uniquid)->delete();
                    $betDetail->delete();
                }
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Selected bets deleted successfully.'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while deleting the bets. Please try again.'
            ]);
        }
    }


    public function get_Gd_declareResultData(Request $request)
    {

        $columns = array(
            0 => 'results_tbls._id',
            1 => 'results_tbls.market_id',
            2 => 'results_tbls.result',
            3 => 'results_tbls.day_of_result',
            4 => 'results_tbls.status',
            5 => 'results_tbls.date',
        );

        $requestData = $_REQUEST;
        $total = Result::whereNotNull('_id')->count();
        $Market = Result::whereNotNull('_id')->orderBy('id', 'desc');
        if ($requestData['search']['value']) {
            $Market = $Market->where('market_id', 'like', '%' . $requestData['search']['value'] . '%')->orWhere('result', 'like', '%' . $requestData['search']['value'] . '%');
        }
        if ($request->orderBy) {
            $Market = $Market->orderBy($request->orderBy, $request->ascending == 1 ? 'ASC' : 'DESC');
        }
        $orderColumn = $columns[$requestData['order'][0]['column']];
        $orderColumnDir = $requestData['order'][0]['dir'];
        $limit = $requestData['length'];
        $offset = $requestData['start'];
        $Market = $Market->offset($offset)->limit((int)$limit)->orderBy($orderColumn, $orderColumnDir)->get();
        // $point = $point->paginate($request->limit ? $request->limit : 20);
        $i = $offset;
        $datas = [];
        foreach ($Market as $item) {
            $i++;
            $nestedData = array();
            $nestedData[] = $i;
            $nestedData[] = is_null($item) ? "NA" : $item->market_id;
            $nestedData[] = is_null($item->market) ? "NA" : $item->market->market_name;
            // $nestedData[] = $item->app_id;
            $nestedData[] = is_null($item) ? "NA" : $item->result;
            // $nestedData[] = $item->result2;
            // $nestedData[] = $item->result3;
            // $nestedData[] = $item->day_of_result;
            $nestedData[] = is_null($item) ? "NA" : $item->date;
            // $nestedData[] = $item->created_at;

            // if ($item->status) {
            //     $message = "'Are you sure you want to Inactive the user?'";
            //     $nestedData[] = '<a href="' . url('/administrator/update-status/' . $item->id) . '" onclick="return confirm(' . $message . ')" title="Active"><i class="fa fa-toggle-on"></i></a>';
            // } else {
            //     $message = "'Are you sure you want to Active the user?'";
            //     $nestedData[] = '<a href="' . url('/administrator/update-status/' . $item->id) . '" onclick="return confirm(' . $message . ')" title="Inactive"><i class="fa fa-toggle-off"></i></a>';
            // }


            // $editLink = '<a href="' . url('/administrator/edit/' . $item->id) . '" title="Edit"><button class="btn btn-warning "><i class="fa fa-pencil"></i></button></a>';
            // $deleteLink = '<a href="' . url('/administrator/delete/' . $item->id) . ' " onclick="return confirm("Are you sure want to delete?")" title="Delete"><button class="btn btn-info "><i class="icon-trash"></i></button></a>';
            // $ViewLink = '<a href="' . url('/administrator/view/' . $item->id) . ' " title="View"><button class="btn btn-primary"><i class="fa fa-eye"></i></button></a>';
            // $nestedData[] = $ViewLink . " " . $editLink . "  " . $deleteLink;
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

    public function get_Gd_ResultHistoryData(Request $request)
    {
        $requestData = $_REQUEST;
        $total = Result::whereNotNull('id')->count();
        $Market = Result::whereNotNull('id')->orderBy('id', 'desc');
        if ($requestData['search']['value']) {
            $Market = $Market->where('market_id', 'like', '%' . $requestData['search']['value'] . '%')->orWhere('mob', 'like', '%' . $requestData['search']['value'] . '%');
        }
        if ($request->orderBy) {
            $Market = $Market->orderBy($request->orderBy, $request->ascending == 1 ? 'ASC' : 'DESC');
        }
        $Market = $Market->paginate((int)$request->limit ? (int)$request->limit : 20);
        $i = 0;
        $datas = [];
        foreach ($Market as $item) {
            $i++;
            $nestedData = array();
            $nestedData[] = $i;
            $nestedData[] = $item->market_id;
            $nestedData[] = $item->app_id;
            $nestedData[] = $item->result;
            $nestedData[] = $item->day_of_result;
            $nestedData[] = $item->date;

            // if ($item->status) {
            //     $message = "'Are you sure you want to Inactive the user?'";
            //     $nestedData[] = '<a href="' . url('/administrator/update-status/' . $item->id) . '" onclick="return confirm(' . $message . ')" title="Active"><i class="fa fa-toggle-on"></i></a>';
            // } else {
            //     $message = "'Are you sure you want to Active the user?'";
            //     $nestedData[] = '<a href="' . url('/administrator/update-status/' . $item->id) . '" onclick="return confirm(' . $message . ')" title="Inactive"><i class="fa fa-toggle-off"></i></a>';
            // }


            // $editLink = '<a href="' . url('/administrator/edit/' . $item->id) . '" title="Edit"><button class="btn btn-warning "><i class="fa fa-pencil"></i></button></a>';
            // $deleteLink = '<a href="' . url('/administrator/delete/' . $item->id) . ' " onclick="return confirm("Are you sure want to delete?")" title="Delete"><button class="btn btn-info "><i class="icon-trash"></i></button></a>';
            // $ViewLink = '<a href="' . url('/administrator/view/' . $item->id) . ' " title="View"><button class="btn btn-primary"><i class="fa fa-eye"></i></button></a>';
            // $nestedData[] = $ViewLink . " " . $editLink . "  " . $deleteLink;
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

    // public function get_Gd_WinningReportData(Request $request)
    // {
    //     $columns = array(
    //         0 => 'point_table._id',
    //         1 => 'point_table.app_id',
    //         2 => 'point_table.user_id',
    //         3 => 'point_table.transaction_id',
    //         4 => 'point_table.tr_value',
    //         5 => 'point_table.tr_device',
    //     );
    //     // DB::statement("SET sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));");
    //     $requestData = $_REQUEST;
    //     $total = PointTable::whereNotNull('_id')->where('tr_nature', 'TRWIN005')->groupBy('user_id')->count();
    //     $Market = PointTable::whereNotNull('_id')->orderBy('_id', 'desc')->where('tr_nature', 'TRWIN005')->groupBy('user_id');
    //     // if ($requestData['search']['value']) {
    //     //     $Market = $Market->where('market_id', 'like', '%' . $requestData['search']['value'] . '%')->orWhere('win_value', 'like', '%' . $requestData['search']['value'] . '%');
    //     // }
    //     // if ($request->orderBy) {
    //     //     $Market = $Market->orderBy($request->orderBy, $request->ascending == 1 ? 'ASC' : 'DESC');
    //     // }
    //     // $orderColumn = $columns[$requestData['order'][0]['column']];
    //     // $orderColumnDir = $requestData['order'][0]['dir'];
    //     // $limit = $requestData['length'];
    //     // $offset = $requestData['start'];

    //     // $Market = $Market->offset($offset)->limit($limit)->orderBy($orderColumn, $orderColumnDir)->get();
    //     // $data = array();
    //     // $i = $offset;
    //     // $datas = [];

    //     if (!empty($request->market_date) && !empty($request->select_market)) {
    //         $format_date = date("d-m-Y", strtotime($request->market_date));
    //         $Market = PointTable::where('date', '=', $format_date)->where('table_id', '=', $request->select_market)->where('tr_nature', 'TRWIN005');
    //         // $amenities = PointTable::where(DB::raw("(DATE_FORMAT(created_at,'%Y-%m-%d'))"),$request->market_date)->whereDate('table_id', '=', $request->select_market)->get();
    //     }



    //     if ($requestData['search']['value']) {
    //         $filtered = $requestData['search']['value'];
    //         $Market = $Market->whereHas('user_data', function ($q) use ($filtered) {
    //             $q->where('FullName', 'Like', '%' . $filtered . '%')->orwhere('mob', 'Like', '%' . $filtered . '%');
    //         });
    //     }
    //     if ($request->orderBy) {
    //         $point = $Market->orderBy($request->orderBy, $request->ascending == 1 ? 'ASC' : 'DESC');
    //     }
    //     $orderColumn = $columns[$requestData['order'][0]['column']];
    //     $orderColumnDir = $requestData['order'][0]['dir'];
    //     $limit = $requestData['length'];
    //     $offset = $requestData['start'];

    //     $Market = $Market->offset($offset)->limit($limit)->orderBy($orderColumn, $orderColumnDir)->get();
    //     $datas = array();
    //     $i = $offset;
    //     dd($Market);
    //     foreach ($Market as $item) {
    //         dd($item);
    //         $i++;
    //         $nestedData = array();
    //         $nestedData[] = $i;
    //         $nestedData[] = is_null($item->user_data) ? "NA" : $item->user_data->FullName;
    //         $nestedData[] = is_null($item->user_data) ? "NA" : $item->user_data->mob;
    //         // $nestedData[] = is_null($item)?"NA":$item->market_id;
    //         $nestedData[] = is_null($item) ? "NA" : $item->table_id;
    //         // $nestedData[] = $item->market_id;
    //         // $nestedData[] = $item->app_id;
    //         $nestedData[] = is_null($item) ? "NA" : $item->win_value;
    //         $nestedData[] = is_null($item) ? "NA" : $item->pred_num;
    //         $nestedData[] = is_null($item) ? "NA" : $item->date;
    //         // if ($item->status) {
    //         //     $message = "'Are you sure you want to Inactive the user?'";
    //         //     $nestedData[] = '<a href="' . url('/administrator/update-status/' . $item->id) . '" onclick="return confirm(' . $message . ')" title="Active"><i class="fa fa-toggle-on"></i></a>';
    //         // } else {
    //         //     $message = "'Are you sure you want to Active the user?'";
    //         //     $nestedData[] = '<a href="' . url('/administrator/update-status/' . $item->id) . '" onclick="return confirm(' . $message . ')" title="Inactive"><i class="fa fa-toggle-off"></i></a>';
    //         // }


    //         // $editLink = '<a href="' . url('/administrator/edit/' . $item->id) . '" title="Edit"><button class="btn btn-warning "><i class="fa fa-pencil"></i></button></a>';
    //         // $deleteLink = '<a href="' . url('/administrator/delete/' . $item->id) . ' " onclick="return confirm("Are you sure want to delete?")" title="Delete"><button class="btn btn-info "><i class="icon-trash"></i></button></a>';
    //         // $ViewLink = '<a href="' . url('/administrator/view/' . $item->id) . ' " title="View"><button class="btn btn-primary"><i class="fa fa-eye"></i></button></a>';
    //         // $nestedData[] = $ViewLink . " " . $editLink . "  " . $deleteLink;
    //         // $nestedData[] = $ViewLink . " " . $editLink . "  " . $deleteLink . " " . $result . " " . $history;
    //         $datas[] = $nestedData;
    //     }
    //     ;

    //     return [
    //         'data' => $datas,
    //         'total' => intval($total),
    //         "recordsTotal" => intval($total),
    //         "recordsFiltered" => intval($total),
    //         'draw' => $request['draw']
    //     ];
    // }
    public function get_Gd_WinningReportData(Request $request)
    {
        $columns = [
            0 => '_id',
            1 => 'app_id',
            2 => 'user_id',
            3 => 'transaction_id',
            4 => 'tr_value',
            5 => 'tr_device',
        ];

        $requestData = $_REQUEST;

        $totalData = PointTable::raw(function ($collection) {
            return $collection->aggregate([
                ['$match' => ['tr_nature' => 'TRWIN005']],
                ['$group' => ['_id' => '$user_id']],
                ['$count' => 'total']
            ]);
        });

        $total = $totalData->toArray();
        $total = !empty($total) ? $total[0]['total'] : 0;

        $Market = PointTable::raw(function ($collection) {
            return $collection->aggregate([
                ['$match' => ['tr_nature' => 'TRWIN005']],
                ['$sort' => ['_id' => -1]], // Sorting by latest _id
                [
                    '$group' => [
                        '_id' => '$user_id',
                        'latestRecord' => ['$first' => '$$ROOT']
                    ]
                ],
            ]);
        })->toArray();

        $userIds = array_values(array_filter(array_column($Market, '_id')));
        $userData = User::whereIn('user_id', $userIds)->get()->keyBy('user_id');

        foreach ($Market as &$item) {
            $userId = $item['_id'] ?? null;
            $item['latestRecord']['user_data'] = $userData[$userId] ?? null;
        }

        if (!empty($requestData['search']['value'])) {
            $filteredValue = trim($requestData['search']['value']);
            $Market = array_filter($Market, function ($item) use ($filteredValue) {
                $latestRecord = $item['latestRecord'] ?? [];
                $user = $latestRecord['user_data'] ?? null;

                return stripos((string) ($user->FullName ?? ''), $filteredValue) !== false ||
                    stripos((string) ($user->mob ?? ''), $filteredValue) !== false ||
                    stripos((string) ($latestRecord['user_id'] ?? ''), $filteredValue) !== false ||
                    stripos((string) ($latestRecord['table_id'] ?? ''), $filteredValue) !== false ||
                    stripos((string) ($latestRecord['win_value'] ?? ''), $filteredValue) !== false;
            });
        }

        // Apply date & market filter correctly (since $Market is an array)
        if (!empty($request->market_date) && !empty($request->select_market)) {
            $formattedDate = date('d-m-Y', strtotime($request->market_date));

            $Market = array_filter($Market, function ($item) use ($formattedDate, $request) {
                return ($item['latestRecord']['date'] ?? '') === $formattedDate &&
                    ($item['latestRecord']['table_id'] ?? '') === $request->select_market;
            });
        }

        // Convert array back to collection if needed
        $Market = array_values($Market);
        $filteredCount = count($Market);

        $orderColumnIndex = $requestData['order'][0]['column'] ?? 0;
        $orderColumn = $columns[$orderColumnIndex] ?? '_id';
        $orderDirection = strtolower($requestData['order'][0]['dir']) === 'desc' ? SORT_DESC : SORT_ASC;

        usort($Market, function ($a, $b) use ($orderColumn, $orderDirection) {
            return $orderDirection === SORT_DESC
                ? ($b['latestRecord'][$orderColumn] ?? '') <=> ($a['latestRecord'][$orderColumn] ?? '')
                : ($a['latestRecord'][$orderColumn] ?? '') <=> ($b['latestRecord'][$orderColumn] ?? '');
        });

        $limit = $requestData['length'] ?? 10;
        $offset = $requestData['start'] ?? 0;
        $pagedMarket = array_slice($Market, $offset, $limit);

        $datas = [];
        $i = $offset;

        foreach ($pagedMarket as $item) {
            $i++;
            $latestRecord = $item['latestRecord'] ?? [];
            $user = $latestRecord['user_data'] ?? null;
            $datas[] = [
                $i,
                $user->FullName ?? 'NA',
                $user->mob ?? 'NA',
                $latestRecord['table_id'] ?? 'NA',
                $latestRecord['win_value'] ?? 'NA',
                $latestRecord['pred_num'] ?? 'NA',
                $latestRecord['date'] ?? 'NA',
            ];
        }

        return response()->json([
            'data' => $datas,
            'total' => $total,
            'recordsTotal' => $total,
            'recordsFiltered' => $filteredCount,
            'draw' => $request['draw']
        ]);
    }



    public function get_Gd_WinningPredictionData(Request $request)
    {
        $requestData = $_REQUEST;
        $total = PointTable::count();
        $Market = PointTable::whereNotNull('id')->orderBy('id', 'desc')->where('tr_nature', 'TRWIN005');
        if ($requestData['search']['value']) {
            $Market = $Market->where('FullName', 'like', '%' . $requestData['search']['value'] . '%')->orWhere('mob', 'like', '%' . $requestData['search']['value'] . '%');
        }
        if ($request->orderBy) {
            $Market = $Market->orderBy($request->orderBy, $request->ascending == 1 ? 'ASC' : 'DESC');
        }
        $Market = $Market->paginate((int)$request->limit ? (int)$request->limit : 20);
        $i = 0;
        $datas = [];
        foreach ($Market as $item) {
            $i++;
            $nestedData = array();
            $nestedData[] = $i;
            $nestedData[] = $item->user_id;
            $nestedData[] = $item->app_id;
            $nestedData[] = $item->win_value;
            $nestedData[] = $item->pred_num;
            $nestedData[] = $item->date;

            if ($item->status) {
                $message = "'Are you sure you want to Inactive the user?'";
                $nestedData[] = '<a href="' . url('/administrator/update-status/' . $item->id) . '" onclick="return confirm(' . $message . ')" title="Active"><i class="fa fa-toggle-on"></i></a>';
            } else {
                $message = "'Are you sure you want to Active the user?'";
                $nestedData[] = '<a href="' . url('/administrator/update-status/' . $item->id) . '" onclick="return confirm(' . $message . ')" title="Inactive"><i class="fa fa-toggle-off"></i></a>';
            }
            // $changeLink = '<a href="' .url('/administrator/sub-admin/change-password/'.$item->id).'" title="Change Password"><button class="btn btn-primary btn-icon-anim btn-circle"><i class="fa fa-key"></i></button></a>';
            // $editLink = '<a href="' .url('/administrator/sub-admin/edit/'.$item->id).'" title="Edit"><button class="btn btn-warning btn-icon-anim btn-circle"><i class="fa fa-pencil"></i></button></a>';
            // $deleteLink = '<a href="' .url('/administrator/sub-admin/delete/'.$item->id).' " onclick="return confirm("Are you sure want to delete?")" title="Delete"><button class="btn btn-info btn-icon-anim btn-circle"><i class="icon-trash"></i></button></a>';

            $editLink = '<a href="' . url('/administrator/edit/' . $item->id) . '" title="Edit"><button class="btn btn-warning "><i class="fa fa-pencil"></i></button></a>';
            $deleteLink = '<a href="' . url('/administrator/delete/' . $item->id) . ' " onclick="return confirm("Are you sure want to delete?")" title="Delete"><button class="btn btn-info "><i class="icon-trash"></i></button></a>';
            $ViewLink = '<a href="' . url('/administrator/view/' . $item->id) . ' " title="View"><button class="btn btn-primary"><i class="fa fa-eye"></i></button></a>';
            $nestedData[] = $ViewLink . " " . $editLink . "  " . $deleteLink;
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

    function result_Gdgame_declear(Request $request)
    {
        date_default_timezone_set('Asia/Kolkata');

        $andar = $request->andar;
        $bahar = $request->bahar;
        $id = $request->id;
        $mdata = Market::where('_id', $id)->first();
        $mid = $mdata->market_id;
        //->whereDate('date', Carbon::today())
        $date = date('d-m-Y');
        $chk = Result::where('market_id', $mid)->where('date', $date)->get()->count();
        if ($chk) {
            return response()->json(['already_declear' => true, 'message' => "Successfully"], 200);
            //   return redirect('administrator/gali-disawar-game-name-list')->with('error_message', 'Result is already declared');

        }
        // SELECT * FROM `point_table` WHERE  app_id ='com.dubaiking' AND table_id ='GHW19' AND tr_nature ='TRGAME001' AND is_win= '0' AND is_result_declared ='0' ORDER BY `id`  DESC
        $gdata = Point::where('table_id', $mid)->where('app_id', 'com.dubaiking')->where('is_result_declared', '0')->where('tr_nature', 'TRGAME001')->where('is_win', '0')->orderBy('id', 'DESC')->get();

        /*$gdata=Point::where('table_id',$mid)->where('tr_nature',"TRGAME001")->where(function($query) use($andar,$bahar) {
                    return $query
                            ->where('pred_num',$andar)
                            ->orWhere('pred_num',$bahar);
                    })->get();*/

        //->where('date',$date)   1 
        //1 jodi 2 andar 3 bahar

        /*if($mdata->id==11)
        {
        $date1=date('Y-m-d H:i:s', strtotime(' -1 day'));
        $date=date('d-m-Y', strtotime(' -1 day'));
        }
        else
        {*/
        $date = date('d-m-Y');
        $date1 = date('Y-m-d H:i:s');

        //}


        //$date=date('Y-m-d');

        if (count((array) $gdata) > 0) {
            foreach ($gdata as $vs) {
                $udata = User::where('user_id', $vs->user_id)->select('credit')->first();

                $winudata = User::where('user_id', $vs->user_id)->select('win_amount')->first();

                if ($vs->pred_num == $andar or $vs->pred_num == $bahar or $vs->pred_num == $andar . $bahar) {
                    if ($vs->game_type == 9 or $vs->game_type == 10) {
                        $bahar1 = Tabletype::where('id', $vs->game_type)->first();

                        $price_lot = $bahar1->price_lot;
                        if ($vs->game_type == 9 and $vs->pred_num == $andar) {
                            $cAmount = $vs->tr_value * $price_lot;

                            $data = array();
                            $data['app_id'] = $vs->app_id;
                            $data['game_type'] = $vs->game_type;
                            $data['admin_key'] = $vs->admin_key;
                            $data['win_value'] = $cAmount;
                            $data['user_id'] = $vs->user_id;
                            $data['transaction_id'] = $vs->transaction_id;
                            $data['tr_nature'] = 'TRWIN005';
                            $data['tr_value'] = $cAmount;
                            $data['win_bet_amt_not_use'] = $vs->tr_value;
                            $data['value_update_by'] = 'Win';
                            $data['tr_value_type'] = "Credit";
                            $data['tr_value_updated'] = @$udata->credit + $cAmount;
                            $data['date'] = $date; //date('d-m-Y');
                            if ($vs->game_type == 9) {
                                $pred_num = $andar;
                            }
                            if ($vs->game_type == 10) {
                                $pred_num = $bahar;
                            }
                            // if($vs->game_type==1)
                            // {
                            // $pred_num= $andar.$bahar;
                            // }

                            $data['pred_num'] = $pred_num;
                            $data['tr_status'] = "Success";
                            $data['market_type'] = "mainMarket";
                            $data['date_time'] = $date1;
                            $data['table_id'] = $vs->table_id;
                            $data['created_at'] = $date1;
                            $rdata = array();
                            $rdata['pred_num'] = $pred_num;
                            $rdata['app_id'] = $vs->app_id;
                            $rdata['transaction_id'] = $vs->transaction_id;
                            $rdata['tr_remark'] = "Game Win";
                            $rdata['game_type'] = $vs->game_type;
                            $rdata['user_id'] = $vs->user_id;
                            $rdata['tr_nature'] = 'TRWIN005';
                            $rdata['win_value'] = $cAmount;
                            $rdata['tr_value'] = $cAmount;
                            $rdata['value_update_by'] = "Game";
                            $rdata['type'] = "Credit";
                            $rdata['tr_value_updated'] = @$udata->credit + $cAmount;
                            $rdata['date'] = $date;
                            $rdata['date_time'] = $date1;
                            $rdata['tr_status'] = "Success";
                            $rdata['table_id'] = $vs->table_id;
                            $rdata['is_win'] = 1;
                            Db::table('wallet_reports')->insert($rdata);

                            Db::table('point_table')->insert($data);
                            Db::table('point_table')->where('id', $vs->id)->update(['is_win' => 1, 'is_result_declared' => 1]);

                            $balance = @$udata->credit + $cAmount;
                            $winamt = @$winudata->win_amount + $cAmount;
                            DB::table('us_reg_tbl')->where('user_id', $vs->user_id)->update(['credit' => $balance, 'win_amount' => $winamt]);
                        } elseif ($vs->game_type == 10 and $vs->pred_num == $bahar) {

                            $cAmount = $vs->tr_value * $price_lot;
                            $data = array();
                            $data['app_id'] = $vs->app_id;
                            $data['game_type'] = $vs->game_type;
                            $data['admin_key'] = $vs->admin_key;
                            $data['win_value'] = $cAmount;
                            $data['user_id'] = $vs->user_id;
                            $data['transaction_id'] = $vs->transaction_id;
                            $data['tr_nature'] = 'TRWIN005';
                            $data['tr_value'] = $cAmount;
                            $data['win_bet_amt_not_use'] = $vs->tr_value;
                            $data['created_at'] = $date1;
                            $data['value_update_by'] = 'Win';
                            $data['tr_value_type'] = "Credit";
                            $data['tr_value_updated'] = @$udata->credit + $cAmount;
                            $data['date'] = $date; //date('d-m-Y');
                            if ($vs->game_type == 9) {
                                $pred_num = $andar;
                            }
                            if ($vs->game_type == 10) {
                                $pred_num = $bahar;
                            }
                            // if($vs->game_type==1)
                            // {
                            // $pred_num= $andar.$bahar;
                            // }
                            $data['pred_num'] = $pred_num;
                            $data['tr_status'] = "Success";
                            $data['market_type'] = "mainMarket";
                            $data['date_time'] = $date1;
                            $data['table_id'] = $vs->table_id;

                            $rdata = array();
                            $rdata['pred_num'] = $pred_num;
                            $rdata['app_id'] = $vs->app_id;
                            $rdata['game_type'] = $vs->game_type;
                            $rdata['user_id'] = $vs->user_id;
                            $rdata['tr_nature'] = 'TRWIN005';
                            $rdata['win_value'] = $cAmount;
                            $rdata['tr_value'] = $cAmount;
                            $rdata['type'] = "Credit";
                            $rdata['tr_value_updated'] = @$udata->credit + $cAmount;
                            $rdata['date'] = $date;
                            $rdata['date_time'] = $date1;
                            $rdata['value_update_by'] = "Game";
                            $rdata['tr_status'] = "Success";
                            $rdata['table_id'] = $vs->table_id;
                            $rdata['is_win'] = 1;
                            $rdata['transaction_id'] = $vs->transaction_id;
                            $rdata['tr_remark'] = "Game Win";
                            Db::table('wallet_reports')->insert($rdata);

                            Db::table('point_table')->insert($data);
                            Db::table('point_table')->where('id', $vs->id)->update(['is_win' => 1, 'is_result_declared' => 1]);

                            $balance = @$udata->credit + $cAmount;
                            $winamt = @$winudata->win_amount + $cAmount;
                            DB::table('us_reg_tbl')->where('user_id', $vs->user_id)->update(['credit' => $balance, 'win_amount' => $winamt]);

                        } else {

                            // commission
                            $poointt = Db::table('point_table')->where('id', $vs->id)->first();
                            $comisionh = (5 * $poointt->tr_value) / 100;
                            $ussser = User::where('user_id', $poointt->user_id)->first();
                            if ($ussser) {
                                $refferbyyy = User::where('ref_code', $ussser->ref_by)->first();
                                $upodater = $refferbyyy->credit + $comisionh;
                                User::where('user_id', $refferbyyy->user_id)->update(['credit' => $upodater]);
                                $refferbyyy11 = User::where('ref_code', $ussser->ref_by)->first();
                                // if($refferbyyy){
                                $ponitypupdate = [
                                    'user_id' => $refferbyyy->user_id,
                                    'app_id' => 'com.dubaiking',
                                    'admin_key' => 'ADMIN0001',
                                    'transaction_id' => rand('000000', '999999'),
                                    'tr_nature' => 'TRDRFRL008',
                                    'tr_value' => $comisionh,
                                    'tr_value_updated' => $refferbyyy11->credit,
                                    'tr_value_type' => 'debit',
                                    'date' => date('d-m-Y'),
                                    'date_time' => date('Y-m-d H:i:s'),
                                    'tr_status' => 'Success',
                                ];
                                $ponitypupdate = new Point($ponitypupdate);
                                $ponitypupdate->save();

                                // }
                            }
                            Db::table('point_table')->where('id', $vs->id)->update(['is_win' => 2, 'is_result_declared' => 1]);

                        }
                    } else {
                        if ($vs->pred_num == $andar . $bahar) {
                            $bahar1 = Tabletype::where('id', $vs->game_type)->first();
                            $price_lot = $bahar1->price_lot;
                            $cAmount = $vs->tr_value * $price_lot;
                            $data = array();
                            $data['app_id'] = $vs->app_id;
                            $data['game_type'] = $vs->game_type;
                            $data['admin_key'] = $vs->admin_key;
                            $data['win_value'] = $cAmount;
                            $data['user_id'] = $vs->user_id;
                            $data['transaction_id'] = $vs->transaction_id;
                            $data['tr_nature'] = 'TRWIN005';
                            $data['tr_value'] = $cAmount;
                            $data['win_bet_amt_not_use'] = $vs->tr_value;
                            $data['market_type'] = "mainMarket";
                            $data['value_update_by'] = 'Win';
                            $data['tr_value_type'] = "Credit";
                            $data['tr_value_updated'] = @$udata->credit + $cAmount;
                            $data['date'] = $date; //date('d-m-Y');
                            $pred_num = $andar . $bahar;
                            $data['pred_num'] = $pred_num;
                            $data['tr_status'] = "Success";
                            $data['created_at'] = $date1;
                            $data['date_time'] = $date1;
                            $data['table_id'] = $vs->table_id;

                            $rdata = array();
                            $rdata['pred_num'] = $pred_num;
                            $rdata['app_id'] = $vs->app_id;
                            $rdata['game_type'] = $vs->game_type;
                            $rdata['user_id'] = $vs->user_id;
                            $rdata['tr_nature'] = 'TRWIN005';
                            $rdata['win_value'] = $cAmount;
                            $rdata['tr_value'] = $cAmount;
                            $rdata['value_update_by'] = "Game";

                            $rdata['type'] = "Credit";
                            $rdata['tr_value_updated'] = @$udata->credit + $cAmount;

                            $rdata['date'] = $date;
                            $rdata['date_time'] = $date1;
                            $rdata['tr_status'] = "Success";
                            $rdata['table_id'] = $vs->table_id;
                            $rdata['is_win'] = 1;
                            $rdata['transaction_id'] = $vs->transaction_id;
                            $rdata['tr_remark'] = "Game Win";
                            Db::table('wallet_reports')->insert($rdata);

                            Db::table('point_table')->insert($data);
                            Db::table('point_table')->where('id', $vs->id)->update(['is_win' => 1, 'is_result_declared' => 1]);

                            $balance = @$udata->credit + $cAmount;
                            $winamt = @$winudata->win_amount + $cAmount;
                            DB::table('us_reg_tbl')->where('user_id', $vs->user_id)->update(['credit' => $balance, 'win_amount' => $winamt]);
                        }
                    }

                } else {

                    // commission
                    $poointt = Db::table('point_table')->where('id', $vs->id)->first();
                    $comisionh = (5 * $poointt->tr_value) / 100;
                    $ussser = User::where('user_id', $poointt->user_id)->first();
                    if ($ussser) {
                        $refferbyyy = User::where('ref_code', $ussser->ref_by)->first();
                        $upodater = $refferbyyy->credit + $comisionh;
                        User::where('user_id', $refferbyyy->user_id)->update(['credit' => $upodater]);
                        $refferbyyy11 = User::where('ref_code', $ussser->ref_by)->first();

                        $ponitypupdate = [
                            'user_id' => $refferbyyy->user_id,
                            'app_id' => 'com.dubaiking',
                            'admin_key' => 'ADMIN0001',
                            'transaction_id' => rand('000000', '999999'),
                            'tr_nature' => 'TRDRFRL008',
                            'tr_value' => $comisionh,
                            'tr_value_updated' => $refferbyyy->credit,
                            'tr_value_type' => 'debit',
                            'date' => date('d-m-Y'),
                            'date_time' => date('Y-m-d H:i:s'),
                            'tr_status' => 'Success',
                        ];
                        $ponitypupdate = new Point($ponitypupdate);
                        $ponitypupdate->save();

                        // }
                    }
                    Db::table('point_table')->where('id', $vs->id)->update(['is_win' => 2, 'is_result_declared' => 1]);
                }

                //Db::table('point_table')->where('id',$vs->id)->update(['is_result_declared'=>1]);
            }

        }

        $result = array();
        $result['market_id'] = $mdata->market_id;
        $result['result'] = $andar . $bahar;
        $result['date'] = $date; //date('d-m-Y');
        $result['is_res_published'] = 1;
        //$result['date_time_result']=date('d-m-Y h:i:s');
        $result['day_of_result'] = date('D');
        $result['app_id'] = $mdata->app_id;
        $result['status'] = 1;

        DB::table('results_tbls')->insert($result);

        //   $this->notification_send($mdata->market_name,"WOW!! Result has been decleared",$result['result']);

        Db::table('point_table')->where('table_id', $mid)->where('app_id', 'com.dubaiking')->where('is_result_declared', '0')->where('tr_nature', 'TRGAME001')->update(['is_win' => 2, 'is_result_declared' => 1]);
        //   DB::table('game_load')->where('table_id',$mid)->delete();

        return response()->json(['success' => true, 'message' => "Successfully"], 200);
        // return redirect('administrator/gali-disawar-game-name-list')->with('success_message', 'One market has been updated successfully.');

    }



}