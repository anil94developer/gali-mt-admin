<?php

namespace App\Http\Controllers\Administrator;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Market;
use App\Models\Tabletype;
use App\Models\Point;
use App\Models\User;
use Session;
use Carbon\Carbon;
use Hash;
use DB;
use Helper;

class CheakgameController extends Controller
{
    public function __construct()
    {
    }

    /*-------Show List Page ---------*/
    public function index(Request $request)
    {
        if (!empty($_REQUEST)) {
            $market_name = Market::where('market_id', $_REQUEST['market'])->first();
            $date = date('d-m-Y', strtotime($_REQUEST['date']));
            // dd($date);
            $total_count = Point::where('table_id', $_REQUEST['market'])->where('date', $date)->where('status', $_REQUEST['gameType'])->count();
            $total_sum = Point::where('table_id', $_REQUEST['market'])->where('date', $date)->where('status', $_REQUEST['gameType'])->sum('tr_value');
            $total_winner = Point::where('table_id', $_REQUEST['market'])->where('date', $date)->where('status', $_REQUEST['gameType'])->where('win_value', 1)->count();
            $total_winner_sum = Point::where('table_id', $_REQUEST['market'])->where('date', $date)->where('status', $_REQUEST['gameType'])->where('win_value', 1)->sum('win_value');



            $single_digit = Point::where('game_type', '1')->where('table_id', $_REQUEST['market'])->where('date', $date)->where('status', $_REQUEST['gameType'])->where('tr_nature', 'TRGAME001')->where('value_update_by', 'Game')->groupBy('pred_num')->get();
            $jodi_digit = Point::where('game_type', '2')->where('table_id', $_REQUEST['market'])->where('date', $date)->where('status', $_REQUEST['gameType'])->where('tr_nature', 'TRGAME001')->where('value_update_by', 'Game')->groupBy('pred_num')->get();
            $singlepana = Point::where('game_type', '3')->where('table_id', $_REQUEST['market'])->where('date', $date)->where('status', $_REQUEST['gameType'])->where('tr_nature', 'TRGAME001')->where('value_update_by', 'Game')->groupBy('pred_num')->get();
            $doublepana = Point::where('game_type', '4')->where('table_id', $_REQUEST['market'])->where('date', $date)->where('status', $_REQUEST['gameType'])->where('tr_nature', 'TRGAME001')->where('value_update_by', 'Game')->groupBy('pred_num')->get();
            $triplepana = Point::where('game_type', '5')->where('table_id', $_REQUEST['market'])->where('date', $date)->where('status', $_REQUEST['gameType'])->where('tr_nature', 'TRGAME001')->where('value_update_by', 'Game')->groupBy('pred_num')->get();
            $halfsangam = Point::where('game_type', '6')->where('table_id', $_REQUEST['market'])->where('date', $date)->where('status', $_REQUEST['gameType'])->where('tr_nature', 'TRGAME001')->where('value_update_by', 'Game')->groupBy('pred_num')->get();
            $fullsangam = Point::where('game_type', '7')->where('table_id', $_REQUEST['market'])->where('date', $date)->where('status', $_REQUEST['gameType'])->where('tr_nature', 'TRGAME001')->where('value_update_by', 'Game')->groupBy('pred_num')->get();
            // dd($total_count);

            $market_data = Market::get();
            // return view('administrator.cheak_game.index', compact('market', 'total_count', 'market_name', 'total_winner'));
        } else {
            $total_count = 0;
            $total_sum = 0;
            $total_winner = 0;
            $total_winner_sum = 0;
            $total_winner = [];
            $market_name = '';
            $market_data = Market::get();
            $date = date('d-m-Y');
            $single_digit = Point::where('game_type', '1')->where('tr_nature', 'TRGAME001')->where('date', $date)->where('value_update_by', 'Game')->groupBy('pred_num')->get();
            $jodi_digit = Point::where('game_type', '2')->where('tr_nature', 'TRGAME001')->where('date', $date)->where('value_update_by', 'Game')->groupBy('pred_num')->get();
            $singlepana = Point::where('game_type', '3')->where('tr_nature', 'TRGAME001')->where('date', $date)->where('value_update_by', 'Game')->groupBy('pred_num')->get();
            $doublepana = Point::where('game_type', '4')->where('tr_nature', 'TRGAME001')->where('date', $date)->where('value_update_by', 'Game')->groupBy('pred_num')->get();
            $triplepana = Point::where('game_type', '5')->where('tr_nature', 'TRGAME001')->where('date', $date)->where('value_update_by', 'Game')->groupBy('pred_num')->get();
            $halfsangam = Point::where('game_type', '6')->where('tr_nature', 'TRGAME001')->where('date', $date)->where('value_update_by', 'Game')->groupBy('pred_num')->get();
            $fullsangam = Point::where('game_type', '7')->where('tr_nature', 'TRGAME001')->where('date', $date)->where('value_update_by', 'Game')->groupBy('pred_num')->get();
            // dd($single_digit);
        }
        // dd($date);
        $date_data = $date;
        // return view('administrator.cheak_game.index', compact('market', 'total_count'));
        return view('administrator.cheak_game.index', compact('market_data', 'total_count', 'market_name', 'total_winner', 'total_count', 'total_sum', 'total_winner_sum', 'total_winner', 'single_digit', 'jodi_digit', 'singlepana', 'doublepana', 'triplepana', 'halfsangam', 'fullsangam', 'date_data'));
    }


    public function getmarketData(Request $request)
    {
        // dd('ooo');
        $requestData = $_REQUEST;
        $total = Market::count();
        $Market = Market::whereNotNull('id')->orderBy('created_at', 'desc');
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
            $nestedData[] = $item->is_holiday;
            $nestedData[] = $this->result_day($item->market_id);
            // $nestedData[] = $item->updated_time_date;
            // $nestedData[] = date("d-m-Y h:i a", strtotime($item->created_at));




            if ($item->status) {
                $message = "'Are you sure you want to Inactive the user?'";
                $nestedData[] = '<a href="' . url('/administrator/market/update-status/' . $item->id) . '" onclick="return confirm(' . $message . ')" title="Active"><i class="fa fa-toggle-on"></i></a>';
            } else {
                $message = "'Are you sure you want to Active the user?'";
                $nestedData[] = '<a href="' . url('/administrator/market/update-status/' . $item->id) . '" onclick="return confirm(' . $message . ')" title="Inactive"><i class="fa fa-toggle-off"></i></a>';
            }
            // $changeLink = '<a href="' .url('/administrator/sub-admin/change-password/'.$item->id).'" title="Change Password"><button class="btn btn-primary btn-icon-anim btn-circle"><i class="fa fa-key"></i></button></a>';
            // $editLink = '<a href="' .url('/administrator/sub-admin/edit/'.$item->id).'" title="Edit"><button class="btn btn-warning btn-icon-anim btn-circle"><i class="fa fa-pencil"></i></button></a>';
            // $deleteLink = '<a href="' .url('/administrator/sub-admin/delete/'.$item->id).' " onclick="return confirm("Are you sure want to delete?")" title="Delete"><button class="btn btn-info btn-icon-anim btn-circle"><i class="icon-trash"></i></button></a>';
            $result = '<a href="' . url('/administrator/market/result/' . $item->id) . '" title="Result"><button class="btn btn-primary ">Result</button></a>';
            $history = '<a href="' . url('/administrator/market/history/') . '" title="History"><button class="btn btn-warning ">History</button></a>';

            $editLink = '<a href="' . url('/administrator/market/edit/' . $item->id) . '" title="Edit"><button class="btn btn-warning "><i class="fa fa-pencil"></i></button></a>';
            $deleteLink = '<a href="' . url('/administrator/market/delete/' . $item->id) . ' " onclick="return confirm("Are you sure want to delete?")" title="Delete"><button class="btn btn-info "><i class="icon-trash"></i></button></a>';
            $ViewLink = '<a href="' . url('/administrator/market/view/' . $item->id) . ' " title="View"><button class="btn btn-primary"><i class="fa fa-eye"></i></button></a>';
            $nestedData[] = $ViewLink . " " . $editLink . "  " . $deleteLink . " " . $result . " " . $history;
            $datas[] = $nestedData;
        };

        return [
            'data' => $datas,
            'total' => intval($total),
            "recordsTotal" => intval($total),
            "recordsFiltered" => intval($total),
            'draw' => $request['draw']
        ];
    }

    public function cheak_game_create()
    {

        return view('administrator.cheak_game.create');
    }


    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'market_name' => 'required',
            'market_view_time_open' => 'required',
            'market_view_time_close' => 'required',
            'market_saturday_time_open' => 'required',
            'market_sunday_time_open' => 'required',
            'is_holiday' => 'required',
            //    'updated_time_date' => 'required',
            'status' => 'required',

        ]);

        if ($validator->fails()) {
            return redirect()->route('admin_market_create')->withErrors($validator)->withInput();
        }
        $insert = new Market;
        $insert->market_name = $request->market_name;
        $insert->market_id = strtoupper(substr($request->market_name, 0, 5));
        $insert->market_sub_name = strtoupper(substr($request->market_name, 0, 3));
        $insert->market_view_time_open = date('h:m:a', strtotime($request->market_view_time_open));
        $insert->market_view_time_close = date('h:m:a', strtotime($request->market_view_time_close));
        $insert->market_saturday_time_open = date('h:m:a', strtotime($request->market_saturday_time_open));
        $insert->market_sunday_time_open = date('h:m:a', strtotime($request->market_sunday_time_open));
        $insert->is_holiday = $request->is_holiday;
        $insert->status = $request->status;
        $insert->is_time_limit_applied = $request->is_time_limit_applied;
        $insert->is_no_limit_game = $request->is_no_limit_game;
        $insert->market_saturday_off = $request->market_saturday_off;
        $insert->close_by_admin = $request->close_by_admin;
        $insert->market_sunday_off = $request->market_sunday_off;
        $insert->market_status = $request->status;
        $insert->app_id = "com.dubaiking";
        $insert->agent_id = "124546";
        $insert->market_position = $request->market_position;
        $insert->market_type = 3;
        $insert->save();
        return redirect()->route('admin_market')->with('success_message', 'One New Team has been created successfully.');
    }


    public function update_holiday($id)
    {
        $response = DB::statement("UPDATE tbl_types SET is_holiday =(CASE WHEN (status = YES) THEN NO ELSE YES END) where id = $id");
        if ($item->holiday) {
            $message = "'Are you sure you want to Inactive the user?'";
            $nestedData[] = '<a href="' . url('/administrator/market/update-holiday/' . $item->id) . '" onclick="return confirm(' . $message . ')" title="Active"><i class=""></i></a>';
        } else {
            $message = "'Are you sure you want to Active the user?'";
            $nestedData[] = '<a href="' . url('/administrator/market/update-holiday/' . $item->id) . '" onclick="return confirm(' . $message . ')" title="Inactive"><i class=""></i></a>';
        }

        return redirect()->back();
    }


    public function delete($id)
    {
        //   dd('dasds');
        if ($select = Market::find($id)) {

            $select->delete();
            Session::flash('success_message', 'One Market has been deleted successfully!');
        } else {
            Session::flash('error_message', 'Please Try Again!');
        }
        return redirect()->back();
    }

    public function update_status($id)
    {
        $response = DB::statement("UPDATE comx_appmarkets SET status =(CASE WHEN (status = 1) THEN 0 ELSE 1 END) where id = $id");
        if ($response) {
            Session::flash('success_message', 'status has been updated successfully!');
        } else {
            Session::flash('error_message', 'Unable to update status');
        }

        return redirect()->back();
    }

    function edit($id)
    {
        $select = Market::where('id', $id)->first();
        return view('administrator.market.edit', compact('select'));
    }

    public function edit_store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'market_name' => 'required',
            'market_view_time_open' => 'required',
            'market_view_time_close' => 'required',
            'market_saturday_time_open' => 'required',
            'market_sunday_time_open' => 'required',
            'is_holiday' => 'required',
            'status' => 'required',

        ]);

        if ($validator->fails()) {
            //    dd('ioo');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $insert['market_name'] = $request->market_name;
        $insert['market_id'] = strtoupper(substr($request->market_name, 0, 5));
        $insert['market_sub_name'] = strtoupper(substr($request->market_name, 0, 3));
        $insert['market_view_time_open'] = date('h:i:a', strtotime($request->market_view_time_open));
        $insert['market_view_time_close'] = date('h:i:a', strtotime($request->market_view_time_close));
        $insert['market_saturday_time_open'] = date('h:i:a', strtotime($request->market_saturday_time_open));
        $insert['market_sunday_time_open'] = date('h:i:a', strtotime($request->market_sunday_time_open));
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
        return redirect()->route('admin_market')->with('success_message', 'One New Team has been created successfully.');
    }

    function view($id)
    {

        $select = Market::where('id', $id)->first();
        return view('administrator.market.view', compact('select'));
    }


    public function result($id)
    {

        return view('administrator.market.result', compact('id'));
    }


    public function history()
    {

        return view('administrator.market.history');
    }

    public function market_type()
    {

        return view('administrator.market.markettype');
    }

    public function market_type_create()
    {

        return view('administrator.market.market_create');
    }


    public function market_type_store(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'tbl_name' => 'required',
            'tbl_txt' => 'required',
            'min_point' => 'required',
            'tbl_code' => 'required',
            'tbl_image' => 'required',
            'price_lot' => 'required',
            'commision' => 'required',
            'lot_time' => 'required',
            'time_interval' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'min_point_play' => 'required',
            'max_point_allowed' => 'required',

        ]);

        if ($validator->fails()) {
            //    dd($validator);
            return redirect()->route('admin_market_type_create')->withErrors($validator)->withInput();
        }
        //    dd($request->all());
        $insert = new Tabletype;
        $insert->tbl_name = $request->tbl_name;
        $insert->tbl_txt = $request->tbl_txt;
        $insert->min_point = $request->min_point;
        $insert->tbl_code = $request->tbl_code;
        $insert->price_lot = $request->price_lot;
        $insert->commision = $request->commision;
        $insert->lot_time = $request->lot_time;
        $insert->time_interval = $request->time_interval;
        $insert->start_time = $request->start_time;
        $insert->end_time = $request->end_time;
        $insert->min_point_play = $request->min_point_play;
        $insert->max_point_allowed = $request->max_point_allowed;

        if ($request->tbl_image) {
            $path_original = public_path() . '/backend/uploads/tbl_types';
            $file = $request->tbl_image;
            $photo_name = time() . '-' . $file->getClientOriginalName();
            $file->move($path_original, $photo_name);
            $insert->tbl_image = $photo_name;
        }

        $insert->save();
        return redirect()->route('admin_market_type')->with('success_message', 'One New Team has been created successfully.');
    }

    public function getmarkettypeData(Request $request)
    {
        // dd('ooo');
        $requestData = $_REQUEST;
        $total = Tabletype::count();
        $Market = Tabletype::whereNotNull('id')->orderBy('created_at', 'desc');
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
            $nestedData[] = $item->tbl_name;
            $nestedData[] = $item->min_point;
            $nestedData[] = $item->tbl_code;
            $nestedData[] = $item->commision;
            // $nestedData[] = $item->updated_time_date;
            // $nestedData[] = date("d-m-Y h:i a", strtotime($item->created_at));


            // if($item->status){
            //     $message = "'Are you sure you want to Inactive the user?'";
            //     $nestedData[] = '<a href="' .url('/administrator/market/update-status/'.$item->id).'" onclick="return confirm('.$message.')" title="Active"><i class="fa fa-toggle-on"></i></a>';
            // }else{
            //     $message = "'Are you sure you want to Active the user?'";
            //     $nestedData[] = '<a href="' .url('/administrator/market/update-status/'.$item->id).'" onclick="return confirm('.$message.')" title="Inactive"><i class="fa fa-toggle-off"></i></a>';
            // }


            $editLink = '<a href="' . url('/administrator/market-type/edit/' . $item->id) . '" title="Edit"><button class="btn btn-warning "><i class="fa fa-pencil"></i></button></a>';
            $deleteLink = '<a href="' . url('/administrator/market-type/delete/' . $item->id) . ' " onclick="return confirm("Are you sure want to delete?")" title="Delete"><button class="btn btn-info "><i class="icon-trash"></i></button></a>';
            $ViewLink = '<a href="' . url('/administrator/market-type/view/' . $item->id) . ' " title="View"><button class="btn btn-primary"><i class="fa fa-eye"></i></button></a>';
            $nestedData[] = $ViewLink . " " . $editLink . "  " . $deleteLink;
            $datas[] = $nestedData;
        };

        return [
            'data' => $datas,
            'total' => intval($total),
            "recordsTotal" => intval($total),
            "recordsFiltered" => intval($total),
            'draw' => $request['draw']
        ];
    }

    public function delete_type($id)
    {
        //   dd('dasds');
        if ($select = Tabletype::find($id)) {
            $path_original = asset('/backend/uploads/tbl_types/');
            if ($select->image != '') {
                try {
                    unlink($path_original . $select->image);
                } catch (\Exception $e) {
                }
            }
            $select->delete();
            Session::flash('success_message', 'One Blog has been deleted successfully!');
        } else {
            Session::flash('error_message', 'Please Try Again!');
        }
        return redirect()->back();
    }


    function view_type($id)
    {

        $select = Tabletype::where('id', $id)->first();
        return view('administrator.market.view_type', compact('select'));
    }

    function notification_send($marketname, $title, $topic_name)
    {
        $data = $marketname;
        $noti = array(

            'body'     => $data,
            'title'  => $title

        );
        $keyData = DB::table('app_controller')->where('app_id', 'com.dubaiking')->select('fcm_key')->first();
        $firebase_api = $keyData->fcm_key;

        $fields = array(
            'to' => '/topics/' . $topic_name,
            'notification' => $noti
        );

        // Set POST variables
        $url = 'https://fcm.googleapis.com/fcm/send';
        $headers = array(
            'Authorization: key=' . $firebase_api,
            'Content-Type: application/json'
        );
        // Open connection
        $ch = curl_init();
        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Disabling SSL Certificate support temporarily
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);


        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

        // Execute post
        $result = curl_exec($ch);

        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }

        // Close connection

        curl_close($ch);
    }

    function admin_result(Request $request)
    {
        date_default_timezone_set("Asia/Calcutta");
        $andar = $request->andar;
        $bahar = $request->bahar;
        $id = $request->id;
        $mdata = Market::where('id', $id)->first();
        $mid = $mdata->market_id;
        //->whereDate('date', Carbon::today())
        $date = date('d-m-Y');
        $gdata = Point::where('table_id', $mid)->where('tr_nature', "TRGAME001")->where(function ($query) use ($andar, $bahar) {
            return $query
                ->where('pred_num', $andar)
                ->orWhere('pred_num', $bahar);
        })->where('date', $date)->get();

        foreach ($gdata as $vs) {
            $bahar = Tabletype::where('id', $vs->game_type)->first();
            $price_lot = $bahar->price_lot;
            $cAmount = $vs->tr_value * $price_lot;
            $data = array();
            $data['app_id'] = $vs->app_id;
            $data['admin_key'] = $vs->admin_key;
            $data['user_id'] = $vs->user_id;
            $data['transaction_id'] = $vs->transaction_id;
            $data['tr_nature'] = $vs->tr_nature;
            $data['tr_value'] = $cAmount;
            //$data['value_updated_by']=;
            $data['tr_value_type'] = "Credit";
            $data['date'] = date('d-m-Y');
            $data['tr_status'] = "Success";
            $data['table_id'] = $vs->table_id;
            $data['is_win'] = 1;
            $obj = new Point($data);
            $obj->save();
            $udata = User::where('user_id', $vs->user_id)->select('credit')->first();
            $balance = $udata->credit + $cAmount;



            DB::table('us_reg_tbl')->where('user_id', $vs->user_id)->update(['credit' => $balance]);
        }

        $result = array();
        $result['market_id'] = $mdata->market_id;
        $result['result'] = $andar . $bahar;
        $result['date'] = date('d-m-Y');
        $result['is_res_published'] = 1;
        $result['date_time_result'] = date('d-m-Y h:i:s');
        $result['day_of_result'] = date('D');
        $result['app_id'] = $mdata->app_id;
        $result['status'] = 1;
        DB::table('results_tbls')->insert($result);
        $this->notification_send($mdata->market_name, "WOW!! Result has been decleared", $result['result']);

        return redirect('administrator/market-list')->with('success_message', 'One market has been updated successfully.');
    }


    function edit_type($id)
    {
        $select = Tabletype::where('id', $id)->first();

        return view('administrator.market.edit_type', compact('select'));
    }


    function edit_store_type(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tbl_name' => 'required',
            'tbl_txt' => 'required',
            'min_point' => 'required',
            'tbl_code' => 'required',
            'tbl_image' => 'required',
            'price_lot' => 'required',
            'commision' => 'required',
            'lot_time' => 'required',
            'time_interval' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'min_point_play' => 'required',
            'max_point_allowed' => 'required',
            'market_position' => 'required',
        ]);
        // dd($validator);
        if ($validator->fails()) {

            //  return redirect()->route('admin_market_edit_type')->withErrors($validator)->withInput();
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $insert = Tabletype::find($request->id);

        $insert->tbl_name = $request->tbl_name;
        $insert->tbl_txt = $request->tbl_txt;
        $insert->min_point = $request->min_point;
        $insert->tbl_code = $request->tbl_code;
        $insert->price_lot = $request->price_lot;
        $insert->commision = $request->commision;
        $insert->lot_time = $request->lot_time;
        $insert->time_interval = $request->time_interval;
        $insert->start_time = $request->start_time;
        $insert->end_time = $request->end_time;
        $insert->min_point_play = $request->min_point_play;
        $insert->max_point_allowed = $request->max_point_allowed;
        $insert->market_position = $request->market_position;


        if ($request->tbl_image) {
            $path_original = public_path() . '/backend/uploads/tbl_types';
            $file = $request->tbl_image;
            $photo_name = time() . '-' . $file->getClientOriginalName();
            $file->move($path_original, $photo_name);
            $insert->tbl_image = $photo_name;
        }

        $insert->save();

        return redirect()->back()->with('success_message', 'One market has been updated successfully.');
    }
}
