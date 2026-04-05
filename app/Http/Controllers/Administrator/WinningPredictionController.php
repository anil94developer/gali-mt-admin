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

class WinningPredictionController extends Controller
{
    public function __construct()
    {
		
    }

    /*-------Show List Page ---------*/
    public function index()
    {
        return view('administrator.winning_prediction.index');
    }

    public function get_WinningPredictionData(Request $request)
    { 
        $requestData = $_REQUEST;
		$total = Point::count();

		$point = Point::whereNotNull('id')->orderBy('created_at', 'desc');
		if ($requestData['search']['value']) {
			$point = $point->where('win_value', 'like', '%' . $requestData['search']['value'] . '%')->orWhere('user_id', 'like', '%' . $requestData['search']['value'] . '%')->orWhere('date', 'like', '%' . $requestData['search']['value'] . '%');
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
			$nestedData[] = $i;
			$nestedData[] = $item->admin_key;
			// $nestedData[] = $item->is_win;
			if ($item->is_win == '1') {
				$data = 'yes';
			} else if ($item->is_win == '0') {
				$data = 'no';

			}

			$nestedData[] = $data;
			$nestedData[] = $item->user_data->FullName;
			// $nestedData[] = $item->game_type;
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