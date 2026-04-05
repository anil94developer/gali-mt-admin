<?php
require('config.php');

session_start();
include('ccv/Crypto.php');

	error_reporting(0);
	
	$workingKey='A7D56554194B3721696F58D1621D1775';		//Working Key should be provided here.
	$encResponse=$_POST["encResp"];			//This is the response sent by the CCAvenue Server
	$rcvdString=decrypt($encResponse,$workingKey);		//Crypto Decryption used as per the specified working key.
	$order_status="";
	$user_id="";
	$decryptValues=explode('&', $rcvdString);
	print_r($decryptValues);
	
	$dataSize=sizeof($decryptValues);
	
	
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
	 
	for($i = 0; $i < $dataSize; $i++) 
	{
		$information=explode('=',$decryptValues[$i]);
		if($i==3)	{ $order_status=$information[1]; }
		if($i==26)	{ $user_id=$information[1]; }
		if($i==0)	{ $order_id=$information[1]; }
		if($i==2)	{ $payid=$information[1]; }
		if($i==10)	{ $amount=$information[1]; }
		if($i==17)	{ $billing_tel=$information[1]; }
		if($i==18)	{ $billing_email=$information[1]; }
	}
   
	
	if($order_status==="Success")
	{
		$success=true;
		
	}
	else{
		
		$success=false;
	}
	




if ($success == true)
{
	
	$html['success'] = 1;
    $html['message'] = "Your payment was successful";
	$order_id = $order_id;
	$payid = $payid;
	$userid = $user_id;
	$orderamount = $amount;
	$mobile = $billing_tel;
	$emailid = $billing_email;
	$sql=mysqli_query($conn, "SELECT * FROM us_reg_tbl WHERE user_id = '".$userid."'");
	 
while($row = mysqli_fetch_assoc($sql)){ 

$newcoins = $row['credit']+ $orderamount;  
$bonus = $row['bonus_diamonds']+ 10;

}
	
	
$insertq =mysqli_query($conn,"update payment set status='Success',trnsid='".$payid."' WHERE uid='".$userid."' and orderid='".$order_id."' ");

			
	    $insertData1 = "INSERT INTO `point_table`( `app_id`, `user_id`, `transaction_id`, `tr_nature`,  `tr_value`, `tr_value_updated`, `value_update_by`, `tr_value_type`, `tr_device`, `date`, `date_time`, `tr_remark`, `tr_status`, `is_deleted`, `device_type`, `device_id`, `admin_key`) 
	                                     VALUES ('com.dubaiking','$userid','$order_id','TRDEPO002','$orderamount','$newcoins','Deposit','Credit','$devName','$date','$date_time','Online','Success','0',' $devType','','ADMIN0001')";
		mysqli_query($conn,$insertData1);
		
    
        
        
        $updateBalance = "UPDATE us_reg_tbl SET credit = '$newcoins' Where user_id = '".$userid."' AND app_id = 'com.dubaiking'";           		
		mysqli_query($conn,$updateBalance);
		
	
	
	
 
			?>
			
			
			
			
			<form method="post" name="redirect" action="success.php">

		</form>
		</center>
		<script language='javascript'>document.redirect.submit();</script>
<?php 	}
else
{
	 
		$html['success'] = 0;
		$html['message'] = $error; ?>
		
		<form method="post" name="redirect" action="failed.php">

		</form>
		</center>
		<script language='javascript'>document.redirect.submit();</script>
 <?php
 
}

 

$json = json_encode($html);
?>