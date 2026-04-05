<?php
$servername = "localhost";
$username = "kduser";
$password = "Krishan001@123";
$database = "kd_game";

$conn = new mysqli($servername, $username, $password, $database);

$date = date('d-m-Y');
 $txnid = $_GET['client_txn_id'];
 $curl = curl_init();

 curl_setopt_array($curl, array(
   CURLOPT_URL => 'https://merchant.upigateway.com/api/check_order_status',
   CURLOPT_RETURNTRANSFER => true,
   CURLOPT_ENCODING => '',
   CURLOPT_MAXREDIRS => 10,
   CURLOPT_TIMEOUT => 0,
   CURLOPT_FOLLOWLOCATION => true,
   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
   CURLOPT_CUSTOMREQUEST => 'POST',
   CURLOPT_POSTFIELDS =>'{
   "key": "2aeb92c8-8821-4439-ac4c-3aeb8c7f085e",
   "client_txn_id": "'.$txnid.'",
   "txn_date": "'.$date.'"
 }',
   CURLOPT_HTTPHEADER => array(
     'Content-Type: application/json'
   ),
 ));

 $response = curl_exec($curl);

 curl_close($curl);
 $res = json_decode($response,true);
 if($res['data']['status'] == "success")
 {
    //  echo $res['data']['status'];
    $date_time = date("d-m-Y h:i", $timestamp);
$created_at = date("Y-m-d H:i:s", $timestamp);

$qr_pendingss = mysqli_query($conn, "SELECT * FROM qr_pendings WHERE t_id = '" . $txnid . "'");
// $qr_pending = mysqli_fetch_assoc($qr_pendingss);
while ($rows = mysqli_fetch_assoc($qr_pendingss)) {
	$userid = $rows['user_id'];
  $orderamount = $rows['amount'];
}
$sql = mysqli_query($conn, "SELECT * FROM us_reg_tbl WHERE user_id = '" . $userid . "'");

while ($row = mysqli_fetch_assoc($sql)) {
	$newcoins = $row['credit'] + $orderamount;
	// dd($newcoins);
	$bonus = $row['bonus_diamonds'] + 10;
}
$updateBalance = "UPDATE us_reg_tbl SET credit = '$newcoins' Where user_id = '".$userid."'";     
mysqli_query($conn,$updateBalance);
$transactionRef = $txnid;
$order_id = $txnid;

$timestamp = time();
$date_time = date("d-m-Y (D) h:i:s A", $timestamp);
$created_at = date("Y-m-d H:i:s", $timestamp);

// $insertData1 = "INSERT INTO `point_table`( `app_id`, `user_id`,`transaction_id`, `transactionRef`, `tr_nature`,  `tr_value`, `tr_value_updated`, `value_update_by`, `tr_value_type`, `tr_device`, `date`, `date_time`, `tr_remark`, `tr_status`, `is_deleted`, `device_type`, `device_id`, `admin_key`,`created_at`) VALUES ('com.dubaiking','$userid','$order_id','$transactionRef','TRDEPO002','$orderamount','$newcoins','Deposit','Credit','com.dubaiking','$date','$date_time','Online','success','0',' ','','ADMIN0001','$created_at')";
// mysqli_query($conn, $insertData1);

$updateBalance = "UPDATE point_table SET tr_status = 'success' , transactionRef = '$transactionRef' Where transaction_id = '".$order_id."'";     
mysqli_query($conn,$updateBalance);

header("Location: https://KGFmatka.com/API/public/payment/success.php"); 
exit();
 }else{
  header("Location: https://KGFmatka.com/API/public/payment/fail.php"); 
exit();

 }
?>