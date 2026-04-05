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
use App\Models\Result;
use App\Models\UserCommission;
use App\Models\ManageCommission;

use App\Models\BlockUser;
use App\Models\BonusReport;
use Session;
use Hash;
use DB;
use Helper;

class UserCommissionController extends Controller
{
	public function __construct()
	{
	}

	public function user_comm_index()
	{
		$user_comm = ManageCommission::where('status', 'pending')->get();
		return view('administrator.user_commission.index', compact('user_comm'));
	}
	public function UserCommissionPayList()
	{
		return view('administrator.user_commission.usercommissionpay');
	}

	public function getUserCommission(Request $request)
	{
		// dd($request->all());
		$columns = array(
			0 => 'manage_commissions.user_id',
			1 => 'manage_commissions.batId',
			2 => 'manage_commissions.bat_amount',
			3 => 'manage_commissions.status',
			4 => 'manage_commissions.date',
		);
		// DB::statement("SET sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));");
		$requestData = $_REQUEST;
		if ($request->date) {
			$total = ManageCommission::whereNotNull('_id')->where('status', 'pending')->whereRaw(['$expr' => ['$gt' => ['$bat_amount', '$win_amount']]])->where('visible', 1)->where('date', $request->date)->count();
			$point = ManageCommission::whereNotNull('_id')->where('status', 'pending')->whereRaw(['$expr' => ['$gt' => ['$bat_amount', '$win_amount']]])->where('visible', 1)->where('date', $request->date)->orderBy('_id', 'desc');
			// dd($point);
		} else {
			$total = ManageCommission::whereNotNull('_id')->where('status', 'pending')->whereRaw(['$expr' => ['$gt' => ['$bat_amount', '$win_amount']]])->where('visible', 1)->count();
			$point = ManageCommission::whereNotNull('_id')->where('status', 'pending')->whereRaw(['$expr' => ['$gt' => ['$bat_amount', '$win_amount']]])->where('visible', 1)->orderBy('_id', 'desc');
		}


		if ($requestData['search']['value']) {
			$filtered = $requestData['search']['value'];
			$point = $point->whereHas('user_data', function ($q) use ($filtered) {
				$q->where('FullName', 'Like', '%' . $filtered . '%')->orwhere('mob', 'Like', '%' . $filtered . '%');
			});
		}
		if ($request->orderBy) {
			$point = $point->orderBy($request->orderBy, $request->ascending == 1 ? 'ASC' : 'DESC');
		}
		$orderColumn = $columns[$requestData['order'][0]['column']];
		$orderColumnDir = $requestData['order'][0]['dir'];
		$limit = $requestData['length'];
		$offset = $requestData['start'];

		// $point = $point->offset($offset)->limit($limit)->orderBy($orderColumn, $orderColumnDir)->get();
		$point = $point->offset($offset)->limit((int)$limit)->orderBy($orderColumn, $orderColumnDir)->get();
		$datas = array();
		$i = $offset;

		$datas = [];
		// dd($point);
		foreach ($point as $item) {
			if ($item->bat_amount > $item->win_amount) {

				$i++;
				$nestedData = array();
				$nestedData[] = '<input type="checkbox" id="' . $item->_id . '" class="checkBoxClass" name="ComissionSelected[]" value="' . $item->id . '">' . $i;
				$nestedData[] = is_null($item->user_data) ? "NULL" : $item->user_data->FullName;
				$nestedData[] = is_null($item->user_data) ? "NULL" : $item->user_data->mob;
				// if ($item->is_win == '1') {
				// 	$data = 'yes';
				// } else if ($item->is_win == '0') {
				// 	$data = 'no';
				// }
				// $nestedData[] = $item->batId;
				$nestedData[] = "(Bet amount)-" . $item->bat_amount . "" . "<br>" . "(Win amount)-" . $item->win_amount . "";
				$user = User::where('user_id', $item->user_id)->first();
				// $user1 = User::where('ref_code', $user->ref_by)->first();

				$diff = $item->bat_amount - $item->win_amount;
				$comm = 0;
				if ($diff > 0) {
					$comm = $diff * 5 / 100;

				} else {
					$comm = "";
				}
				$nestedData[] = $comm;
				$nestedData[] = $item->status;
				$nestedData[] = $item->market_id;
				$nestedData[] = $item->date instanceof \MongoDB\BSON\UTCDateTime
					? $item->date->toDateTime()->format('d-m-Y')
					: $item->date;
				//$nestedData[] = $item->date("d-m-Y h:i a", strtotime($item->created_at));
				//$ViewLink = '<a href="' . url('/administrator/view-user-commission/' . $item->user_id) . ' " title="View" class="btn btn-primary">View</a>';
				//$nestedData[] = $ViewLink;
				$datas[] = $nestedData;
			}
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

	public function View_UserCommission(Request $request)
	{
		$viewuser = UserCommission::where('user_id', $request->id)->get();
		return view('administrator.user_commission.view', compact('viewuser'));
	}
	public function getUserCommission_distribute(Request $request)
	{
		
		date_default_timezone_set('Asia/Kolkata');
		$diff = 0;
		$comm = 0;

		if ($request->ComissionSelected) {
			$data = ManageCommission::whereIn('_id', $request->ComissionSelected)->where('status', 'pending')->get();
			
			foreach ($data as $vs) {
				// print_r($vs);die;
				$user = User::where('user_id', $vs->user_id)->first();
				
				$user1 = User::where('ref_code', @$user->ref_by)->first();
			   
				$diff = $vs->bat_amount - $vs->win_amount;

				if ($diff > 0) {
					$comm = $diff * 5 / 100;
					if ($user1) {

						$credit = (int) $user1->credit + $comm;
						User::where('user_id', $user1->user_id)->update(['credit' => $credit]);

					}
				}

				ManageCommission::where('_id', $vs->_id)->update(['status' => 'success']);
				// DB::table('user_comissions')->where('id', $vs->id)->update(['status' => 'success']);
				if ($user1) {
					$commission = new UserCommission;
					$commission->user_id = $user1->user_id;
					$commission->market_id = $vs->market_id;
					$commission->batId = "1";
					$commission->status = "success";
					$commission->amount = $comm;
					$commission->date = date('Y-m-d');
					$commission->created_at = date('Y-m-d H:i:s');
					$commission->save();
				}
			}
			return redirect()->back();
		} else {
			return redirect()->back();
		}
	}

	public function getUserCommissionPayData(Request $request)
	{
		$columns = [
			0 => '_id',
			1 => 'amount',
			2 => 'status',
			3 => 'created_at',
			4 => 'date',
		];

		$requestData = $request->all();
		$draw = (int) $request->input('draw', 0);

		$datec = date('Y-m-d');
		$date7 = date('Y-m-d', strtotime($datec . ' -7 days'));

		$recordsTotalAll = UserCommission::where('status', 'success')->count();

		$Market = UserCommission::where('status', 'success');
		$total = $recordsTotalAll;

		$searchVal = $requestData['search']['value'] ?? '';

		if ($request->filled('date') && $request->filled('mobile')) {
			$user = User::where('mob', (string) $request->mobile)->first();
			if (!$user) {
				return response()->json([
					'data' => [],
					'recordsTotal' => $recordsTotalAll,
					'recordsFiltered' => 0,
					'draw' => $draw,
				]);
			}
			$Market = UserCommission::where('status', 'success')
				->where('date', $request->date)
				->where('user_id', $user->user_id);
			$total = $Market->count();
		} elseif ($searchVal !== '') {
			$user = User::where('mob', $searchVal)->orWhere('FullName', $searchVal)->first();
			if (!$user) {
				return response()->json([
					'data' => [],
					'recordsTotal' => $recordsTotalAll,
					'recordsFiltered' => 0,
					'draw' => $draw,
				]);
			}
			$Market = UserCommission::where('status', 'success')
				->where('user_id', $user->user_id)
				->where('date', '>=', $date7);
			$total = $Market->count();
		}

		if ($request->orderBy) {
			$Market = $Market->orderBy($request->orderBy, $request->ascending == 1 ? 'ASC' : 'DESC');
		}

		$orderColIdx = (int) data_get($requestData, 'order.0.column', 0);
		if (!array_key_exists($orderColIdx, $columns)) {
			$orderColIdx = 0;
		}
		$orderColumn = $columns[$orderColIdx];
		$orderColumnDir = data_get($requestData, 'order.0.dir', 'desc');
		$limit = (int) ($requestData['length'] ?? 10);
		$offset = (int) ($requestData['start'] ?? 0);
		$i = $offset;

		$Market = $Market->offset($offset)->limit($limit)->orderBy($orderColumn, $orderColumnDir)->get();

		$datas = [];
		foreach ($Market as $item) {
			$nestedData = [];
			$nestedData[] = $i + 1;
			$nestedData[] = $item->amount;
			$nestedData[] = $item->status;
			if ($item->created_at) {
				$nestedData[] = $item->created_at instanceof \Carbon\Carbon
					? $item->created_at->format('h:i A')
					: date('h:i A', strtotime((string) $item->created_at));
			} else {
				$nestedData[] = '-';
			}
			$nestedData[] = $item->date;
			$datas[] = $nestedData;
			$i++;
		}

		return response()->json([
			'data' => $datas,
			'total' => (int) $total,
			'recordsTotal' => (int) $recordsTotalAll,
			'recordsFiltered' => (int) $total,
			'draw' => $draw,
		]);
	}

}