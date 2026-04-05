<?PHP
require('config.php');
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.instamojo.com/oauth2/token/');     
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);

$payload = Array(
    'grant_type' => 'client_credentials',
    'client_id' => '1bIabAQ2cET7S0RQ86bbdlPHGOemFmU7WZuoh0Jq',
    'client_secret' => '7cYQfsnTw4y98E9RFC5vXFNS3d4Lz9tGCgeNw0kgxTOOSvlBwkOUXQ6oifKzFmDRCqSFx9CVIDlt8wJQF4x2jbbtnneP3FDd0vkuTtnZx29yCRiJDmbR4FgF7fxfSzjG'
  );
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
$response = curl_exec($ch);
curl_close($ch); 
$tdata= json_decode($response);

//echo $tdata->access_token;
//die;

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.instamojo.com/v2/payments/'.$_REQUEST['payment_id'].'/');
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);

curl_setopt($ch, CURLOPT_HTTPHEADER,array('Authorization: Bearer '.$tdata->access_token.''));

$response1 = curl_exec($ch);
curl_close($ch); 
$dta=json_decode($response1);
$name= $dta->name;
//die;
$order_status= $dta->status;
if($order_status==1)
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
	$order_id = $dta->id;
	$payid = $dta->id;
	$userid = $name;
	$orderamount = (int)$dta->amount;
	$mobile = $dta->phone;
	$emailid = $dta->email;
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


