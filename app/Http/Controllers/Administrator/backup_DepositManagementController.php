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
use App\Models\BonusReport;
use Session;
use Hash;
use DB;
use App\Helpers\Helper;

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
        // dd('demo');
        return view('administrator.deposit_management.pending');
    }
    public function deposit_success()
    {
        return view('administrator.deposit_management.success');
    }
    public function deposit_cancelled()
    {
        return view('administrator.deposit_management.cancelled');
    }
    public function deposit_dateway_pending()
    {
        return view('administrator.deposit_management.datewaypending');
    }


    // public function DateDepositManageData(Request $request)
    // {
    //     DB::statement("SET sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));");

    //     $requestData = $_REQUEST;
    //     $columns = array(
    //         0 => 'point_table.tr_value',
    //         1 => 'point_table.user_id',
    //         2 => 'point_table.tr_status',
    //         3 => 'point_table.date',
    //         4 => 'point_table.tr_nature',
    //     );
    //     $totalItems = PointTable::with('user_data')->where('tr_nature','TRDEPO002')->orderBy('created_at', 'desc')->where('tr_status','success')->groupBy(DB::raw("(DATE_FORMAT(created_at,'%Y-%m-%d'))"))->get()->count();

    //     $totalFiltered = $totalItems;

    //     $items = PointTable::where('tr_nature','TRDEPO002')->orderBy('created_at', 'desc')->where('tr_status','success')->groupBy(DB::raw("(DATE_FORMAT(created_at,'%Y-%m-%d'))"));


    //     if ($requestData['search']['value']) {
    //         $point = $items->where('win_value', 'like', '%' . $requestData['search']['value'] . '%')->orWhere('user_id', 'like', '%' . $requestData['search']['value'] . '%')->orWhere('date', 'like', '%' . $requestData['search']['value'] . '%');
    //     }
    //     if ($request->orderBy) {
    //         $point = $items->orderBy($request->orderBy, $request->ascending == 1 ? 'ASC' : 'DESC');
    //     }
    //     $orderColumn = $columns[$requestData['order'][0]['column']];
    //     $orderColumnDir = $requestData['order'][0]['dir'];
    //     $limit = $requestData['length'];
    //     $offset = $requestData['start'];

    //     $items = $items->offset($offset)->limit($limit)->orderBy($orderColumn, $orderColumnDir)->get();
    //     $datas = array();
    //     $i = $offset;
    //     // dd($items);
    //     foreach ($items as $item) {
    //         $i++;
    //         $nestedData = array();
    //         $nestedData[] = $i;
    //         $nestedData[] = date("d-m-Y", strtotime($item->created_at));
    //         $nestedData[] = $item->tr_value;
    //         // $nestedData[] = $item->tr_remark;

    //         $totall = PointTable::with('user_data')->where('tr_status','Success')->where('tr_nature','TRDEPO002')->whereNotNull('id')->orderBy('created_at', 'desc')->where('tr_status','Pending')->where(DB::raw("(DATE_FORMAT(created_at,'%Y-%m-%d'))"),date("Y-m-d", strtotime($item->created_at)))->get()->count();
    //         $nestedData[] = $totall;
    //         // $nestedData[] = date("d-m-Y", strtotime($item->created_at));
    //         // $nestedData[] = $item->tr_status;

    //         $editLink = '<a href="' . url('/administrator/deposit-approve/' . $item->id) . '" title="Approve"><button class="btn btn-warning ">Approve</button></a>';
    //         // $deleteLink = '<a href="' . url('/administrator/delete/' . $item->id) . ' " onclick="return confirm("Are you sure want to delete?")" title="Delete"><button class="btn btn-info "><i class="icon-trash"></i></button></a>';
    //         $ViewLink = '<a href="' . url('/administrator/deposit-cancelled/' . $item->id) . ' " title="Cancelled"><button class="btn btn-primary">Cancelled</button></a>';
    //         $View = '<a href="' . url('/administrator/deposit-view-dataa/'.date("Y-m-d", strtotime($item->created_at))). ' " title="View"><button class="btn btn-primary">View</button></a>';
    //         $nestedData[] = $View;  
    //         // $nestedData[] = $ViewLink . " " . $editLink . "  " . $deleteLink . " " . $result . " " . $history;
    //         $datas[] = $nestedData;
    //     };

    //     $json_data = array(
    //         "draw" => intval($requestData['draw']),
    //         "recordsTotal" => intval($totalItems),
    //         "recordsFiltered" => intval($totalFiltered),
    //         "data" => $datas
    //     );

    //     echo json_encode($json_data);
    // }

    public function DateDepositManageData(Request $request)
    {

        $requestData = $_REQUEST;
        $columns = array(
            0 => 'point_table.tr_value',
            1 => 'point_table.user_id',
            2 => 'point_table.tr_status',
            3 => 'point_table.date',
            4 => 'point_table.tr_nature',
        );
        DB::statement("SET sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));");
        $totalItems = PointTable::whereNotNull('id')->where('tr_status', 'Success')->where('tr_nature', 'TRDEPO002')->groupBy('date')->count();
        // dd($totalItems);
        $totalFiltered = $totalItems;
        $items = PointTable::whereNotNull('id')->orderBy('id', 'desc')->where('tr_nature', 'TRDEPO002')->where('tr_status', 'Success')->groupBy("date");

        // old
        // if ($requestData['search']['value']) {
        //     // $point = $items->where('FullName', 'like', '%' . $requestData['search']['value'] . '%')->orWhere('tr_remark', 'like', '%' . $requestData['search']['value'] . '%')->orWhere('date', 'like', '%' . $requestData['search']['value'] . '%');
        //     $filtered = $requestData['search']['value'];
        //     $items = $items->whereHas('user_data', function ($q) use ($filtered) {
        //         $q->where('FullName', 'Like','%'.$filtered.'%')->orwhere('mob', 'Like','%'.$filtered.'%');
        //     });
        // }
        // if ($request->orderBy) {
        //     $point = $items->orderBy($request->orderBy, $request->ascending == 1 ? 'ASC' : 'DESC');
        // }
        // $orderColumn = $columns[$requestData['order'][0]['column']];
        // $orderColumnDir = $requestData['order'][0]['dir'];
        // $limit = $requestData['length'];
        // $offset = $requestData['start'];

        // $items = $items->offset($offset)->limit($limit)->orderBy($orderColumn, $orderColumnDir)->get();
        // $datas = array();
        // $i = $offset;
        // old close

        // new
        if (!empty($request->deposit_date)) {
            $format_date = date("d-m-Y", strtotime($request->deposit_date));
            // dd($format_date);
            // $items = PointTable::where(DB::raw("(DATE_FORMAT(created_at,'%d-%m-%Y'))"),$format_date)->where('table_id',$request->select_market)->where('tr_nature', 'TRGAME001');
            $items = PointTable::where('date', $format_date)->where('tr_nature', 'TRDEPO002')->where('tr_status', 'Success')->groupBy("date");
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

        $items = $items->offset($offset)->limit($limit)->orderBy($orderColumn, $orderColumnDir)->get();
        $datas = array();
        $i = $offset;
        // new close

        // dd($items);
        foreach ($items as $item) {
            //PointTable::where('tr_status','Success')->groupBy("date")->sum('tr_value');
            $i++;
            $date = $item->date;
            $nestedData = array();
            $nestedData[] = $i;
            // $nestedData[] = is_null($item->user_data) ? "NA" : $item->user_data->FullName;
            // $nestedData[] = is_null($item->user_data) ? "NA" : $item->user_data->mob;
            $widthraw_amount = Helper::depositamout($date);
            //dd($profit_loss);
            $nestedData[] = $widthraw_amount;
            $widthraw_amount_count = Helper::depositamout_count($date);
            $nestedData[] = $widthraw_amount_count;
            // $nestedData[] = $item->tr_remark;
            $nestedData[] = date("d-m-Y", strtotime($item->date));
            // $nestedData[] = date("h:i:s a", strtotime($item->created_at));
            //dd($profit_loss);
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
        $select = PointTable::where('tr_status', 'Success')->where('tr_nature', 'TRDEPO002')->where('date', date('d-m-Y', strtotime($date)))->get();
        return view('administrator.deposit_management.view', compact('select'));
    }
    public function depositManageData_pending(Request $request)
    {
        // dd('ppp');
        $requestData = $_REQUEST;
        $columns = array(
            0 => 'point_table.tr_value',
            1 => 'point_table.user_id',
            2 => 'point_table.tr_status',
            3 => 'point_table.date',
            4 => 'point_table.tr_nature',
        );
        $totalItems = PointTable::where('tr_nature', 'TRDEPO002')->where('tr_status', 'Pending')->get()->count();
        // dd($totalItems);
        $totalFiltered = $totalItems;
        $items = PointTable::where('tr_nature', 'TRDEPO002')->whereNotNull('id')->orderBy('created_at', 'desc')->where('tr_status', 'Pending');
        if ($requestData['search']['value']) {
            // $point = $items->where('FullName', 'like', '%' . $requestData['search']['value'] . '%')->orWhere('tr_remark', 'like', '%' . $requestData['search']['value'] . '%')->orWhere('date', 'like', '%' . $requestData['search']['value'] . '%');
            $filtered = $requestData['search']['value'];
            $items = $items->whereHas('user_data', function ($q) use ($filtered) {
                $q->where('FullName', 'Like', '%' . $filtered . '%')->orwhere('mob', 'Like', '%' . $filtered . '%');
            });
        }
        if (!empty($request->market_date)) {
            // dd($request->market_date);
            $items = PointTable::where('tr_nature', 'TRDEPO002')->whereNotNull('id')->orderBy('created_at', 'desc')->where('tr_status', 'Pending')->where(DB::raw("(DATE_FORMAT(created_at,'%Y-%m-%d'))"), $request->market_date);
        }
        if ($request->orderBy) {
            $point = $items->orderBy($request->orderBy, $request->ascending == 1 ? 'ASC' : 'DESC');
        }
        $orderColumn = $columns[$requestData['order'][0]['column']];
        $orderColumnDir = $requestData['order'][0]['dir'];
        $limit = $requestData['length'];
        $offset = $requestData['start'];

        $items = $items->offset($offset)->limit($limit)->orderBy($orderColumn, $orderColumnDir)->get();
        $datas = array();
        $i = $offset;
        // dd($items);
        foreach ($items as $item) {
            $i++;
            $nestedData = array();
            $nestedData[] = $i;
            $nestedData[] = is_null($item->user_data) ? "NA" : $item->user_data->FullName;
            $nestedData[] = is_null($item->user_data) ? "NA" : $item->user_data->mob;
            $nestedData[] = $item->tr_value;
            $nestedData[] = $item->transactionRef;
            $nestedData[] = $item->status;
            $nestedData[] = date("H:i:s", strtotime($item->created_at));
            $nestedData[] = date("d-m-Y", strtotime($item->created_at));


            $editLink = '<a href="' . url('/administrator/deposit-approve/' . $item->id) . '" title="Approve"><button class="btn btn-warning ">Approve</button></a>';
            // $deleteLink = '<a href="' . url('/administrator/delete/' . $item->id) . ' " onclick="return confirm("Are you sure want to delete?")" title="Delete"><button class="btn btn-info "><i class="icon-trash"></i></button></a>';
            $ViewLink = '<a href="' . url('/administrator/deposit-cancelled/' . $item->id) . ' " title="Cancelled"><button class="btn btn-primary">Cancelled</button></a>';
            $nestedData[] = $ViewLink . " " . $editLink;
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
    public function withdraw_cancel($id)
    {
        $dta = Point::where('id', $id)->first();
        $user = DB::table('us_reg_tbl')->where('user_id', $dta->user_id)->first();
        $amount = $user->credit + $dta->tr_value;
        DB::table('us_reg_tbl')->where('user_id', $dta->user_id)->update(['credit' => $amount]);
        Point::where('id', $id)->update(['tr_status' => 'Cancelled']);

        // dd($dta);
        return redirect('administrator/game/withdraw-pending');
    }
    public function deposit_approve($id)
    {
        
        $point = Point::where('id', $id)->first();
        $user = User::where('user_id', $point->user_id)->first();
        $amt = $user->credit + $point->tr_value;
        $walletdata = [
            'user_id' => $point->user_id,
            'app_id' => 'com.dubaiking',
            'transaction_id' => $point->transaction_id,
            'tr_value' => $point->tr_value,
            'tr_status' => "Success",
            'tr_nature' => "TRDEPO002",
            'type' => "Credit",
            'tr_remark' => "Online",
            'date' => date('d-m-Y'),
            'date_time' => date('Y-m-d H:i:s'),
            'value_update_by' => "Deposit",
            'tr_value_updated' => $amt,
            ];
            DB::table('wallet_reports')->insert($walletdata);

        $user = User::where('user_id', $point->user_id)->update(['credit' => $amt]);
        Point::where('id', $id)->update(['tr_status' => 'Success']);
        return redirect()->back();
    }
    public function deposit_cancel($id)
    {
        // $point = Point::where('id', $id)->first();
        // $user = User::where('user_id', $point->user_id)->first();
        // $amt = $user->credit - $point->tr_value;
        // $user = User::where('user_id', $point->user_id)->update(['credit' => $amt]);
        // dd($user);
        Point::where('id', $id)->update(['tr_status' => 'Cancelled']);
        return redirect()->back();
    }
    public function depositManageData_success(Request $request)
    {
     

        $requestData = $_REQUEST;
        $columns = array(
            0 => 'point_table.tr_value',
            1 => 'point_table.user_id',
            2 => 'point_table.tr_status',
            3 => 'point_table.date',
            4 => 'point_table.tr_nature',
        );
        $totalItems = PointTable::where('tr_nature', 'TRDEPO002')->where('tr_status', 'success')->get()->count();

        
        $totalFiltered = $totalItems;
        $items = PointTable::where('tr_nature', 'TRDEPO002')->orderBy('id', 'desc')->where('tr_status','success');
       
        
        
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
            // dd($request->market_date);
            $items = PointTable::where('tr_nature', 'TRDEPO002')->whereNotNull('id')->orderBy('created_at', 'desc')->where('tr_status', 'Success')->where(DB::raw("(DATE_FORMAT(created_at,'%Y-%m-%d'))"), $request->market_date);
        }
        $orderColumn = $columns[$requestData['order'][0]['column']];
        $orderColumnDir = $requestData['order'][0]['dir'];
        $limit = $requestData['length'];
        $offset = $requestData['start'];

        $items = $items->offset($offset)->limit($limit)->orderBy($orderColumn, $orderColumnDir)->get();
        $datas = array();
        $i = $offset;
        // dd($items);
        foreach ($items as $item) {
            $i++;
            $nestedData = array();
            $nestedData[] = $i;
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
            $nestedData[] = $candelled;
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

    public function depositManageData_cancelled(Request $request)
    {
        // dd('ppp');
        $requestData = $_REQUEST;
        $columns = array(
            0 => 'point_table.tr_value',
            1 => 'point_table.user_id',
            2 => 'point_table.tr_status',
            3 => 'point_table.date',
            4 => 'point_table.tr_nature',
        );
        $totalItems = PointTable::where('tr_nature', 'TRDEPO002')->where('tr_status', 'Cancelled')->get()->count();
        $totalFiltered = $totalItems;
        $items = PointTable::where('tr_nature', 'TRDEPO002')->whereNotNull('id')->orderBy('created_at', 'desc')->where('tr_status', 'Cancelled');
        if ($requestData['search']['value']) {
            // $point = $items->where('FullName', 'like', '%' . $requestData['search']['value'] . '%')->orWhere('tr_remark', 'like', '%' . $requestData['search']['value'] . '%')->orWhere('date', 'like', '%' . $requestData['search']['value'] . '%');
            $filtered = $requestData['search']['value'];
            $items = $items->whereHas('user_data', function ($q) use ($filtered) {
                $q->where('FullName', 'Like', '%' . $filtered . '%')->orwhere('mob', 'Like', '%' . $filtered . '%');
            });
        }
        if (!empty($request->market_date)) {
            // dd($request->market_date);
            $items = PointTable::where('tr_nature', 'TRDEPO002')->whereNotNull('id')->orderBy('created_at', 'desc')->where('tr_status', 'Cancelled')->where(DB::raw("(DATE_FORMAT(created_at,'%Y-%m-%d'))"), $request->market_date);
        }
        if ($request->orderBy) {
            $point = $items->orderBy($request->orderBy, $request->ascending == 1 ? 'ASC' : 'DESC');
        }
        $orderColumn = $columns[$requestData['order'][0]['column']];
        $orderColumnDir = $requestData['order'][0]['dir'];
        $limit = $requestData['length'];
        $offset = $requestData['start'];
        $items = $items->offset($offset)->limit($limit)->orderBy($orderColumn, $orderColumnDir)->get();
        $datas = array();
        $i = $offset;
        // dd($items);
        foreach ($items as $item) {
            $i++;
            $nestedData = array();
            $nestedData[] = $i;
            $nestedData[] = is_null($item->user_data) ? "NA" : $item->user_data->FullName;
            $nestedData[] = is_null($item->user_data) ? "NA" : $item->user_data->mob;
            // $nestedData[] = is_null($item->user_id)?"NA":$item->user_id;
            $nestedData[] = $item->tr_value;
            $nestedData[] = $item->transactionRef;
            $nestedData[] = $item->tr_status;
            $nestedData[] = date("H:i:s", strtotime($item->created_at));
            $nestedData[] = date("d-m-Y", strtotime($item->created_at));

            // if ($item->status) {
            //     $message = "'Are you sure you want to Inactive the user?'";
            //     $nestedData[] = '<a href="' . url('/administrator/update-status/' . $item->id) . '" onclick="return confirm(' . $message . ')" title="Active"><i class="fa fa-toggle-on"></i></a>';
            // } else {
            //     $message = "'Are you sure you want to Active the user?'";
            //     $nestedData[] = '<a href="' . url('/administrator/update-status/' . $item->id) . '" onclick="return confirm(' . $message . ')" title="Inactive"><i class="fa fa-toggle-off"></i></a>';
            // }


            // $editLink = '<a href="' . url('/administrator/approve/' . $item->id) . '" title="Edit"><button class="btn btn-warning ">Approve</button></a>';
            // $deleteLink = '<a href="' . url('/administrator/delete/' . $item->id) . ' " onclick="return confirm("Are you sure want to delete?")" title="Delete"><button class="btn btn-info "><i class="icon-trash"></i></button></a>';
            // $ViewLink = '<a href="' . url('/administrator/cancelled/' . $item->id) . ' " title="View"><button class="btn btn-primary">Cancelled</button></a>';
            $approve = '<a href="' . url('/administrator/deposit-approve/' . $item->id) . '" title="Approve"><button class="btn btn-warning ">Approve</button></a>';
            $nestedData[] = $approve;
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

    public function success_deposit_cancel($id)
    {
        $point = Point::where('id', $id)->first();
        $user = User::where('user_id', $point->user_id)->first();
        $amt = $user->credit - $point->tr_value;
        $user = User::where('user_id', $point->user_id)->update(['credit' => $amt]);
        Point::where('id', $id)->update(['tr_status' => 'Cancelled']);
        return redirect()->back();
    }
}