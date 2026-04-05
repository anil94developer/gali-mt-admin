<?php
namespace App\Http\Controllers\Administrator;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserCoin;
use App\Models\Point;
use App\Models\AdminControl;
use App\Models\Admin;

use App\Models\BlockUser;
use App\Models\BonusReport;
use Session;
use Hash;
use DB;
use Helper;

class TransactionHistoryController extends Controller
{
	public function __construct()
	{
	}
	
	public function admin_transaction_history()
	{
		return view('administrator.transaction_histroy.index');
	}


// 	public function gettransactionData(Request $request)
// {
	
		
// 		$requestData = $_REQUEST;
// 		$total = Point::count();
// 		$point = Point::with('user_data','payer_data')->orderBy('created_at', 'desc');
// 		if ($requestData['search']['value']) {
// 			$point = $point->where('FullName', 'like', '%' . $requestData['search']['value'] . '%');
// 		}
// 		if ($request->orderBy) {
// 			$point = $point->orderBy($request->orderBy, $request->ascending == 1 ? 'ASC' : 'DESC');
// 		}
// 		$point = $point->paginate($request->limit ? $request->limit : 20);
// 		$i = 0;
// 		$datas = [];
// 		foreach ($point as $item) {
// 			$i++;
// 			$nestedData = array();
// 			$nestedData[] = $i;
// 			$nestedData[] = $item->us_reg_tbl->FullName;
// 			$nestedData[] = $item->game_type;
		
		
			
//          	$nestedData[] = date("d-m-Y",strtotime($item->date));
			
// 			$datas[] = $nestedData;
// 		};
	
// 		return [
// 			'data' => $datas,
// 			'total' => intval($total),
// 			"recordsTotal" => intval($total),
// 			"recordsFiltered" => intval($total),
// 			'draw' => $request['draw']
// 		];
// 	}


public function gettransactionData(Request $request){
     // dd('hcgvb');
	$requestData = $_REQUEST;
	$total = Point::count();
	$point = Point::whereNotNull('id')->orderBy('created_at', 'desc');
	// dd($requestData['search']['value']);
	if ($requestData['search']['value']) {
		$point = $point->where('transaction_id', 'like', '%' . $requestData['search']['value'] . '%');
	}
	if ($request->orderBy) {
		$point = $point->orderBy($request->orderBy, $request->ascending == 1 ? 'ASC' : 'DESC');
	}
	$point = $point->paginate($request->limit ? $request->limit : 20);
	$i = 0;
	$datas = [];
	foreach ($point as $item) {
		$i++;
		$nestedData = array();
		$nestedData[] = !is_null($item->user_data)?$item->user_data->FullName:"NA";
		$nestedData[] = !is_null($item->user_data)?$item->user_data->mob:"NA";
		$nestedData[] = $item->type->tr_type_name;
		$nestedData[] = $item->tr_value;
		$nestedData[] = $item->transaction_id;
		$nestedData[] = date("d-m-Y H:i:s a",strtotime($item->created_at));
			
		// $editLink = '<a href="' .url('/administrator/seopages/edit/'.$item->id).'" title="Edit"><button class="btn btn-warning btn-icon-anim btn-circle"><i class="fa fa-pencil"></i></button></a>';
		// $deleteLink = '<a href="' .url('/administrator/seopages/delete/'.$item->id).' " onclick="return confirm("Are you sure want to delete?")" title="Delete"><button class="btn btn-info btn-icon-anim btn-circle"><i class="icon-trash"></i></button></a>';
		// $ViewLink = '<a href="' .url('/administrator/seopages/view/'.$item->id).' " title="View"><button class="btn btn-primary btn-icon-anim btn-circle"><i class="fa fa-eye"></i></button></a>';
		// $nestedData[] = $ViewLink." ". $editLink."  ".$deleteLink;
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

	
