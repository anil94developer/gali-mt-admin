<?php 

include("config.php");
$appId          = $_POST['app_id'];
$user_id 		= $_POST['user_id'];
$dev_id 		= $_POST['dev_id'];


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
$currentHour=date("H",$timestamp);


$currentTime = time() + 3600; 
     
  if($user_id=='' && $appId=='' && $dev_id==''){
	   
	    $rows['success'] = "0";
		 $rows['message'] = "Error Plaese Fill All Details"; 
		 echo (json_encode($rows));
		 exit;
  
  }else{

//device_id ='".$dev_id."' AND

$sqluser=mysqli_query($conn, "SELECT * FROM us_reg_tbl WHERE  user_id='".$user_id."' AND app_id = '".$appId."'");
 $count = mysqli_num_rows($sqluser);
 
  if($count > 0){
  
  
  
  $allMarkets = mysqli_query($conn, 'CALL getAllMarket("'.$appId.'")');
  
  //$allMarkets = mysqli_query($conn, "SELECT market_sub_name,market_view_time_close,market_name,market_id FROM comx_appmarkets WHERE app_id = '".$appId."' order by market_position asc ");
 
  $countMarkets = mysqli_num_rows($allMarkets);
  
  if($countMarkets > 0){
  
  
         $rows['status'] = "1";
		 $rows['message'] = "Successfully Markets Fetched";
		 
  $i=0;
  while($marketData = mysqli_fetch_assoc($allMarkets)){
  
  
     $rows['data'][$i]['SUB_NAME'] = $marketData['market_sub_name'];
     $rows['data'][$i]['time'] = $marketData['market_view_time_close'];
     
     $mtime = $marketData['market_view_time_close'];
     

     $time_in_24_hour_format  = date("H:i", strtotime($mtime));
     $time_in_24_hour_format1  = date("H", strtotime($mtime));
              // $rows['data'][$i]['name'] = $marketData['market_name'];
               $rows['data'][$i]['name'] = $marketData['market_name'];

  $mid = $marketData['market_id'];

     
     $rows['data'][$i]['id'] = $marketData['market_id'];

if($mid == 'DISAW'){
//echo $current_time_second_24hours1;
if(strtotime($current_time_second_24hours1)>=strtotime('02:20') and strtotime($current_time_second_24hours1)<=strtotime('09:00')){


          $rows['data'][$i]['is_play'] = '0';

    
     }else{

          $rows['data'][$i]['is_play'] = '1';

        
     }
     

}
elseif($mid == 'SHIV '){
//echo $current_time_second_24hours1;
if(strtotime($current_time_second_24hours1)>=strtotime('1:00') and strtotime($current_time_second_24hours1)<=strtotime('09:00')){


          $rows['data'][$i]['is_play'] = '0';

    
     }else{

          $rows['data'][$i]['is_play'] = '1';

        
     }
     

}
 else{

    if(($current_time_second_24hours < $time_in_24_hour_format) &&($currentHour>6)){
          $rows['data'][$i]['is_play'] = '1';

     }else{
     
          $rows['data'][$i]['is_play'] = '0';
}    
     
     






}

  
       
  
  $i++;
  
  }
     
  
  
  }else {
	
	$rows['status'] = "0";
$rows['message'] = "No Market Availavle For Play";
}
  

        
  
  
  
   
  }else {
	
	$rows['status'] = "0";
$rows['message'] = "User Not Available Or Blocked";
}
 
 
 }



				  echo (json_encode($rows));
exit;

/*$devId     = $_POST['dev_id'];
$appId     = $_POST['app_id'];
$usrId     = $_POST['user_id'];
$fltDate     = $_POST['flt_date'];
$tblCode     = $_POST['tbl_code'];
$dataType     = $_POST['type'];  ///1 = transactions 2 = history 3 me pending withdraw history only
//$fltDate= date('Y-m-d',strtotime($fltDate));

if($appId=='' || $devId=='' || $usrId == ''){	  
	 	 $rows['success'] = "0";
		 $rows['message'] = "Error Plaese Fill All Details"; 
		 echo (json_encode($rows));
		 exit;
  }else{
$chk_user=mysqli_query($conn, "SELECT * FROM us_reg_tbl WHERE user_id ='".$usrId."' AND app_id = '".$appId."' AND user_status = '1'");
$row_chk_user = mysqli_fetch_assoc($chk_user);
$count_chk_user = mysqli_num_rows($chk_user);


if($count_chk_user > 0){



if($dataType == '1'){

 //$sqler=mysqli_query($conn, "SELECT tr_value,tr_remark,date_time,t_mob,value_update_by,tr_value_updated,tr_status FROM `point_table` WHERE  app_id = '".$appId ."'  AND user_id = '".$usrId."' AND is_deleted = '0' AND tr_nature !='TRGAME001' AND tr_status IN ('Success','Pending') ORDER BY id DESC limit 10");

 $sqler=mysqli_query($conn, 'CALL GetWalletData("'.$usrId.'")');
  //echo mysqli_error($conn);
  



}elseif($dataType == '2'){

if(!$fltDate=='' && $tblCode == ''){
    //echo "hello";
	
 $sqler=mysqli_query($conn, "SELECT  * FROM `point_table` WHERE  app_id = '".$appId ."' AND user_id = '".$usrId."' AND is_deleted = '0' AND DATE(created_at) = '".$fltDate."' AND c = 'TRGAME001' ORDER BY id DESC  ");

}else if(!$tblCode == '' && !$fltDate==''){

  $sqler=mysqli_query($conn, "SELECT * FROM `point_table` WHERE  app_id = '".$appId ."' AND user_id = '".$usrId."' AND is_deleted = '0' AND date = '$fltDate' AND table_id = '$tblCode' AND tr_nature = 'TRGAME001' ORDER BY id DESC");

}else if(!$tblCode == '' && $fltDate==''){

 
 //$sqler=mysqli_query($conn, "SELECT * FROM `point_table` WHERE  app_id = '".$appId ."' AND user_id = '".$usrId."'  AND is_deleted = '0' AND table_id = '$tblCode' AND tr_nature = 'TRGAME001' ORDER BY id DESC");
 $sqler=mysqli_query($conn, "SELECT * FROM `point_table` WHERE  app_id = '".$appId ."' AND user_id = '".$usrId."'  AND is_deleted = '0' AND date = '$fltDate' AND tr_nature = 'TRGAME001' ORDER BY id DESC limit 10");

}else {
	$days_ago = date('Y-m-d', strtotime('-3 days', strtotime(date('Y-m-d'))));
  $dt=date('d-m-Y');
   //echo "hello";
  $sqler=mysqli_query($conn, "SELECT *  FROM `point_table` WHERE  app_id = '".$appId ."' AND user_id = '".$usrId."' AND is_deleted = '0' AND tr_nature = 'TRGAME001'  and DATE(created_at) >= '".$days_ago."' ORDER BY created_at DESC");
  
}
//tr_value,win_value,date,tr_remark,pred_num,game_type,value_update_by,is_result_declared

}elseif($dataType == '3'){

 $sqler=mysqli_query($conn, "SELECT tr_value,tr_remark,date_time,t_mob,value_update_by,tr_value_updated,tr_status FROM `point_table` WHERE  app_id = '".$appId ."'  AND user_id = '".$usrId."' AND is_deleted = '0' AND tr_nature='TRWITH003' AND tr_status IN ('Success','Pending') ORDER BY id DESC limit 10");

}






	$count = mysqli_num_rows($sqler);
	    
	    if($count > 0){
			
			
			$i=0;
	 while($row2 = mysqli_fetch_assoc($sqler))
	 {	
       
		
			
	        $type="";
			if($row2['tr_remark']=="redeemed")
			{
				$type="Bonus";
			}
			
			
			
    $row2['value_update_by']=(($type=="Bonus")?$row2['value_update_by']."\n($type)":$row2['value_update_by']);
	if($row2['tr_remark']=="transfer")
			{
			 $row2['value_update_by']= $row2['value_update_by']."\nTransfer-".$row2['t_mob'];
			}
			
    $row2['date']=date('d-m-Y h:i:s a',strtotime($row2['created_at']));			   
    //$row2['date_time']=date("d-m-Y H:i:s a",strtotime($row2['updated_at']));			   
	$table_id =	$row2['game_type'];
	$trans_nature =	$row2['tr_nature'];
	$market_id =	$row2['table_id'];
		
		
  $tblcodeid = mysqli_query($conn, "SELECT * FROM `tbl_types` WHERE  app_id = '".$appId ."' AND tbl_code = '".$table_id."'");
	$countid = mysqli_num_rows($tblcodeid);
	
   $tblcodeData = mysqli_fetch_assoc($tblcodeid);
    
    
    		
  $trns_name = mysqli_query($conn, "SELECT * FROM `tr_type` WHERE  app_id = '".$appId ."' AND tr_type_code = '".$trans_nature."'");
	$trncount = mysqli_num_rows($trns_name);
	
   $trnstypeName = mysqli_fetch_assoc($trns_name);
    
        
    		
  $slot_name = mysqli_query($conn, "SELECT * FROM `comx_appmarkets` WHERE  app_id = '".$appId ."' AND market_id = '".$market_id."'");
	$slot_count = mysqli_num_rows($slot_name);
	
   $slotData = mysqli_fetch_assoc($slot_name);
    
    			
		$rows['success'] = "1";
        $rows['message'] = "PointData details success";
		$rows['data'][$i] = $row2;
    
    
    
   
       
         if($countid > 0){
    		$rows['data'][$i]['game_type'] = $tblcodeData['tbl_name'];

    }else{
    		$rows['data'][$i]['game_type'] = 'Table Not Found';

       }
       
         
    if($trncount > 0){
    		$rows['data'][$i]['transaction_name'] = $trnstypeName['tr_type_name'];

    }else{
    		$rows['data'][$i]['transaction_name'] = 'Other';

       }   
       
            
    if($slot_count > 0){
    		$rows['data'][$i]['market_name'] = $slotData['market_name'];

    }else{
    		$rows['data'][$i]['market_name'] = 'NFS';

       }
		
			
			

		
		
	$i++;
	 }
		
}else{

         $rows['success'] = "0";
		 $rows['message'] = "No data Available Or May Be Something went wrong"; 
		 echo (json_encode($rows));
		 exit;
		 
		 
}
}else{


	    
	    $rows['success'] = '3';
		 $rows['message'] = 'User Not Exits Or Blocked Please Check Again' ; 
		 echo (json_encode($rows));
		 exit; 
	    
	

}



}
 
echo (json_encode($rows));*/

