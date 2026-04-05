<?php
$servername = "localhost";
$username = "kduser";
$password = "Krishan001@123";
$database = "kd_game";
$conn = new mysqli($servername, $username, $password, $database);
// die();

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$orderid = rand('00000','99999').rand('55555','88888').rand('333333','777777');
$user_id = $_GET['userid'];
$userid = $_GET['userid'];
$amount = $_GET['amount'];

$sql12 = "INSERT INTO `qr_pendings`(`user_id`,`amount`,`t_id`, `status`,`payment_status`)
	       VALUES ('$user_id','$amount','$orderid','0','pending')";
			mysqli_query($conn, $sql12);

      $timestamp = time();
      $date_time = date("d-m-Y (D) h:i:s A", $timestamp);
      $date = date('d-m-Y');
      $created_at = date("Y-m-d H:i:s", $timestamp);

      
      $sql = mysqli_query($conn, "SELECT * FROM us_reg_tbl WHERE user_id = '" . $userid . "'");
      
      while ($row = mysqli_fetch_assoc($sql)) {
        $c_name = $row['FullName'];
        $mob = $row['mob'];
        $newcoins = $row['credit'] + $amount;
      }      
      $insertData111 = "INSERT INTO `point_table`( `app_id`, `user_id`,`transaction_id`, `transactionRef`, `tr_nature`,  `tr_value`, `tr_value_updated`, `value_update_by`, `tr_value_type`, `tr_device`, `date`, `date_time`, `tr_remark`, `tr_status`, `is_deleted`, `device_type`, `device_id`, `admin_key`,`created_at`) VALUES ('com.dubaiking','$userid','$orderid','','TRDEPO002','$amount','$newcoins','Deposit','Credit','com.dubaiking','$date','$date_time','Online','pending','0',' ','','ADMIN0001','$created_at')";
      // echo $insertData111;
      // die();
       mysqli_query($conn, $insertData111);
// echo $c_name;
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://merchant.upigateway.com/api/create_order',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
  "key": "2aeb92c8-8821-4439-ac4c-3aeb8c7f085e",
  "client_txn_id": "'.$orderid.'",
  "amount": "'.$_GET['amount'].'",
  "p_info": "Product Name",
  "customer_name": "'.$c_name.'",
  "customer_email": "jondoe@gmail.com",
  "customer_mobile": "'.$mob.'",
  "redirect_url": "https://KGFmatka.com/API/public/payment/orderStatus.php",
  "udf1": "user defined field 1 (max 25 char)",
  "udf2": "user defined field 2 (max 25 char)",
  "udf3": "user defined field 3 (max 25 char)"
}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
$res = json_decode($response, true);
print_r($res);
if($res['status'] == 1){
    // print_r($res['data']['payment_url']);
    // header("Location:www.google.com");
    $url = $res['data']['payment_url'];
    // echo "<script> location.href=$url; </script>";
    header("Location: $url"); 
    exit();
}
?>
