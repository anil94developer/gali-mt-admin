<?php
require('config.php');
session_start();
	error_reporting(0);
    date_default_timezone_set('Asia/Kolkata');
	$timestamp = time();
	$date_time = date("d-m-Y (D) h:i:s A", $timestamp);
	//echo "Current date and local time on this server is $date_time";
	$date = date("d-m-Y", $timestamp);
	$current_date = date("d-m-Y", $timestamp);
	$CounterTime = date("h:i", $timestamp);
	$CounterTimeTo = date("h:i", $timestamp);
	$current_time_second = date("h:i:s", $timestamp);
	$current_time_second_24hours = date("H:i:s", $timestamp);
	$timeampm = date("A", $timestamp);
	$currentTime = time() + 3600; 
	$html['success'] = 1;
    $html['message'] = "Your payment was successful";
	$order_id = @$_GET['order_id'];
	$payid = "001";
	$userid = $_GET['user_id'];
	$orderamount = (int)$_GET['amount'];
	$referenceId = @$_GET['utr'];
	$bknref = @$_GET['bknref'];
	$cdate=date('Y-m-d H:i:s');
	$cdate1=date('d-m-Y');
	//$mobile = $billing_tel;
	//$emailid = $billing_email;

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
       "key": "9ccab429-064d-4325-b6e9-e504681fd9de",
       "client_txn_id": "'.$txnid.'",
       "txn_date": "'.$cdate1.'"
     }',
       CURLOPT_HTTPHEADER => array(
         'Content-Type: application/json'
       ),
     ));

     $response = curl_exec($curl);
 
    curl_close($curl);
    $res = json_decode($response);
	if($res->status==1)
	{
	$userid=$res->data->customer_name;
	$referenceId= $res->data->upi_txn_id;
	$orderamount= $res->data->amount;

	$sql=mysqli_query($conn, "SELECT * FROM us_reg_tbl WHERE user_id = '".$userid."'");
	 
while($row = mysqli_fetch_assoc($sql)){ 

$newcoins = $row['credit']+ $orderamount;  
//$bonus = $row['bonus_diamonds']+ 10;

}
	
	
//$insertq =mysqli_query($conn,"update payment set status='Success',trnsid='".$payid."' WHERE uid='".$userid."' and orderid='".$order_id."' ");

			
	    $insertData1 = "INSERT INTO `point_table`( `app_id`, `user_id`, `transaction_id`, `tr_nature`,  `tr_value`, `tr_value_updated`, `value_update_by`, `tr_value_type`, `tr_device`, `date`, `date_time`, `tr_remark`, `tr_status`, `is_deleted`, `device_type`, `device_id`, `admin_key`) 
	                                     VALUES ('com.dubaiking','$userid','$referenceId','TRDEPO002','$orderamount','$newcoins','Deposit','Credit','$devName','$date','$date_time','Online','Success','0',' $devType','','ADMIN0001')";
		mysqli_query($conn,$insertData1);
		
    
		$sql12 = "INSERT INTO `wallet_reports`(`type`,`transaction_id`,`value_update_by`,`user_id`,`app_id`,`tr_nature`, `tr_value`,`tr_value_updated`,`date`,`date_time`,`tr_status`,`created_at`,`tr_remark`)
		VALUES ('Credit','$referenceId','Deposit','$userid','com.dubaiking','TRDEPO002','$orderamount','$newcoins','$date','$date_time','Success','$cdate', 'Online') ";
	 mysqli_query($conn,$sql12);

	 

        
        $updateBalance = "UPDATE us_reg_tbl SET credit = '$newcoins' Where user_id = '".$userid."' AND app_id = 'com.dubaiking'";           		
		mysqli_query($conn,$updateBalance);
		
	
	
	
 
			?>
			
<form method="post" name="redirect" action="success.php">
</form>
</center>
<script language='javascript'>document.redirect.submit();</script>
<?php
	}
	else
	{
?>
<form method="post" name="redirect" action="failed.php">
</form>
</center>
<script language='javascript'>document.redirect.submit();</script>
<?php
	}
?>