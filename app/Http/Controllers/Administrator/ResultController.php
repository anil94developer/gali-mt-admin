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

class ResultController extends Controller
{
    public function __construct()
    {
    }

    /*-------Show List Page ---------*/
    public function index()
    {
        return view('administrator.result.index');
    }

    
        public function get_resultData(Request $request)
    {
        //dd('datacare');
        $requestData = $_REQUEST;
        $total = User::count();
        $Market = User::whereNotNull('id')->orderBy('id', 'desc')->where('user_status', 1);
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
            $nestedData[] = $item->FullName;
            $nestedData[] = $item->mob;
            $nestedData[] = "<a href=' https://wa.me/$item->mob 'target='_blank'><button class='btn btn-success btn-icon-anim btn-circle'><i class='fa fa-whatsapp'></i></button></a>". '&nbsp&nbsp&nbsp'. '<input type="text" value="' . $item->mob . '" id="myInput_' . $item->id . '" style="display:none"><button class="bg-secondary refer-button cxy ml-2 d-flex" onclick="myFunction(' . $item->id . ')"> <span class="mr-2"></span>
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
            $result = '<a href="' . url('/administrator/result/' . $item->id) . '" title="Result"><button class="btn btn-primary ">Open Result</button></a>';
            $resultclose = '<a href="' . url('/administrator/result-close/' . $item->id) . '" title="Result"><button class="btn btn-primary ">Close Result</button></a>';
            $history = '<a href="' . url('/administrator/market/history/') . '" title="History"><button class="btn btn-warning ">History</button></a>';

            $editLink = '<a href="' . url('/administrator/user/edit/' . $item->id) . '" title="Edit"><button class="btn btn-warning "><i class="fa fa-pencil"></i></button></a>';
            $deleteLink = '<a href="' . url('/administrator/delete/' . $item->id) . ' " onclick="return confirm("Are you sure want to delete?")" title="Delete"><button class="btn btn-info "><i class="icon-trash"></i></button></a>';
            $ViewLink = '<a href="' . url('/administrator/view/' . $item->id) . ' " title="View"><button class="btn btn-primary"><i class="fa fa-eye"></i></button></a>';
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
    

    
}