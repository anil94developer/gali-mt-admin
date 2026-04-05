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
$userId = $_POST['user_id'];
$dev_id = $_POST['dev_id'];

if ($userId == '' && $appId == '' && $dev_id == '') {
	$rows['success'] = "0";
	$rows['message'] = "Plese Fill Out The required Fields";
	echo (json_encode($rows));
	exit;
}


$sql = mysqli_query($conn, "SELECT * FROM us_reg_tbl WHERE user_id='" . $userId . "' AND app_id = '" . $appId . "'");
$count = mysqli_num_rows($sql);
$row_chk_user = mysqli_fetch_assoc($sql);


if ($count > 0) {
	$otp = rand('1111', '9999');
	$mobileNum = $row_chk_user['mob'];

	//$otp = 1234;
	$curl = curl_init();

	curl_setopt_array(
		$curl,
		array(
			// CURLOPT_URL => "https://www.fast2sms.com/dev/bulkV2?authorization=dOh4l8D1jUX03Bz6TQsuCa9m2gFwrvGVn5SHMWeiqkocyZxPfEH5PKWtcpRVBn9Qo1d4X8lGvx6kqU7g&variables_values=" . $otp . "&route=otp&numbers=" . urlencode($mobileNum),
			CURLOPT_URL => "http://msg.easy2approach.com/api/smsapi?key=e81f57f880277bc7efbba3a6a875fa0e&route=1&sender=USERSV&number=".urlencode($mobileNum)."&sms=Your%20one%20time%20verification%20code%20is%20" . $otp . ".%20Verification%20code%20is%20valid%20for%2030%20min.,%20We%20have%20never%20ask%20for%20verification%20code%20or%20pin.%20&templateid=1207161838546260705",
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
	

} //my code close
else {
	

	$rows['success'] = "0";
	$rows['message'] = "User Not Found";
	echo (json_encode($rows));
	$conn->close();
	exit;
}
echo (json_encode($rows));
$conn->close();
exit;