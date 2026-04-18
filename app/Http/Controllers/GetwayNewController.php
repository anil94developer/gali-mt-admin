<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use URL;
use Illuminate\Support\Facades\DB;
use Session;
use Validator;
use Response;
use Illuminate\Support\Facades\Redirect;
use User;
use App\Models\PointTable;
use App\Models\ScannerPayment;
use App\Models\PaymentInstruction;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class GetwayNewController extends Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	public function payment_getway2(Request $request)
	{
		date_default_timezone_set("Asia/Calcutta");
		$requestedGateway = $request->get('getaway') ?? $request->get('gateway') ?? $request->get('slug');
		$requestedGateway = is_string($requestedGateway) ? trim($requestedGateway) : null;

		// Allow dynamic UPI ID from URL query (used for QR/UPI generation for "menual" flow).
		$requestedUpiId = $request->get('upi_id')
			?? $request->get('upiId')
			?? $request->get('upi')
			?? $request->get('upiid');
		$requestedUpiId = is_string($requestedUpiId) ? trim($requestedUpiId) : null;
		if ($requestedUpiId && !preg_match('/^[a-zA-Z0-9._-]{2,256}@[a-zA-Z]{2,64}$/', $requestedUpiId)) {
			$requestedUpiId = null;
		}

		if ($requestedGateway) {
			if ($requestedGateway === 'scanner') {
				$requestedGateway = 'payment-by-scanner';
			}

			// Prefer exact slug match first (prevents "utr" names mapping into "online" accidentally).
			$res = DB::table('payment_getways')
				->where('status', 1)
				->where('slug', $requestedGateway)
				->first();
			if (!$res) {
				$res = DB::table('payment_getways')
					->where('status', 1)
					->where('name', $requestedGateway)
					->first();
			}
		} else {
			$res = DB::table('payment_getways')->where('status', 1)->first();
		}

		if (!$res) {
			$res = DB::table('payment_getways')->where('status', 1)->first();
		}
		$upi = DB::table('app_controller')->select('upiId', 'help_line_number')->first();
		$paymentInstruction = PaymentInstruction::where('status', 1)->first();
		$chkuser = DB::table('us_reg_tbl')->where('user_id', $request->userid)->count();
		if ($chkuser > 0) {
			if (@$res->slug == "menual") {
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
					'transaction_id' => $rand,
					'tr_nature' => 'TRDEPO002',
					'tr_value' => $request->amount,
					'value_update_by' => 'Deposit',
					'transactionRef' => $remark,
					'tr_value_type' => 'Credit',
					'date' => date('d-m-Y'),
					'date_time' => date('d-m-Y h:i:s'),
					'created_at' => date('Y-m-d H:i:s'),
					'tr_remark' => 'online',
					'tr_status' => 'Pending',
				];
				DB::table('deposit_history')->insert($data);

				if ($requestedUpiId && $upi) {
					$upi->upiId = $requestedUpiId;
				}

				$intentData = "upi://pay?pa=" . $upi->upiId . "&pn=dubaiking&tn=" . $remark . "&am=" . $amount . "&cu=INR";
				$qrcode = QrCode::size(250)
					->margin(1)->generate(
						$intentData
					);
				return view('front.page.manual_gateway', compact('rand', 'upi', 'remark', 'qrcode', 'paymentInstruction'));
			} elseif (@$res->slug == "online" || @$res->slug == "imb") {
				// dd($request->all());
				if (!isset($_GET['name']) || !isset($_GET['userid']) || !isset($_GET['amount']) || !isset($_GET['contact'])) {
					return json_encode(['status' => false, 'message' => 'please Pass All Parameter!']);
				}
				$orderid = rand('000000', '999999') . rand('444444', '777777') . rand('333', '888');
				$key = "ecfe18b8-2742-43d3-a6ee-43f5d8a84b08";    // you can get your key from https://merchant.upigateway.com/user/api_credentials
				$data = [
					'app_id' => 'com.dubaiking',
					'admin_key' => 'ADMIN0001',
					'user_id' => $request->userid,
					'transaction_id' => $orderid,
					'tr_nature' => 'TRDEPO002',
					'tr_value' => $request->amount,
					'value_update_by' => 'Deposit',
					'tr_value_type' => 'Credit',
					'date' => date('d-m-Y'),
					'date_time' => date('d-m-Y h:i:s'),
					'created_at' => date('Y-m-d H:i:s'),
					'tr_remark' => 'online',
					'tr_status' => 'Pending',
				];
				$data = DB::table('deposit_history')->insert($data);
				// $all_user = DB::table('wallet_reports')->where('user_id', $request->userid)->first();
				// $total = $all_user->credit + $request->amount;
				$walletdata = [
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
					'created_at' => date('Y-m-d H:i:s'),
					'value_update_by' => "Deposit",
					// 'tr_value_updated' => $total,
				];
				$walletdata = DB::table('wallet_reports')->insert($walletdata);
				// dd($user);
				$content = json_encode(
					array(
						"key" => $key,
						"client_txn_id" => $orderid, // order id or your own transaction id
						"amount" => $request->amount,
						"p_info" => "domi",
						"customer_name" => $request->userid, // customer name
						"customer_email" => "dubaiking@gmail.com", // customer email
						"customer_mobile" => $request->contact, // customer mobile number
						"redirect_url" => "https://24x7good.com/public/redirect-payment", // redirect url after payment, with ?client_txn_id=&txn_id=
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
						'User-Agent: PHP',
						'Content-Length: ' . strlen($content),
					];
					$context = stream_context_create([
						'http' => [
							'method' => 'POST',
							'header' => implode("\r\n", $headers),
							'content' => $content,
							'timeout' => 60,
							'ignore_errors' => true,
						],
						'ssl' => [
							'verify_peer' => false,
							'verify_peer_name' => false,
							'allow_self_signed' => true,
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
					if ($json_response === false) {
						$e = error_get_last();
						die("Error: call to URL $url failed. file_get_contents error: " . ($e['message'] ?? 'unknown'));
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
				DB::table('deposit_history')->insert($data);
				$qr_code = ScannerPayment::where('status', '1')->first();
				return view('front.page.payment_by_scanner', compact('qr_code', 'upi'));
			} else {
				$rand = rand(111111, 99999) . rand(123, 999);
				$remark = substr($request->contact, -6);
				$amount = $request->amount;
				$userid = $request->userid;
				$name = $request->name;
				$contact = $request->contact;
				$data = new PointTable();

				$data->app_id = 'com.dubaiking';
				$data->admin_key = 'ADMIN0001';
				$data->user_id = $request->userid;
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
				$general_settings = DB::table('app_controller')->first();
				return view('front.page.EkpayGateway', compact('general_settings', 'amount', 'userid', 'contact', 'id'));
			}
		}

		// Public QR for scanner must work even without authentication/user record.
		if (@$res->slug == "payment-by-scanner") {
			$qr_code = ScannerPayment::where('status', '1')->first();
			return view('front.page.payment_by_scanner', compact('qr_code', 'upi'));
		}

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
			$payment = DB::table('deposit_history')->where('transaction_id', $order_id)->first();
			if ($payment->tr_status != 'Success') {
				$user = DB::table('us_reg_tbl')->where('user_id', $payment->user_id)->first();
				$totalAmt = $user->credit + $payment->tr_value;
				DB::table('us_reg_tbl')->where('user_id', $payment->user_id)->update(['credit' => $totalAmt]);
				$payment = DB::table('deposit_history')->where('transaction_id', $order_id)->update(['tr_status' => 'Success', 'tr_value_updated' => $totalAmt]);
				$workingpayment = DB::table('wallet_reports')->where('transaction_id', $order_id)->update(['tr_status' => 'Success', 'tr_value_updated' => $totalAmt]);
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

		$walletdata = PointTable::where('order_id', $request->utr)->count();
		if ($walletdata > 0) {
			return redirect()->back()->with('error', 'This UTR Number already used');
		} else {
			DB::table('deposit_history')->where('id', $request->id)->update(['order_id' => $request->utr]);
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
}
