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



class WalletController extends Controller
{
    public function __construct()
    {
    }

    /*-------Show List Page ---------*/
    public function fund_request()
    {
        return view('administrator.wallet_management.fund_request_list');
    }
    public function withdraw_request()
    {
        return view('administrator.wallet_management.withdraw_request_list');
    }
    public function add_fund()
    {
        return view('administrator.wallet_management.add_fund');
    }
    public function bid_revert()
    {
        return view('administrator.wallet_management.bid_revert');
    }

    public function get_fundrequestData(Request $request)
    {
        // dd("mmm");
        $requestData = $_REQUEST;
        $total = Point::count();
        $Market = Point::whereNotNull('id')->orderBy('id', 'desc');
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
            // $nestedData[] = is_null($item->market_name)?"Na":$item->market_name;
            $nestedData[] = $item->user_id;
            $nestedData[] = $item->tr_value;
            $nestedData[] = $item->status;
            $nestedData[] = $item->value_update_by;
            $nestedData[] = $item->date;
            // $nestedData[] = $item->market_sunday_time_open;
            //$nestedData[] = $item->is_holiday;
            // $nestedData[] = $this->result_day($item->market_id);
            // $nestedData[] = $item->updated_time_date;
            // $nestedData[] = date("d-m-Y h:i a", strtotime($item->created_at));

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
            $result = '<a href="' . url('/administrator/result/' . $item->id) . '" title="Result"><button class="btn btn-primary ">Open Result</button></a>';
            $resultclose = '<a href="' . url('/administrator/result-close/' . $item->id) . '" title="Result"><button class="btn btn-primary ">Close Result</button></a>';
            $history = '<a href="' . url('/administrator/market/history/') . '" title="History"><button class="btn btn-warning ">History</button></a>';
            $editLink = '<a href="' . url('/administrator/edit/' . $item->id) . '" title="Edit"><button class="btn btn-warning "><i class="fa fa-pencil"></i></button></a>';
            $deleteLink = '<a href="' . url('/administrator/delete/' . $item->id) . ' " onclick="return confirm("Are you sure want to delete?")" title="Delete"><button class="btn btn-info "><i class="icon-trash"></i></button></a>';
            $ViewLink = '<a href="' . url('/administrator/view/' . $item->id) . ' " title="View"><button class="btn btn-primary"><i class="fa fa-eye"></i></button></a>';
            $nestedData[] = $ViewLink . " " . $editLink . "  " . $deleteLink . "<br><br> " . $result . " <br><br>" . $resultclose;
            // $nestedData[] = $ViewLink . " " . $editLink . "  " . $deleteLink . " " . $result . " " . $history;
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

}

    