<?PHP
     
     
    //  include('config.php'); 

	$servername = "localhost";
	$username = "kduser";
	$password = "Krishan001@123";
	$database = "kd_game";
    $conn = new mysqli($servername, $username, $password, $database);
   
    // die();

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
	$cdate=date('Y-m-d H:i:s');
	$cdate1=date('d-m-Y');
	

    $sql11=mysqli_query($conn, "SELECT t_id,id,user_id,created_at FROM qr_pendings where status='0' and created_at > now() - interval 7 minute and created_at < now() - interval 30 second limit 10");
	$resdata= mysqli_num_rows($sql11);
    // $updateBalance = "UPDATE users SET wallet = '500' Where id = '1'";           		
    //      mysqli_query($conn,$updateBalance);
    
    while($dta=mysqli_fetch_array($sql11))
	{
	$txnid = $dta['t_id'];
    $userid = $dta['user_id'];
    $created_at = date('Y-m-d H:i:s',strtotime($dta['created_at']));
	
	$sql112=mysqli_query($conn, "SELECT id FROM point_table WHERE transaction_id = '".$txnid."'");
     $resdata2= mysqli_num_rows($sql112);
if(!$resdata2)
{
	if($resdata>0)
	{		
        
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
	   "txn_date": "'.$cdate1.'"
	 }',
       CURLOPT_HTTPHEADER => array(
         'Content-Type: application/json'
       ),
     ));
     $response = curl_exec($curl);
	
	 
    curl_close($curl);
    $res = json_decode($response);
	// dd($res)
	if($res->status)
	{
		if($res->data->status=="success")
        {
		$userid=$res->data->customer_name;
		$referenceId= $res->data->upi_txn_id;
		$orderamount= $res->data->amount;
		
	    $insertData21 = "update qr_pendings set status='1' and payment_status='success' where t_id='".$txnid."'";
		mysqli_query($conn,$insertData21);

        $paymentTable=mysqli_query($conn, "SELECT * FROM qr_pendings where t_id='".$txnid."'");
	    $paymentTabledata= mysqli_fetch_assoc($paymentTable);
        $user_id  = $paymentTabledata['user_id'];
        $new_amount  = $paymentTabledata['amount'];
        $userTable=mysqli_query($conn, "SELECT * FROM us_reg_tbl where user_id='".$user_id."'");
	    $userTabledata= mysqli_fetch_assoc($userTable);
        $updateAmount = $userTabledata['credit']+$new_amount;
        $updateBalance = "UPDATE us_reg_tbl SET credit = '$updateAmount' Where user_id = '".$user_id."'";           		
		mysqli_query($conn,$updateBalance);
			$paymentId  = $paymentTabledata['t_id'];
             $day = date('d');
		     $month = date('M');
			 $year = date('Y');
			 $paying_time = date('h:i A');
             

			 $insertData1 = "INSERT INTO `point_table`( `app_id`, `user_id`,`transaction_id`, `transactionRef`, `tr_nature`,  `tr_value`, `tr_value_updated`, `value_update_by`, `tr_value_type`, `tr_device`, `date`, `date_time`, `tr_remark`, `tr_status`, `is_deleted`, `device_type`, `device_id`, `admin_key`,`created_at`) VALUES ('com.dubaiking','$userid','$paymentId','$paymentId','TRDEPO002','$updateAmount','$new_amount','Deposit','Credit','com.dubaiking','$date','$date_time','Online','Success','0',' ','','ADMIN0001','$created_at')";
			 mysqli_query($conn, $insertData1);

			//  $insertData1 = "INSERT INTO `wallet_reports`( `user_id`, `app_id`,`transaction_id`, `tr_value`, `tr_status`,  `type`, `tr_remark`, `date`, `date_time`, `value_update_by`, `tr_value_updated`) VALUES ('$userid','com.dubaiking','$userid','$paymentId','$paymentId','TRDEPO002','$updateAmount','$new_amount','Deposit','Credit','com.dubaiking','$date','$date_time','Online','Success','0',' ','','ADMIN0001','$created_at')";
			//  mysqli_query($conn, $insertData1);
		
		}
		else
		{
			$insertData211 = "update qr_pendings set status='2' where t_id='".$txnid."'";
		    mysqli_query($conn,$insertData211);
			//no payment
			
		}
	}
	else
	{
		//no response
		    $insertData211 = "update qr_pendings set status='2' where t_id='".$txnid."'";
		    mysqli_query($conn,$insertData211);
		
	}
	
	}
	
}
}

			?>