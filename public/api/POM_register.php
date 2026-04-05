<?php
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
$otp = $_POST['otp'];

if($otp == '' && $otp == null)
{
	$rows['success'] = "0";
	$rows['message'] = "please Enter valid OTP !";
	echo (json_encode($rows));
	exit;
}
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
// echo $refercode; die;
// echo "<pre>";
// print_r($mobileNum . $pss . $devId . $appId);
// echo "</pre>";
// die;

$senderRefAmt = 100;
$recRefAmt = 100;
$length = 10;

// $tr_id = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 1, $length);
// $tr_id = rand(00000,99999);
$tr_name = substr($fullName, 0, 2);
$cap = strtoupper($tr_name);
$tr_id = substr($mobileNum, -5);
$user_tr_id = $cap.$tr_id.rand(2222,8888).rand(11,99);

$sql = mysqli_query($conn, "SELECT * FROM us_temp WHERE mobile='" . $mobileNum . "'");
$otpdata = mysqli_fetch_assoc($sql);

	function random_strings($length_of_string)
	{

		// String of all alphanumeric character
		$str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';

		// Shuffle the $str_result and returns substring
		// of specified length
		return substr(str_shuffle($str_result), 
						0, $length_of_string);
	}

if ($mobileNum == '' && $app_id == '' && $pss == '' && $dev_id == '') {
	$rows['success'] = "0";
	$rows['message'] = "Error";
	echo (json_encode($rows));
	exit;
} else {
	$curl = curl_init();

		curl_setopt_array($curl, array(
		CURLOPT_URL => 'https://a2technosoft.services/api/v1/sms-check-otp',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'POST',
		CURLOPT_POSTFIELDS => array('key' => 'IcVavPGPvzWnONAss8O6CmDO5i6ZplyvNEQgZKUFtgIjcymJHKMk','otp' => $otp,'requestId' => $otpdata['otp']),
		));

		$response = curl_exec($curl);

		curl_close($curl);

		$res = json_decode($response);


	// if ($otpdata['otp'] == $otp) {
	if ($res->message != "Invalid otp") {
		$sql = mysqli_query($conn, "SELECT * FROM us_reg_tbl WHERE mob='" . $mobileNum . "' AND app_id = '" . $appId . "'");
		$count = mysqli_num_rows($sql);
		if ($count > 0) {
			$rows['success'] = "0";
			$rows['message'] = "Mobile Number already exists, please try with another mobile number";
			echo (json_encode($rows));
			$conn->close();
			exit;
		} else {
			$auth = md5(uniqid(rand(100000, 999999), true));
			$size = 6;
			$code = strtoupper(substr(md5(time() . rand(10000, 99999)), 0, $size));
			///$refercode =  preg_replace(array('/^\[/','/\]$/'), '',$refercode);  
			$sql98 = mysqli_query($conn, "SELECT * FROM us_reg_tbl ORDER BY id DESC");
			$count98 = mysqli_num_rows($sql98);
			$lastOrder = mysqli_fetch_assoc($sql98);
			if ($count > 0) {
				$number = 0;
				$referral = sprintf('%05d', intval($number));
			} else {
				$number = $lastOrder['id'];
				$referral = sprintf('%05d', intval($number));
			}

			if ($refercode !== null && $refercode !== "null") {
				$sql3 = mysqli_query($conn, "SELECT * FROM us_reg_tbl WHERE ref_code = '" . $refercode . "' AND app_id = '" . $appId . "'");
				$count3 = mysqli_num_rows($sql3);
				if ($count3 == 0) {
					$rows['success'] = "0";
					$rows['message'] = "Given Reffral Code Is Not Valid ! Please Try Again";
					echo (json_encode($rows));
					$conn->close();
					exit;
				} else {
					
					$token = random_strings(40);
					$sql = "INSERT INTO `us_reg_tbl`(`mob`, `us_pass`,`app_id`,`FullName`,`ref_code`, `ref_by`, `lat`, `lng`, `dev_model`,`dev_name`, `device_id`, `dob`,`us_gender`,`credit`,`bonus_diamonds`, `user_id`,`login_token`) VALUES ('$mobileNum', '$pss','$appId','$fullName','$referral', '$refercode', '$lat', '$lng', '$address', '$devModel', '$devName', '$devId','$gender','00','0','$user_tr_id','$token')";
					$dd = mysqli_query($conn, $sql);
					$getDat = mysqli_query($conn, "SELECT* FROM us_reg_tbl  WHERE mob='" . $mobileNum . "'AND app_id = '" . $appId . "'");
					$userData = mysqli_fetch_assoc($getDat);
					$divice_reg = "INSERT INTO `device_block`(`device_id`, `user_id`, `app_id`) VALUES ('$devId','" . $userData['user_id'] . "', '$appId')";
					$insww = mysqli_query($conn, $divice_reg);
					$rows['success'] = "1";
					$rows['message'] = "User Registration Success";
					$rows['user_id'] = $userData['user_id'];
					$rows['device_id'] = $userData['device_id'];
					$rows['login_token'] = $userData['login_token'];
					$rows['isReffrelGive'] = '1';
					$rows['isReffrelGivenMessage'] = 'Congratulation You get ' . $recRefAmt . ' Rs Credit for play game';
					$rows['refercode'] = $refercode;
					echo (json_encode($rows));
					$conn->close();
					exit;
				}
			} else {
				$sql1 = mysqli_query($conn, "SELECT * FROM device_block WHERE device_id = '" . $refercode . "' AND app_id = '" . $appId . "'");
				$count1 = mysqli_num_rows($sql1);
				if ($count1) {
					$rows['success'] = "0";
					$rows['message'] = "Device is Blocked ! Please Try Again";
					echo (json_encode($rows));
					$conn->close();
					exit;
				}
				$token = random_strings(40);
				$sql = "INSERT INTO `us_reg_tbl`(`mob`, `us_pass`,`app_id`,`FullName`,`ref_code`, `ref_by`, `lat`, `lng`, `dev_model`,`dev_name`, `device_id`, `dob`,`us_gender`,`credit`,`bonus_diamonds`, `user_id`,`login_token`) VALUES ('$mobileNum', '$pss','$appId','$fullName','$referral', '$refercode', '$lat', '$lng', '$address', '$devModel', '$devName', '$devId','$gender','00','0','$user_tr_id','$token')";
				$dd = mysqli_query($conn, $sql);
				$getDat = mysqli_query($conn, "SELECT* FROM us_reg_tbl  WHERE mob='" . $mobileNum . "'AND app_id = '" . $appId . "'");
				$userData = mysqli_fetch_assoc($getDat);
				$divice_reg = "INSERT INTO `device_block`(`device_id`, `user_id`, `app_id`) VALUES ('$devId','" . $userData['user_id'] . "', '$appId')";
				$insww = mysqli_query($conn, $divice_reg);
				$rows['success'] = "1";
				$rows['message'] = "User Registration Success";
				$rows['user_id'] = $userData['user_id'];
				$rows['device_id'] = $userData['device_id'];
				$rows['isReffrelGive'] = '1';
				$rows['isReffrelGivenMessage'] = 'Congratulation You get ' . $recRefAmt . ' Rs Credit for play game';
				$rows['refercode'] = $refercode;
				$rows['login_token'] = $userData['login_token'];
				echo (json_encode($rows));
				$conn->close();
				exit;
			}

			// $anotherBalData = mysqli_fetch_assoc($sql3);
			// if ($count3 > 0) {
			// 	echo"op";
			// } else {
			// 	echo"pppppppp";
			// 	// $rows['success'] = "0";
			// 	// $rows['message'] = "Given Reffral Code Is Not Valid ! Please Try Again";
			// 	// echo (json_encode($rows));
			// 	// exit;
			// }
			// die;
			// print_r($count3);
			// die;

		}
	} else {
		$rows['success'] = "0";
		$rows['message'] = "OTP Is Not Valid";
		echo (json_encode($rows));
		$conn->close();
		exit;
	}
}
echo (json_encode($rows));
$conn->close();
exit;
