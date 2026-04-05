<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use URL;
use DB;
use Session;
use Validator;
use Response;
use Illuminate\Support\Facades\Redirect;
// use User;
use App\Models\AppControl;
use App\Models\PaymentGetway;
use App\Models\DepositHistory;
use App\Models\ScannerPayment;
use App\Models\PaymentInstruction;
use App\Models\Walletreport;
use App\Models\User;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Carbon\Carbon;
use App\Models\Result;
use App\Models\Market;


class GetwayController extends Controller
{
	public function __construct()
	{

		// parent::__construct();
	}
	public function payment_getway2(Request $request)
	{
		date_default_timezone_set("Asia/Calcutta");
		$requestedGateway = $request->get('getaway') ?? $request->get('gateway') ?? $request->get('slug');
		$requestedGateway = is_string($requestedGateway) ? trim($requestedGateway) : null;

		if (!empty($requestedGateway)) {
			// Normalize short values like "scanner" to real slug
			if ($requestedGateway === 'scanner') {
				$requestedGateway = 'payment-by-scanner';
			}
			// Prefer exact slug match first (prevents "utr" names mapping into "online" accidentally).
			$res = PaymentGetway::where('status', 1)->where('slug', $requestedGateway)->first();
			if (!$res) {
				$res = PaymentGetway::where('status', 1)->where('name', $requestedGateway)->first();
			}
		} else {
			$res = PaymentGetway::where('status', 1)->first();
		}

		// Fallback: if requested slug doesn't exist, keep original behavior
		if (!$res) {
			$res = PaymentGetway::where('status', 1)->first();
		}
		$upi = AppControl::select('upiId', 'help_line_number')->first();
		$paymentInstruction = PaymentInstruction::where('status', 1)->first();
		$chkuser = User::where('user_id', $request->userid)->count();
		$userDetail = User::where('user_id', $request->userid)->first();
		if ($chkuser > 0) {
			if (@$res->slug == "menual") {
				$rand = rand(111111, 99999) . rand(123, 999);
				$remark = substr($request->contact, -6);
				$amount = $request->amount;
				$userid = $request->userid;
				$name = $request->name;
				$contact = $request->contact;

				$store = DepositHistory::create([
					'app_id' => 'com.dubaiking',
					'admin_key' => 'ADMIN0001',
					'user_id' => $userid,
					'username' => $userDetail->FullName,
					'mobile_number' => $userDetail->mob,
					'transaction_id' => $rand,
					'tr_nature' => 'TRDEPO002',
					'tr_value' => $amount,
					'value_update_by' => 'Deposit',
					'transactionRef' => $remark,
					'tr_value_type' => 'Credit',
					'date' => date('d-m-Y'),
					'date_time' => date('d-m-Y h:i:s'),
					'created_at' => now(),
					'tr_remark' => 'online',
					'tr_status' => 'Pending',
				]);

				$intentData = "upi://pay?pa=" . $upi->upiId . "&pn=dubaiking&tn=" . $remark . "&am=" . $amount . "&cu=INR";

				$qrcode = QrCode::size(250)
					->margin(1)->generate(
						$intentData
					);

				// $id = $store->_id;
				$general_settings = AppControl::first();
				return view('front.page.manual_gateway', compact('rand', 'upi', 'remark', 'paymentInstruction', 'intentData', 'qrcode', 'general_settings'));
			} elseif (@$res->slug == "online") {
				// dd($request->all());
				if (!isset($_GET['name']) || !isset($_GET['userid']) || !isset($_GET['amount']) || !isset($_GET['contact'])) {
					return json_encode(['status' => false, 'message' => 'please Pass All Parameter!']);
				}
				$orderid = rand('000000', '999999') . rand('444444', '777777') . rand('333', '888');
				$key = "ecfe18b8-2742-43d3-a6ee-43f5d8a84b08";
				DepositHistory::create([
					'app_id' => 'com.dubaiking',
					'admin_key' => 'ADMIN0001',
					'user_id' => $request->userid,
					'username' => $userDetail->FullName,
					'mobile_number' => $userDetail->mob,
					'transaction_id' => $orderid,
					'tr_nature' => 'TRDEPO002',
					'tr_value' => $request->amount,
					'value_update_by' => 'Deposit',
					'tr_value_type' => 'Credit',
					'date' => date('d-m-Y'),
					'date_time' => date('d-m-Y h:i:s'),
					'created_at' => now(),
					'tr_remark' => 'online',
					'tr_status' => 'Pending',
				]);
				// $all_user = DB::table('wallet_reports')->where('user_id', $request->userid)->first();
				// $total = $all_user->credit + $request->amount;

				$walletData = [
					'user_id' => $request->userid,
					'app_id' => 'com.dubaiking',
					'transaction_id' => $orderid,
					'tr_value' => $request->amount,
					'tr_status' => "Pending",
					'tr_nature' => "TRDEPO002",
					'type' => "Credit",
					'tr_remark' => "Online",
					'date' => date('d-m-Y'),
					'date_time' => date('Y-m-d H:i:s'),
					'created_at' => now(),
					'value_update_by' => "Deposit",
				];

				// Insert into MongoDB
				Walletreport::create($walletData);

				// dd($user);
				$content = json_encode(
					array(
						"key" => $key,
						"client_txn_id" => $orderid, // order id or your own transaction id
						"amount" => $request->amount,
						"p_info" => "domi",
						"customer_name" => $request->userid, // customer name
						"customer_email" => "dsmatka@gmail.com", // customer email
						"customer_mobile" => $request->contact, // customer mobile number
						"redirect_url" => "https://admin.24x7good.com/public/redirect-payment", // redirect url after payment, with ?client_txn_id=&txn_id=
						"udf1" => "user defined field 1", // udf1, udf2 and udf3 are used to save other order related data, like customer id etc.
						"udf2" => "user defined field 2",
						"udf3" => "user defined field 3",
					)
				);
				$url = "https://merchant.upigateway.com/api/create_order";
				$useCurl = function_exists('\\curl_init') && function_exists('\\curl_exec');
				if ($useCurl) {
					$curl = \curl_init($url);
					\curl_setopt($curl, CURLOPT_HEADER, false);
					\curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
					\curl_setopt(
						$curl,
						CURLOPT_HTTPHEADER,
						array("Content-type: application/json")
					);
					\curl_setopt($curl, CURLOPT_POST, true);
					\curl_setopt($curl, CURLOPT_POSTFIELDS, $content);
					$json_response = \curl_exec($curl);
					$status = \curl_getinfo($curl, CURLINFO_HTTP_CODE);
					// dd($json_response);
					if ($status != 200) {
						die("Error: call to URL $url failed with status $status, response " . ($json_response ?? ''));
					}
					\curl_close($curl);
				} else {
					// Fallback when PHP curl extension is disabled.
					$headers = [
						'Content-type: application/json',
						'Accept: application/json',
						'Content-Length: ' . strlen($content),
					];
					$context = stream_context_create([
						'http' => [
							'method' => 'POST',
							'header' => implode("\r\n", $headers),
							'content' => $content,
							'timeout' => 60,
						],
					]);
					$json_response = @file_get_contents($url, false, $context);
					$status = 0;
					if (isset($http_response_header) && is_array($http_response_header)) {
						foreach ($http_response_header as $h) {
							if (preg_match('#HTTP/\\S+\\s+(\\d+)#', $h, $m)) {
								$status = (int)$m[1];
								break;
							}
						}
					}
					if ($status != 200) {
						die("Error: call to URL $url failed with status $status, response " . ($json_response ?? ''));
					}
				}
				$response = json_decode($json_response, true);
				// dd($response);
				if ($response["status"] == true) {

					$phonepaya = $response['data']['upi_intent']['phonepe_link'];
					$paytm_linka = $response['data']['upi_intent']['paytm_link'];
					$gpay_linka = $response['data']['upi_intent']['gpay_link'];

					$vdata = explode(":", $phonepaya);
					$intafter = $vdata[1];

					$vdata1 = explode("?", $phonepaya);
					$intaftergpay = $vdata1[1];

					$intentData1 = "gpay://upi/pay?" . $intaftergpay;

					$intentData2 = "paytm:" . $intafter;
					$intentData3 = "phonepe:" . $intafter;


					$url = $response["data"]["payment_url"];
					// dd($url);
					return Redirect::intended($url);

					//    return view('front.page.upi_gateway', compact('phonepaya', 'paytm_linka', 'gpay_linka', 'intentData1','intentData2','intentData3'));

				} else {
					// 		Alert::error('Error Occur!!', 'A Error occur during payment, please try again.');
					// return view('user.payment_failed');
					//return redirect()->back();
				}
			} elseif (@$res->slug == "payment-by-scanner") {
				$rand = rand(111111, 99999) . rand(123, 999);
				$remark = substr($request->contact, -6);
				$amount = $request->amount;
				$userid = $request->userid;
				$name = $request->name;
				$contact = $request->contact;
				$data = [
					'app_id' => 'com.dubaiking',
					'admin_key' => 'ADMIN0001',
					'user_id' => $request->userid,
					'username' => $userDetail->FullName,
					'mobile_number' => $userDetail->mob,
					'transaction_id' => $rand,
					'tr_nature' => 'TRDEPO002',
					'tr_value' => $request->amount,
					'value_update_by' => 'Deposit',
					'transactionRef' => $remark,
					'tr_value_type' => 'Credit',
					'date' => date('d-m-Y'),
					'date_time' => date('d-m-Y h:i:s'),
					'created_at' => date('Y-m-d H:i:s'),
					'tr_remark' => 'qr_scane',
					'tr_status' => 'Pending',
				];
				DepositHistory::create($data);
				$qr_code = ScannerPayment::where('status', 1)->first();
				return view('front.page.payment_by_scanner', compact('qr_code', 'upi'));
			} else {
				// dd('opppp');
				$rand = rand(111111, 99999) . rand(123, 999);
				$remark = substr($request->contact, -6);
				$amount = $request->amount;
				$userid = $request->userid;
				$name = $request->name;
				$contact = $request->contact;
				$data = new DepositHistory();

				$data->app_id = 'com.dubaiking';
				$data->admin_key = 'ADMIN0001';
				$data->user_id = $request->userid;
				$data->username = $userDetail->FullName;
				$data->mobile_number = $userDetail->mob;
				$data->transaction_id = $rand;
				$data->tr_nature = 'TRDEPO002';
				$data->tr_value = $request->amount;
				$data->value_update_by = 'Deposit';
				$data->transactionRef = $remark;
				$data->tr_value_type = 'Credit';
				$data->date = date('d-m-Y');
				$data->date_time = date('d-m-Y h:i:s');
				$data->created_at = date('d-m-Y h:i:s');
				$data->tr_remark = 'qr_scane';
				$data->tr_status = 'Pending';
				$data->save();

				$id = $data->id;
				$general_settings = AppControl::first();
				return view('front.page.EkpayGateway', compact('general_settings', 'amount', 'userid', 'contact', 'id'));
			}
		}

		// Public QR for scanner must work even without authentication/user record.
		// (Payment processing may still fail later if the user truly doesn't exist.)
		if (@$res->slug == "payment-by-scanner") {
			$qr_code = ScannerPayment::where('status', 1)->first();
			return view('front.page.payment_by_scanner', compact('qr_code', 'upi'));
		}

		// If user doesn't exist, redirect()->back() goes to home page.
		// Return explicit error for direct-access flows.
		return response()->json([
			'status' => false,
			'message' => 'User not found',
			'userid' => $request->userid,
		], 404);
	}
	public function getway_callback(Request $request)
	{
		date_default_timezone_set("Asia/Calcutta");
		// 		dd('pppprrrrrrrrr');
		/*$data='{"id":"58281473","customer_vpa":"8003466954@paytm","amount":"1","client_txn_id":"967786","customer_name":"SONU KUMAR SINGH SO RAMESHWAR singh","customer_email":"ddharmrajbairwa@gmail.com","customer_mobile":"9660133196","p_info":"product_name","upi_txn_id":"359324088233","status":"success","remark":null,"udf1":null,"udf2":null,"udf3":null,"redirect_url":"https:\/\/indiaallinone.in\/user\/checkStatus","txnAt":"2023-08-15","createdAt":"2023-08-15T11:21:00.000Z"}'; //*/
		;

		$res = json_decode(json_encode($request->all()));
		// 			$file = fopen("/public_html/visa.a2logicgroup.com/dubaiking/public/storage/logs/log.txt", "w");
// 			fwrite($file, json_encode($request->all()));

		$customer_vpa = $res->customer_vpa;
		$client_txn_id = $res->client_txn_id;
		$customer_name = $res->customer_name;
		$customer_email = $res->customer_email;
		$customer_mobile = $res->customer_mobile;
		$p_info = $res->p_info;
		$upi_txn_id = $res->upi_txn_id;
		$amount = $res->amount;
		$status = $res->status;
		$txnAt = $res->txnAt;
		if ($status == "success") {

			$order_id = $client_txn_id;
			$payment = DepositHistory::where('transaction_id', $order_id)->first();
			if ($payment->tr_status != 'Success') {
				$user = User::where('user_id', $payment->user_id)->first();
				$totalAmt = $user->credit + $payment->tr_value;
				User::where('user_id', $payment->user_id)->update(['credit' => $totalAmt]);
				$payment = DepositHistory::where('transaction_id', $order_id)->update(['tr_status' => 'Success', 'tr_value_updated' => $totalAmt]);
				$workingpayment = Walletreport::where('transaction_id', $order_id)->update(['tr_status' => 'Success', 'tr_value_updated' => $totalAmt]);
			}
		}

	}
	public function redirect_payment()
	{

		return redirect('https://24x7good.com/');

	}
	public function manual_upload_Deposit(Request $request)
	{
		date_default_timezone_set("Asia/Calcutta");
		$rand = rand(111111, 99999) . rand(123, 999);
		$remark = substr($request->contact, -6);
		$amount = $request->amount;
		$userid = $request->userid;
		$name = $request->name;
		$contact = $request->contact;

		$walletdata = DepositHistory::where('order_id', $request->utr)->count();
		if ($walletdata > 0) {
			return redirect()->back()->with('error', 'This UTR Number already used');
		} else {
			DepositHistory::where('id', $request->id)->update(['order_id' => $request->utr]);
		}
		// DB::table('deposit_history')->where('transaction_id', $rand)->update(['order_id' => $request->utr]);

		// $data = [
		// 	'app_id' => 'com.dubaiking',
		// 	'admin_key' => 'ADMIN0001',
		// 	'user_id' => $request->userid,
		// 	'transaction_id' => $rand,
		// 	'order_id' => $request->utr,
		// 	'tr_nature' => 'TRDEPO002',
		// 	'tr_value' => $request->amount,
		// 	'value_update_by' => 'Deposit',
		// 	'transactionRef' => $remark,
		// 	'tr_value_type' => 'Credit',
		// 	'date' => date('d-m-Y'),
		// 	'date_time' => date('d-m-Y h:i:s'),
		// 	'created_at' => date('Y-m-d H:i:s'),
		// 	'tr_remark' => 'online',
		// 	'tr_status' => 'Pending',
		// ];
		// $response = DB::table('deposit_history')->insert($data);
		return redirect('https://24x7good.com/');
		// dd($request->all());
		// $walletdata = Walletreport::where('order_id', $request->utr)->first();
		// if ($walletdata) {
		// 	return redirect()->back()->with('error', 'This UTR Number already used');
		// }

		// $UserWallet = new UserWallet;
		// $UserWallet->user_id = $request->user_id;
		// $UserWallet->upi_id = $request->upi;
		// $UserWallet->order_id = $request->utr;
		// $UserWallet->app_id = "com.dubaiking";
		// $UserWallet->tr_value = $request->amount;
		// $UserWallet->type = "Credit";
		// $UserWallet->tr_status = "pending";
		// $UserWallet->save();

		// return redirect('user/dashboard')->with('status', 'Message sent!'); 

	}

	public function upload_reciept(Request $request)
	{

		$rand = rand(111111, 99999) . rand(123, 999);
		$remark = substr($request->contact, -6);
		$amount = $request->amount;
		$userid = $request->userid;
		$insert = new DepositHistory;
		$photo_name = "";
		if ($request->image) {
			$path_original = public_path() . '/backend/uploads/payment_reciept';
			$file = $request->image;
			$photo_name = time() . '-' . $file->getClientOriginalName();
			$file->move($path_original, $photo_name);
			$insert->image = $photo_name;
		}
		$userDetail = User::where('user_id', $request->userid)->first();
		/*$store = DepositHistory::create([
			'app_id' => 'com.dubaiking',
			'admin_key' => 'ADMIN0001',
			'user_id' => $userid,
			'username' => $userDetail->FullName,
			'mobile_number' => $userDetail->mob,
			'transaction_id' => $rand,
			'tr_nature' => 'TRDEPO002',
			'tr_value' => $amount,
			'value_update_by' => 'Deposit',
			'transactionRef' => $remark,
			'tr_value_type' => 'Credit',
			'date' => date('d-m-Y'),
			'date_time' => date('d-m-Y h:i:s'),
			'created_at' => now(),
			'tr_remark' => 'online',
			'tr_status' => 'Pending',
			'image' => $photo_name,
		]);*/

		DepositHistory::where('transaction_id', $request->transaction_id)->where('user_id', $userid)->update(['image' => $photo_name]);

		return redirect('https://24x7good.com/');

	}

	public function resultsss(Request $request)
	{
		ini_set('memory_limit', -1);

		$month = $request->input('month', now()->format('Y-m'));
		$startDate = Carbon::parse($month . '-01');
		$endDate = $startDate->copy()->endOfMonth();

		$dates = [];
		for ($date = $startDate->copy(); $date->lte($endDate); $date->addDay()) {
			$dates[] = $date->format('d-m-Y');
		}

		$markets = Market::select('market_id')->get();
		// print_r($markets);die;
		$results = [];

		foreach ($dates as $date) {
			$row = ['date' => $date];
			foreach ($markets as $market) {
				$res = Result::where('date', $date)->where('market_id', $market->market_id)->first();

				$row[$market->market_id] = $res ? $res->result : '';
			}
			$results[] = $row;
		}

		return view('front.page.satta_results', compact('results', 'markets', 'month'));
	}
}
