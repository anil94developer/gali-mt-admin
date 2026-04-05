<?php 
include("config.php");

$user = $_POST['user_id'];
$dev_id = $_POST['dev_id'];
$appId = $_POST['app_id'];
$bal_req = $_POST['point'];
$req_message = $_POST['message'];


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
$cdate=date('Y-m-d H:i:s');

if($appId == '' || $dev_id == '' || $user == '' || $bal_req == ''){

         $rows['success'] = '0';
		 $rows['message'] = 'Invalid data iserted try again or if you more wrong try you will block by system' ; 
		 echo (json_encode($rows));
		 exit; 
		 
}else{
		 

$chk_user=mysqli_query($conn, "SELECT * FROM us_reg_tbl WHERE user_id ='".$user."' AND app_id = '".$appId."' AND user_status = '1'");
$row_chk_user = mysqli_fetch_assoc($chk_user);
$count_chk_user = mysqli_num_rows($chk_user);


$chk_controler = mysqli_query($conn, "SELECT * FROM app_controller WHERE  app_id = '".$appId."' AND admin_status = '1'");
$row_ccontroler = mysqli_fetch_assoc($chk_controler);


if($count_chk_user > 0){

 $userBal = $row_chk_user['credit']; 
   $minRedeem = $row_ccontroler['min_redeem'];

if((int)$bal_req >= (int)$minRedeem){

if((int)$userBal >= (int)$bal_req){


    $UpdatedBalance = (int)$userBal - (int)$bal_req;


              $random = substr(md5(mt_rand()), 0, 10);     
				
	    $insertData1 = "INSERT INTO `point_table`( `app_id`, `user_id`, `transaction_id`, `tr_nature`,  `tr_value`, `tr_value_updated`, `value_update_by`, `tr_value_type`, `tr_device`, `date`, `date_time`, `tr_remark`, `tr_status`, `is_deleted`, `device_type`, `device_id`, `admin_key`, `game_type`) 
	    VALUES ('$appId','$user','$random','TRWITH003','$bal_req','$UpdatedBalance','Withdraw','Debit','$devName','$date','$date_time','".$req_message."','Pending','0','$devType','$devId','ADMIN0001', '1')";
		mysqli_query($conn,$insertData1);
		
		
		
		$sql12 = "INSERT INTO `wallet_reports`(`type`,`transaction_id`,`value_update_by`,`user_id`,`app_id`,`tr_nature`, `tr_value`,`tr_value_updated`,`date`,`date_time`,`tr_status`,`created_at`,`tr_remark`)
	       VALUES ('Debit','$random','Withdraw','$user','$appId','TRWITH003','$bal_req','$UpdatedBalance','$date','$date_time','Pending','$cdate', 'A/C Withdraw') ";
        mysqli_query($conn,$sql12);
       
	
        $updateBalance = "UPDATE us_reg_tbl SET credit = '$UpdatedBalance' Where user_id = '".$user."'";           		
		mysqli_query($conn,$updateBalance);
        

function get_data($d)
	{
		$value="";
		$c=count($d)-2;
		foreach($d as $ks=>$vs)
		{
			if($ks<$c)
			{
			if($vs!="")
			{
				$value.=" ".$vs;
			}
			}
		}
		return $value;
		
	}
	
$ac=explode("=",$req_message);
if(@$ac[4]!=" ")
{	
	$bank_name= strtoupper(get_data(explode(" ",@$ac[1])));
	$account_holder= strtoupper(get_data(explode(" ",@$ac[2])));
	$account_no= get_data(explode(" ",@$ac[3]));
	$ifsc= strtoupper(trim(@$ac[4]));
	$chk_user1=mysqli_query($conn, "SELECT * FROM user_withdraw WHERE account_no ='".$account_no."' and user_id='".$user."'");
    $count_chk_user = mysqli_num_rows($chk_user1);
	if($count_chk_user==0)
	{
	     $insertData12 = "INSERT INTO `user_withdraw`( `bank_name`, `account_holder`, `account_no`, `ifsc`,`user_id`) 
	     VALUES ('$bank_name','$account_holder','$account_no','$ifsc','$user')";
		mysqli_query($conn,$insertData12);
	}
}


	




 $rows['success'] = '1';
 $rows['message'] = 'Withdraw Request Successfully Created';
 echo (json_encode($rows));
 exit;




}else{
 $rows['success'] = '2';
 $rows['message'] = 'Withdraw Request Failed OR InSufficient Balance';
 echo (json_encode($rows));
 exit;
}
}else{
 $rows['success'] = '4';
 $rows['message'] = 'Withdraw Request Failed OR Need Minimum '.$minRedeem.' Points In Your Wallet Your Balance is '.$row_chk_user['credit'].' Earn More';
 echo (json_encode($rows));
 exit;
}

}else{


	    
	    $rows['success'] = '3';
		 $rows['message'] ='User Not Exits Or Blocked Please Check Again'; 
		 echo (json_encode($rows));
		 exit; 
	    
	

}

}
