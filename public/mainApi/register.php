<?php 
include("config.php");


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






$appId          = $_POST['app_id'];
$pss            = $_POST['pss'];
$fullName       = $_POST['name'];
$refercode 		= $_POST['refercode'];
$lat 			= $_POST['lat'];
$lng 			= $_POST['lng'];
$address 		= $_POST['address'];
$devModel 		= $_POST['dev_model'];
$devName 		= $_POST['dev_name'];
$devId 		    = $_POST['dev_id'];
$dob 			= $_POST['dob'];
$gender 		= 'Male';
$mobileNum 		= $_POST['mobileNum'];






$senderRefAmt = 100;
$recRefAmt = 100;


$length = 10;    
$tr_id =  substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,$length);


  
     
  if($mobileNum=='' && $app_id=='' && $pss=='' && $dev_id==''){
	  
	 	 $rows['success'] = "0";
		 $rows['message'] = "Error"; 
		 echo (json_encode($rows));
		 exit;
  }else{
      
       $sql=mysqli_query($conn, "SELECT * FROM us_reg_tbl WHERE mob='".$mobileNum."' AND app_id = '".$appId."'");
	   $count = mysqli_num_rows($sql);
	    if($count > 0){ 
		
		 $rows['success'] = "0";
		 $rows['message'] = "Mobile Number already exists, please try with another";
		  echo (json_encode($rows));
		 exit;
		
		} else { 
		 	
		 	$auth = md5(uniqid(rand(100000,999999),true));
			
			$size = 6;
			$code = strtoupper(substr(md5(time().rand(10000,99999)), 0, $size));
			///$refercode =  preg_replace(array('/^\[/','/\]$/'), '',$refercode);  
			$referral = str_replace(array('i','o'), '',$code);
			
     
     

        
        
         if(strlen($refercode) > 0){
         
         
         
	        
	        $sql3=mysqli_query($conn, "SELECT * FROM us_reg_tbl WHERE ref_code = '".$refercode."' AND app_id = '".$appId."'");
	   $count3 = mysqli_num_rows($sql3);
	   $anotherBalData = mysqli_fetch_assoc($sql3);
	   
	   
	    if($count3 > 0){ 
	    
	    
	      $sql1=mysqli_query($conn, "SELECT * FROM device_block WHERE device_id = '".$refercode."' AND app_id = '".$appId."'");
	   $count1 = mysqli_num_rows($sql1);
	    if($count1 > 0){ 
	    
	    		 $rows['message'] = "This device reffrl already used or already you have another account make before";
	    		 $rows['refisGiven'] = "0";

	        
	         }else{
	         
	         $sql = "INSERT INTO `us_reg_tbl`(`mob`, `us_pass`,`app_id`,`FullName`,`ref_code`, `ref_by`, `lat`, `lng`, `address`, `dev_model`,`dev_name`, `device_id`, `dob`,`us_gender`,`credit`,`bonus_diamonds`, `user_id`) 
			        VALUES ('$mobileNum', '$pss','$appId','$fullName','$referral', '$refercode', '$lat', '$lng', '$address', '$devModel', '$devName', '$devId', '$dob','$gender','00','0','$tr_id')"; 
			        	
			$dd=mysqli_query($conn,$sql); 
			
			
		 $getDat=mysqli_query($conn, "SELECT* FROM us_reg_tbl  WHERE mob='".$mobileNum."'AND app_id = '".$appId."'");
      
        $userData = mysqli_fetch_assoc($getDat); 
	
	        $divice_reg = "INSERT INTO `device_block`(`device_id`, `user_id`, `app_id`) VALUES ('$devId','".$userData['user_id']."', '$appId')";
	      
	        $insww=mysqli_query($conn,$divice_reg); 

              /////value update for reciever
              
	          $userBalance = $userData['credit'];
	            $userUpdatedBal = ($userBalance + $recRefAmt);
	            
	            //$updateUserB = "UPDATE `us_reg_tbl` SET `credit` = '$userUpdatedBal' WHERE  user_id = '".$userData['user_id']."' AND app_id = '".$appId."'";
	            
	            //$ResUpdateBl = mysqli_query($conn,$updateUserB);
	            
	            
	            
	                 
	        /*$sqlRec = "INSERT INTO `point_table`( `app_id`, `user_id`, `transaction_id`, `tr_nature`, `tr_value`, `tr_value_updated`, `value_update_by`, `tr_value_type`, `tr_device`, `date`, `date_time`, `tr_remark`, `tr_status`, `is_deleted`, `device_type`, `device_id`)
	                                      VALUES ( '$appId', '".$userData['user_id']."', '$tr_id', 'TRDRFRL008', '$recRefAmt', '$userUpdatedBal', 'Reffral', 'Credit', '$dev_model', '$date', '$date_time', 'No Any Remark', 'Success', '0', 'Android','$tr_id') ";
		  $resRec = mysqli_query($conn,$sqlRec);*/
		  
		  
		  	
	            ////value update for sender
	            
	            
	            $senderBal = $anotherBalData['credit']; 
	            $senderUserId = $anotherBalData['user_id']; 
	            
	            $updtSendBal = ($senderBal+ $senderRefAmt);
	            
	            //echo $updateSenderB = "UPDATE `us_reg_tbl` SET `credit` = '$updtSendBal' WHERE  user_id = '".$senderUserId."' AND app_id = '".$appId."'";
	            //die;
	            //$ResUpdateSenderBl = mysqli_query($conn,$updateSenderB);
	            
	            
	            
	        /*$sqlSend = "INSERT INTO `point_table`( `app_id`, `user_id`, `transaction_id`, `tr_nature`, `tr_value`, `tr_value_updated`, `value_update_by`, `tr_value_type`, `date`, `date_time`, `tr_remark`, `tr_status`, `is_deleted`, `device_type`)
	                                                            VALUES ( '$appId', '".$senderUserId."', '$tr_id', 'TRDRFRL008', '$senderRefAmt', '$updtSendBal', 'Reffral', 'Credit', '$date', '$date_time', 'No Any Remark', 'Success', '0', 'Android')";
		  $resSend = mysqli_query($conn,$sqlSend); */	
	            
	            
	            
	            
	         
	         
	         
 $rows['success'] = "1";
 $rows['message'] = "User Registration Success";
 $rows['user_id'] = $userData['user_id'];
 $rows['device_id'] = $userData['device_id'];
 $rows['isReffrelGive'] = '1';
 $rows['isReffrelGivenMessage'] = 'Congratulation You get '.$recRefAmt.' Rs Credit for play game';
 
 
 echo (json_encode($rows));
		 exit;
	         
	         }
	    
	           
	    }else{
	    
	    
	    	 $rows['success'] = "0";
		 $rows['message'] = "Given Reffral Code Is Not Valid ! Please Try Again";
		  echo (json_encode($rows));
		 exit;
	    
	    }
	    
	        
	        } else{
	        
	        
	        
	         $sql = "INSERT INTO `us_reg_tbl`(`mob`, `us_pass`,`app_id`,`FullName`,`ref_code`, `ref_by`, `lat`, `lng`, `address`, `dev_model`,`dev_name`, `device_id`, `dob`,`us_gender`,`credit`,`bonus_diamonds`, `user_id`) 
			        VALUES ('$mobileNum', '$pss','$appId','$fullName','$referral', '$refercode', '$lat', '$lng', '$address', '$devModel', '$devName', '$devId', '$dob','$gender','00','0','$tr_id')"; 
			$dd=mysqli_query($conn,$sql); 
		 $getDat=mysqli_query($conn, "SELECT* FROM us_reg_tbl  WHERE mob='".$mobileNum."'AND app_id = '".$appId."'");
      
        $userData = mysqli_fetch_assoc($getDat); 
	
	        $divice_reg = "INSERT INTO `device_block`(`device_id`, `user_id`, `app_id`) VALUES ('$devId','".$userData['user_id']."', '$appId')";
	      
	        $insww=mysqli_query($conn,$divice_reg); 
	        
	        
 $rows['success'] = "1";
 $rows['message'] = "User Registration Success";
 $rows['user_id'] = $userData['user_id'];
 $rows['device_id'] = $userData['device_id'];
$rows['isReffrelGive'] = '0';
$rows['isReffrelGivenMessage'] = 'You dont have any reffral inserted';

 echo (json_encode($rows));
		 exit;
	        
	        }

	
		 
       


}
      
} 
  



 echo (json_encode($rows));
		 exit;