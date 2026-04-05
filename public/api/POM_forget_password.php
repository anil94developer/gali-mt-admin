<?php
include("POM_config.php");
session_start();

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



$app_id = $_POST['app_id'];
$mobileNumber = $_POST['mobile'];
$otprecive = $_POST['otp'];
$password = $_POST['password'];

// echo "<pre>";
// print_r($paytm_number . "<br>" . $google_pay . "<br>" . $phone_pay . "<br>" . $account_number . "<br>" . $bank_name . "<br>" . $ifsc_code . "<br>" . $account_holder_name . "<br>" . $userId);
// echo "</pre>";
// die;

$sqlq = mysqli_query($conn, "SELECT mob FROM us_reg_tbl WHERE mob ='" . $mobileNumber . "' AND app_id = '" . $app_id . "'");
$row = mysqli_fetch_assoc($sqlq);
$mobile = $row['mob'];
if ($mobile != $mobileNumber) {
    $rows['success'] = '0';
    $rows['message'] = "User Not Found Invalid Mobile Number";
    echo (json_encode($rows));
    $conn->close();
    exit;
}
if (empty($otprecive)) {
    $divice_reg = "DELETE FROM otpforgetpassword WHERE mobile=$mobileNumber";
    $conn->query($divice_reg);
    $otp = rand('0000', '9999');
    if (strlen($otp) == 3) {
        $otp = $otp . rand('0', '9');
    } elseif (strlen($otp) == 2) {
        $otp = $otp . rand('00', '99');
    }
    $sql = "INSERT INTO `otpforgetpassword`(`mobile`, `otp`)
	       VALUES ('$mobileNumber', '$otp') ";
    $res = mysqli_query($conn, $sql);

    $curl = curl_init();

    curl_setopt_array(
        $curl,
        array(
            // CURLOPT_URL => "https://www.fast2sms.com/dev/bulkV2?authorization=dOh4l8D1jUX03Bz6TQsuCa9m2gFwrvGVn5SHMWeiqkocyZxPfEH5PKWtcpRVBn9Qo1d4X8lGvx6kqU7g&variables_values=" . $otp . "&route=otp&numbers=" . urlencode($mobileNumber),
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

    $rows['success'] = '1';
    $rows['message'] = "Success";
    echo (json_encode($rows));
    $conn->close();
    exit;
} else {
    $pincodesend = mysqli_query($conn, "SELECT * FROM otpforgetpassword WHERE mobile = '" . $mobileNumber . "'");
    $pincodesenddata = mysqli_fetch_assoc($pincodesend);
    // echo $pincodesenddata['otp'];
    // die;

    if ($pincodesenddata['otp'] == $otprecive) {
        $divice_reg = "UPDATE us_reg_tbl SET us_pass='$password' WHERE mob='$mobileNumber'";
        $conn->query($divice_reg);
        $rows['success'] = '1';
        $rows['message'] = "Password Updated Succesfully";
        echo (json_encode($rows));
        $conn->close();
        exit;
    } else {
        $rows['success'] = '0';
        $rows['message'] = "Invalid Otp";
        echo (json_encode($rows));
        $conn->close();
        exit;
    }
}
echo (json_encode($rows));
$conn->close();
exit;
