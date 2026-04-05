<?php
include("POM_config.php");
error_reporting(2);
// echo "dddddd"; die;
$appId = $_POST['app_id'];
$user_id = $_POST['user_id'];
$dev_id = $_POST['dev_id'];

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

          $allPaymentGetway = mysqli_query($conn, "SELECT id,slug,name,status FROM payment_getways WHERE status = '1'");
          $countPaymentGetway = mysqli_num_rows($allPaymentGetway);
          $upiId = mysqli_query($conn, "SELECT upiId FROM app_controller WHERE id = '1'");
          $upiId_res = mysqli_fetch_assoc($upiId);

          // echo $countPaymentGetway;die;

          if ($countPaymentGetway > 0) {

               $rows['status'] = "1";
               $rows['message'] = "Successfully Payment Getway Fetched";

               $i = 0;
               while ($paymentgetway = mysqli_fetch_assoc($allPaymentGetway)) {

                    $rows['data'][$i]['id'] = $paymentgetway['id'];
                    $rows['data'][$i]['name'] = $paymentgetway['name'];
                    // $rows['data'][$i]['slug'] = $paymentgetway['slug'];
                    $rows['data'][$i]['status'] = $paymentgetway['status'];
                    $rows['data'][$i]['upi_id'] = $upiId_res['upiId'];                    
                    $i++;
               }
               echo (json_encode($rows));
               $conn->close();
               exit;
          } else {
               $rows['status'] = "0";
               $rows['message'] = "No Payment Getway Availavle Now";
          }
     } else {
          $rows['status'] = "0";
          $rows['message'] = "User Not Available Or Blocked";
     }
}
echo (json_encode($rows));
$conn->close();
exit;