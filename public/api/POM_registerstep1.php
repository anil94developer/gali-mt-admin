<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");
include("POM_config.php");
date_default_timezone_set('Asia/Kolkata');
$timestamp = time();
$date_time = date("d-m-Y (D) h:i:s A", $timestamp);
//echo "Current date and local time on this server is $date_time";
$date = date("d-m-Y", $timestamp);
$current_date = date("d-m-Y", $timestamp);
$current_time = date("h:i", $timestamp);
$current_time_second = date("h:i:s", $timestamp);
$current_time_second_24hours = date("H:i:s", $timestamp);
$timeampm = date("A", $timestamp);
$currentTime = time() + 3600;
$appId = $_POST['app_id'];
$pss = $_POST['pss'];
// $fullName = $_POST['name'];
$fullName = trim($_POST['name']);
$refercode = $_POST['refercode'];
$lat = $_POST['lat'];
$lng = $_POST['lng'];
//$address 		= $_POST['address'];
$devModel = $_POST['dev_model'];
$devName = $_POST['dev_name'];
$devId = $_POST['dev_id'];
//$dob 			= $_POST['dob'];
$gender = 'Male';
// $mobileNum = $_POST['mobileNum'];
$mobileNum = str_replace('+91', '', $_POST['mobileNum']);
if($mobileNum == '' && $mobileNum == null)
{
	$rows['success'] = "0";
	$rows['message'] = "please Enter mobile number";
	echo (json_encode($rows));
	exit;
}
if (!ctype_digit($mobileNum))
{
    $rows['success'] = "0";
    $rows['message'] = "Mobile number should contain only numeric values.";
    echo json_encode($rows);
    exit;
}

if (strlen($mobileNum) !== 10) {
    // Mobile number is valid
    // echo "Valid mobile number: " . $mobileNum;
	$rows['success'] = "0";
    $rows['message'] = "Mobile number should contain only 10 digits.";
    echo json_encode($rows);
    exit;
}
// echo "<pre>";
// print_r($mobileNum . $pss . $devId . $appId);
// echo "</pre>";
// die;
$senderRefAmt = 100;
$recRefAmt = 100;
$length = 10;
// $tr_id = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 1, $length);
// $tr_id = rand(00000,99999);
$tr_id = substr($mobileNum, -5);


if ($mobileNum == '' && $app_id == '' && $pss == '' && $dev_id == '') {
	$rows['success'] = "0";
	$rows['message'] = "Plese Fill Out The required Fields";
	echo (json_encode($rows));
	exit;
}
//my code
// echo $refercode;
// die;
if ($refercode != 'null') {
	if (strlen($refercode) > 0) {
		// echo "SELECT * FROM us_reg_tbl WHERE ref_code = '" . $refercode . "' AND app_id = '" . $appId . "'";
		$sql3 = mysqli_query($conn, "SELECT * FROM us_reg_tbl WHERE ref_code = '" . $refercode . "' AND app_id = '" . $appId . "'");
		$count3 = mysqli_num_rows($sql3);
		$anotherBalData = mysqli_fetch_assoc($sql3);
		if ($count3 < 1) {
			$rows['success'] = "0";
			$rows['message'] = "Invalid Reffer Code";
			echo (json_encode($rows));
			$conn->close();
			exit;
		}
	}
}

$sql = mysqli_query($conn, "SELECT * FROM us_reg_tbl WHERE mob='" . $mobileNum . "' AND app_id = '" . $appId . "'");
$count = mysqli_num_rows($sql);

if ($count > 0) {

	$rows['success'] = "0";
	$rows['message'] = "Mobile Number already exists, please try with another mobile number";
	echo (json_encode($rows));
	$conn->close();
	exit;

} //my code close
else {
	$otp = rand('1111', '9999');
	$number = "+91".$mobileNum;
	$curl = curl_init();

	curl_setopt_array($curl, array(
	CURLOPT_URL => 'https://a2technosoft.services/api/v1/sms-secure-push',
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_ENCODING => '',
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 0,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => 'POST',
	CURLOPT_POSTFIELDS => array('key' => 'IcVavPGPvzWnONAss8O6CmDO5i6ZplyvNEQgZKUFtgIjcymJHKMk','mobile' => $number,'otp' => '5656'),
	));

	$response = curl_exec($curl);
	curl_close($curl);

	$res = json_decode($response);
	// dd($res);
	if($res->requestId == 0){
	$rows['success'] = "0";
	$rows['message'] = "Please Try Again";
	// $rows['ddtd'] = $number;
	// $rows['rttt'] = $res;
	echo (json_encode($rows));
	$conn->close();
	exit;
	}
	$otp = $res->requestId;

	
	// $requestid 

	// echo $response;
	//$otp = 1234;
	// $curl = curl_init();

	// curl_setopt_array(
	// 	$curl,
	// 	array(
	// 		// CURLOPT_URL => "https://www.fast2sms.com/dev/bulkV2?authorization=dOh4l8D1jUX03Bz6TQsuCa9m2gFwrvGVn5SHMWeiqkocyZxPfEH5PKWtcpRVBn9Qo1d4X8lGvx6kqU7g&variables_values=" . $otp . "&route=otp&numbers=" . urlencode($mobileNum),
	// 		CURLOPT_URL => "http://msg.easy2approach.com/api/smsapi?key=e81f57f880277bc7efbba3a6a875fa0e&route=1&sender=USERSV&number=".urlencode($mobileNum)."&sms=Your%20one%20time%20verification%20code%20is%20" . $otp . ".%20Verification%20code%20is%20valid%20for%2030%20min.,%20We%20have%20never%20ask%20for%20verification%20code%20or%20pin.%20&templateid=1207161838546260705",
	// 		CURLOPT_RETURNTRANSFER => true,
	// 		CURLOPT_ENCODING => "",
	// 		CURLOPT_MAXREDIRS => 10,
	// 		CURLOPT_TIMEOUT => 30,
	// 		CURLOPT_SSL_VERIFYHOST => 0,
	// 		CURLOPT_SSL_VERIFYPEER => 0,
	// 		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	// 		CURLOPT_CUSTOMREQUEST => "GET",
	// 		CURLOPT_HTTPHEADER => array(
	// 			"cache-control: no-cache"
	// 		),
	// 	)
	// );


	// $response = curl_exec($curl);
	// $err = curl_error($curl);

	// curl_close($curl);
	// $curl = curl_init();

	// curl_setopt_array($curl, array(
	//   CURLOPT_URL => 'https://dummyjson.com/products/1',
	//   CURLOPT_RETURNTRANSFER => true,
	//   CURLOPT_ENCODING => '',
	//   CURLOPT_MAXREDIRS => 10,
	//   CURLOPT_TIMEOUT => 0,
	//   CURLOPT_FOLLOWLOCATION => true,
	//   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	//   CURLOPT_CUSTOMREQUEST => 'GET',
	// ));

	// $response = curl_exec($curl);

	// curl_close($curl);
	// echo $response;


	$sql = mysqli_query($conn, "SELECT * FROM us_temp WHERE mobile='" . $mobileNum . "'");
	$count = mysqli_num_rows($sql);


	if ($count > 0) {
		//echo $otp;
		$sql = "UPDATE us_temp SET otp='" . $otp . "' WHERE mobile='" . $mobileNum . "'";
		mysqli_query($conn, $sql);
		$rows['success'] = "1";
		$rows['message'] = "OTP Send Success";
		echo (json_encode($rows));
		$conn->close();
		exit;
	} else {
		$sql = "INSERT INTO `us_temp`(`mobile`, `otp`) VALUES ('$mobileNum', '$otp')";
		$dd = mysqli_query($conn, $sql);
		$rows['success'] = "1";
		$rows['message'] = "OTP Send Success";
		echo (json_encode($rows));
		$conn->close();
		exit;
	}
}
echo (json_encode($rows));
$conn->close();
exit;