<?php
include('POM_config.php');
session_start();
$userid = $_POST['userid'];
$amount = $_POST['amount'];
$trnsid = $_POST['trnsid'];
$device_id = $_POST['device_id'];

$get_user_credit = "SELECT * FROM `us_reg_tbl` WHERE user_id = '" . $userid . "' AND device_id = '" . $device_id . "'";
$get_user_credit_result = mysqli_query($conn, $get_user_credit);
$getData = mysqli_fetch_assoc($get_user_credit_result);
$updateAmt = $getData['credit'] + $amount;

$sqlr = "INSERT INTO `payment` (`pid`, `uid`, `orderid`, `trnsid`, `status`, `trnstype`, `amount`, `getway`) VALUES (NULL, '" . $userid . "','" . $orderid . "','" . $trnsid . "', 'Success','upi','" . $amount . "','upi')";
$result = mysqli_query($conn, $sqlr);

$sqlr1 = "INSERT INTO `point_table` (`id`, `app_id`, `admin_key`, `user_id`, `transaction_id`, `tr_nature`, `tr_value`, `tr_value_type`,`date`, `date_time`, `tr_status`, `device_id`) VALUES (NULL, 'com.dubaiking','ADMIN0001','" . $userid . "', '" . $trnsid . "','TRDEPO002','" . $amount . "','credit','" . date('d-m-Y') . "','" . date('d-m-Y H:i:s') . "','Success','$device_id')";
$result1 = mysqli_query($conn, $sqlr1);

$sql12 = "INSERT INTO `wallet_reports`(`app_id`,`user_id`,`tr_nature`, `tr_value`,`type`,`tr_value_updated`,`value_update_by`, `date`,`date_time`,  `tr_status`, `tr_remark`,`transaction_id`, `transfer_user_id`) VALUES ('com.dubaiking','$userid','TRDEPO002','$amount','Credit','$updateAmt','Transfer','" . date('d-m-Y') . "','" . date('d-m-Y H:i:s') . "','Success','remark','$trnsid','$userid') ";
$result22 = mysqli_query($conn, $sql12);


if ($result1) {
    $udatecredit = "UPDATE `us_reg_tbl` SET `credit`='" . $updateAmt . "' WHERE user_id = '" . $userid . "'";
    $udatecredit_result = mysqli_query($conn, $udatecredit);
    $rows['success'] = true;
    $rows['message'] = "success";
    echo (json_encode($rows));
    $conn->close();
} else {

}

?>