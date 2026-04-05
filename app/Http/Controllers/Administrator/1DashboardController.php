<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use Carbon\Carbon;
use App\Models\User;
// use App\Models\User;
use App\Models\Point;
use App\Models\Market;
use App\Models\Newsletter;
use App\Models\PointTable;
use Auth;
use DB;
use Session;
use Hash;
use Helper;

class DashboardController extends Controller
{
	public function __construct()
	{
	}

	public function index(Request $request)
	{


		// dd($request->select_date);

		if(isset($_GET['select_date'])){
			$date = date('d-m-Y',strtotime($_GET['select_date']));
			// dd($date);
			$winningAmount = Point::where('tr_nature', 'TRWIN005')->sum('tr_value');
			$Disawar = Point::where('table_id','DISAWAR')->where('tr_nature','TRGAME001')->where('date', $date)->sum('tr_value');
			$Faridabad = Point::where('table_id','FARIDABAD')->where('tr_nature','TRGAME001')->where('date', $date)->sum('tr_value');
			$GhaziaBad = Point::where('table_id','GAZIABAD')->where('tr_nature','TRGAME001')->where('date', $date)->sum('tr_value');
			$GaliBet = Point::where('table_id','GALI')->where('tr_nature','TRGAME001')->where('date', $date)->sum('tr_value');
			$DelhiBazar = Point::where('table_id','DELHIBAZAR')->where('tr_nature','TRGAME001')->where('date', $date)->sum('tr_value');
			$ShreeGanesh = Point::where('table_id','SHREEGANESH')->where('tr_nature','TRGAME001')->where('date', $date)->sum('tr_value');
			$dubaiKing = Point::where('table_id','dubaiKing')->where('tr_nature','TRGAME001')->where('date', $date)->sum('tr_value');
			$KdmNight = Point::where('table_id','KDMnight')->where('tr_nature','TRGAME001')->where('date', $date)->sum('tr_value');

			$customer_balance = User::whereNotNull('id')->where(DB::raw("(DATE_FORMAT(created_at,'%d-%m-%Y'))"),$date)->sum('credit');
			$add_money = Point::where('tr_nature', 'TRDEPO002')->where('tr_status', 'Success')->where('date', $date)->sum('tr_value');
			$withdraw_money = Point::where('tr_status','Success')->where('tr_nature','TRWITH003')->where('date', $date)->sum('tr_value');
			$Total_bidding = Point::where('tr_nature','TRGAME001')->where('date', $date)->sum('tr_value');

			$today_bet = Point::where('tr_nature', 'TRGAME001')->where('tr_value_type', "Debit")->where('date', $date)->sum('tr_value');
			$today_win = Point::where('tr_nature', 'TRWIN005')->where('tr_value_type', "Credit")->where('date', $date)->sum('tr_value');
			$todaypl = $today_bet - $today_win;
			return view('administrator.dashboard.index', compact('withdraw_money','add_money','Total_bidding','customer_balance','todaypl','today_win','winningAmount','dubaiKing','GaliBet','DelhiBazar','ShreeGanesh','GhaziaBad','Faridabad','Disawar','KdmNight'));
		}
		else{
			$date = date('d-m-Y');
			$winningAmount = Point::where('tr_nature', 'TRWIN005')->sum('tr_value');
			$Disawar = Point::where('table_id','DISAWAR')->where('tr_nature','TRGAME001')->where('date', $date)->sum('tr_value');
			$Faridabad = Point::where('table_id','FARIDABAD')->where('tr_nature','TRGAME001')->where('date', $date)->sum('tr_value');
			$GhaziaBad = Point::where('table_id','GAZIABAD')->where('tr_nature','TRGAME001')->where('date', $date)->sum('tr_value');
			$GaliBet = Point::where('table_id','GALI')->where('tr_nature','TRGAME001')->where('date', $date)->sum('tr_value');
			$DelhiBazar = Point::where('table_id','DELHIBAZAR')->where('tr_nature','TRGAME001')->where('date', $date)->sum('tr_value');
			$ShreeGanesh = Point::where('table_id','SHREEGANESH')->where('tr_nature','TRGAME001')->where('date', $date)->sum('tr_value');
			$dubaiKing = Point::where('table_id','dubaiKing')->where('tr_nature','TRGAME001')->where('date', $date)->sum('tr_value');
			$KdmNight = Point::where('table_id','KDMnight')->where('tr_nature','TRGAME001')->where('date', $date)->sum('tr_value');

			$customer_balance = User::whereNotNull('id')->where(DB::raw("(DATE_FORMAT(created_at,'%d-%m-%Y'))"),$date)->sum('credit');
			$add_money = Point::where('tr_nature', 'TRDEPO002')->where('tr_status', 'Success')->where('date', $date)->sum('tr_value');
			$withdraw_money = Point::where('tr_status','Success')->where('tr_nature','TRWITH003')->where('date', $date)->sum('tr_value');
			$Total_bidding = Point::where('tr_nature','TRGAME001')->where('date', $date)->sum('tr_value');

			$today_bet = Point::where('tr_nature', 'TRGAME001')->where('tr_value_type', "Debit")->where('date', $date)->sum('tr_value');
			$today_win = Point::where('tr_nature', 'TRWIN005')->where('tr_value_type', "Credit")->where('date', $date)->sum('tr_value');
			$todaypl = $today_bet - $today_win;
			return view('administrator.dashboard.index', compact('withdraw_money','add_money','Total_bidding','customer_balance','todaypl','today_win','winningAmount','dubaiKing','GaliBet','DelhiBazar','ShreeGanesh','GhaziaBad','Faridabad','Disawar','KdmNight'));

		}




	}


	// public function index(Request $request)
	// {


	// 	dd($request->select_date);

	// 	$winningAmount = Point::where('tr_nature', 'TRWIN005')->sum('tr_value');
	// 	$Disawar = Point::where('table_id','DISAWAR')->where('tr_nature','TRGAME001')->whereDate('created_at', date('Y-m-d'))->sum('tr_value');
	// 	$Faridabad = Point::where('table_id','FARIDABAD')->where('tr_nature','TRGAME001')->whereDate('created_at', date('Y-m-d'))->sum('tr_value');
	// 	$GhaziaBad = Point::where('table_id','GAZIABAD')->where('tr_nature','TRGAME001')->whereDate('created_at', date('Y-m-d'))->sum('tr_value');
	// 	$GaliBet = Point::where('table_id','GALI')->where('tr_nature','TRGAME001')->whereDate('created_at', date('Y-m-d'))->sum('tr_value');
	// 	$DelhiBazar = Point::where('table_id','DELHIBAZAR')->where('tr_nature','TRGAME001')->whereDate('created_at', date('Y-m-d'))->sum('tr_value');
	// 	$ShreeGanesh = Point::where('table_id','SHREEGANESH')->where('tr_nature','TRGAME001')->whereDate('created_at', date('Y-m-d'))->sum('tr_value');
	// 	$dubaiKing = Point::where('table_id','dubaiKing')->where('tr_nature','TRGAME001')->whereDate('created_at', date('Y-m-d'))->sum('tr_value');
	// 	$KdmNight = Point::where('table_id','KDMnight')->where('tr_nature','TRGAME001')->whereDate('created_at', date('Y-m-d'))->sum('tr_value');

	// 	$customer_balance = User::whereNotNull('id')->whereDate('created_at', '=', date('Y-m-d'))->sum('credit');
	// 	$add_money = Point::where('tr_nature', 'TRDEPO002')->where('tr_status', 'Success')->whereDate('created_at', '=', date('Y-m-d'))->sum('tr_value');
	// 	$withdraw_money = Point::where('tr_status','Success')->where('tr_nature','TRWITH003')->whereDate('created_at', '=', date('Y-m-d'))->sum('tr_value');
	// 	$Total_bidding = Point::where('tr_nature','TRGAME001')->whereDate('created_at', '=', date('Y-m-d'))->sum('tr_value');

	// 	$today_bet = Point::where('tr_nature', 'TRGAME001')->where('tr_value_type', "Debit")->whereDate('created_at', date('Y-m-d'))->sum('tr_value');
	// 	$today_win = Point::where('tr_nature', 'TRWIN005')->where('tr_value_type', "Credit")->whereDate('created_at', date('Y-m-d'))->sum('tr_value');
	// 	$todaypl = $today_bet - $today_win;


	// 	return view('administrator.dashboard.index', compact('withdraw_money','add_money','Total_bidding','customer_balance','todaypl','today_win','winningAmount','dubaiKing','GaliBet','DelhiBazar','ShreeGanesh','GhaziaBad','Faridabad','Disawar','KdmNight'));
	// }
}
?>
