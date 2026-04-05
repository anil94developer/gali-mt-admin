<?php

namespace App\Http\Controllers\Administrator;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserCoin;
use App\Models\Point;
use App\Models\Admin;
use App\Models\Market;
use App\Models\BlockUser;
use App\Models\StarlineGameRate;
use App\Models\PointTable;
use App\Models\Result;
use Session;
use Hash;
use DB;
use App\Helpers\Helper;

class StarlineController extends Controller
{
    public function __construct()
    {
    }

    /*-------Show List Page ---------*/
    public function index()
    {
        return view('administrator.starline.index');
    }
    public function game_rate()
    {
        $strgamerate = StarlineGameRate::find(1);
        return view('administrator.starline.game_rate', compact('strgamerate'));
    }
    public function bid_history()
    {
        return view('administrator.starline.bid_history');
    }
    public function declare_result()
    {
        return view('administrator.starline.result_declare');
    }
    public function result_history()
    {
        return view('administrator.starline.result_history');
    }
    public function sell_report()
    {
        return view('administrator.starline.sell_report');
    }
    public function winning_report()
    {
        return view('administrator.starline.winning_report');
    }
    public function winning_prediction()
    {
        return view('administrator.starline.winning_prediction');
    }

    public function getGameData(Request $request)
    {
        $columns = array(
            0 => 'comx_appmarkets.id',
            1 => 'comx_appmarkets.market_view_time_open',
            2 => 'comx_appmarkets.market_view_time_close',
            3 => 'comx_appmarkets.market_sunday_time_open',
            4 => 'comx_appmarkets.date',
            5 => 'comx_appmarkets.app_id',
        );
        $requestData = $_REQUEST;
        $total = Market::count();
        $Market = Market::whereNotNull('id')->orderBy('id', 'desc')->where('market_type', 2);
        if ($requestData['search']['value']) {
            $Market = $Market->where('FullName', 'like', '%' . $requestData['search']['value'] . '%')->orWhere('mob', 'like', '%' . $requestData['search']['value'] . '%');
        }
        if ($request->orderBy) {
            $Market = $Market->orderBy($request->orderBy, $request->ascending == 1 ? 'ASC' : 'DESC');
        }
        $orderColumn = $columns[$requestData['order'][0]['column']];
        $orderColumnDir = $requestData['order'][0]['dir'];
        $limit = $requestData['length'];
        $offset = $requestData['start'];
        $Market = $Market->offset($offset)->limit($limit)->orderBy($orderColumn, $orderColumnDir)->get();
        // $point = $point->paginate($request->limit ? $request->limit : 20);
        // dd($point);
        $i = $offset;
        // $i = 0;
        $datas = [];
        foreach ($Market as $item) {
            $i++;
            $nestedData = array();
            $nestedData[] = $i;
            $nestedData[] = date('h:i A', strtotime($item->market_name));
            $nestedData[] = $item->market_id;
            $nestedData[] = $item->market_view_time_open;
            $nestedData[] = $item->market_view_time_close;
            // $nestedData[] = $item->market_saturday_time_open;
            $nestedData[] = $item->market_sunday_time_open;

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

            $result = '<a href="' . url('/administrator/result/' . $item->id) . '" title="Result"><button class="btn btn-primary ">Result</button></a>';
            // $deleteLink = '<a href="' . url('/administrator/delete/' . $item->id) . ' " onclick="return confirm("Are you sure want to delete?")" title="Delete"><button class="btn btn-info "><i class="icon-trash"></i></button></a>';
            $ViewLink = '<a href="' . url('/administrator/view/' . $item->id) . ' " title="View"><button class="btn btn-primary"><i class="fa fa-eye"></i></button></a>';
            $nestedData[] = $ViewLink . " " . $result;
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

    public function add_starline_market()
    {
        return view('administrator.starline.add_starlinemarket');
    }

    public function store_starline_market(Request $request)
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
            return redirect()->route('add_starline_gamemarket')->withErrors($validator)->withInput();
        }
        $market_type = 2;
        $insert = new Market;
        $insert['market_name'] = date('H:i', strtotime($request->market_name));
        // $insert['market_id'] = strtoupper(substr($request->market_name, 0, 5));
        $insert['market_id'] = str_replace(' ', '', $request->market_name);
        $insert['market_sub_name'] = strtoupper(substr($request->market_name, 0, 3));
        $insert['market_view_time_open'] = date('H:i', strtotime($request->market_view_time_open));
        $insert['market_view_time_close'] = date('H:i', strtotime($request->market_view_time_close));
        $insert['market_sunday_time_close'] = date('H:i', strtotime($request->market_sunday_time_open));
        $insert['market_sunday_time_open'] = date('H:i', strtotime($request->market_sunday_time_open));
        $insert['is_holiday'] = $request->is_holiday;

        $insert['is_time_limit_applied'] = $request->is_time_limit_applied;

        $insert['is_no_limit_game'] = $request->is_no_limit_game;
        $insert['market_saturday_off'] = $request->market_saturday_off;
        $insert['close_by_admin'] = $request->close_by_admin;
        $insert['market_sunday_off'] = $request->market_sunday_off;
        $insert['market_status'] = $request->status;
        $insert['market_position'] = $request->market_position;
        $insert['market_type'] = $market_type;
        $insert['status'] = $request->status;

        $insert->save();
        // dd($insert);

        return redirect()->route('game_name_list')->with('success_message', 'One New Starline Market has been created successfully.');
    }

    function view($id)
    {
        // dd('llll');
        $select = Market::where('_id', $id)->first();
        return view('administrator.starline.view', compact('select'));
    }

   public function update_status($id)
{
    $item = Market::find($id);

    if ($item) {
        $item->status = $item->status == 1 ? 0 : 1;
        $item->save();

        Session::flash('success_message', 'Status has been updated successfully!');
    } else {
        Session::flash('error_message', 'Unable to update status');
    }

    return redirect()->back();
}

    function edit($id)
    {
        $select = Market::where('id', $id)->first();
        return view('administrator.starline.edit', compact('select'));
    }

    public function edit_store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'market_name' => 'required',
            'market_view_time_open' => 'required',
            'market_view_time_close' => 'required',
            //'market_saturday_time_open' => 'required',
            'market_sunday_time_open' => 'required',
            'is_holiday' => 'required',
            'status' => 'required',

        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $insert['market_name'] = date('H:i', strtotime($request->market_name));
        // $insert['market_id'] = strtoupper(substr($request->market_name, 0, 5));
        $insert['market_id'] = str_replace(' ', '', $request->market_name);
        $insert['market_sub_name'] = strtoupper(substr($request->market_name, 0, 3));
        $insert['market_view_time_open'] = date('H:i', strtotime($request->market_view_time_open));
        $insert['market_view_time_close'] = date('H:i', strtotime($request->market_view_time_close));
        $insert['market_sunday_time_close'] = date('H:i', strtotime($request->market_sunday_time_open));
        $insert['market_sunday_time_open'] = date('H:i', strtotime($request->market_sunday_time_open));
        $insert['is_holiday'] = $request->is_holiday;
        $insert['is_time_limit_applied'] = $request->is_time_limit_applied;
        $insert['is_no_limit_game'] = $request->is_no_limit_game;
        $insert['market_saturday_off'] = $request->market_saturday_off;
        $insert['close_by_admin'] = $request->close_by_admin;
        $insert['market_sunday_off'] = $request->market_sunday_off;
        $insert['market_status'] = $request->status;
        $insert['market_position'] = $request->market_position;
        $insert['status'] = $request->status;

        DB::table('comx_appmarkets')->where('id', $request->markets_id)->update($insert);
        return redirect()->route('game_name_list')->with('success_message', 'One New Team has been updated successfully.');
    }

    public function delete($id)
    {
        if ($select = Market::find($id)) {
            $select->delete();
            Session::flash('success_message', 'One Market has been deleted successfully!');
        } else {
            Session::flash('error_message', 'Please Try Again!');
        }
        return redirect()->back();
    }

    public function result($id)
    {

        return view('administrator.starline.result', compact('id'));
    }
    // public function result_close($id)
    // {

    //     return view('administrator.starline.close', compact('id'));
    // }

    public function result_close($id)
    {
        return view('administrator.starline.result_close', compact('id'));
    }

    public function getBidHistoryData(Request $request)
    {
        // dd($request->all());
        $requestData = $_REQUEST;
        $columns = array(
            0 => 'point_table.id',
            1 => 'point_table.app_id',
            2 => 'point_table.user_id',
            3 => 'point_table.transaction_id',
            4 => 'point_table.tr_value',
            5 => 'point_table.tr_device',
        );
        $totalItems = PointTable::get()->count();
        $totalFiltered = $totalItems;
        $items = PointTable::whereNotNull('id')->where('tr_nature', 'TRGAME001')->orderBy('created_at', 'desc');
        if ($requestData['search']['value']) {
            $point = $items->where('win_value', 'like', '%' . $requestData['search']['value'] . '%')->orWhere('user_id', 'like', '%' . $requestData['search']['value'] . '%')->orWhere('date', 'like', '%' . $requestData['search']['value'] . '%');
        }
        if ($request->orderBy) {
            $point = $items->orderBy($request->orderBy, $request->ascending == 1 ? 'ASC' : 'DESC');
        }
        $orderColumn = $columns[$requestData['order'][0]['column']];
        $orderColumnDir = $requestData['order'][0]['dir'];
        $limit = $requestData['length'];
        $offset = $requestData['start'];

        $items = $items->offset($offset)->limit($limit)->orderBy($orderColumn, $orderColumnDir)->get();
        $data = array();
        $i = $offset;
        foreach ($items as $item) {
            $i++;
            $nestedData = array();
            $nestedData[] = $i;
            // $nestedData[] = is_null($item)?"":$item->market_name;
            $nestedData[] = is_null($item->market_id) ? "NA" : $item->market_id;
            $nestedData[] = $item->user_id;
            $nestedData[] = $item->transaction_id;
            $nestedData[] = $item->tr_device;

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

            // $editLink = '<a href="' . url('/administrator/edit/' . $item->id) . '" title="Edit"><button class="btn btn-warning "><i class="fa fa-pencil"></i></button></a>';
            // $deleteLink = '<a href="' . url('/administrator/delete/' . $item->id) . ' " onclick="return confirm("Are you sure want to delete?")" title="Delete"><button class="btn btn-info "><i class="icon-trash"></i></button></a>';
            // $ViewLink = '<a href="' . url('/administrator/view/' . $item->id) . ' " title="View"><button class="btn btn-primary"><i class="fa fa-eye"></i></button></a>';
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

    public function getGamerate_Data(Request $request)
    {
        $requestData = $_REQUEST;
        $total = StarlineGameRate::count();
        $Market = StarlineGameRate::whereNotNull('id')->orderBy('id', 'desc');
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
            $nestedData[] = $item->market_name;
            $nestedData[] = $item->market_id;
            $nestedData[] = $item->market_view_time_open;
            $nestedData[] = $item->market_view_time_close;
            $nestedData[] = $item->market_saturday_time_open;
            $nestedData[] = $item->market_sunday_time_open;

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
    public function getDeclareData(Request $request)
    {
        $columns = array(
            0 => 'results_tbls.id',
            1 => 'results_tbls.market_id',
            2 => 'results_tbls.result',
            3 => 'results_tbls.day_of_result',
            4 => 'results_tbls.status',
            5 => 'results_tbls.date',
        );

        $requestData = $_REQUEST;
        $total = Result::count();
        $Market = Result::whereNotNull('id')->orderBy('id', 'desc');
        if ($requestData['search']['value']) {
            $Market = $Market->where('FullName', 'like', '%' . $requestData['search']['value'] . '%')->orWhere('mob', 'like', '%' . $requestData['search']['value'] . '%');
        }
        if ($request->orderBy) {
            $Market = $Market->orderBy($request->orderBy, $request->ascending == 1 ? 'ASC' : 'DESC');
        }
        $orderColumn = $columns[$requestData['order'][0]['column']];
        $orderColumnDir = $requestData['order'][0]['dir'];
        $limit = $requestData['length'];
        $offset = $requestData['start'];

        $Market = $Market->offset($offset)->limit($limit)->orderBy($orderColumn, $orderColumnDir)->get();
        $data = array();
        $i = $offset;
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
            // $changeLink = '<a href="' .url('/administrator/sub-admin/change-password/'.$item->id).'" title="Change Password"><button class="btn btn-primary btn-icon-anim btn-circle"><i class="fa fa-key"></i></button></a>';
            // $editLink = '<a href="' .url('/administrator/sub-admin/edit/'.$item->id).'" title="Edit"><button class="btn btn-warning btn-icon-anim btn-circle"><i class="fa fa-pencil"></i></button></a>';
            // $deleteLink = '<a href="' .url('/administrator/sub-admin/delete/'.$item->id).' " onclick="return confirm("Are you sure want to delete?")" title="Delete"><button class="btn btn-info btn-icon-anim btn-circle"><i class="icon-trash"></i></button></a>';


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
    public function getResultHistoryData(Request $request)
    {
        $columns = array(
            0 => 'results_tbls.id',
            1 => 'results_tbls.market_id',
            2 => 'results_tbls.result',
            3 => 'results_tbls.day_of_result',
            4 => 'results_tbls.status',
            5 => 'results_tbls.date',
        );
        $requestData = $_REQUEST;
        $total = Result::count();
        $Market = Result::whereNotNull('id')->orderBy('id', 'desc');
        if ($requestData['search']['value']) {
            $Market = $Market->where('FullName', 'like', '%' . $requestData['search']['value'] . '%')->orWhere('mob', 'like', '%' . $requestData['search']['value'] . '%');
        }
        if ($request->orderBy) {
            $Market = $Market->orderBy($request->orderBy, $request->ascending == 1 ? 'ASC' : 'DESC');
        }
        $orderColumn = $columns[$requestData['order'][0]['column']];
        $orderColumnDir = $requestData['order'][0]['dir'];
        $limit = $requestData['length'];
        $offset = $requestData['start'];
        $Market = $Market->offset($offset)->limit($limit)->orderBy($orderColumn, $orderColumnDir)->get();
        // $point = $point->paginate($request->limit ? $request->limit : 20);
        // dd($point);
        $i = $offset;
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
            // $changeLink = '<a href="' .url('/administrator/sub-admin/change-password/'.$item->id).'" title="Change Password"><button class="btn btn-primary btn-icon-anim btn-circle"><i class="fa fa-key"></i></button></a>';
            // $editLink = '<a href="' .url('/administrator/sub-admin/edit/'.$item->id).'" title="Edit"><button class="btn btn-warning btn-icon-anim btn-circle"><i class="fa fa-pencil"></i></button></a>';
            // $deleteLink = '<a href="' .url('/administrator/sub-admin/delete/'.$item->id).' " onclick="return confirm("Are you sure want to delete?")" title="Delete"><button class="btn btn-info btn-icon-anim btn-circle"><i class="icon-trash"></i></button></a>';


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
    public function getWinningReportData(Request $request)
    {
        $columns = array(
            0 => 'point_table.id',
            1 => 'point_table.admin_key',
            2 => 'point_table.is_win',
            3 => 'point_table.FullName',
            4 => 'point_table.date',
        );
        $requestData = $_REQUEST;
        $total = PointTable::count();
        $Market = PointTable::whereNotNull('id')->orderBy('id', 'desc')->where('tr_nature', 'TRWIN005');
        if ($requestData['search']['value']) {
            $Market = $Market->where('FullName', 'like', '%' . $requestData['search']['value'] . '%')->orWhere('mob', 'like', '%' . $requestData['search']['value'] . '%');
        }
        if ($request->orderBy) {
            $Market = $Market->orderBy($request->orderBy, $request->ascending == 1 ? 'ASC' : 'DESC');
        }
        $orderColumn = $columns[$requestData['order'][0]['column']];
        $orderColumnDir = $requestData['order'][0]['dir'];
        $limit = $requestData['length'];
        $offset = $requestData['start'];
        $Market = $Market->offset($offset)->limit($limit)->orderBy($orderColumn, $orderColumnDir)->get();
        // $point = $point->paginate($request->limit ? $request->limit : 20);
        // dd($point);
        $i = $offset;
        $datas = [];
        foreach ($Market as $item) {
            $i++;
            $nestedData = array();
            $nestedData[] = $i;
            $nestedData[] = $item->user_id;
            $nestedData[] = $item->app_id;
            $nestedData[] = $item->win_value;
            $nestedData[] = $item->date;
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
    public function getWinningPredictionData(Request $request)
    {
        $columns = array(
            0 => 'point_table.id',
            1 => 'point_table.admin_key',
            2 => 'point_table.is_win',
            3 => 'point_table.FullName',
            4 => 'point_table.date',
            5 => 'point_table.date',
        );
        $requestData = $_REQUEST;
        $total = PointTable::count();
        $Market = PointTable::whereNotNull('id')->orderBy('id', 'desc')->where('tr_nature', 'TRWIN005');
        if ($requestData['search']['value']) {
            $Market = $Market->where('FullName', 'like', '%' . $requestData['search']['value'] . '%')->orWhere('mob', 'like', '%' . $requestData['search']['value'] . '%');
        }
        if ($request->orderBy) {
            $Market = $Market->orderBy($request->orderBy, $request->ascending == 1 ? 'ASC' : 'DESC');
        }
        $orderColumn = $columns[$requestData['order'][0]['column']];
        $orderColumnDir = $requestData['order'][0]['dir'];
        $limit = $requestData['length'];
        $offset = $requestData['start'];
        $Market = $Market->offset($offset)->limit($limit)->orderBy($orderColumn, $orderColumnDir)->get();
        // $point = $point->paginate($request->limit ? $request->limit : 20);
        // dd($point);
        $i = $offset;
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


}