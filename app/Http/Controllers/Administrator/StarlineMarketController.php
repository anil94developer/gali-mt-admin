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

class StarlineMarketController extends Controller
{
    public function __construct()
    {
        date_default_timezone_set('Asia/Kolkata');
    }

    /*-------Show List Page ---------*/
    public function index()
    {
        return view('administrator.starline_market.index');
    }


    public function result_day($id)
    {
        $dta = DB::table('results_tbls')->where('market_id', $id)->orderBy('id', 'desc')->first();
        if (count((array)$dta) > 0) {
            return $dta->result;
        } else {
            return 0;
        }
    }

    public function getstarline_marketData(Request $request)
    {
        // dd('ooo');
        $requestData = $_REQUEST;
        $total = Market::where('market_type', 2)->count();
        $Market = Market::whereNotNull('id')->where('market_type', 2)->orderBy('market_position', 'asc');
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
                $nestedData[] = '<a href="' . url('/administrator/starline-market/update-status/' . $item->id) . '" onclick="return confirm(' . $message . ')" title="Active"><i class="fa fa-toggle-on"></i></a>';
            } else {
                $message = "'Are you sure you want to Active the user?'";
                $nestedData[] = '<a href="' . url('/administrator/starline-market/update-status/' . $item->id) . '" onclick="return confirm(' . $message . ')" title="Inactive"><i class="fa fa-toggle-off"></i></a>';
            }
            // $changeLink = '<a href="' .url('/administrator/sub-admin/change-password/'.$item->id).'" title="Change Password"><button class="btn btn-primary btn-icon-anim btn-circle"><i class="fa fa-key"></i></button></a>';
            // $editLink = '<a href="' .url('/administrator/sub-admin/edit/'.$item->id).'" title="Edit"><button class="btn btn-warning btn-icon-anim btn-circle"><i class="fa fa-pencil"></i></button></a>';
            // $deleteLink = '<a href="' .url('/administrator/sub-admin/delete/'.$item->id).' " onclick="return confirm("Are you sure want to delete?")" title="Delete"><button class="btn btn-info btn-icon-anim btn-circle"><i class="icon-trash"></i></button></a>';
            $result = '<a href="' . url('/administrator/starline-market/result/' . $item->id) . '" title="Result"><button class="btn btn-primary ">Result</button></a>';
            $history = '<a href="' . url('/administrator/market/history/') . '" title="History"><button class="btn btn-warning ">History</button></a>';

            $editLink = '<a href="' . url('/administrator/starline-market/edit/' . $item->id) . '" title="Edit"><button class="btn btn-warning "><i class="fa fa-pencil"></i></button></a>';
            $deleteLink = '<a href="' . url('/administrator/starline-market/delete/' . $item->id) . ' " onclick="return confirm("Are you sure want to delete?")" title="Delete"><button class="btn btn-info "><i class="icon-trash"></i></button></a>';
            $ViewLink = '<a href="' . url('/administrator/starline-market/view/' . $item->id) . ' " title="View"><button class="btn btn-primary"><i class="fa fa-eye"></i></button></a>';
            $nestedData[] = $ViewLink . " " . $editLink . "  " . $deleteLink . " " . $result;
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

    public function create()
    {

        return view('administrator.starline_market.create');
    }


    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'market_name' => 'required',
            'market_view_time_open' => 'required',
            'market_view_time_close' => 'required',
            //'market_saturday_time_open' => 'required',
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
        $insert->market_view_time_open = date('H:i:s', strtotime($request->market_view_time_open));
        $insert->market_view_time_close = date('H:i:s', strtotime($request->market_view_time_close));
        $insert->market_sunday_time_close = date('H:i:s', strtotime($request->market_sunday_time_open));
        $insert->market_sunday_time_open = date('H:i:s', strtotime($request->market_sunday_time_open));
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
        $insert->market_position = 1;
        $insert->is_deleted = 1;
        $insert->market_type = 2;
        $insert->save();
        // dd($insert);
        return redirect()->route('admin_starline_market')->with('success_message', 'One New Team has been created successfully.');
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
        return view('administrator.starline_market.edit', compact('select'));
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
            //    dd('ioo');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $insert['market_name'] = $request->market_name;
        $insert['market_id'] = strtoupper(substr($request->market_name, 0, 5));
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
        $insert['market_status'] = $request->status;
        $insert['market_position'] = $request->market_position;
        $insert['status'] = $request->status;

        DB::table('comx_appmarkets')->where('id', $request->markets_id)->update($insert);
        return redirect()->route('admin_starline_market')->with('success_message', 'One New Team has been created successfully.');
    }

    function view($id)
    {

        $select = Market::where('id', $id)->first();
        return view('administrator.starline_market.view', compact('select'));
    }


    public function result($id)
    {

        return view('administrator.starline_market.result', compact('id'));
    }


    public function history()
    {

        return view('administrator.starline_market.history');
    }

    public function market_type()
    {

        return view('administrator.starline_market.markettype');
    }

    public function market_type_create()
    {

        return view('administrator.starline_market.market_create');
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
    function admin_result_starline(Request $request)
    {
        // dd('dfdfdf');
        // dd($request->all());
        date_default_timezone_set("Asia/Calcutta");
        $opennumber = $request->number;
        // $bahar = $request->bahar;
        $id = $request->id;
        $type = $request->type;
        $mdata = Market::where('id', $id)->first();
        $mid = $mdata->market_id;
        // dd($mid);
        //->whereDate('date', Carbon::today())
        $date = date('d-m-Y');
        // SELECT * FROM `point_table` WHERE  app_id ='com.dubaiking' AND table_id ='GHW19' AND tr_nature ='TRGAME001' AND is_win= '0' AND is_result_declared ='0' ORDER BY `id`  DESC
        $gdata = Point::where('table_id', $mid)->where('app_id', 'com.dubaiking')->where('is_result_declared', '0')->where('tr_nature', 'TRGAME001')->where('is_win', '0')->where('status', 'starline')->orderBy('id', 'DESC')->get();
        // dd($gdata);
        $n = (int)$opennumber;

        $x = (string)$n;
        $sum1 = 0;
        for ($i = 0; $i < strlen($x); $i++) {
            $sum1 = $sum1 + (int)$x[$i];
        }

        $resultSumNumber1 = $sum1;
        $len1 = strlen($resultSumNumber1) - 1;
        $lastvalue = substr($resultSumNumber1, $len1);


        /*$num = $n;  
        $sum=0; $rem=0;  
        for ($i =0; $i<=strlen($num);$i++)  
        {  
        $rem=$num%10;  
        $sum = $sum + $rem;  
        $num=$num/10;  
        }  
        $resultSumNumber = $sum;  
        $len = strlen($resultSumNumber) - 1;
        $lastvalue = substr($resultSumNumber,$len); */
        // dd($lastvalue);
        /*$gdata=Point::where('table_id',$mid)->where('tr_nature',"TRGAME001")->where(function($query) use($andar,$bahar) {
             return $query
                    ->where('pred_num',$andar)
                    ->orWhere('pred_num',$bahar);
            })->get();*/
        //dd($gdata);

        //->where('date',$date)   1 
        //1 jodi 2 andar 3 bahar

        if (count((array)$gdata) > 0) {
            foreach ($gdata as $vs) {
                $udata = User::where('user_id', $vs->user_id)->select('credit')->first();
                if ($vs->game_type == 1) {
                    $singlewinAmt = $vs->tr_value * 10;
                    if ($vs->pred_num == $lastvalue) {
                        $data = array();
                        $data['app_id'] = $vs->app_id;
                        $data['game_type'] = $vs->game_type;
                        $data['admin_key'] = $vs->admin_key;
                        $data['win_value'] = $singlewinAmt;
                        $data['user_id'] = $vs->user_id;
                        $data['transaction_id'] = $vs->transaction_id;
                        $data['tr_nature'] = 'TRWIN005';
                        $data['tr_value'] = $singlewinAmt;
                        $data['win_bet_amt_not_use'] = $vs->tr_value;
                        $data['status'] = $vs->status;

                        $data['value_update_by'] = 'Win';
                        $data['tr_value_type'] = "Credit";
                        $data['tr_value_updated'] = $udata->credit + $singlewinAmt;
                        $data['date'] = date('d-m-Y');
                        $data['pred_num'] = $vs->pred_num;
                        $data['tr_status'] = "Success";
                        $data['is_win'] = 1;
                        $data['date_time'] = date('Y-m-d H:i:s');

                        $data['table_id'] = $vs->table_id;
                        Db::table('point_table')->insert($data);
                        Db::table('point_table')->where('id', $vs->id)->update(['is_win' => 1, 'is_result_declared' => 1]);

                        $balance = $udata->credit + $singlewinAmt;
                        DB::table('us_reg_tbl')->where('user_id', $vs->user_id)->update(['credit' => $balance]);
                    } else {
                        Db::table('point_table')->where('id', $vs->id)->update(['is_win' => 2, 'is_result_declared' => 1]);
                    }
                } elseif ($vs->game_type == 3) {
                    $singlepanawinAmt = $vs->tr_value * 160;
                    if ($vs->pred_num == $n) {
                        $data = array();
                        $data['app_id'] = $vs->app_id;
                        $data['game_type'] = $vs->game_type;
                        $data['admin_key'] = $vs->admin_key;
                        $data['win_value'] = $singlepanawinAmt;
                        $data['user_id'] = $vs->user_id;
                        $data['transaction_id'] = $vs->transaction_id;
                        $data['tr_nature'] = 'TRWIN005';
                        $data['tr_value'] = $singlepanawinAmt;
                        $data['win_bet_amt_not_use'] = $vs->tr_value;
                        $data['status'] = $vs->status;
                        $data['value_update_by'] = 'Win';
                        $data['tr_value_type'] = "Credit";
                        $data['tr_value_updated'] = $udata->credit + $singlepanawinAmt;
                        $data['date'] = date('d-m-Y');
                        $data['pred_num'] = $vs->pred_num;
                        $data['tr_status'] = "Success";
                        $data['is_win'] = 1;
                        $data['date_time'] = date('Y-m-d H:i:s');

                        $data['table_id'] = $vs->table_id;
                        Db::table('point_table')->insert($data);
                        Db::table('point_table')->where('id', $vs->id)->update(['is_win' => 1, 'is_result_declared' => 1]);

                        $balance = $udata->credit + $singlepanawinAmt;
                        DB::table('us_reg_tbl')->where('user_id', $vs->user_id)->update(['credit' => $balance]);
                    } else {
                        Db::table('point_table')->where('id', $vs->id)->update(['is_win' => 2, 'is_result_declared' => 1]);
                    }
                } elseif ($vs->game_type == 4) {
                    $singlepanawinAmt = $vs->tr_value * 320;
                    if ($vs->pred_num == $n) {
                        $data = array();
                        $data['app_id'] = $vs->app_id;
                        $data['game_type'] = $vs->game_type;
                        $data['admin_key'] = $vs->admin_key;
                        $data['win_value'] = $singlepanawinAmt;
                        $data['user_id'] = $vs->user_id;
                        $data['transaction_id'] = $vs->transaction_id;
                        $data['tr_nature'] = 'TRWIN005';
                        $data['tr_value'] = $singlepanawinAmt;
                        $data['win_bet_amt_not_use'] = $vs->tr_value;
                        $data['status'] = $vs->status;
                        $data['value_update_by'] = 'Win';
                        $data['tr_value_type'] = "Credit";
                        $data['tr_value_updated'] = $udata->credit + $singlepanawinAmt;
                        $data['date'] = date('d-m-Y');
                        $data['pred_num'] = $vs->pred_num;
                        $data['tr_status'] = "Success";
                        $data['is_win'] = 1;
                        $data['date_time'] = date('Y-m-d H:i:s');

                        $data['table_id'] = $vs->table_id;
                        Db::table('point_table')->insert($data);
                        Db::table('point_table')->where('id', $vs->id)->update(['is_win' => 1, 'is_result_declared' => 1]);

                        $balance = $udata->credit + $singlepanawinAmt;
                        DB::table('us_reg_tbl')->where('user_id', $vs->user_id)->update(['credit' => $balance]);
                    } else {
                        Db::table('point_table')->where('id', $vs->id)->update(['is_win' => 2, 'is_result_declared' => 1]);
                    }
                } elseif ($vs->game_type == 5) {
                    $singlepanawinAmt = $vs->tr_value * 700;
                    if ($vs->pred_num == $n) {
                        $data = array();
                        $data['app_id'] = $vs->app_id;
                        $data['game_type'] = $vs->game_type;
                        $data['admin_key'] = $vs->admin_key;
                        $data['win_value'] = $singlepanawinAmt;
                        $data['user_id'] = $vs->user_id;
                        $data['transaction_id'] = $vs->transaction_id;
                        $data['tr_nature'] = 'TRWIN005';
                        $data['tr_value'] = $singlepanawinAmt;
                        $data['win_bet_amt_not_use'] = $vs->tr_value;
                        $data['status'] = $vs->status;
                        $data['value_update_by'] = 'Win';
                        $data['tr_value_type'] = "Credit";
                        $data['tr_value_updated'] = $udata->credit + $singlepanawinAmt;
                        $data['date'] = date('d-m-Y');
                        $data['pred_num'] = $vs->pred_num;
                        $data['tr_status'] = "Success";
                        $data['is_win'] = 1;

                        $data['date_time'] = date('Y-m-d H:i:s');

                        $data['table_id'] = $vs->table_id;
                        Db::table('point_table')->insert($data);
                        Db::table('point_table')->where('id', $vs->id)->update(['is_win' => 1, 'is_result_declared' => 1]);

                        $balance = $udata->credit + $singlepanawinAmt;
                        DB::table('us_reg_tbl')->where('user_id', $vs->user_id)->update(['credit' => $balance]);
                    } else {
                        Db::table('point_table')->where('id', $vs->id)->update(['is_win' => 2, 'is_result_declared' => 1]);
                    }
                }
            }
        }
        $result = array();
        $result['market_id'] = $mdata->market_id;
        $result['type'] = $mdata->game_type;
        $result['date'] = date('d-m-Y');
        $result['is_res_published'] = 1;
        $result['date_time_result'] = date('d-m-Y h:i:s');
        $result['day_of_result'] = date('D');
        $result['app_id'] = $mdata->app_id;
        $result['status'] = 1;
        $result['result'] = $n;
        $result['result2'] = $lastvalue;
        // dd($result);
        DB::table('results_tbls')->insert($result);
        // $this->notification_send($mdata->market_name, "WOW!! Result has been decleared", $result['result']);
        return redirect('administrator/starline-market-list')->with('success_message', 'One market has been updated successfully.');
    }

    // function admin_result(Request $request)
    // {
    //     date_default_timezone_set("Asia/Calcutta");
    //     $andar = $request->andar;
    //     $bahar = $request->bahar;
    //     $id = $request->id;
    //     $mdata = Market::where('id', $id)->first();
    //     $mid = $mdata->market_id;
    //     //->whereDate('date', Carbon::today())
    //     $date = date('d-m-Y');
    //     // SELECT * FROM `point_table` WHERE  app_id ='com.dubaiking' AND table_id ='GHW19' AND tr_nature ='TRGAME001' AND is_win= '0' AND is_result_declared ='0' ORDER BY `id`  DESC
    //     $gdata = Point::where('table_id', $mid)->where('app_id', 'com.dubaiking')->where('is_result_declared', '0')->where('tr_nature', 'TRGAME001')->where('is_win', '0')->orderBy('id', 'DESC')->get();

    //     /*$gdata=Point::where('table_id',$mid)->where('tr_nature',"TRGAME001")->where(function($query) use($andar,$bahar) {
    //          return $query
    //                 ->where('pred_num',$andar)
    //                 ->orWhere('pred_num',$bahar);
    //         })->get();*/
    //     //dd($gdata);

    //     //->where('date',$date)   1 
    //     //1 jodi 2 andar 3 bahar

    //     if (count((array)$gdata) > 0) {
    //         foreach ($gdata as $vs) {

    //             $udata = User::where('user_id', $vs->user_id)->select('credit')->first();
    //             if ($vs->pred_num == $andar or $vs->pred_num == $bahar or $vs->pred_num == $andar . $bahar) {

    //                 if ($vs->game_type == 2 or $vs->game_type == 3) {

    //                     $bahar1 = Tabletype::where('id', $vs->game_type)->first();

    //                     $price_lot = $bahar1->price_lot;
    //                     if ($vs->game_type == 2 and $vs->pred_num == $andar) {
    //                         $cAmount = $vs->tr_value * $price_lot;
    //                         $data = array();
    //                         $data['app_id'] = $vs->app_id;
    //                         $data['game_type'] = $vs->game_type;
    //                         $data['admin_key'] = $vs->admin_key;
    //                         $data['win_value'] = $cAmount;
    //                         $data['user_id'] = $vs->user_id;
    //                         $data['transaction_id'] = $vs->transaction_id;
    //                         $data['tr_nature'] = 'TRWIN005';
    //                         $data['tr_value'] = $cAmount;
    //                         $data['win_bet_amt_not_use'] = $vs->tr_value;

    //                         $data['value_update_by'] = 'Win';
    //                         $data['tr_value_type'] = "Credit";
    //                         $data['tr_value_updated'] = $udata->credit + $cAmount;
    //                         $data['date'] = date('d-m-Y');
    //                         if ($vs->game_type == 2) {
    //                             $pred_num = $andar;
    //                         }
    //                         if ($vs->game_type == 3) {
    //                             $pred_num = $bahar;
    //                         }
    //                         // if($vs->game_type==1)
    //                         // {
    //                         // $pred_num= $andar.$bahar;
    //                         // }

    //                         $data['pred_num'] = $pred_num;
    //                         $data['tr_status'] = "Success";

    //                         $data['date_time'] = date('Y-m-d H:i:s');

    //                         $data['table_id'] = $vs->table_id;
    //                         Db::table('point_table')->insert($data);
    //                         Db::table('point_table')->where('id', $vs->id)->update(['is_win' => 1, 'is_result_declared' => 1]);

    //                         $balance = $udata->credit + $cAmount;
    //                         DB::table('us_reg_tbl')->where('user_id', $vs->user_id)->update(['credit' => $balance]);
    //                     } elseif ($vs->game_type == 3 and $vs->pred_num == $bahar) {

    //                         $cAmount = $vs->tr_value * $price_lot;
    //                         $data = array();
    //                         $data['app_id'] = $vs->app_id;
    //                         $data['game_type'] = $vs->game_type;
    //                         $data['admin_key'] = $vs->admin_key;
    //                         $data['win_value'] = $cAmount;
    //                         $data['user_id'] = $vs->user_id;
    //                         $data['transaction_id'] = $vs->transaction_id;
    //                         $data['tr_nature'] = 'TRWIN005';
    //                         $data['tr_value'] = $cAmount;
    //                         $data['win_bet_amt_not_use'] = $vs->tr_value;

    //                         $data['value_update_by'] = 'Win';
    //                         $data['tr_value_type'] = "Credit";
    //                         $data['tr_value_updated'] = $udata->credit + $cAmount;
    //                         $data['date'] = date('d-m-Y');
    //                         if ($vs->game_type == 2) {
    //                             $pred_num = $andar;
    //                         }
    //                         if ($vs->game_type == 3) {
    //                             $pred_num = $bahar;
    //                         }
    //                         // if($vs->game_type==1)
    //                         // {
    //                         // $pred_num= $andar.$bahar;
    //                         // }

    //                         $data['pred_num'] = $pred_num;
    //                         $data['tr_status'] = "Success";

    //                         $data['date_time'] = date('Y-m-d H:i:s');

    //                         $data['table_id'] = $vs->table_id;
    //                         Db::table('point_table')->insert($data);
    //                         Db::table('point_table')->where('id', $vs->id)->update(['is_win' => 1, 'is_result_declared' => 1]);

    //                         $balance = $udata->credit + $cAmount;
    //                         DB::table('us_reg_tbl')->where('user_id', $vs->user_id)->update(['credit' => $balance]);
    //                     } else {
    //                         Db::table('point_table')->where('id', $vs->id)->update(['is_win' => 2, 'is_result_declared' => 1]);
    //                     }
    //                 } else {
    //                     if ($vs->pred_num == $andar . $bahar) {
    //                         $bahar1 = Tabletype::where('id', $vs->game_type)->first();
    //                         $price_lot = $bahar1->price_lot;
    //                         $cAmount = $vs->tr_value * $price_lot;
    //                         $data = array();
    //                         $data['app_id'] = $vs->app_id;
    //                         $data['game_type'] = $vs->game_type;
    //                         $data['admin_key'] = $vs->admin_key;
    //                         $data['win_value'] = $cAmount;
    //                         $data['user_id'] = $vs->user_id;
    //                         $data['transaction_id'] = $vs->transaction_id;
    //                         $data['tr_nature'] = 'TRWIN005';
    //                         $data['tr_value'] = $cAmount;
    //                         $data['win_bet_amt_not_use'] = $vs->tr_value;

    //                         $data['value_update_by'] = 'Win';
    //                         $data['tr_value_type'] = "Credit";
    //                         $data['tr_value_updated'] = $udata->credit + $cAmount;
    //                         $data['date'] = date('d-m-Y');
    //                         $pred_num = $andar . $bahar;
    //                         $data['pred_num'] = $pred_num;
    //                         $data['tr_status'] = "Success";

    //                         $data['date_time'] = date('Y-m-d H:i:s');

    //                         $data['table_id'] = $vs->table_id;
    //                         Db::table('point_table')->insert($data);
    //                         Db::table('point_table')->where('id', $vs->id)->update(['is_win' => 1, 'is_result_declared' => 1]);

    //                         $balance = $udata->credit + $cAmount;
    //                         DB::table('us_reg_tbl')->where('user_id', $vs->user_id)->update(['credit' => $balance]);
    //                     }
    //                 }
    //             } else {

    //                 Db::table('point_table')->where('id', $vs->id)->update(['is_win' => 2, 'is_result_declared' => 1]);
    //             }
    //         }
    //     }
    //     $result = array();
    //     $result['market_id'] = $mdata->market_id;
    //     $result['result'] = $andar . $bahar;
    //     $result['date'] = date('d-m-Y');
    //     $result['is_res_published'] = 1;
    //     $result['date_time_result'] = date('d-m-Y h:i:s');
    //     $result['day_of_result'] = date('D');
    //     $result['app_id'] = $mdata->app_id;
    //     $result['status'] = 1;
    //     DB::table('results_tbls')->insert($result);
    //     $this->notification_send($mdata->market_name, "WOW!! Result has been decleared", $result['result']);
    //     return redirect('administrator/market-list')->with('success_message', 'One market has been updated successfully.');
    // }


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
