<?php

namespace App\Helpers;

use App\Models\User;
use App\Models\Tabletype;
use App\Models\Market;
use App\Models\Admin;
use App\Models\Super;
use App\Models\Point;
use App\Models\DepositHistory;
use App\Models\PointTable;
use App\Models\GameLoad;
use App\Models\ManageCommission;
use DB;

class Helper
{

  public static function get_market($id)
  {
    // dd($id);
    $select = Market::where('market_id', $id)->first();
    return $select;
  }

  public static function widthrawamout($date)
  {
    $widthraw_amount = Point::where('tr_status','Success')->where('tr_nature', 'TRWITH003')->where('date',$date)->get()->sum('tr_value');
    return  $widthraw_amount;
  }

  public static function widthrawamout_count($date)
  {
    $widthraw_amount_count = Point::where('tr_status','Success')->where('tr_nature', 'TRWITH003')->where('date',$date)->get()->count();
    return  $widthraw_amount_count;
  }

  public static function depositamout($date)
  {
    $widthraw_amount = DepositHistory::where('tr_status','Success')->where('tr_nature', 'TRDEPO002')->where('date',$date)->get()->sum('tr_value');
    return  $widthraw_amount;
  }
   public static function userdepositamout($user_id)
  {
    $widthraw_amount = DepositHistory::where('tr_status','Success')->where('tr_nature', 'TRDEPO002')->where('user_id',(string)$user_id)->get()->sum('tr_value');
    return  $widthraw_amount;
  }
  public static function depositamout_count($date)
  {
    $widthraw_amount_count = DepositHistory::where('tr_status','Success')->where('tr_nature', 'TRDEPO002')->where('date',$date)->get()->count();
    return  $widthraw_amount_count;
  }


  public static function depositamout_old($date)
  {
    $widthraw_amount = PointTable::where('tr_status','Success')->where('tr_nature', 'TRDEPO002')->where('date',$date)->get()->sum('tr_value');
    return  $widthraw_amount;
  }
  public static function depositamout_count_old($date)
  {
    $widthraw_amount_count = PointTable::where('tr_status','Success')->where('tr_nature', 'TRDEPO002')->where('date',$date)->get()->count();
    return  $widthraw_amount_count;
  }

  public static function get_child($id)
  {
    // dd($id);
    $select = User::where('ref_by', $id)->get()->count();
    return $select;
  }

  public static function get_played($id)
  {
    // dd($id);
    $select = Point::where('tr_nature', 'TRGAME001')->where('user_id', $id)->where('tr_value_type', "Debit")->sum('tr_value');
    return $select;
  }
  public static function get_bet_num_amt($num, $game_type)
  {
    $select = Point::where('tr_nature', 'TRGAME001')->where('game_type', $game_type)->where('pred_num', $num)->sum('tr_value');
    return $select;
  }

  public static function get_child_played($id)
  {
    // dd($id);
    $select = User::where('ref_by', $id)->get();
    //print_r($select);
    //die;

    $sum = 0;
    foreach ($select as $vs) {
      $sum = $sum + Point::where('tr_nature', 'TRGAME001')->where('user_id', $vs->user_id)->where('tr_value_type', "Debit")->sum('tr_value');
    }
    return $sum;
  }

  public static function get_pl($date, $mid)
  {

    $dep = Point::where('tr_nature', 'TRGAME001')->where('tr_value_type', "Debit")->where('date', $date)->where('table_id', $mid)->sum('tr_value');
    $with = Point::where('tr_nature', 'TRWIN005')->where('tr_value_type', "Credit")->where('date', $date)->where('table_id', $mid)->sum('tr_value');
    return $dep - $with;
  }

  public static function get_date_pl($date)
  {

    $dep = Point::where('tr_nature', 'TRGAME001')->where('tr_value_type', "Debit")->where('date', $date)->sum('tr_value');
    $with = Point::where('tr_nature', 'TRWIN005')->where('tr_value_type', "Credit")->where('date', $date)->sum('tr_value');
    return $dep - $with;
  }



  public static function get_game_type($id)
  {
    // dd($id);
    // $select = Tabletype::where('tbl_code', $id)->first();

    if ($id == 1) {
      $select = 'SingleDigit';
    } elseif ($id == 2) {
      $select = 'JodiDigit';
    } elseif ($id == 3) {
      $select = 'SinglePana';
    } elseif ($id == 4) {
      $select = 'DoublePana';
    } elseif ($id == 5) {
      $select = 'TriplePana';
    } elseif ($id == 6) {
      $select = 'HalfSangam';
    } elseif ($id == 7) {
      $select = 'FullSangam';
    }
    return $select;
  }
  public static function gettotalnumberdata($game_type, $number, $date)
  {
    // dd($date);
    $single_digit = Point::where('game_type', $game_type)->where('tr_nature', 'TRGAME001')->where('value_update_by', 'Game')->where('pred_num', $number)->where('date', $date)->sum('tr_value');
    return $single_digit;
  }
  public static function getJodi($id, $date11, $market)
  {
    $id = (($id == 100) ? "00" : $id);
    // $date = date('01-03-2022');
    if ($date11) {
      $date = date('d-m-Y', strtotime($date11));
      $total_winnerJodi = Point::where('game_type', '1')->where('table_id', $market)->where('date', $date)->where('is_result_declared', 0)->where('tr_nature', 'TRGAME001')->where('pred_num', $id)->sum('tr_value');
    } else {
      $date1 = date('d-m-Y');
      $total_winnerJodi = Point::where('game_type', '1')->where('date', $date1)->where('is_result_declared', 0)->where('tr_nature', 'TRGAME001')->where('pred_num', $id)->sum('tr_value');
    }


    return $total_winnerJodi;
  }
  public static function getAndar($id, $date11, $market)
  {
    // dd('ppp');
    // $date = date('01-03-2022');
    $id = (($id == 10) ? "0" : $id);
    if ($date11) {
      $date = date('d-m-Y', strtotime($date11));
      $total_winnerAndar = Point::where('game_type', '2')->where('date', $date)->where('table_id', $market)->where('is_result_declared', 0)->where('tr_nature', 'TRGAME001')->where('pred_num', $id)->sum('tr_value');
    } else {
      $date1 = date('d-m-Y');
      $total_winnerAndar = Point::where('game_type', '2')->where('date', $date1)->where('is_result_declared', 0)->where('tr_nature', 'TRGAME001')->where('pred_num', $id)->sum('tr_value');
    }

    return $total_winnerAndar;
  }
  public static function getBahar($id, $date11, $market)
  {
    $id = (($id == 10) ? "0" : $id);
    // dd('ppp');
    // $date = date('01-03-2022');
    if ($date11) {
      $date = date('d-m-Y', strtotime($date11));
      $total_winnerBahar = Point::where('game_type', '3')->where('date', $date)->where('table_id', $market)->where('is_result_declared', 0)->where('tr_nature', 'TRGAME001')->where('pred_num', $id)->sum('tr_value');
    } else {
      $date1 = date('d-m-Y');
      $total_winnerBahar = Point::where('game_type', '3')->where('date', $date1)->where('is_result_declared', 0)->where('tr_nature', 'TRGAME001')->where('pred_num', $id)->sum('tr_value');
    }

    return $total_winnerBahar;
  }

  public static function razor_order_id($name, $email, $contact, $ref_id)
  {

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://api.razorpay.com/v1/contacts');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, '{
				  "name":"' . $name . '",
				  "email":"' . $email . '",
				  "contact":"' . $contact . '",
				  "type":"vendor",
				  "reference_id":"' . $ref_id . '",
				  "notes":{
					"notes_key_1":"Account for payment",
					"notes_key_2":"seller for payment"
				  }
				}');
    //curl_setopt($ch, CURLOPT_USERPWD, 'rzp_test_DSuvF1zjLE6pYG' . ':' . 'aCwUQKQpe0QnRYZGLdkWsp4Y');
    curl_setopt($ch, CURLOPT_USERPWD, 'rzp_live_5wtzZNHKy4TEyL' . ':' . 'gGIk1D9RNlJVdRwi9a4gQxqm');
    $headers = array();
    $headers[] = 'Content-Type: application/json';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $result = curl_exec($ch);
    if (curl_errno($ch)) {
      echo 'Error:' . curl_error($ch);
    }
    curl_close($ch);
    $data = json_decode($result);
    return $data->id;
  }

  public static function add_fund_account($dataList = array())
  {



    $name = strtolower($dataList['name']);
    //$ac_name = $dataList['ac_name'];
    //$ifsc = $dataList['ifsc'];
    $vpa = strtolower($dataList['vpa']);
    $email = strtolower($dataList['email']);
    $contact = $dataList['contact'];
    $ref_id = $dataList['ref_id'];
    $value = self::razor_order_id($name, $email, $contact, $ref_id);


    $url = "https://api.razorpay.com/v1/fund_accounts";

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $headers = array(
      "Content-Type: application/json",
      "Authorization: Basic " . base64_encode('rzp_live_5wtzZNHKy4TEyL:gGIk1D9RNlJVdRwi9a4gQxqm') . "",
    );
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

    $data = <<<DATA
{
  "account_type":"vpa",
  "contact_id":"$value",
  "vpa":{
    "address":"$vpa"
  }
}
DATA;

    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

    //for debug only!
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

    $resp = curl_exec($curl);
    curl_close($curl);
    return json_decode($resp);
  }



  public static function payment($fid, $amount)
  {


    $url = "https://api.razorpay.com/v1/payouts";

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $headers = array(
      "Content-Type: application/json",
      //"Authorization: Basic ".base64_encode('rzp_test_USH6cE4ebZSkEL:w9ukWaWywsHobTuI1pLoT4fQ')."",
      "Authorization: Basic " . base64_encode('rzp_live_5wtzZNHKy4TEyL:gGIk1D9RNlJVdRwi9a4gQxqm') . "",
    );
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_POSTFIELDS, '{
  "account_number":"4564569659171014",
  "fund_account_id":"' . $fid . '",
  "amount":' . $amount . ',
  "currency": "INR",
  "mode": "UPI",
  "purpose": "payout",
  "queue_if_low_balance": false,
  "reference_id": "Acme Transaction ID 12345",
  "narration": "Acme Corp Fund Transfer",
  "notes": {
    "notes_key_1":"Tea, Earl Grey, Hot",
    "notes_key_2":"Tea, Earl Grey… decaf."
  }
}');
    //curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    //for debug only!
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

    $resp = curl_exec($curl);
    curl_close($curl);

    return json_decode($resp);
  }

  public static function getJodiNew($id, $date11, $market)
	{
    
		$id = (($id == 100) ? "00" : $id);
    
		if ($date11) {
			$date = date('d-m-Y', strtotime($date11));
			$total_winnerJodi = GameLoad::where('game_type', 8)->where('table_id', $market)->where('date', $date)->where('tr_nature', 'TRGAME001')->where('pred_num', (string)$id)->get()->sum('tr_value');

      
		} else {
      // dd((string)$id);
			$date1 = date('d-m-Y');
			$total_winnerJodi = GameLoad::where('game_type', 8)->where('date', $date1)->where('tr_nature', 'TRGAME001')->where('pred_num', (string)$id)->get()->sum('tr_value');
		}

    
		return $total_winnerJodi;
	}
	public static function getAndarNew($id, $date11, $market)
	{
		// dd('ppp');
		// $date = date('01-03-2022');
		$id = (($id == 10) ? "0" : $id);
		if ($date11) {
			$date = date('d-m-Y', strtotime($date11));
     
			$total_winnerAndar = GameLoad::where('game_type', 9)->where('date', $date)->where('table_id', $market)->where('tr_nature', 'TRGAME001')->where('pred_num', (string)$id)->get()->sum('tr_value');
		} else {
			$date1 = date('d-m-Y');
			$total_winnerAndar = GameLoad::where('game_type', 9)->where('date', $date1)->where('tr_nature', 'TRGAME001')->where('pred_num', (string)$id)->get()->sum('tr_value');
		}

		return $total_winnerAndar;
	}
	public static function getBaharNew($id, $date11, $market)
	{
		$id = (($id == 10) ? "0" : $id);
		// dd('ppp');
		// $date = date('01-03-2022');
		if ($date11) {
			$date = date('d-m-Y', strtotime($date11));
			$total_winnerBahar = GameLoad::where('game_type', 10)->where('date', $date)->where('table_id', $market)->where('tr_nature', 'TRGAME001')->where('pred_num', (string)$id)->get()->sum('tr_value');
		} else {
			$date1 = date('d-m-Y');
			$total_winnerBahar = GameLoad::where('game_type', 10)->where('date', $date1)->where('tr_nature', 'TRGAME001')->where('pred_num', (string)$id)->get()->sum('tr_value');
		}

		return $total_winnerBahar;
	}


  public static function send_msg($mobile_number, $message)
	{
		// dd($message);
		// $username = "A2TECHNOSOFT";
		// $password = "Aa123456";
		// $sender = "hunger";
		// $authokey = "92JXdxwAanf5w";

		// $url=file_get_contents("https://www.fast2sms.com/dev/bulkV2?authorization=48TQalPZI7VuDLEvf1zmUwCMB6RrjGtWyAHk35hecJOFo2dXx0WgyHQusCwfvPZERkpKnxiSbY3L2thA&variables_values=5599&route=otp&numbers=9999999999,8888888888,7777777777");
		// // $url=file_get_contents("http://94.237.74.58/api/pushsms?user=A2TECHNOSOFT&authkey=92JXdxwAanf5w&sender=hunger&mobile=$mobile_number&text=".urlencode($message)."&unicode=0&output=json");
		// dd($url);

		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://www.fast2sms.com/dev/bulkV2?authorization=dOh4l8D1jUX03Bz6TQsuCa9m2gFwrvGVn5SHMWeiqkocyZxPfEH5PKWtcpRVBn9Qo1d4X8lGvx6kqU7g&variables_values=" . $message . "&route=otp&numbers=" . urlencode($mobile_number),
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_SSL_VERIFYHOST => 0,
			CURLOPT_SSL_VERIFYPEER => 0,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_HTTPHEADER => array(
				"cache-control: no-cache"
			),
		));

		$response = curl_exec($curl);
		// dd($response);
		$err = curl_error($curl);

		curl_close($curl);


		//$username = "k.k.sales";
		//$password = "khanshab@123";
		//$sender = "cartly";
		//$url = "login.bulksmsgateway.in/sendmessage.php?user=" . urlencode($username) . "&password=" . urlencode($password) . "&mobile=" . urlencode($mobile_number) . "&message=" . urlencode($message) . "&sender=" . urlencode($sender) . "&type=" . urlencode('3');
		//$ch = curl_init($url);
		//curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		//$curl_scraped_page = curl_exec($ch);
		//curl_close($ch);  
	}


  public static function getPointData($itemId){
   return ManageCommission::whereNotNull('id')
        ->where('status', 'pending')
        ->whereColumn('win_amount', '<', 'bat_amount')
        ->where('visible', 1)->first();
  }

  public static function check_permission($user_id, $menu)
	{
   
		if ($user_id == "1") {
			return true;
		} else {
			$permission = Super::where('ad_id', $user_id)->first();
			// Fallback: if no permission mapping exists in "supers",
			// keep menus visible for logged administrator.
			if (!$permission || empty($permission['role_id'])) {
				return true;
			}
			$access = $permission['role_id'];
			if (in_array($menu, explode(",", $access))) {
				return true;
			} else {
				return false;
			}
		}
	}



}
?>