<?php
include("POM_config.php");
$appId = $_REQUEST['app_id'];
$mobileNum = $_REQUEST['mobileNum'];
$type = $_REQUEST['type'];  /////1 =register 2 forgot
// echo $mobileNum;
// die();
function send_msg($mobile_number, $message)
{

	$curl = curl_init();
	curl_setopt_array($curl, array(
		CURLOPT_URL => "https://www.fast2sms.com/dev/bulkV2?authorization=48TQalPZI7VuDLEvf1zmUwCMB6RrjGtWyAHk35hecJOFo2dXx0WgyHQusCwfvPZERkpKnxiSbY3L2thA&variables_values=" . $message . "&route=otp&numbers=" . urlencode($mobile_number),
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
	)
	);

	$response = curl_exec($curl);
	$err = curl_error($curl);
	curl_close($curl);
}

$otp = mt_rand(100000, 999999);
$message = $otp;
//$otp='123456';
//$message = "Your Ludofame One Time Password(OTP) is- ".$otp." Don't share Your OTP to anyone.";
//$message = "Your Ludofame One Time Password(OTP) is- ".$otp." .";
//$message = rawurlencode($message); 

$sql = mysqli_query($conn, "SELECT * FROM us_reg_tbl WHERE mob='" . $mobileNum . "' AND app_id = '" . $appId . "'");
$count = mysqli_num_rows($sql);

if ($count > 0) {

	if ($type == '1') {
		$rows['success'] = "0";
		$rows['message'] = "Mobile Number already exists, please try with another";
		echo (json_encode($rows));
		$conn->close();
		exit;

	} else if ($type == '2') {
		/*$admin_url="http://bulksms.anksms.com/api/mt/SendSMS?user=FOODGAZE&password=123456&senderid=AALERT&channel=TRANS&DCS=0&flashsms=0&number=91$mobile&text=$message&route=04";*/
		$url = 'https://www.fast2sms.com/dev/bulkV2?authorization=3C60NRFraEJ8g2BvHAt5O4SwPzK7UqWQIsnxXi9Lmob1VcGYZye1BYFioxPptK6h0OXaw3Hj5GWsDnvq&variables_values=' . $message . '&route=otp&numbers=' . urlencode($mobileNum) . '';

		$resultss = file($url);
		//print_r($resultss);
		//die;

		//send_msg($mobileNum , $otp);

		$rows['success'] = "1";
		$rows['message'] = "Success";
		$rows['otp'] = $otp;
	}
} else {
	//$admin_url="http://india.jaipurbulksms.com/api/mt/SendSMS?user=kunalm&password=zapak123&senderid=SUPERS&channel=trans&DCS=0&flashsms=0&number=91$mobile&text=$message&route=3";
//$admin_url="http://bulksms.anksms.com/api/mt/SendSMS?user=FOODGAZE&password=123456&senderid=AALERT&channel=TRANS&DCS=0&flashsms=0&number=91$mobile&text=$message&route=04";
	$url = 'https://www.fast2sms.com/dev/bulkV2?authorization=3C60NRFraEJ8g2BvHAt5O4SwPzK7UqWQIsnxXi9Lmob1VcGYZye1BYFioxPptK6h0OXaw3Hj5GWsDnvq&variables_values=' . $message . '&route=otp&numbers=' . urlencode($mobileNum) . '';
	$resultss = file($url);
	//print_r($resultss);
//die;
//send_msg($mobileNum ,$otp);

	$rows['success'] = "1";
	$rows['message'] = "Success";
	$rows['otp'] = $otp;
}
echo (json_encode($rows));
$conn->close();
exit;