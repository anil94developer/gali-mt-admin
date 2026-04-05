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
use App\Models\BonusReport;
use Session;
use Hash;
use DB;
use App\Helpers\Helper;

class PointController extends Controller
{
    public function __construct()
    {
    }

    /*-------Show List Page ---------*/
    public function deposit_point_list()
    {
        return view('administrator.point.deposit');
    }

    public function bonus_report()
    {
        $data = DB::table('us_reg_tbl')->where('is_child', 0)->where('is_ref_check', 0)->get();
        foreach ($data as $vs) {
            $chk = Helper::get_child($vs->ref_code);
            if ($chk > 0) {
                DB::table('us_reg_tbl')->where('id', $vs->id)->update(['is_child' => 1]);
            }
        }
        DB::table('us_reg_tbl')->update(['is_ref_check' => 1]);
        return view('administrator.report.index');
    }

    public function withdraw_point_list()
    {
        return view('administrator.point.withdraw');
    }
    public function winner_point_list()
    {
        $total_winner = Point::where('win_value', '1')->where('tr_value_type', 'Credit')->where('tr_nature', 'TRGAME001')->where('tr_status', 'Success')->sum('tr_value');
        $total_deposite = Point::where('tr_nature', 'TRDEPO002')->where('tr_status', 'Success')->sum('tr_value');
        $total_bat = Point::where('tr_nature', 'TRGAME001')->where('tr_value_type', 'Debit')->count();
        $total_invester = Point::where('win_value', '0')->where('tr_nature', 'TRGAME001')->where('tr_status', 'Success')->sum('tr_value');
        $total_profit_loss = $total_invester - $total_winner;
        $market = Market::get();
        return view('administrator.point.winner', compact('market', 'total_winner', 'total_deposite', 'total_bat', 'total_profit_loss'));
    }
    public function bet_list()
    {
        //$total_winner = Point::where('win_value', '1')->where('tr_value_type', 'Credit')->where('tr_nature', 'TRGAME001')->where('tr_status', 'Success')->sum('tr_value');
        //$total_deposite = Point::where('tr_nature', 'TRDEPO002')->where('tr_status', 'Success')->sum('tr_value');
        //$total_bat = Point::where('tr_nature', 'TRGAME001')->where('tr_value_type', 'Debit')->count();
        $total_amount = Point::where('tr_nature', 'TRGAME001')->where('tr_value_type', 'Debit')->sum('tr_value');
        $with = Point::where('tr_nature', 'TRWIN005')->where('tr_value_type', "Credit")->sum('tr_value');

        //$total_invester = Point::where('win_value', '0')->where('tr_nature', 'TRGAME001')->where('tr_status', 'Success')->sum('tr_value');
        $market = Market::get();
        return view('administrator.point.bat', compact('total_amount', 'with', 'market'));
    }

    /*-------Get data for listing Page ---------*/
    public function get_deposit_point(Request $request)
    {
        $columns = array(
            0 => 'point_table.id',
            1 => 'point_table.user_id',
            2 => 'point_table.pred_num'
        );
        $requestData = $_REQUEST;
        $total = Point::with('user_data')->where('value_update_by', 'Deposit')->count();
        $subAdmin = Point::with('user_data')->whereNotNull('id')->where('value_update_by', 'Deposit')->orderBy('created_at', 'desc');
        if ($requestData['search']['value']) {
            $searchString = $requestData['search']['value'];
            $subAdmin = $subAdmin->whereHas('user_data', function ($query) use ($searchString) {
                $query->whereRaw("mob LIKE '%" . $searchString . "%'");
            });

            //$subAdmin = $subAdmin->where('mob', 'like', '%' . $requestData['search']['value'] . '%');

        }
        if ($request->orderBy) {
            $subAdmin = $subAdmin->orderBy($request->orderBy, $request->ascending == 1 ? 'ASC' : 'DESC');
        }
        if ($request->from != "") {
            $subAdmin = $subAdmin->whereDate('created_at',  '>=', $request->from)->whereDate('created_at',  '<=', $request->to);
        }
        $orderColumn = $columns[$requestData['order'][0]['column']];
        $orderColumnDir = $requestData['order'][0]['dir'];
        $limit = $requestData['length'];
        $offset = $requestData['start'];
        $subAdmin = $subAdmin->offset($offset)->limit($limit)->orderBy($orderColumn, $orderColumnDir)->get();

        $i = 0;
        $datas = [];
        foreach ($subAdmin as $item) {
            $i++;
            // dd($item);
            $nestedData = array();
            $nestedData[] = $i;

            $nestedData[] = !is_null($item->user_data) ? $item->user_data->FullName : "NA";
            $nestedData[] = !is_null($item->user_data) ? $item->user_data->mob : "NA";
            $nestedData[] = $item->transaction_id;
            $nestedData[] = $item->tr_value;
            $nestedData[] = $item->tr_value_type;
            $nestedData[] = $item->tr_status;
            $nestedData[] = $item->value_update_by;
            $nestedData[] = date("d-m-Y h:i a", strtotime($item->created_at));


            // if($item->status){
            //     $message = "'Are you sure you want to Inactive the user?'";
            //     $nestedData[] = '<a href="' .url('/administrator/sub-admin/update-status/'.$item->id).'" onclick="return confirm('.$message.')" title="Active"><i class="fa fa-toggle-on"></i></a>';
            // }else{
            //     $message = "'Are you sure you want to Active the user?'";
            //     $nestedData[] = '<a href="' .url('/administrator/sub-admin/update-status/'.$item->id).'" onclick="return confirm('.$message.')" title="Inactive"><i class="fa fa-toggle-off"></i></a>';
            // }
            // $changeLink = '<a href="' .url('/administrator/sub-admin/change-password/'.$item->id).'" title="Change Password"><button class="btn btn-primary btn-icon-anim btn-circle"><i class="fa fa-key"></i></button></a>';
            // $editLink = '<a href="' .url('/administrator/sub-admin/edit/'.$item->id).'" title="Edit"><button class="btn btn-warning btn-icon-anim btn-circle"><i class="fa fa-pencil"></i></button></a>';
            // $deleteLink = '<a href="' .url('/administrator/sub-admin/delete/'.$item->id).' " onclick="return confirm("Are you sure want to delete?")" title="Delete"><button class="btn btn-info btn-icon-anim btn-circle"><i class="icon-trash"></i></button></a>';
            // $ViewLink = '<a href="' .url('/administrator/sub-admin/view/'.$item->id).' " title="View"><button class="btn btn-primary btn-icon-anim btn-circle"><i class="fa fa-eye"></i></button></a>';
            // $nestedData[] = $ViewLink;
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

    function last_day_of_the_month($date = '')
    {
        $month  = date('m', strtotime($date));
        $year   = date('Y', strtotime($date));
        $result = strtotime("{$year}-{$month}-01");
        $result = strtotime('-1 second', strtotime('+1 month', $result));

        return date('Y-m-d', $result);
    }


    /*-------Get data for listing Page ---------*/
    public function get_bonus_data(Request $request)
    {
        $dta = DB::table('app_controller')->select('ref_comm')->first();
        $columns = array(
            0 => 'us_reg_tbl.id',
            1 => 'us_reg_tbl.FullName',
            2 => 'us_reg_tbl.mob'
        );
        // dd('ooo');
        $requestData = $_REQUEST;
        $total = User::where('is_child', 1)->count();
        $subAdmin = User::where('is_child', 1)->orderBy('created_at', 'desc');
        if ($requestData['search']['value']) {
            $subAdmin = $subAdmin->where('FullName', 'like', '%' . $requestData['search']['value'] . '%');
        }
        if ($request->orderBy) {
            $subAdmin = $subAdmin->orderBy($request->orderBy, $request->ascending == 1 ? 'ASC' : 'DESC');
        }

        $orderColumn = $columns[$requestData['order'][0]['column']];
        $orderColumnDir = $requestData['order'][0]['dir'];
        $limit = $requestData['length'];
        $offset = $requestData['start'];
        $subAdmin = $subAdmin->offset($offset)->limit($limit)->orderBy($orderColumn, $orderColumnDir)->get();


        //$subAdmin = $subAdmin->paginate($request->limit ? $request->limit : 20);


        $i = 0;
        $datas = [];
        foreach ($subAdmin as $item) {
            $pamt = Helper::get_child_played($item->ref_code);
            $chk = Helper::get_child($item->ref_code);

            $i++;
            $nestedData = array();
            $nestedData[] = $i;
            $nestedData[] = $item->FullName;
            $nestedData[] = $item->mob;
            $nestedData[] = Helper::get_child($item->ref_code);
            $nestedData[] = $pamt;
            $nestedData[] = $pamt * $dta->ref_comm / 100;
            $pay = "";
            //$pay='<a class="btn btn-primary" href="' .url('/administrator/bonus/pay/'.$item->user_id).' " title="View">Pay Now</a>';

            if ($this->last_day_of_the_month(date('Y-m-d')) == date('Y-m-d')) {
                $pay = '<a href="' . url('/administrator/bonus/pay/' . $item->user_id) . ' " title="View">Pay Now</a>';
            }
            $nestedData[] = '<a href="' . url('/administrator/bonus/view/' . $item->user_id) . ' " title="View"><button class="btn btn-primary btn-icon-anim btn-circle"><i class="fa fa-eye"></i></button></a>' . " " . $pay;
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

    /*-------Get data for listing Page ---------*/
    public function getchildData(Request $request)
    {
        $dta = DB::table('app_controller')->select('ref_comm')->first();

        // dd('ooo');
        $requestData = $_REQUEST;
        $total = User::where('ref_by', $request->user_id)->count();
        $subAdmin = User::where('ref_by', $request->user_id)->orderBy('created_at', 'desc');
        if ($requestData['search']['value']) {
            $subAdmin = $subAdmin->where('FullName', 'like', '%' . $requestData['search']['value'] . '%');
        }
        if ($request->orderBy) {
            $subAdmin = $subAdmin->orderBy($request->orderBy, $request->ascending == 1 ? 'ASC' : 'DESC');
        }
        $subAdmin = $subAdmin->paginate($request->limit ? $request->limit : 20);
        $i = 0;
        $datas = [];
        foreach ($subAdmin as $item) {
            $pmt = Helper::get_played($item->user_id);
            $i++;
            $nestedData = array();
            $nestedData[] = $i;
            $nestedData[] = $item->FullName;
            $nestedData[] = $item->mob;
            $nestedData[] = Helper::get_played($item->user_id);
            $nestedData[] = $pmt * $dta->ref_comm / 100;
            $nestedData[] = '<a href="' . url('/administrator/bonus-market/view/' . $item->user_id) . ' " title="View"><button class="btn btn-primary btn-icon-anim btn-circle"><i class="fa fa-eye"></i></button></a>';
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

    /*-------Get data for listing Page ---------*/
    public function getMarketData(Request $request)
    {
        $dta = DB::table('app_controller')->select('ref_comm')->first();

        // dd('ooo');
        $requestData = $_REQUEST;
        $total = Point::where('user_id', $request->user_id)->where('tr_nature', 'TRGAME001')->where('tr_value_type', "Debit")->groupBy('table_id')->count();
        $subAdmin = Point::where('user_id', $request->user_id)->select(DB::raw("SUM(tr_value) as sum"), 'table_id')->where('tr_nature', 'TRGAME001')->where('tr_value_type', "Debit")->groupBy('table_id');
        if ($requestData['search']['value']) {
            $subAdmin = $subAdmin->where('FullName', 'like', '%' . $requestData['search']['value'] . '%');
        }
        if ($request->orderBy) {
            $subAdmin = $subAdmin->orderBy($request->orderBy, $request->ascending == 1 ? 'ASC' : 'DESC');
        }
        $subAdmin = $subAdmin->paginate($request->limit ? $request->limit : 20);
        $i = 0;
        $datas = [];
        foreach ($subAdmin as $item) {
            $pmt = Helper::get_played($item->user_id);
            $i++;
            $nestedData = array();
            $nestedData[] = $i;
            $nestedData[] = $item->table_id;
            $nestedData[] = $item->sum;
            $nestedData[] = $item->sum * $dta->ref_comm / 100;
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

    function pl_merket($date)
    {
        $market = Market::get();
        return view('administrator.report.date_profit_loss_list', compact('market', 'date'));
    }

    /*-------Get data for listing Page ---------*/
    public function getPlData(Request $request)
    {
        $requestData = $_REQUEST;
        $total = Point::where('tr_nature', 'TRGAME001')->count();
        $subAdmin = Point::where('tr_nature', 'TRGAME001')->groupBy('date')->groupBy('table_id');
        if ($requestData['search']['value']) {
            $subAdmin = $subAdmin->where('FullName', 'like', '%' . $requestData['search']['value'] . '%');
        }
        if ($request->orderBy) {
            $subAdmin = $subAdmin->orderBy($request->orderBy, $request->ascending == 1 ? 'ASC' : 'DESC');
        }
        $subAdmin = $subAdmin->paginate($request->limit ? $request->limit : 20);
        $i = 0;
        $datas = [];
        foreach ($subAdmin as $item) {
            $i++;
            $amt = Helper::get_pl($item->date, $item->table_id);
            $nestedData = array();
            $nestedData[] = $i;
            $nestedData[] = $item->date;
            $nestedData[] = $item->table_id;
            $nestedData[] = $amt;
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


    /*-------Get data for listing Page ---------*/
    public function getMPlData(Request $request)
    {
        $requestData = $_REQUEST;
        $total = Point::where('tr_nature', 'TRGAME001')->count();
        $subAdmin = Point::where('tr_nature', 'TRGAME001')->groupBy('date');
        if ($requestData['search']['value']) {
            $subAdmin = $subAdmin->where('FullName', 'like', '%' . $requestData['search']['value'] . '%');
        }
        if ($request->orderBy) {
            $subAdmin = $subAdmin->orderBy($request->orderBy, $request->ascending == 1 ? 'ASC' : 'DESC');
        }
        if ($request->month) {
            $subAdmin = $subAdmin->whereMonth('created_at', $request->month);
        }
        if ($request->year) {
            $subAdmin = $subAdmin->whereYear('created_at', $request->year);
        }



        $subAdmin = $subAdmin->paginate($request->limit ? $request->limit : 20);
        $i = 0;
        $datas = [];
        foreach ($subAdmin as $item) {
            $i++;
            $amt = Helper::get_date_pl($item->date);
            $nestedData = array();
            $nestedData[] = $i;
            $nestedData[] = $item->date;
            $nestedData[] = $amt;
            $nestedData[] = '<a href="' . url('/administrator/pl-market/view/' . $item->date) . ' " title="View"><button class="btn btn-primary btn-icon-anim btn-circle"><i class="fa fa-eye"></i></button></a>';


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

    public function bonus_view($id)
    {
        $users = User::where('user_id', $id)->first();
        $dta = DB::table('app_controller')->select('ref_comm')->first();
        $child = Helper::get_child($users->ref_code);
        $pamt = Helper::get_child_played($users->ref_code);
        $comm = $pamt * $dta->ref_comm / 100;

        return view('administrator.report.view', compact('pamt', 'comm', 'child', 'users'));
    }

    public function bet_report()
    {
        //$users = User::where('user_id',$id)->first();
        //$dta=DB::table('app_controller')->select('ref_comm')->first();
        //$child=Helper::get_child($users->ref_code);
        //$pamt=Helper::get_child_played($users->ref_code);
        //$comm=$pamt*$dta->ref_comm/100;
        $market = Market::get();
        $total_amount = Point::where('tr_nature', 'TRGAME001')->where('tr_value_type', 'Debit');
        if (isset($_GET['market'])) {
            $total_amount = $total_amount->where('table_id', $_GET['market']);
        }
        if (isset($_GET['startDate']) and isset($_GET['endDate'])) {
            $total_amount = $total_amount->whereDate('created_at',  '>=', $_GET['startDate'])->whereDate('created_at',  '<=', $_GET['endDate']);;
        }
        $total_amount = $total_amount->sum('tr_value');

        $with = Point::where('tr_nature', 'TRWIN005')->where('tr_value_type', "Credit");
        if (isset($_GET['market'])) {
            $with = $with->where('table_id', $_GET['market']);
        }
        if (isset($_GET['startDate']) and isset($_GET['endDate'])) {
            $with = $with->whereDate('created_at',  '>=', $_GET['endDate'])->whereDate('created_at',  '<=', $_GET['endDate']);;
        }
        $with = $with->sum('tr_value');
        return view('administrator.point.bet_report', compact('market', 'total_amount', 'with'));
    }

    public function pay_bonus($id)
    {
        $users = User::where('user_id', $id)->first();
        $dta = DB::table('app_controller')->select('ref_comm')->first();
        $child = Helper::get_child($users->ref_code);
        $pamt = Helper::get_child_played($users->ref_code);
        $comm = $pamt * $dta->ref_comm / 100;

        $data = array();
        $data['app_id'] = "com.dubaiking";
        $data['game_type'] = "";
        $data['admin_key'] = "ADMIN0001";
        $data['win_value'] = $comm;
        $data['user_id'] = $id;
        $data['transaction_id'] = "#" . rand(111, 999) . rand(11, 99);
        $data['tr_nature'] = 'TRWIN005';
        $data['tr_value'] = $comm;
        $data['win_bet_amt_not_use'] = $comm;
        $data['value_update_by'] = 'Bonus';
        $data['tr_value_type'] = "Credit";
        $data['date'] = date('d-m-Y');
        $data['tr_status'] = "Success";
        $data['date_time'] = date('Y-m-d H:i:s');
        Db::table('point_table')->insert($data);
        $balance = $users->credit + $comm;
        DB::table('us_reg_tbl')->where('user_id', $id)->update(['credit' => $balance]);
        return redirect()->back()->with('success_message', 'Commission has been transfered successfully');
        //return view('administrator.report.view', compact('pamt', 'comm', 'child', 'users'));
    }


    public function profit_loss_list()
    {
        return view('administrator.report.profit_loss_list');
    }

    public function monthly_profit_loss_list()
    {
        return view('administrator.report.monthly_profit_loss_list');
    }



    public function bonus_market_view($id)
    {

        $users = User::where('user_id', $id)->first();
        $dta = DB::table('app_controller')->select('ref_comm')->first();
        $pamt = Helper::get_played($users->user_id);
        $comm = $pamt * $dta->ref_comm / 100;

        return view('administrator.report.bonus_view', compact('pamt', 'comm', 'users'));
    }

    public function get_withdraw_point(Request $request)
    {
        $columns = array(
            0 => 'point_table.id',
            1 => 'point_table.user_id',
            2 => 'point_table.pred_num'
        );
        $requestData = $_REQUEST;
        $total = Point::with('user_data')->where('value_update_by', 'Withdraw')->count();
        $subAdmin = Point::with('user_data')->where('value_update_by', 'Withdraw')->orderBy('created_at', 'desc');
        if ($requestData['search']['value']) {
            $searchString = $requestData['search']['value'];


            $subAdmin = $subAdmin->whereHas('user_data', function ($query) use ($searchString) {
                $query->whereRaw("mob LIKE '%" . $searchString . "%'");
            });

            $total = Point::with('user_data')->whereNotNull('id')->where('value_update_by', 'Withdraw')->orderBy('created_at', 'desc')->orWhereHas('user_data', function ($query) use ($searchString) {
                $query->whereRaw("mob LIKE '%" . $searchString . "%'");
            })->get()->count();
        }
        if ($request->from != "") {
            $subAdmin = $subAdmin->whereDate('created_at',  '>=', $request->from)->whereDate('created_at',  '<=', $request->to);
        }

        if ($request->orderBy) {
            $subAdmin = $subAdmin->orderBy($request->orderBy, $request->ascending == 1 ? 'ASC' : 'DESC');
        }
        $orderColumn = $columns[$requestData['order'][0]['column']];
        $orderColumnDir = $requestData['order'][0]['dir'];
        $limit = $requestData['length'];
        $offset = $requestData['start'];
        $subAdmin = $subAdmin->offset($offset)->limit($limit)->orderBy($orderColumn, $orderColumnDir)->get();

        $i = 0;
        $datas = [];
        foreach ($subAdmin as $item) {
            $i++;
            // dd($item);
            $nestedData = array();
            $nestedData[] = $i;

            $nestedData[] = (!is_null($item->user_data) ? $item->user_data->mob : "NA");
            $nestedData[] = (!is_null($item->user_data) ? $item->user_data->FullName : "NA");
            $nestedData[] = $item->transaction_id;
            $nestedData[] = $item->win_value;
            $nestedData[] = $item->tr_value;
            $nestedData[] = $item->tr_value_type;
            $nestedData[] = $item->tr_status;
            $nestedData[] = $item->value_update_by;
            $nestedData[] = $item->tr_remark;
            $nestedData[] = date("d-m-Y h:i a", strtotime($item->created_at));


            if ($item->tr_status == 'Pending') {
                $accept = '<a href="' . url('/administrator/point-withdraw/accpet/' . $item->id) . ' " title="Accpet"><button class="btn btn-primary ">Accept</i></button></a>';
                $declined = '<a href="' . url('/administrator/point-withdraw/declined/' . $item->id) . ' " title="Declined"><button class="btn btn-danger ">Declined</i></button></a>';
                $nestedData[] = $accept . " " . $declined;
            } else {
                $nestedData[] = '<button class="btn btn-success ">' . $item->tr_status . '</i></button>';
            }
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

    public function get_winner_point(Request $request)
    {

        $columns = array(
            0 => 'point_table.id',
            1 => 'point_table.user_id',
            2 => 'point_table.pred_num'
        );
        $requestData = $_REQUEST;
        $total = Point::with('user_data')->where('tr_nature', 'TRWIN005')->count();
        $subAdmin = Point::with('user_data')->whereNotNull('id')->where('tr_nature', 'TRWIN005')->orderBy('created_at', 'desc');
        if ($requestData['search']['value']) {

            $searchString = $requestData['search']['value'];
            $subAdmin = $subAdmin->whereHas('user_data', function ($query) use ($searchString) {
                $query->whereRaw("mob LIKE '%" . $searchString . "%'");
            });

            //$subAdmin = $subAdmin->where('FullName', 'like', '%' . $requestData['search']['value'] . '%')->orWhere('game_type','like', '%' . $requestData['search']['value'] . '%');
        }
        if ($request->from != "") {
            $subAdmin = $subAdmin->whereDate('created_at', '>=', $request->from)->whereDate('created_at', '<=', $request->to);
        }

        if ($request->market != "") {
            $subAdmin = $subAdmin->where('table_id', $request->market);
        }
        if ($request->orderBy) {
            $subAdmin = $subAdmin->orderBy($request->orderBy, $request->ascending == 1 ? 'ASC' : 'DESC');
        }

        $orderColumn = $columns[$requestData['order'][0]['column']];
        $orderColumnDir = $requestData['order'][0]['dir'];
        $limit = $requestData['length'];
        $offset = $requestData['start'];
        $subAdmin = $subAdmin->offset($offset)->limit($limit)->orderBy($orderColumn, $orderColumnDir)->get();


        //$subAdmin = $subAdmin->paginate($request->limit ? $request->limit : 20);

        $i = 0;
        $datas = [];
        foreach ($subAdmin as $item) {
            $i++;
            // dd($item);

            $nestedData = array();
            $nestedData[] = $i;

            $nestedData[] = !is_null($item->user_data) ? $item->user_data->mob : "NA";

            $nestedData[] = !is_null($item->user_data) ? $item->user_data->FullName : "NA";

            $data = Helper::get_market($item->table_id);
            $nestedData[] = ((count((array)$data) > 0) ? $data->market_name : $item->table_id);
            $nestedData[] = $item->status;
            $game_type = Helper::get_game_type($item->game_type);
            $nestedData[] = $game_type;
            $nestedData[] = $item->pred_num;
            $nestedData[] = $item->win_bet_amt_not_use;
            $nestedData[] = $item->win_value;
            $nestedData[] = $item->date_time;
            // $nestedData[] = date("d-m-Y h:i a", strtotime($item->created_at));

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
    public function get_bet_point(Request $request)
    {
        $columns = array(
            0 => 'point_table.id',
            1 => 'point_table.user_id',
            2 => 'point_table.pred_num'
        );
        $requestData = $_REQUEST;
        $total = Point::with('user_data')->where('tr_nature', 'TRGAME001')->where('value_update_by', 'Game')->where('tr_status', 'Success')->count();
        $subAdmin = Point::with('user_data')->whereNotNull('id')->where('tr_nature', 'TRGAME001')->where('value_update_by', 'Game')->where('tr_status', 'Success')->orderBy('created_at', 'desc');
        if ($requestData['search']['value']) {
            $searchString = $requestData['search']['value'];
            $subAdmin = $subAdmin->whereHas('user_data', function ($query) use ($searchString) {
                $query->whereRaw("mob LIKE '%" . $searchString . "%'");
            });


            $total = Point::with('user_data')->whereNotNull('id')->where('tr_nature', 'TRGAME001')->where('value_update_by', 'Game')->where('tr_status', 'Success')->orderBy('created_at', 'desc')->orWhereHas('user_data', function ($query) use ($searchString) {
                $query->whereRaw("us_reg_tbl.FullName LIKE '%" . $searchString . "%'");
            })->get()->count();
            //$subAdmin = $subAdmin->where('FullName', 'like', '%' . $requestData['search']['value'] . '%');
        }

        if ($request->orderBy) {
            $subAdmin = $subAdmin->orderBy($request->orderBy, $request->ascending == 1 ? 'ASC' : 'DESC');
        }
        if ($request->from != "") {
            $subAdmin = $subAdmin->whereDate('created_at',  '>=', $request->from)->whereDate('created_at',  '<=', $request->to);
        }

        if ($request->market != "") {
            $subAdmin = $subAdmin->where('table_id', $request->market);
        }

        $orderColumn = $columns[$requestData['order'][0]['column']];
        $orderColumnDir = $requestData['order'][0]['dir'];
        $limit = $requestData['length'];
        $offset = $requestData['start'];
        $subAdmin = $subAdmin->offset($offset)->limit($limit)->orderBy($orderColumn, $orderColumnDir)->get();

        //$subAdmin = $subAdmin->paginate($request->limit ? $request->limit : 20);

        $i = 0;
        $datas = [];
        foreach ($subAdmin as $item) {
            $i++;
            // dd($item);

            $nestedData = array();
            $nestedData[] = $i;

            $nestedData[] = !is_null($item->user_data) ? $item->user_data->mob : "NA";
            $nestedData[] = !is_null($item->user_data) ? $item->user_data->FullName : "NA";
            $data = Helper::get_market($item->table_id);
            $nestedData[] = ((count((array)$data) > 0) ? $data->market_name : "NA");
            $nestedData[] = strtoupper($item->status);

            $game_type = Helper::get_game_type($item->game_type);
            $nestedData[] = is_null($game_type) ? 'NA' : $game_type;
            $nestedData[] = $item->pred_num;
            $nestedData[] = $item->close_sangam;
            $nestedData[] = $item->win_bet_amt_not_use;
            $nestedData[] = $item->tr_value;
            $nestedData[] = $item->date_time;
            // $nestedData[] = date("d-m-Y h:i a", strtotime($item->created_at));
            if ($item->is_result_declared == 1) {
                if ($item->close_sangam) {
                    $nestedData[] = '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" onclick="getid(' . $item->id . ',1)">Edit</button>';
                } else {
                    $nestedData[] = '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" onclick="getid(' . $item->id . ',2)">Edit</button>';
                }
            } else {
                $nestedData[] = '';
            }
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
    public function bet_number_update(Request $request)
    {
        // dd($request->all());
        if ($request->numbersecond) {

            $total = Point::where('id', $request->id)->where('tr_nature', 'TRGAME001')->where('value_update_by', 'Game')->update(['pred_num' => $request->number, 'close_sangam' => $request->numbersecond]);
        } else {
            $total = Point::where('id', $request->id)->where('tr_nature', 'TRGAME001')->where('value_update_by', 'Game')->update(['pred_num' => $request->number]);
        }
        Session::flash('success_message', "Number has been Updated successfully");
        return redirect()->back();
    }
    public function accept_withdraw($id)
    {
        // dd($id);
        $data = Point::with('user_data')->where('id', $id)->first();
        // dd($data);
        //$v=explode(" ",$data->tr_remark);
        $data1 = array();
        $data1['name'] = $data->user_data->FullName;
        $data1['contact'] = $data->user_data->mob;;
        $data1['email'] = "anmolrattan631@gmail.com";
        $data1['ref_id'] = $data->user_data->id;
        /*if($v[0]=="PhonePe")
		{
		$data1['vpa']=$v[1].'@ybl';
		}
		elseif($v[0]=="Paytm")
		{
			$data1['vpa']=$v[1].'@paytm';
		}*/
        $data1['vpa'] = trim($data->tr_remark);
        // $fdata = Helper::add_fund_account($data1);
        // $res = Helper::payment($fdata->id, $data->tr_value * 100);

        // if (@$res->error->code != "NA") {
        //     Session::flash('error_message', $res->error->description);
        // } else {

        // DB::table('withdraw_payout_data')->insert(['point_id' => $data->id, 'transaction_id' => $res->id]);
        $update = Point::with('user_data')->where('id', $id)->update(['tr_status' => 'Success']);
        $User = User::where('user_id', $data->user_id)->first();
        $user_amuont = $User->credit;
        $recive_amount = $data->tr_value;
        $total = $user_amuont - $recive_amount;
        $User = User::where('user_id', $data->user_id)->update(['credit' => $total]);
        Session::flash('success_message', "Amount has been transfered successfully");
        // }


        return redirect()->back();
    }
    public function declined_withdraw($id)
    {
        $update = Point::with('user_data')->where('id', $id)->update(['tr_status' => 'Cancelled']);
        $data = Point::with('user_data')->where('id', $id)->first();
        $User = User::where('user_id', $data->user_id)->first();
        $user_amuont = $User->credit;
        $recive_amount = $data->tr_value;
        $total = $user_amuont + $recive_amount;
        $User = User::where('user_id', $data->user_id)->update(['credit' => $total]);

        return redirect()->back();
    }

    public function withdraw_pending_point_list()
    {
        return view('administrator.point.pending_withdraw');
    }

    public function get_withdraw_pending_point(Request $request)
    {
        // dd('ooo');
        $requestData = $_REQUEST;
        $total = Point::with('user_data')->where('tr_nature', 'TRWITH003')->where('tr_status', 'Pending')->count();
        $subAdmin = Point::with('user_data')->whereNotNull('id')->where('tr_nature', 'TRWITH003')->where('tr_status', 'Pending')->orderBy('created_at', 'desc');
        if ($request->from != "") {
            $subAdmin = $subAdmin->whereDate('created_at',  '>=', $request->from)->whereDate('created_at',  '<=', $request->to);
        }
        if ($requestData['search']['value']) {
            $searchString = $requestData['search']['value'];
            $subAdmin = $subAdmin->whereHas('user_data', function ($query) use ($searchString) {
                $query->whereRaw("mob LIKE '%" . $searchString . "%'");
            });

            //$subAdmin = $subAdmin->where('FullName', 'like', '%' . $requestData['search']['value'] . '%');

        }
        if ($request->orderBy) {
            $subAdmin = $subAdmin->orderBy($request->orderBy, $request->ascending == 1 ? 'ASC' : 'DESC');
        }
        $subAdmin = $subAdmin->paginate($request->limit ? $request->limit : 20);
        $i = 0;
        $datas = [];
        foreach ($subAdmin as $item) {
            $i++;
            // dd($item);
            $nestedData = array();
            $nestedData[] = $i;

            $nestedData[] = (!is_null($item->user_data) ? $item->user_data->mob : "NA");
            $nestedData[] = (!is_null($item->user_data) ? $item->user_data->FullName : "NA");
            $nestedData[] = $item->transaction_id;
            $nestedData[] = $item->win_value;
            $nestedData[] = $item->tr_value;
            $nestedData[] = $item->tr_value_type;
            $nestedData[] = $item->tr_status;
            $nestedData[] = $item->value_update_by;
            $nestedData[] = $item->tr_remark;
            $nestedData[] = date("d-m-Y h:i a", strtotime($item->created_at));


            // if($item->status){
            //     $message = "'Are you sure you want to Inactive the user?'";
            //     $nestedData[] = '<a href="' .url('/administrator/withdraw/update-pending/'.$item->id).'" onclick="return confirm('.$message.')" title="Active"><i class="fa fa-toggle-on"></i></a>';
            // }else{
            //     $message = "'Are you sure you want to Active the user?'";
            //     $nestedData[] = '<a href="' .url('/administrator/market/update-pending/'.$item->id).'" onclick="return confirm('.$message.')" title="Inactive"><i class="fa fa-toggle-off"></i></a>';
            // }
            if ($item->tr_status == 'Pending') {
                $accept = '<a href="' . url('/administrator/point-withdraw/accpet/' . $item->id) . ' " title="Accpet"><button class="btn btn-primary ">Accept</i></button></a>';
                $declined = '<a href="' . url('/administrator/point-withdraw/declined/' . $item->id) . ' " title="Declined"><button class="btn btn-danger ">Declined</i></button></a>';
                $nestedData[] = $accept . " " . $declined;
            } else {
                $nestedData[] = '<button class="btn btn-success ">' . $item->tr_status . '</i></button>';
            }
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


    public function withdraw_success_point_list()
    {
        return view('administrator.point.success_withdraw');
    }

    public function get_withdraw_Success_point(Request $request)
    {
        // dd('ooo');
        $requestData = $_REQUEST;
        $total = Point::with('user_data')->where('tr_nature', 'TRWITH003')->where('tr_status', 'Success')->count();
        $subAdmin = Point::with('user_data')->whereNotNull('id')->where('tr_nature', 'TRWITH003')->where('tr_status', 'Success')->orderBy('created_at', 'desc');
        if ($request->from != "") {
            $subAdmin = $subAdmin->whereDate('created_at',  '>=', $request->from)->whereDate('created_at',  '<=', $request->to);
        }
        if ($requestData['search']['value']) {
            $searchString = $requestData['search']['value'];
            $subAdmin = $subAdmin->whereHas('user_data', function ($query) use ($searchString) {
                $query->whereRaw("mob LIKE '%" . $searchString . "%'");
            });
        }
        if ($request->orderBy) {
            $subAdmin = $subAdmin->orderBy($request->orderBy, $request->ascending == 1 ? 'ASC' : 'DESC');
        }
        $subAdmin = $subAdmin->paginate($request->limit ? $request->limit : 20);
        $i = 0;
        $datas = [];
        foreach ($subAdmin as $item) {
            $i++;
            // dd($item);
            $nestedData = array();
            $nestedData[] = $i;
            $nestedData[] = (!is_null($item->user_data) ? $item->user_data->mob : "NA");
            $nestedData[] = (!is_null($item->user_data) ? $item->user_data->FullName : "NA");
            $nestedData[] = $item->transaction_id;
            $nestedData[] = $item->win_value;
            $nestedData[] = $item->tr_value;
            $nestedData[] = $item->tr_value_type;
            $nestedData[] = $item->tr_status;
            $nestedData[] = $item->value_update_by;
            $nestedData[] = $item->tr_remark;
            $nestedData[] = date("d-m-Y h:i a", strtotime($item->created_at));

            if ($item->status) {
                $message = "'Are you sure you want to Inactive the user?'";
                $nestedData[] = '<a href="' . url('/administrator/withdraw/update-success/' . $item->id) . '" onclick="return confirm(' . $message . ')" title="Active"><i class="fa fa-toggle-on"></i></a>';
            } else {
                $message = "'Are you sure you want to Active the user?'";
                $nestedData[] = '<a href="' . url('/administrator/market/update-successs/' . $item->id) . '" onclick="return confirm(' . $message . ')" title="Inactive"><i class="fa fa-toggle-off"></i></a>';
            }
            if ($item->tr_status == 'Pending') {
                $accept = '<a href="' . url('/administrator/point-withdraw/accpet/' . $item->id) . ' " title="Accpet"><button class="btn btn-primary ">Accept</i></button></a>';
                $declined = '<a href="' . url('/administrator/point-withdraw/declined/' . $item->id) . ' " title="Declined"><button class="btn btn-danger ">Declined</i></button></a>';
                $nestedData[] = $accept . " " . $declined;
            } else {
                $nestedData[] = '<button class="btn btn-success ">' . $item->tr_status . '</i></button>';
            }
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

    public function withdraw_reject_point_list()
    {
        return view('administrator.point.reject_withdraw');
    }

    public function get_withdraw_reject_point(Request $request)
    {
        // dd('ooo');
        $requestData = $_REQUEST;
        $total = Point::with('user_data')->where('value_update_by', 'Withdraw')->where('tr_status', 'Cancelled')->count();
        $subAdmin = Point::with('user_data')->whereNotNull('id')->where('value_update_by', 'Withdraw')->where('tr_status', 'Cancelled')->orderBy('created_at', 'desc');
        if ($request->from != "") {
            $subAdmin = $subAdmin->whereDate('created_at',  '>=', $request->from)->whereDate('created_at',  '<=', $request->to);
        }
        if ($requestData['search']['value']) {
            $searchString = $requestData['search']['value'];
            $subAdmin = $subAdmin->whereHas('user_data', function ($query) use ($searchString) {
                $query->whereRaw("mob LIKE '%" . $searchString . "%'");
            });
        }
        if ($request->orderBy) {
            $subAdmin = $subAdmin->orderBy($request->orderBy, $request->ascending == 1 ? 'ASC' : 'DESC');
        }
        $subAdmin = $subAdmin->paginate($request->limit ? $request->limit : 20);
        $i = 0;
        $datas = [];
        foreach ($subAdmin as $item) {
            $i++;
            // dd($item);
            $nestedData = array();
            $nestedData[] = $i;
            $nestedData[] = (!is_null($item->user_data) ? $item->user_data->mob : "NA");
            $nestedData[] = (!is_null($item->user_data) ? $item->user_data->FullName : "NA");
            $nestedData[] = $item->transaction_id;
            $nestedData[] = $item->win_value;
            $nestedData[] = $item->tr_value;
            $nestedData[] = $item->tr_value_type;
            $nestedData[] = $item->tr_status;
            $nestedData[] = $item->value_update_by;
            $nestedData[] = $item->tr_remark;
            $nestedData[] = date("d-m-Y h:i a", strtotime($item->created_at));


            if ($item->tr_status == 'Pending') {
                $accept = '<a href="' . url('/administrator/point-withdraw/accpet/' . $item->id) . ' " title="Accpet"><button class="btn btn-primary ">Accept</i></button></a>';
                $declined = '<a href="' . url('/administrator/point-withdraw/declined/' . $item->id) . ' " title="Declined"><button class="btn btn-danger ">Declined</i></button></a>';
                $nestedData[] = $accept . " " . $declined;
            } else {
                $nestedData[] = '<button class="btn btn-success ">' . $item->tr_status . '</i></button>';
            }
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

    public function update_pending($id)
    {
        $response = DB::statement("UPDATE point_table SET status =(CASE WHEN (status = pending) THEN NO ELSE pending END) where id = $id");
        if ($item->holiday) {
            $message = "'Are you sure you want to Inactive the user?'";
            $nestedData[] = '<a href="' . url('/administrator/market/update-holiday/' . $item->id) . '" onclick="return confirm(' . $message . ')" title="Active"><i class=""></i></a>';
        } else {
            $message = "'Are you sure you want to Active the user?'";
            $nestedData[] = '<a href="' . url('/administrator/market/update-holiday/' . $item->id) . '" onclick="return confirm(' . $message . ')" title="Inactive"><i class=""></i></a>';
        }

        return redirect()->back();
    }

    public function update_success($id)
    {
        $response = DB::statement("UPDATE point_table SET status =(CASE WHEN (status = success) THEN NO ELSE success END) where id = $id");
        if ($item->holiday) {
            $message = "'Are you sure you want to Inactive the user?'";
            $nestedData[] = '<a href="' . url('/administrator/market/update-holiday/' . $item->id) . '" onclick="return confirm(' . $message . ')" title="Active"><i class=""></i></a>';
        } else {
            $message = "'Are you sure you want to Active the user?'";
            $nestedData[] = '<a href="' . url('/administrator/market/update-holiday/' . $item->id) . '" onclick="return confirm(' . $message . ')" title="Inactive"><i class=""></i></a>';
        }

        return redirect()->back();
    }

    /*public function update_success($id)
        {
            $response=DB::statement("UPDATE point_table SET status =(CASE WHEN (status = success) THEN NO ELSE success END) where id = $id");
                if($item->holiday){
                    $message = "'Are you sure you want to Inactive the user?'";
                    $nestedData[] = '<a href="' .url('/administrator/market/update-holiday/'.$item->id).'" onclick="return confirm('.$message.')" title="Active"><i class=""></i></a>';
                }else{
                    $message = "'Are you sure you want to Active the user?'";
                    $nestedData[] = '<a href="' .url('/administrator/market/update-holiday/'.$item->id).'" onclick="return confirm('.$message.')" title="Inactive"><i class=""></i></a>';
                }
        
            return redirect()->back();
          }*/
}
