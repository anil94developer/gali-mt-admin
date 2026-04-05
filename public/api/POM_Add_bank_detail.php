<?php
include("POM_config.php");

// die('pppp');
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

$type          = $_POST['type'];
$paytm_number          = $_POST['paytm_number'];
$google_pay            = $_POST['google_pay'];
$phone_pay            = $_POST['phone_pay'];
$account_number       = $_POST['account_number'];
$bank_name         = $_POST['bank_name'];
$ifsc_code             = $_POST['ifsc_code'];
$account_holder_name             = $_POST['account_holder_name'];
$userId         = $_POST['userId'];

// echo "<pre>";
// print_r($paytm_number . "<br>" . $google_pay . "<br>" . $phone_pay . "<br>" . $account_number . "<br>" . $bank_name . "<br>" . $ifsc_code . "<br>" . $account_holder_name . "<br>" . $userId);
// echo "</pre>";
// die;
$chk_user = mysqli_query($conn, "SELECT * FROM bank_details WHERE userId ='" . $userId . "'");
$row_chk_user = mysqli_fetch_assoc($chk_user);
$count_chk_user = mysqli_num_rows($chk_user);
if ($count_chk_user > 0) {
    if ($type == 'Bank') {
        
        // $divice_reg = "INSERT INTO `bank_details`(`userId`,  `account_number`,`bank_name`,`ifsc_code`,`account_holder_name`) VALUES ('$userId', '$account_number','$bank_name','$ifsc_code','$account_holder_name')";
        $divice_reg = "UPDATE bank_details SET account_number='$account_number',bank_name='$bank_name',ifsc_code='$ifsc_code',account_holder_name='$account_holder_name' WHERE userId='$userId'";

        $conn->query($divice_reg);
    } elseif ($type == 'Gpay') {
        $divice_reg = "UPDATE bank_details SET google_pay='$google_pay' WHERE userId='$userId'";
        $conn->query($divice_reg);
    } elseif ($type == 'Paytm') {
        // $divice_reg = "INSERT INTO bank_details(userId, paytm_number) VALUES ('$userId', '$paytm_number')";
        $divice_reg = "UPDATE bank_details SET paytm_number='$paytm_number' WHERE userId='$userId'";
        $conn->query($divice_reg);
    } elseif ($type == 'phonePe') {
        // $divice_reg = "INSERT INTO `bank_details`(`userId`, `phone_pay`) VALUES ('$userId','$phone_pay')";
        $divice_reg = "UPDATE bank_details SET phone_pay='$phone_pay' WHERE userId='$userId'";

        $conn->query($divice_reg);
    }
} else {

    if ($type == 'Bank') {
        $divice_reg = "INSERT INTO `bank_details`(`userId`,  `account_number`,`bank_name`,`ifsc_code`,`account_holder_name`) VALUES ('$userId', '$account_number','$bank_name','$ifsc_code','$account_holder_name')";
        $conn->query($divice_reg);
    } elseif ($type == 'Gpay') {
        $divice_reg = "INSERT INTO `bank_details`(`userId`, `google_pay`) VALUES ('$userId','$google_pay')";
        $conn->query($divice_reg);
    } elseif ($type == 'Paytm') {
        $divice_reg = "INSERT INTO bank_details(userId, paytm_number) VALUES ('$userId', '$paytm_number')";
        $conn->query($divice_reg);
    } elseif ($type == 'phonePe') {
        $divice_reg = "INSERT INTO `bank_details`(`userId`, `phone_pay`) VALUES ('$userId','$phone_pay')";
        $conn->query($divice_reg);
    }
}



$rows['success'] = "1";
$rows['message'] = "Bank Details added sucessfully";

echo (json_encode($rows));
exit;
