<?php
include("POM_config.php");
error_reporting(2);
// echo "dddddd"; die;
$appId = $_POST['app_id'];
$user_id = $_POST['user_id'];
$dev_id = $_POST['dev_id'];
$amount = $_POST['amount'];

// echo $appId, $user_id, $dev_id; die;
/// Show Market only result has deculered ///

date_default_timezone_set('Asia/Kolkata');
$timestamp = time();
$date_time = date("d-m-Y (D) h:i:s A", $timestamp);


$nowdate_time = date("y-m-d H:i:s", $timestamp);

//echo "Current date and local time on this server is $date_time";
$date = date("Y-m-d", $timestamp);
$current_date = date("d-m-Y", $timestamp);


$current_time = date("h:i A", $timestamp);


$current_time_second = date("h:i:s", $timestamp);
$current_time_second_24hours = date("H:i:s", $timestamp);
$current_time_second_24hours1 = date("H:i", $timestamp);
$timeampm = date("A", $timestamp);
$currentHour = date("H", $timestamp);


$currentTime = time() + 3600;

if ($user_id == '' && $appId == '' && $dev_id == '') {
     $rows['success'] = "0";
     $rows['message'] = "Error Plaese Fill All Details";
     echo (json_encode($rows));
     exit;
} else {
     //device_id ='".$dev_id."' AND
     $sqluser = mysqli_query($conn, "SELECT * FROM us_reg_tbl WHERE  user_id='" . $user_id . "' AND app_id = '" . $appId . "'");
     $count = mysqli_num_rows($sqluser);

     if ($count > 0) {
          $allPaymentGetway = mysqli_query($conn, "SELECT id,slug,name,status FROM paymentgetway WHERE status = '1'");
          $countPaymentGetway = mysqli_num_rows($allPaymentGetway);

          if ($countPaymentGetway > 0) {
               $rows['status'] = "1";
               $rows['message'] = "Successfully Payment Getway Fetched";

               $i = 0;
               while ($paymentgetway = mysqli_fetch_assoc($allPaymentGetway)) {
                    if ($paymentgetway['status'] == 2) {
                         header("Location:https://dubaiking.com/API/public/payment/index.php?amount=${amount}&userid=${userId}");
                    }
                    $i++;
               }
               echo (json_encode($rows));
               $conn->close();
               exit;

          } else {
               $rows['status'] = "0";
               $rows['message'] = "No Market Availavle For Play";
          }
     } else {
          $rows['status'] = "0";
          $rows['message'] = "User Not Available Or Blocked";
     }
}
echo (json_encode($rows));
$conn->close();
exit;