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

use App\Models\BlockUser;
use App\Models\BonusReport;
use Session;
use Hash;
use DB;
use Helper;

class ReportController extends Controller
{
	public function __construct()
	{
	}

	public function user_bidhistory()
	{
		return view('administrator.reportss.index');
	}
	public function customer_sell_report()
	{
		return view('administrator.reportss.customersell_report');
	}
	public function winning_report()
	{
		return view('administrator.reportss.winning_report');
	}
	public function transport_point_report()
	{
		return view('administrator.reportss.transpost_point');
	}
	public function bid_winning_report()
	{
		return view('administrator.reportss.bidwinning_report');
	}
	public function withdraw_report()
	{
		return view('administrator.reportss.withdraw_report');
	}
	public function add_fund_report()
	{
		return view('administrator.reportss.addfund_report_list');
	}
	public function auto_deposit_history()
	{
		return view('administrator.reportss.auto_deposithistory_list');
	}

	public function getbidhistoryData(Request $request)
	{
		$columns = array(
            0 => 'point_table.id',
            1 => 'point_table.admin_key',
            2 => 'point_table.is_win',
            3 => 'point_table.FullName',
            4 => 'point_table.date',
        );
		$requestData = $_REQUEST;
		$total = Point::count();
		$point = Point::orderBy('id', 'desc')->where('tr_nature','TRGAME001');
		if ($requestData['search']['value']) {
			$point = $point->where('win_value', 'like', '%' . $requestData['search']['value'] . '%')->orWhere('user_id', 'like', '%' . $requestData['search']['value'] . '%')->orWhere('date', 'like', '%' . $requestData['search']['value'] . '%');
		}
		if ($request->orderBy) {
			$point = $point->orderBy($request->orderBy, $request->ascending == 1 ? 'ASC' : 'DESC');
		}
		$orderColumn = $columns[$requestData['order'][0]['column']];
        $orderColumnDir = $requestData['order'][0]['dir'];
        $limit = $requestData['length'];
        $offset = $requestData['start'];
		$point = $point->offset($offset)->limit($limit)->orderBy($orderColumn, $orderColumnDir)->get();
		// $point = $point->paginate($request->limit ? $request->limit : 20);
		// dd($point);
		$i = $offset;
		$datas = [];
		foreach ($point as $item) {
			$i++;
			$nestedData = array();
			$nestedData[] = $i;
			$nestedData[] = $item->admin_key;
			// $nestedData[] = $item->is_win;
			if ($item->is_win == '1') {
				$data = 'yes';
			} else if ($item->is_win == '0') {
				$data = 'no';

			}

			// $nestedData[] = $data;
			$nestedData[] = $item->user_data->FullName;
			$nestedData[] = $item->game_type;
			$nestedData[] = $item->date;
			//$nestedData[] = $item->date("d-m-Y h:i a", strtotime($item->created_at));
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


	public function result()
	{
		// $query=Result::whereIn('type',[$request->type]);
		// if($request->type!="")
		// {
		//     $query=$query->whereRaw("FIND_IN_SET(?, type) > 0", [$request->type]);
		// }
		// $result=$query->get();
		// $resulttype =$query->get();
		return view('administrator.result.index');
	}

	public function getResultData(Request $request)
	{
		// dd($request->all());
		$columns = array(
			0 => 'results_tbls.id',
			1 => 'results_tbls.market_id',
			2 => 'results_tbls.day_of_result'
		);
		$requestData = $_REQUEST;
		$total = Result::count();
		$point = Result::with('market')->whereNotNull('id')->orderBy('date', 'desc');
		// dd($requestData['search']['value']);
		if ($requestData['search']['value']) {
			$point = $point->orWhere('date', 'like', '%' . $requestData['search']['value'] . '%');
		}
		if ($request->orderBy) {
			$point = $point->orderBy($request->orderBy, $request->ascending == 1 ? 'ASC' : 'DESC');
		}
		// dd($request->to_date);

		if (!is_null($request->to_date) && !is_null($request->from_date) && !is_null($request->type)) {
			$todate = date('d-m-Y', strtotime($request->to_date));
			$fromdate = date('d-m-Y', strtotime($request->from_date));
			$point = Result::with('market')->whereNotNull('id')->where('type', $request->type)->whereBetween('date', [$fromdate, $todate])->orderBy('date', 'desc');
		} elseif (!is_null($request->to_date) && !is_null($request->from_date)) {
			$todate = date('d-m-Y', strtotime($request->to_date));
			$fromdate = date('d-m-Y', strtotime($request->from_date));
			// dd($fromdate);
			$point = Result::with('market')->whereNotNull('id')->whereBetween('date', [$fromdate, $todate])->orderBy('date', 'desc');
			// dd($point);
		} elseif (!is_null($request->type)) {
			$point = Result::with('market')->whereNotNull('id')->where('type', $request->type)->orderBy('date', 'desc');
		}

		$orderColumn = $columns[$requestData['order'][0]['column']];
		$orderColumnDir = $requestData['order'][0]['dir'];
		$limit = $requestData['length'];
		$offset = $requestData['start'];
		$point = $point->offset($offset)->limit($limit)->orderBy($orderColumn, $orderColumnDir)->get();
		//$point = $point->paginate($request->limit ? $request->limit : 20);

		$i = 0;
		$datas = [];
		foreach ($point as $item) {
			$i++;
			$nestedData = array();
			$nestedData[] = $i;
			$nestedData[] = $item->market_id;
			$nestedData[] = $item->date_time_result;
			// $nestedData[] = $item->result;
			$d1 = is_null($item->result) ? '###' : $item->result;
			$d2 = is_null($item->result2) ? '##' : $item->result2;
			$d3 = is_null($item->result3) ? '###' : $item->result3;
			$nestedData[] = $d1 . '-' . $d2 . '-' . $d3;




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
	

	public function getwithdrawReportData(Request $request)
	{
		$columns = array(
            0 => 'point_table.id',
            1 => 'point_table.admin_key',
            2 => 'point_table.is_win',
            3 => 'point_table.FullName',
            4 => 'point_table.date',
        );
		$requestData = $_REQUEST;
		$total = Point::count();
		$point = Point::orderBy('id', 'desc')->where('tr_nature','TRWITH003');
		if ($requestData['search']['value']) {
			$point = $point->where('win_value', 'like', '%' . $requestData['search']['value'] . '%')->orWhere('user_id', 'like', '%' . $requestData['search']['value'] . '%')->orWhere('date', 'like', '%' . $requestData['search']['value'] . '%');
		}
		if ($request->orderBy) {
			$point = $point->orderBy($request->orderBy, $request->ascending == 1 ? 'ASC' : 'DESC');
		}
		$orderColumn = $columns[$requestData['order'][0]['column']];
        $orderColumnDir = $requestData['order'][0]['dir'];
        $limit = $requestData['length'];
        $offset = $requestData['start'];
		$point = $point->offset($offset)->limit($limit)->orderBy($orderColumn, $orderColumnDir)->get();
		// $point = $point->paginate($request->limit ? $request->limit : 20);
		// dd($point);
		$i = $offset;
		$datas = [];
		foreach ($point as $item) {
			$i++;
			$nestedData = array();
			$nestedData[] = $i;
			$nestedData[] = $item->admin_key;
			// $nestedData[] = $item->is_win;
			if ($item->is_win == '1') {
				$data = 'yes';
			} else if ($item->is_win == '0') {
				$data = 'no';

			}

			// $nestedData[] = $data;
			$nestedData[] = $item->user_data->FullName;
			$nestedData[] = $item->game_type;
			$nestedData[] = $item->tr_value;
			$nestedData[] = $item->date;
			//$nestedData[] = $item->date("d-m-Y h:i a", strtotime($item->created_at));
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
	public function getautoDepositData(Request $request)
	{
		$columns = array(
            0 => 'point_table.id',
            1 => 'point_table.admin_key',
            2 => 'point_table.is_win',
            3 => 'point_table.FullName',
            4 => 'point_table.date',
        );
		$requestData = $_REQUEST;
		$total = Point::count();
		$point = Point::orderBy('id', 'desc')->where('tr_nature','TRDEPO002');
		if ($requestData['search']['value']) {
			$point = $point->where('win_value', 'like', '%' . $requestData['search']['value'] . '%')->orWhere('user_id', 'like', '%' . $requestData['search']['value'] . '%')->orWhere('date', 'like', '%' . $requestData['search']['value'] . '%');
		}
		if ($request->orderBy) {
			$point = $point->orderBy($request->orderBy, $request->ascending == 1 ? 'ASC' : 'DESC');
		}
		$orderColumn = $columns[$requestData['order'][0]['column']];
        $orderColumnDir = $requestData['order'][0]['dir'];
        $limit = $requestData['length'];
        $offset = $requestData['start'];
		$point = $point->offset($offset)->limit($limit)->orderBy($orderColumn, $orderColumnDir)->get();
		// $point = $point->paginate($request->limit ? $request->limit : 20);
		// dd($point);
		$i = $offset;
		$datas = [];
		foreach ($point as $item) {
			$i++;
			$nestedData = array();
			$nestedData[] = $i;
			$nestedData[] = $item->admin_key;
			// $nestedData[] = $item->is_win;
			if ($item->is_win == '1') {
				$data = 'yes';
			} else if ($item->is_win == '0') {
				$data = 'no';

			}

			// $nestedData[] = $data;
			$nestedData[] = $item->user_data->FullName;
			$nestedData[] = $item->game_type;
			$nestedData[] = $item->tr_value;
			$nestedData[] = $item->date;
			//$nestedData[] = $item->date("d-m-Y h:i a", strtotime($item->created_at));
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
	public function getaddfundReportData(Request $request)
	{
		$columns = array(
            0 => 'point_table.id',
            1 => 'point_table.admin_key',
            2 => 'point_table.is_win',
            3 => 'point_table.FullName',
            4 => 'point_table.date',
        );
		$requestData = $_REQUEST;
		$total = Point::count();
		$point = Point::orderBy('id', 'desc')->where('tr_nature','TRDEPO002');
		if ($requestData['search']['value']) {
			$point = $point->where('win_value', 'like', '%' . $requestData['search']['value'] . '%')->orWhere('user_id', 'like', '%' . $requestData['search']['value'] . '%')->orWhere('date', 'like', '%' . $requestData['search']['value'] . '%');
		}
		if ($request->orderBy) {
			$point = $point->orderBy($request->orderBy, $request->ascending == 1 ? 'ASC' : 'DESC');
		}
		$orderColumn = $columns[$requestData['order'][0]['column']];
        $orderColumnDir = $requestData['order'][0]['dir'];
        $limit = $requestData['length'];
        $offset = $requestData['start'];
		$point = $point->offset($offset)->limit($limit)->orderBy($orderColumn, $orderColumnDir)->get();
		// $point = $point->paginate($request->limit ? $request->limit : 20);
		// dd($point);
		$i = $offset;
		$datas = [];
		foreach ($point as $item) {
			$i++;
			$nestedData = array();
			$nestedData[] = $i;
			$nestedData[] = $item->admin_key;
			// $nestedData[] = $item->is_win;
			if ($item->is_win == '1') {
				$data = 'yes';
			} else if ($item->is_win == '0') {
				$data = 'no';

			}
			// $nestedData[] = $data;
			$nestedData[] = $item->user_data->FullName;
			$nestedData[] = $item->game_type;
			$nestedData[] = $item->tr_value;
			$nestedData[] = $item->date;
			//$nestedData[] = $item->date("d-m-Y h:i a", strtotime($item->created_at));
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
	public function getwinningReportData(Request $request)
	{
		$columns = array(
            0 => 'point_table.id',
            1 => 'point_table.admin_key',
            2 => 'point_table.is_win',
            3 => 'point_table.FullName',
            4 => 'point_table.date',
        );
		$requestData = $_REQUEST;
		$total = Point::count();
		$point = Point::orderBy('id', 'desc')->where('tr_nature','TRWIN005');
		if ($requestData['search']['value']) {
			$point = $point->where('win_value', 'like', '%' . $requestData['search']['value'] . '%')->orWhere('user_id', 'like', '%' . $requestData['search']['value'] . '%')->orWhere('date', 'like', '%' . $requestData['search']['value'] . '%');
		}
		if ($request->orderBy) {
			$point = $point->orderBy($request->orderBy, $request->ascending == 1 ? 'ASC' : 'DESC');
		}
		$orderColumn = $columns[$requestData['order'][0]['column']];
        $orderColumnDir = $requestData['order'][0]['dir'];
        $limit = $requestData['length'];
        $offset = $requestData['start'];
		$point = $point->offset($offset)->limit($limit)->orderBy($orderColumn, $orderColumnDir)->get();
		// $point = $point->paginate($request->limit ? $request->limit : 20);
		// dd($point);
		$i = $offset;
		$datas = [];
		foreach ($point as $item) {
			$i++;
			$nestedData = array();
			$nestedData[] = $i;
			$nestedData[] = $item->admin_key;
			// $nestedData[] = $item->is_win;
			if ($item->is_win == '1') {
				$data = 'yes';
			} else if ($item->is_win == '0') {
				$data = 'no';

			}

			// $nestedData[] = $data;
			$nestedData[] = $item->user_data->FullName;
			$nestedData[] = $item->game_type;
			$nestedData[] = $item->tr_value;
			$nestedData[] = $item->date;
			//$nestedData[] = $item->date("d-m-Y h:i a", strtotime($item->created_at));
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
	public function gettransfarPointData(Request $request)
	{
		$columns = array(
            0 => 'point_table.id',
            1 => 'point_table.admin_key',
            2 => 'point_table.is_win',
            3 => 'point_table.FullName',
            4 => 'point_table.date',
        );
		$requestData = $_REQUEST;
		$total = Point::count();
		$point = Point::orderBy('id', 'desc')->where('tr_nature','TRDRFRL008');
		if ($requestData['search']['value']) {
			$point = $point->where('win_value', 'like', '%' . $requestData['search']['value'] . '%')->orWhere('user_id', 'like', '%' . $requestData['search']['value'] . '%')->orWhere('date', 'like', '%' . $requestData['search']['value'] . '%');
		}
		if ($request->orderBy) {
			$point = $point->orderBy($request->orderBy, $request->ascending == 1 ? 'ASC' : 'DESC');
		}
		$orderColumn = $columns[$requestData['order'][0]['column']];
        $orderColumnDir = $requestData['order'][0]['dir'];
        $limit = $requestData['length'];
        $offset = $requestData['start'];
		$point = $point->offset($offset)->limit($limit)->orderBy($orderColumn, $orderColumnDir)->get();
		// $point = $point->paginate($request->limit ? $request->limit : 20);
		// dd($point);
		$i = $offset;
		$datas = [];
		foreach ($point as $item) {
			$i++;
			$nestedData = array();
			$nestedData[] = $i;
			$nestedData[] = $item->admin_key;
			// $nestedData[] = $item->is_win;
			if ($item->is_win == '1') {
				$data = 'yes';
			} else if ($item->is_win == '0') {
				$data = 'no';

			}

			// $nestedData[] = $data;
			$nestedData[] = $item->user_data->FullName;
			$nestedData[] = $item->game_type;
			$nestedData[] = $item->tr_value;
			$nestedData[] = $item->date;
			//$nestedData[] = $item->date("d-m-Y h:i a", strtotime($item->created_at));
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
	public function getbidWinningData(Request $request)
	{
		$columns = array(
            0 => 'point_table.id',
            1 => 'point_table.admin_key',
            2 => 'point_table.is_win',
            3 => 'point_table.FullName',
            4 => 'point_table.date',
        );
		$requestData = $_REQUEST;
		$total = Point::count();
		$point = Point::orderBy('id', 'desc')->where('tr_nature','TRWIN005');
		if ($requestData['search']['value']) {
			$point = $point->where('win_value', 'like', '%' . $requestData['search']['value'] . '%')->orWhere('user_id', 'like', '%' . $requestData['search']['value'] . '%')->orWhere('date', 'like', '%' . $requestData['search']['value'] . '%');
		}
		if ($request->orderBy) {
			$point = $point->orderBy($request->orderBy, $request->ascending == 1 ? 'ASC' : 'DESC');
		}
		$orderColumn = $columns[$requestData['order'][0]['column']];
        $orderColumnDir = $requestData['order'][0]['dir'];
        $limit = $requestData['length'];
        $offset = $requestData['start'];
		$point = $point->offset($offset)->limit($limit)->orderBy($orderColumn, $orderColumnDir)->get();
		// $point = $point->paginate($request->limit ? $request->limit : 20);
		// dd($point);
		$i = $offset;
		$datas = [];
		foreach ($point as $item) {
			$i++;
			$nestedData = array();
			$nestedData[] = $i;
			$nestedData[] = $item->admin_key;
			// $nestedData[] = $item->is_win;
			if ($item->is_win == '1') {
				$data = 'yes';
			} else if ($item->is_win == '0') {
				$data = 'no';

			}

			// $nestedData[] = $data;
			$nestedData[] = $item->user_data->FullName;
			$nestedData[] = $item->game_type;
			$nestedData[] = $item->tr_value;
			$nestedData[] = $item->date;
			//$nestedData[] = $item->date("d-m-Y h:i a", strtotime($item->created_at));
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