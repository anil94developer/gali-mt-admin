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
use App\Models\DepositHistory;
use App\Models\GameLoad;
use App\Models\UserCommission;
use Auth;
use DB;
use Session;
use Hash;
use Helper;
use MongoDB\BSON\UTCDateTime;

class DashboardController extends Controller
{
	public function __construct()
	{
	}

	public function index(Request $request)
	{

		if(isset($_GET['select_date'])){
			$date = date('d-m-Y',strtotime($_GET['select_date']));
			$date1 = date('Y-m-d',strtotime($_GET['select_date']));
			
			$today_deposit = Point::where('tr_nature', 'TRDEPO002')->where('date', $date)->get()->sum('tr_value');
			$winningAmount = Point::where('tr_nature', 'TRWIN005')->get()->sum('tr_value');
			
			$Disawar = GameLoad::where('table_id','DISAWAR')->where('tr_nature','TRGAME001')->where('date', $date)->get()->sum('tr_value');
			$Disawar_winning = Point::where('table_id','DISAWAR')->where('tr_nature','TRWIN005')->where('date', $date)->get()->sum('win_value');
			$Disawar_pl=$Disawar-$Disawar_winning;
			
			$Faridabad = GameLoad::where('table_id','FARIDABAAD')->where('tr_nature','TRGAME001')->where('date', $date)->get()->sum('tr_value');
			$Faridabad_winning = Point::where('table_id','FARIDABAAD')->where('tr_nature','TRWIN005')->where('date', $date)->get()->sum('win_value');
			$Faridabad_pl=$Faridabad-$Faridabad_winning;
			
			$GhaziaBad = GameLoad::where('table_id','GAZIABAAD')->where('tr_nature','TRGAME001')->where('date', $date)->get()->sum('tr_value');
			$GhaziaBad_winning = Point::where('table_id','GAZIABAAD')->where('tr_nature','TRWIN005')->where('date', $date)->get()->sum('win_value');
			$GhaziaBad_pl=$GhaziaBad-$GhaziaBad_winning;

			$GaliBet = GameLoad::where('table_id','GALI')->where('tr_nature','TRGAME001')->where('date', $date)->get()->sum('tr_value');
			$GaliBet_winning = Point::where('table_id','GALI')->where('tr_nature','TRWIN005')->where('date', $date)->get()->sum('win_value');
			$GaliBet_pl=$GaliBet-$GaliBet_winning;


			$TajBet = GameLoad::where('table_id','TAJ')->where('tr_nature','TRGAME001')->where('date', $date)->get()->sum('tr_value');
			$TajBet_winning = Point::where('table_id','TAJ')->where('tr_nature','TRWIN005')->where('date', $date)->get()->sum('win_value');
			$TajBet_pl=$TajBet-$TajBet_winning;

			$test = GameLoad::where('table_id','test')->where('tr_nature','TRGAME001')->where('date', $date)->get()->sum('tr_value');
			$test_winning = Point::where('table_id','test')->where('tr_nature','TRWIN005')->where('date', $date)->get()->sum('win_value');
			$test_pl=$test-$test_winning;

			
			$DelhiBazar = GameLoad::where('table_id','DELHIBAZAAR')->where('tr_nature','TRGAME001')->where('date', $date)->get()->sum('tr_value');
			$DelhiBazar_winning = Point::where('table_id','DELHIBAZAAR')->where('tr_nature','TRWIN005')->where('date', $date)->get()->sum('win_value');
			$DelhiBazar_pl=$DelhiBazar-$DelhiBazar_winning;

			$ShreeGanesh = GameLoad::where('table_id','SHREEGANESH')->where('tr_nature','TRGAME001')->where('date', $date)->get()->sum('tr_value');
			$ShreeGanesh_winning = Point::where('table_id','SHREEGANESH')->where('tr_nature','TRWIN005')->where('date', $date)->get()->sum('win_value');
			$ShreeGanesh_pl=$ShreeGanesh-$ShreeGanesh_winning;

			$dubaiKing = GameLoad::where('table_id','dubaiKing')->where('tr_nature','TRGAME001')->where('date', $date)->get()->sum('tr_value');
			$dubaiKing_winning = Point::where('table_id','dubaiKing')->where('tr_nature','TRWIN005')->where('date', $date)->get()->sum('win_value');
			$dubaiKing_pl=$dubaiKing-$dubaiKing_winning;

			$laxmidarbar = GameLoad::where('table_id','LAKSHMIDARBAR')->where('tr_nature','TRGAME001')->where('date', $date)->get()->sum('tr_value');
			$laxmidarbar_winning = Point::where('table_id','LAKSHMIDARBAR')->where('tr_nature','TRWIN005')->where('date', $date)->get()->sum('win_value');
			$laxmidarbar_pl=$laxmidarbar-$laxmidarbar_winning;

			$avadhexpress = GameLoad::where('table_id','AVADHEXPRESS')->where('tr_nature','TRGAME001')->where('date', $date)->get()->sum('tr_value');
			$avadhexpress_winning = Point::where('table_id','AVADHEXPRESS')->where('tr_nature','TRWIN005')->where('date', $date)->get()->sum('win_value');
			$avadhexpress_pl=$avadhexpress-$avadhexpress_winning;
			
			

			$rajdhanigold = GameLoad::where('table_id','RAJDHANIGOLD')->where('tr_nature','TRGAME001')->where('date', $date)->get()->sum('tr_value');
			$rajdhanigold_winning = Point::where('table_id','RAJDHANIGOLD')->where('tr_nature','TRWIN005')->where('date', $date)->get()->sum('win_value');
			$rajdhanigold_pl=$rajdhanigold-$rajdhanigold_winning;
			
			$morningstar = GameLoad::where('table_id','MORNI')->where('tr_nature','TRGAME001')->where('date', $date)->get()->sum('tr_value');			
			$morningstar_winning = Point::where('table_id','MORNI')->where('tr_nature','TRWIN005')->where('date', $date)->get()->sum('win_value');
			$morningstar_pl=$morningstar-$morningstar_winning;
			
			$londonbazaar = GameLoad::where('table_id','LONDO')->where('tr_nature','TRGAME001')->where('date', $date)->get()->sum('tr_value');
			$londonbazaar_winning = Point::where('table_id','LONDO')->where('tr_nature','TRWIN005')->where('date', $date)->get()->sum('win_value');
			$londonbazaar_pl=$londonbazaar-$londonbazaar_winning; 
			
			$devdarshan = GameLoad::where('table_id','DEV D')->where('tr_nature','TRGAME001')->where('date', $date)->get()->sum('tr_value');
			$devdarshan_winning = Point::where('table_id','DEV D')->where('tr_nature','TRWIN005')->where('date', $date)->get()->sum('win_value');
			$devdarshan_pl=$devdarshan-$devdarshan_winning;
			
			$nepalborder = GameLoad::where('table_id','NEPAL')->where('tr_nature','TRGAME001')->where('date', $date)->get()->sum('tr_value');
			$nepalborder_winning = Point::where('table_id','NEPAL')->where('tr_nature','TRWIN005')->where('date', $date)->get()->sum('win_value');
			$nepalborder_pl = $nepalborder-$nepalborder_winning;
			
			$indiaclub = GameLoad::where('table_id','INDIA')->where('tr_nature','TRGAME001')->where('date', $date)->get()->sum('tr_value');
			$indiaclub_winning = Point::where('table_id','INDIA')->where('tr_nature','TRWIN005')->where('date', $date)->get()->sum('win_value');
			$indiaclub_pl = $indiaclub-$indiaclub_winning;

			$matkamarket = GameLoad::where('table_id','MATKAMARKET')->where('tr_nature','TRGAME001')->where('date', $date)->get()->sum('tr_value');
			$matkamarket_winning = Point::where('table_id','MATKAMARKET')->where('tr_nature','TRWIN005')->where('date', $date)->get()->sum('win_value');
			$matkamarket_pl = $matkamarket-$matkamarket_winning;

			$customer_balance = User::whereNotNull('_id')
			->where('created_at', '>=', new UTCDateTime(strtotime($date . ' 00:00:00') * 1000))
			->where('created_at', '<=', new UTCDateTime(strtotime($date . ' 23:59:59') * 1000))
			->get()->sum('credit');

			$PointData = Point::where('tr_nature', 'TRDEPO002')->where('tr_status', 'Success')->where('date', $date)->get()->sum('tr_value');
			$DepositData = DepositHistory::where('tr_nature', 'TRDEPO002')->where('tr_status', 'Success')->where('date', $date)->get()->sum('tr_value');
			$add_money = $PointData+$DepositData;
		    $withdraw_money = Point::where('tr_status','Success')->where('tr_nature','TRWITH003')->where('date', $date)->sum('tr_value');
			$pending_withdraw_money = Point::where('tr_status','Pending')->where('tr_nature','TRWITH003')->where('date', $date)->get()->sum('tr_value');
			$cancel_withdraw_money = Point::where('tr_status','Cancelled')->where('tr_nature','TRWITH003')->where('date', $date)->get()->sum('tr_value');
			$total_user = User::where('user_status','1')->count();
			$total_commission = UserCommission::where('status','success')->where('date', $date1)->get()->sum('amount');
			$Total_bidding = GameLoad::where('tr_nature','TRGAME001')->where('date', $date)->get()->sum('tr_value');
			
			$today_bet = GameLoad::where('tr_nature', 'TRGAME001')->where('date', $date)->get()->sum('tr_value');
			$today_win = Point::where('tr_nature', 'TRWIN005')->where('date', $date)->get()->sum('win_value');
			$todaypl = $today_bet - $today_win - $total_commission;
			

			return view('administrator.dashboard.index', compact('laxmidarbar','laxmidarbar_pl','laxmidarbar_winning','dubaiKing_pl','dubaiKing_winning','ShreeGanesh_pl','ShreeGanesh_winning','DelhiBazar_pl','DelhiBazar_winning','GaliBet_pl','GaliBet_winning','GhaziaBad_pl','GhaziaBad_winning','Faridabad_pl','Faridabad_winning','Disawar_pl','Disawar_winning','withdraw_money','pending_withdraw_money','cancel_withdraw_money','add_money','Total_bidding','customer_balance','todaypl','today_win','winningAmount','dubaiKing','GaliBet','DelhiBazar','ShreeGanesh','GhaziaBad','Faridabad','Disawar','today_deposit','TajBet','TajBet_winning','TajBet_pl','total_user','total_commission','avadhexpress','avadhexpress_winning','avadhexpress_pl','rajdhanigold','rajdhanigold_winning','rajdhanigold_pl','morningstar','morningstar_winning','morningstar_pl','londonbazaar','londonbazaar_winning','londonbazaar_pl','devdarshan','devdarshan_winning','devdarshan_pl','nepalborder','nepalborder_winning','nepalborder_pl','indiaclub','indiaclub_winning','indiaclub_pl', 'matkamarket', 'matkamarket_winning','matkamarket_pl'));
		}
		else{
			$date = date('d-m-Y');
			$ymd_date = date('Y-m-d');
			$commissiondate = date('Y-m-d');
			$today_deposit = Point::where('tr_nature', 'TRDEPO002')->where('tr_status', 'Success')->where('date', $date)->get()->sum('tr_value');
			
			$winningAmount = Point::where('tr_nature', 'TRWIN005')->sum('tr_value');

			$Disawar = GameLoad::where('table_id','DISAWAR')->where('tr_nature','TRGAME001')->where('date', $date)->get()->sum('tr_value');
			$Disawar_winning = Point::where('table_id','DISAWAR')->where('tr_nature','TRWIN005')->where('date', $date)->get()->sum('win_value');
			$Disawar_pl=$Disawar-$Disawar_winning;
			
			$Faridabad = GameLoad::where('table_id','FARIDABAAD')->where('tr_nature','TRGAME001')->where('date', $date)->get()->sum('tr_value');
			$Faridabad_winning = Point::where('table_id','FARIDABAAD')->where('tr_nature','TRWIN005')->where('date', $date)->get()->sum('win_value');
			$Faridabad_pl=$Faridabad-$Faridabad_winning;
			
			$GhaziaBad = GameLoad::where('table_id','GAZIABAAD')->where('tr_nature','TRGAME001')->where('date', $date)->get()->sum('tr_value');
			$GhaziaBad_winning = Point::where('table_id','GAZIABAAD')->where('tr_nature','TRWIN005')->where('date', $date)->get()->sum('win_value');
			$GhaziaBad_pl=$GhaziaBad-$GhaziaBad_winning;

			$GaliBet = GameLoad::where('table_id','GALI')->where('tr_nature','TRGAME001')->where('date', $date)->get()->sum('tr_value');
			$GaliBet_winning = Point::where('table_id','GALI')->where('tr_nature','TRWIN005')->where('date', $date)->get()->sum('win_value');
			$GaliBet_pl=$GaliBet-$GaliBet_winning;


			$TajBet = GameLoad::where('table_id','TAJ')->where('tr_nature','TRGAME001')->where('date', $date)->get()->sum('tr_value');
			$TajBet_winning = Point::where('table_id','TAJ')->where('tr_nature','TRWIN005')->where('date', $date)->get()->sum('win_value');
			$TajBet_pl=$TajBet-$TajBet_winning;

			$test = GameLoad::where('table_id','test')->where('tr_nature','TRGAME001')->where('date', $date)->get()->sum('tr_value');
			$test_winning = Point::where('table_id','test')->where('tr_nature','TRWIN005')->where('date', $date)->get()->sum('win_value');
			$test_pl=$test-$test_winning;

			
			$DelhiBazar = GameLoad::where('table_id','DELHIBAZAAR')->where('tr_nature','TRGAME001')->where('date', $date)->get()->sum('tr_value');
			$DelhiBazar_winning = Point::where('table_id','DELHIBAZAAR')->where('tr_nature','TRWIN005')->where('date', $date)->get()->sum('win_value');
			$DelhiBazar_pl=$DelhiBazar-$DelhiBazar_winning;

			$ShreeGanesh = GameLoad::where('table_id','SHREEGANESH')->where('tr_nature','TRGAME001')->where('date', $date)->get()->sum('tr_value');
			$ShreeGanesh_winning = Point::where('table_id','SHREEGANESH')->where('tr_nature','TRWIN005')->where('date', $date)->get()->sum('win_value');
			$ShreeGanesh_pl=$ShreeGanesh-$ShreeGanesh_winning;

			$dubaiKing = GameLoad::where('table_id','dubaiKing')->where('tr_nature','TRGAME001')->where('date', $date)->get()->sum('tr_value');
			$dubaiKing_winning = Point::where('table_id','dubaiKing')->where('tr_nature','TRWIN005')->where('date', $date)->get()->sum('win_value');
			$dubaiKing_pl=$dubaiKing-$dubaiKing_winning;

			$laxmidarbar = GameLoad::where('table_id','LAKSHMIDARBAR')->where('tr_nature','TRGAME001')->where('date', $date)->get()->sum('tr_value');
			$laxmidarbar_winning = Point::where('table_id','LAKSHMIDARBAR')->where('tr_nature','TRWIN005')->where('date', $date)->get()->sum('win_value');
			$laxmidarbar_pl=$laxmidarbar-$laxmidarbar_winning;

			$avadhexpress = GameLoad::where('table_id','AVADHEXPRESS')->where('tr_nature','TRGAME001')->where('date', $date)->get()->sum('tr_value');
			$avadhexpress_winning = Point::where('table_id','AVADHEXPRESS')->where('tr_nature','TRWIN005')->where('date', $date)->get()->sum('win_value');
			$avadhexpress_pl=$avadhexpress-$avadhexpress_winning;

			
			
  

			$rajdhanigold = GameLoad::where('table_id','RAJDHANIGOLD')->where('tr_nature','TRGAME001')->where('date', $date)->get()->sum('tr_value');
			$rajdhanigold_winning = Point::where('table_id','RAJDHANIGOLD')->where('tr_nature','TRWIN005')->where('date', $date)->get()->sum('win_value');
			$rajdhanigold_pl=$rajdhanigold-$rajdhanigold_winning;
			
			$morningstar = GameLoad::where('table_id','MORNI')->where('tr_nature','TRGAME001')->where('date', $date)->get()->sum('tr_value');
			$morningstar_winning = Point::where('table_id','MORNI')->where('tr_nature','TRWIN005')->where('date', $date)->get()->sum('win_value');
			$morningstar_pl=$morningstar-$morningstar_winning;
			
			$londonbazaar = GameLoad::where('table_id','LONDO')->where('tr_nature','TRGAME001')->where('date', $date)->get()->sum('tr_value');
			$londonbazaar_winning = Point::where('table_id','LONDO')->where('tr_nature','TRWIN005')->where('date', $date)->get()->sum('win_value');
			$londonbazaar_pl=$londonbazaar-$londonbazaar_winning;
			
			$devdarshan = GameLoad::where('table_id','DEV D')->where('tr_nature','TRGAME001')->where('date', $date)->get()->sum('tr_value');
			$devdarshan_winning = Point::where('table_id','DEV D')->where('tr_nature','TRWIN005')->where('date', $date)->get()->sum('win_value');
			$devdarshan_pl=$devdarshan-$devdarshan_winning;
			
			$nepalborder = GameLoad::where('table_id','NEPAL')->where('tr_nature','TRGAME001')->where('date', $date)->get()->sum('tr_value');
			$nepalborder_winning = Point::where('table_id','NEPAL')->where('tr_nature','TRWIN005')->where('date', $date)->get()->sum('win_value');
			$nepalborder_pl = $nepalborder-$nepalborder_winning;
			
			$indiaclub = GameLoad::where('table_id','INDIA')->where('tr_nature','TRGAME001')->where('date', $date)->get()->sum('tr_value');
			$indiaclub_winning = Point::where('table_id','INDIA')->where('tr_nature','TRWIN005')->where('date', $date)->get()->sum('win_value');
			$indiaclub_pl = $indiaclub-$indiaclub_winning;
			
			$matkamarket = GameLoad::where('table_id','MATKAMARKET')->where('tr_nature','TRGAME001')->where('date', $date)->get()->sum('tr_value');
			$matkamarket_winning = Point::where('table_id','MATKAMARKET')->where('tr_nature','TRWIN005')->where('date', $date)->get()->sum('win_value');
			$matkamarket_pl = $matkamarket-$matkamarket_winning;

			$customer_balance = User::whereNotNull('_id')->get()->sum('credit');
			$PointData = Point::where('tr_nature', 'TRDEPO002')->where('tr_status', 'Success')->where('date', $date)->get()->sum('tr_value');
			$DepositData = DepositHistory::where('tr_nature', 'TRDEPO002')->where('tr_status', 'Success')->where('date', $date)->get()->sum('tr_value');
			$add_money = $PointData+$DepositData;
			$withdraw_money = Point::where('tr_status','Success')->where('tr_nature','TRWITH003')->where('date', $date)->get()->sum('tr_value');
			$pending_withdraw_money = Point::where('tr_status','Pending')->where('tr_nature','TRWITH003')->where('date', $date)->get()->sum('tr_value');
			$cancel_withdraw_money = Point::where('tr_status','Cancelled')->where('tr_nature','TRWITH003')->where('date', $date)->get()->sum('tr_value');
			$Total_bidding = GameLoad::where('tr_nature','TRGAME001')->where('date', $date)->get()->sum('tr_value');
			
			$total_user = User::where('user_status','1')->count();
			$total_commission = UserCommission::where('status','success')->where('date', $commissiondate)->get()->sum('amount');
			$today_bet = GameLoad::where('tr_nature', 'TRGAME001')->where('date', $date)->get()->sum('tr_value');
			$today_win = Point::where('tr_nature', 'TRWIN005')->where('tr_value_type', "Credit")->where('date', $date)->get()->sum('win_value');
			$todaypl = $today_bet - $today_win - $total_commission;
			
			return view('administrator.dashboard.index', compact('laxmidarbar','laxmidarbar_pl','laxmidarbar_winning','dubaiKing_pl','dubaiKing_winning','ShreeGanesh_pl','ShreeGanesh_winning','DelhiBazar_pl','DelhiBazar_winning','GaliBet_pl','GaliBet_winning','GhaziaBad_pl','GhaziaBad_winning','Faridabad_pl','Faridabad_winning','Disawar_pl','Disawar_winning','withdraw_money','pending_withdraw_money','cancel_withdraw_money','add_money','Total_bidding','customer_balance','todaypl','today_win','winningAmount','dubaiKing','GaliBet','DelhiBazar','ShreeGanesh','GhaziaBad','Faridabad','Disawar','today_deposit','TajBet','TajBet_winning','TajBet_pl','total_user','total_commission','avadhexpress','avadhexpress_winning','avadhexpress_pl','rajdhanigold','rajdhanigold_winning','rajdhanigold_pl','morningstar','morningstar_winning','morningstar_pl','londonbazaar','londonbazaar_winning','londonbazaar_pl','devdarshan','devdarshan_winning','devdarshan_pl','nepalborder','nepalborder_winning','nepalborder_pl','indiaclub','indiaclub_winning','indiaclub_pl', 'matkamarket', 'matkamarket_winning','matkamarket_pl'));
		}

	}



	/*public function index(Request $request)
	{

		if(isset($_GET['select_date'])){
			$date = date('d-m-Y',strtotime($_GET['select_date']));
			$date1 = date('Y-m-d',strtotime($_GET['select_date']));
			
			$today_deposit = Point::where('tr_nature', 'TRDEPO002')->where('date', $date)->get()->sum('tr_value');
			$winningAmount = Point::where('tr_nature', 'TRWIN005')->get()->sum('tr_value');
			
			$Disawar = Point::where('table_id','DISAWAR')->where('tr_nature','TRGAME001')->where('date', $date)->get()->sum('tr_value');
			$Disawar_winning = Point::where('table_id','DISAWAR')->where('tr_nature','TRWIN005')->where('date', $date)->get()->sum('win_value');
			$Disawar_pl=$Disawar-$Disawar_winning;
			
			$Faridabad = Point::where('table_id','FARIDABAAD')->where('tr_nature','TRGAME001')->where('date', $date)->get()->sum('tr_value');
			$Faridabad_winning = Point::where('table_id','FARIDABAAD')->where('tr_nature','TRWIN005')->where('date', $date)->get()->sum('win_value');
			$Faridabad_pl=$Faridabad-$Faridabad_winning;
			
			$GhaziaBad = Point::where('table_id','GAZIABAAD')->where('tr_nature','TRGAME001')->where('date', $date)->get()->sum('tr_value');
			$GhaziaBad_winning = Point::where('table_id','GAZIABAAD')->where('tr_nature','TRWIN005')->where('date', $date)->get()->sum('win_value');
			$GhaziaBad_pl=$GhaziaBad-$GhaziaBad_winning;

			$GaliBet = Point::where('table_id','GALI')->where('tr_nature','TRGAME001')->where('date', $date)->get()->sum('tr_value');
			$GaliBet_winning = Point::where('table_id','GALI')->where('tr_nature','TRWIN005')->where('date', $date)->get()->sum('win_value');
			$GaliBet_pl=$GaliBet-$GaliBet_winning;


			$TajBet = Point::where('table_id','TAJ')->where('tr_nature','TRGAME001')->where('date', $date)->get()->sum('tr_value');
			$TajBet_winning = Point::where('table_id','TAJ')->where('tr_nature','TRWIN005')->where('date', $date)->get()->sum('win_value');
			$TajBet_pl=$TajBet-$TajBet_winning;

			$test = Point::where('table_id','test')->where('tr_nature','TRGAME001')->where('date', $date)->get()->sum('tr_value');
			$test_winning = Point::where('table_id','test')->where('tr_nature','TRWIN005')->where('date', $date)->get()->sum('win_value');
			$test_pl=$test-$test_winning;

			
			$DelhiBazar = Point::where('table_id','DELHIBAZAAR')->where('tr_nature','TRGAME001')->where('date', $date)->get()->sum('tr_value');
			$DelhiBazar_winning = Point::where('table_id','DELHIBAZAAR')->where('tr_nature','TRWIN005')->where('date', $date)->get()->sum('win_value');
			$DelhiBazar_pl=$DelhiBazar-$DelhiBazar_winning;

			$ShreeGanesh = Point::where('table_id','SHREEGANESH')->where('tr_nature','TRGAME001')->where('date', $date)->get()->sum('tr_value');
			$ShreeGanesh_winning = Point::where('table_id','SHREEGANESH')->where('tr_nature','TRWIN005')->where('date', $date)->get()->sum('win_value');
			$ShreeGanesh_pl=$ShreeGanesh-$ShreeGanesh_winning;

			$dubaiKing = Point::where('table_id','dubaiKing')->where('tr_nature','TRGAME001')->where('date', $date)->get()->sum('tr_value');
			$dubaiKing_winning = Point::where('table_id','dubaiKing')->where('tr_nature','TRWIN005')->where('date', $date)->get()->sum('win_value');
			$dubaiKing_pl=$dubaiKing-$dubaiKing_winning;

			$laxmidarbar = Point::where('table_id','LAKSHMIDARBAR')->where('tr_nature','TRGAME001')->where('date', $date)->get()->sum('tr_value');
			$laxmidarbar_winning = Point::where('table_id','LAKSHMIDARBAR')->where('tr_nature','TRWIN005')->where('date', $date)->get()->sum('win_value');
			$laxmidarbar_pl=$laxmidarbar-$laxmidarbar_winning;

			$avadhexpress = Point::where('table_id','AVADHEXPRESS')->where('tr_nature','TRGAME001')->where('date', $date)->get()->sum('tr_value');
			$avadhexpress_winning = Point::where('table_id','AVADHEXPRESS')->where('tr_nature','TRWIN005')->where('date', $date)->get()->sum('win_value');
			$avadhexpress_pl=$avadhexpress-$avadhexpress_winning;
			
			

			$rajdhanigold = Point::where('table_id','RAJDHANIGOLD')->where('tr_nature','TRGAME001')->where('date', $date)->get()->sum('tr_value');
			$rajdhanigold_winning = Point::where('table_id','RAJDHANIGOLD')->where('tr_nature','TRWIN005')->where('date', $date)->get()->sum('win_value');
			$rajdhanigold_pl=$rajdhanigold-$rajdhanigold_winning;
			
			$morningstar = Point::where('table_id','MORNI')->where('tr_nature','TRGAME001')->where('date', $date)->get()->sum('tr_value');			
			$morningstar_winning = Point::where('table_id','MORNI')->where('tr_nature','TRWIN005')->where('date', $date)->get()->sum('win_value');
			$morningstar_pl=$morningstar-$morningstar_winning;
			
			$londonbazaar = Point::where('table_id','LONDO')->where('tr_nature','TRGAME001')->where('date', $date)->get()->sum('tr_value');
			$londonbazaar_winning = Point::where('table_id','LONDO')->where('tr_nature','TRWIN005')->where('date', $date)->get()->sum('win_value');
			$londonbazaar_pl=$londonbazaar-$londonbazaar_winning; 
			
			$devdarshan = Point::where('table_id','DEV D')->where('tr_nature','TRGAME001')->where('date', $date)->get()->sum('tr_value');
			$devdarshan_winning = Point::where('table_id','DEV D')->where('tr_nature','TRWIN005')->where('date', $date)->get()->sum('win_value');
			$devdarshan_pl=$devdarshan-$devdarshan_winning;
			
			$nepalborder = Point::where('table_id','NEPAL')->where('tr_nature','TRGAME001')->where('date', $date)->get()->sum('tr_value');
			$nepalborder_winning = Point::where('table_id','NEPAL')->where('tr_nature','TRWIN005')->where('date', $date)->get()->sum('win_value');
			$nepalborder_pl = $nepalborder-$nepalborder_winning;
			
			$indiaclub = Point::where('table_id','INDIA')->where('tr_nature','TRGAME001')->where('date', $date)->get()->sum('tr_value');
			$indiaclub_winning = Point::where('table_id','INDIA')->where('tr_nature','TRWIN005')->where('date', $date)->get()->sum('win_value');
			$indiaclub_pl = $indiaclub-$indiaclub_winning;

			$matkamarket = Point::where('table_id','MATKAMARKET')->where('tr_nature','TRGAME001')->where('date', $date)->get()->sum('tr_value');
			$matkamarket_winning = Point::where('table_id','MATKAMARKET')->where('tr_nature','TRWIN005')->where('date', $date)->get()->sum('win_value');
			$matkamarket_pl = $matkamarket-$matkamarket_winning;

			$customer_balance = User::whereNotNull('_id')
			->where('created_at', '>=', new UTCDateTime(strtotime($date . ' 00:00:00') * 1000))
			->where('created_at', '<=', new UTCDateTime(strtotime($date . ' 23:59:59') * 1000))
			->get()->sum('credit');

			$PointData = Point::where('tr_nature', 'TRDEPO002')->where('tr_status', 'Success')->where('date', $date)->get()->sum('tr_value');
			$DepositData = DepositHistory::where('tr_nature', 'TRDEPO002')->where('tr_status', 'Success')->where('date', $date)->get()->sum('tr_value');
			$add_money = $PointData+$DepositData;
			 $withdraw_money = Point::where('tr_status','Success')->where('tr_nature','TRWITH003')->where('date', $date)->get()->sum('tr_value');
			
			$total_user = User::where('user_status','1')->count();
			$total_commission = UserCommission::where('status','success')->where('date', $date1)->get()->sum('amount');
			$Total_bidding = Point::where('tr_nature','TRGAME001')->where('date', $date)->get()->sum('tr_value');
			
			$today_bet = Point::where('tr_nature', 'TRGAME001')->where('date', $date)->get()->sum('tr_value');
			$today_win = Point::where('tr_nature', 'TRWIN005')->where('date', $date)->get()->sum('win_value');
			$todaypl = $today_bet - $today_win - $total_commission;
			

			return view('administrator.dashboard.index', compact('laxmidarbar','laxmidarbar_pl','laxmidarbar_winning','dubaiKing_pl','dubaiKing_winning','ShreeGanesh_pl','ShreeGanesh_winning','DelhiBazar_pl','DelhiBazar_winning','GaliBet_pl','GaliBet_winning','GhaziaBad_pl','GhaziaBad_winning','Faridabad_pl','Faridabad_winning','Disawar_pl','Disawar_winning','withdraw_money','add_money','Total_bidding','customer_balance','todaypl','today_win','winningAmount','dubaiKing','GaliBet','DelhiBazar','ShreeGanesh','GhaziaBad','Faridabad','Disawar','today_deposit','TajBet','TajBet_winning','TajBet_pl','total_user','total_commission','avadhexpress','avadhexpress_winning','avadhexpress_pl','rajdhanigold','rajdhanigold_winning','rajdhanigold_pl','morningstar','morningstar_winning','morningstar_pl','londonbazaar','londonbazaar_winning','londonbazaar_pl','devdarshan','devdarshan_winning','devdarshan_pl','nepalborder','nepalborder_winning','nepalborder_pl','indiaclub','indiaclub_winning','indiaclub_pl', 'matkamarket', 'matkamarket_winning','matkamarket_pl'));
		}
		else{
			
			$date = date('d-m-Y');
			$ymd_date = date('Y-m-d');
			$commissiondate = date('Y-m-d');
			$today_deposit = Point::where('tr_nature', 'TRDEPO002')->where('tr_status', 'Success')->where('date', $date)->get()->sum('tr_value');

			$winningAmount = Point::where('tr_nature', 'TRWIN005')->sum('tr_value');

			$Disawar = Point::where('table_id','DISAWAR')->where('tr_nature','TRGAME001')->where('date', $date)->get()->sum('tr_value');
			$Disawar_winning = Point::where('table_id','DISAWAR')->where('tr_nature','TRWIN005')->where('date', $date)->get()->sum('win_value');
			$Disawar_pl=$Disawar-$Disawar_winning;
			
			$Faridabad = Point::where('table_id','FARIDABAAD')->where('tr_nature','TRGAME001')->where('date', $date)->get()->sum('tr_value');
			$Faridabad_winning = Point::where('table_id','FARIDABAAD')->where('tr_nature','TRWIN005')->where('date', $date)->get()->sum('win_value');
			$Faridabad_pl=$Faridabad-$Faridabad_winning;
			
			$GhaziaBad = Point::where('table_id','GAZIABAAD')->where('tr_nature','TRGAME001')->where('date', $date)->get()->sum('tr_value');
			$GhaziaBad_winning = Point::where('table_id','GAZIABAAD')->where('tr_nature','TRWIN005')->where('date', $date)->get()->sum('win_value');
			$GhaziaBad_pl=$GhaziaBad-$GhaziaBad_winning;

			$GaliBet = Point::where('table_id','GALI')->where('tr_nature','TRGAME001')->where('date', $date)->get()->sum('tr_value');
			$GaliBet_winning = Point::where('table_id','GALI')->where('tr_nature','TRWIN005')->where('date', $date)->get()->sum('win_value');
			$GaliBet_pl=$GaliBet-$GaliBet_winning;


			$TajBet = Point::where('table_id','TAJ')->where('tr_nature','TRGAME001')->where('date', $date)->get()->sum('tr_value');
			$TajBet_winning = Point::where('table_id','TAJ')->where('tr_nature','TRWIN005')->where('date', $date)->get()->sum('win_value');
			$TajBet_pl=$TajBet-$TajBet_winning;

			$test = Point::where('table_id','test')->where('tr_nature','TRGAME001')->where('date', $date)->get()->sum('tr_value');
			$test_winning = Point::where('table_id','test')->where('tr_nature','TRWIN005')->where('date', $date)->get()->sum('win_value');
			$test_pl=$test-$test_winning;

			
			$DelhiBazar = Point::where('table_id','DELHIBAZAAR')->where('tr_nature','TRGAME001')->where('date', $date)->get()->sum('tr_value');
			$DelhiBazar_winning = Point::where('table_id','DELHIBAZAAR')->where('tr_nature','TRWIN005')->where('date', $date)->get()->sum('win_value');
			$DelhiBazar_pl=$DelhiBazar-$DelhiBazar_winning;

			$ShreeGanesh = Point::where('table_id','SHREEGANESH')->where('tr_nature','TRGAME001')->where('date', $date)->get()->sum('tr_value');
			
			$ShreeGanesh_winning = Point::where('table_id','SHREEGANESH')->where('tr_nature','TRWIN005')->where('date', $date)->get()->sum('win_value');
			$ShreeGanesh_pl=$ShreeGanesh-$ShreeGanesh_winning;

			$dubaiKing = Point::where('table_id','dubaiKing')->where('tr_nature','TRGAME001')->where('date', $date)->get()->sum('tr_value');
			$dubaiKing_winning = Point::where('table_id','dubaiKing')->where('tr_nature','TRWIN005')->where('date', $date)->get()->sum('win_value');
			$dubaiKing_pl=$dubaiKing-$dubaiKing_winning;

			$laxmidarbar = Point::where('table_id','LAKSHMIDARBAR')->where('tr_nature','TRGAME001')->where('date', $date)->get()->sum('tr_value');
			$laxmidarbar_winning = Point::where('table_id','LAKSHMIDARBAR')->where('tr_nature','TRWIN005')->where('date', $date)->get()->sum('win_value');
			$laxmidarbar_pl=$laxmidarbar-$laxmidarbar_winning;

			$avadhexpress = Point::where('table_id','AVADHEXPRESS')->where('tr_nature','TRGAME001')->where('date', $date)->get()->sum('tr_value');
			$avadhexpress_winning = Point::where('table_id','AVADHEXPRESS')->where('tr_nature','TRWIN005')->where('date', $date)->get()->sum('win_value');
			$avadhexpress_pl=$avadhexpress-$avadhexpress_winning;

			
			
  

			$rajdhanigold = Point::where('table_id','RAJDHANIGOLD')->where('tr_nature','TRGAME001')->where('date', $date)->get()->sum('tr_value');
			$rajdhanigold_winning = Point::where('table_id','RAJDHANIGOLD')->where('tr_nature','TRWIN005')->where('date', $date)->get()->sum('win_value');
			$rajdhanigold_pl=$rajdhanigold-$rajdhanigold_winning;
			
			$morningstar = Point::where('table_id','MORNI')->where('tr_nature','TRGAME001')->where('date', $date)->get()->sum('tr_value');
			$morningstar_winning = Point::where('table_id','MORNI')->where('tr_nature','TRWIN005')->where('date', $date)->get()->sum('win_value');
			$morningstar_pl=$morningstar-$morningstar_winning;
			
			$londonbazaar = Point::where('table_id','LONDO')->where('tr_nature','TRGAME001')->where('date', $date)->get()->sum('tr_value');
			$londonbazaar_winning = Point::where('table_id','LONDO')->where('tr_nature','TRWIN005')->where('date', $date)->get()->sum('win_value');
			$londonbazaar_pl=$londonbazaar-$londonbazaar_winning;
			
			$devdarshan = Point::where('table_id','DEV D')->where('tr_nature','TRGAME001')->where('date', $date)->get()->sum('tr_value');
			$devdarshan_winning = Point::where('table_id','DEV D')->where('tr_nature','TRWIN005')->where('date', $date)->get()->sum('win_value');
			$devdarshan_pl=$devdarshan-$devdarshan_winning;
			
			$nepalborder = Point::where('table_id','NEPAL')->where('tr_nature','TRGAME001')->where('date', $date)->get()->sum('tr_value');
			$nepalborder_winning = Point::where('table_id','NEPAL')->where('tr_nature','TRWIN005')->where('date', $date)->get()->sum('win_value');
			$nepalborder_pl = $nepalborder-$nepalborder_winning;
			
			$indiaclub = Point::where('table_id','INDIA')->where('tr_nature','TRGAME001')->where('date', $date)->get()->sum('tr_value');
			$indiaclub_winning = Point::where('table_id','INDIA')->where('tr_nature','TRWIN005')->where('date', $date)->get()->sum('win_value');
			$indiaclub_pl = $indiaclub-$indiaclub_winning;
			
			$matkamarket = Point::where('table_id','MATKAMARKET')->where('tr_nature','TRGAME001')->where('date', $date)->get()->sum('tr_value');
			$matkamarket_winning = Point::where('table_id','MATKAMARKET')->where('tr_nature','TRWIN005')->where('date', $date)->get()->sum('win_value');
			$matkamarket_pl = $matkamarket-$matkamarket_winning;

			$customer_balance = User::whereNotNull('_id')->get()->sum('credit');
			$PointData = Point::where('tr_nature', 'TRDEPO002')->where('tr_status', 'Success')->get()->sum('tr_value');
			$DepositData = DepositHistory::where('tr_nature', 'TRDEPO002')->where('tr_status', 'Success')->get()->sum('tr_value');
			$add_money = $PointData+$DepositData;
			$withdraw_money = Point::where('tr_status','Success')->where('tr_nature','TRWITH003')->get()->sum('tr_value');
			$Total_bidding = Point::where('tr_nature','TRGAME001')->get()->sum('tr_value');
			
			$total_user = User::where('user_status','1')->count();
			$total_commission = UserCommission::where('status','success')->where('date', $commissiondate)->get()->sum('amount');
			$today_bet = Point::where('tr_nature', 'TRGAME001')->where('tr_value_type', "Debit")->where('date', $date)->get()->sum('tr_value');
			$today_win = Point::where('tr_nature', 'TRWIN005')->where('tr_value_type', "Credit")->where('date', $date)->get()->sum('win_value');
			$todaypl = $today_bet - $today_win - $total_commission;
			
			return view('administrator.dashboard.index', compact('laxmidarbar','laxmidarbar_pl','laxmidarbar_winning','dubaiKing_pl','dubaiKing_winning','ShreeGanesh_pl','ShreeGanesh_winning','DelhiBazar_pl','DelhiBazar_winning','GaliBet_pl','GaliBet_winning','GhaziaBad_pl','GhaziaBad_winning','Faridabad_pl','Faridabad_winning','Disawar_pl','Disawar_winning','withdraw_money','add_money','Total_bidding','customer_balance','todaypl','today_win','winningAmount','dubaiKing','GaliBet','DelhiBazar','ShreeGanesh','GhaziaBad','Faridabad','Disawar','today_deposit','TajBet','TajBet_winning','TajBet_pl','total_user','total_commission','avadhexpress','avadhexpress_winning','avadhexpress_pl','rajdhanigold','rajdhanigold_winning','rajdhanigold_pl','morningstar','morningstar_winning','morningstar_pl','londonbazaar','londonbazaar_winning','londonbazaar_pl','devdarshan','devdarshan_winning','devdarshan_pl','nepalborder','nepalborder_winning','nepalborder_pl','indiaclub','indiaclub_winning','indiaclub_pl', 'matkamarket', 'matkamarket_winning','matkamarket_pl'));
		}

	}*/
}
