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
$timeampm = date("A", $timestamp);
$currentTime = time() + 3600; 
 if($appId=='' && $user_id==''){
	 	 $rows['success'] = "0";
		 $rows['message'] = "Error"; 
		 echo (json_encode($rows));
		 exit;
  }else{
       //update last seen;
	    mysqli_query($conn, "update us_reg_tbl set last_seen='".date('Y-m-d H:i:s')."' WHERE user_id='".$user_id."'");
	   
       $sql=mysqli_query($conn, "SELECT credit,is_kyc FROM us_reg_tbl WHERE user_id='".$user_id."' AND app_id = '".$appId."'");
	   $count = mysqli_num_rows($sql);
	    if($count > 0){ 
 $appUserData = mysqli_fetch_assoc($sql);
  $allMarkets = mysqli_query($conn, "SELECT market_name,market_view_time_open,market_sunday_time_close,market_view_time_close,market_id FROM comx_appmarkets WHERE app_id = '".$appId."' AND status = '1' ORDER BY market_position ASC");
  $countMarkets = mysqli_num_rows($allMarkets);
$appControler = mysqli_query($conn,"SELECT whatsapp,call_enable,admin_contact_mob FROM app_controller WHERE app_id = '".$appId."'");
  $appControllerData = mysqli_fetch_assoc($appControler);
  if($countMarkets > 0){
  ////get last updated market for currentday
  $lastreslt = mysqli_query($conn, "SELECT market_id,result,date_time_result FROM results_tbls WHERE date ='".$current_date."' ORDER BY id DESC ");
  $checkLastTodayMarket = mysqli_num_rows($lastreslt);
  if($checkLastTodayMarket > 0){
    $resultData = mysqli_fetch_assoc($lastreslt);
	$lastUpdated_marketId =  $resultData['market_id'];
	$lastresult =  $resultData['result'];
	$date_time_result =  $resultData['date_time_result'];  
	
	$checkNameLastMarket = mysqli_query($conn, "SELECT market_name FROM comx_appmarkets WHERE app_id = '".$appId."' AND market_id = '".$lastUpdated_marketId."'");
	$marketnameLast = mysqli_fetch_assoc($checkNameLastMarket);
     $market_name=  $marketnameLast['market_name'];
  }else{
    $lastresult=  'Result Not Available';
	$market_id=  ' Not Available';
	
	$market_name=  ' Not Available';
	$date_time_result=  ' Not Available';  
  }
         $rows['success'] = "1";
		 $rows['message'] = "Home dashboard Fetch Successfully";
		 $rows['nformat'] = $date_time;
		 $rows['current_date'] = $date;
		 $rows['app_version'] ='1.4';

		 $rows['user_balance'] = $appUserData['credit'];
		 $rows['is_kyc'] = $appUserData['is_kyc'];
		 $rows['note'] = 'अगर आप referal कोड से अपने दोस्तो को जोड़ोगे तो आपका दोस्त जितनी गेम प्ले करेगा उसका 3 परसेंट आपको दिया जाएगा'; //$appControllerData['imp_notice_on_home'];

		 $rows['current_market_details']['today_day'] ="BabajiClub Today Results";
		  $rows['current_market_details']['whatsap'] = $appControllerData['whatsapp'];
		 $rows['current_market_details']['call'] = $appControllerData['call_enable'];
		 $rows['current_market_details']['whatsapnum'] = $appControllerData['admin_contact_mob'];
		 $rows['current_market_details']['market_name'] =$market_name;
		 $rows['current_market_details']['market_id'] =$lastUpdated_marketId ;
		 $rows['current_market_details']['updated_time'] =$date_time_result;
		 $rows['current_market_details']['market_result'] ="\n\n".$lastresult;
		 
  $i=0;
  while($marketData = mysqli_fetch_assoc($allMarkets)){
    //echo $marketData['market_id'];
   $market_id= $marketData['market_id'];
  $getRet = mysqli_query($conn, "SELECT result FROM results_tbls WHERE market_id = '".$market_id."' AND date = '".$current_date."'");
     $restdata = mysqli_fetch_assoc($getRet);
     $marketRes = $restdata['result'];
	  if($marketRes!=''){
	  
						$rows['data'][$i]['market_result'] = $restdata['result'];

	  }else{
						$rows['data'][$i]['market_result'] = "XX";

	  }
  
   
	
	   
  $openTime     = date('h:i A', strtotime($marketData['market_view_time_open']));
  $closeTime = date('h:i A', strtotime($marketData['market_sunday_time_close']));
  $resultTime =  date('h:i A', strtotime($marketData['market_view_time_close']));
					$rows['data'][$i]['market_name'] = $marketData['market_name'];							
					$rows['data'][$i]['open_time'] = $openTime;
					$rows['data'][$i]['close_time'] = $closeTime;
					$rows['data'][$i]['result_time'] = $resultTime;	
 			
					$rows['data'][$i]['is_open'] = '0';
					$rows['data'][$i]['market_id'] = $market_id;				
					
					$rows['data'][$i]['mini_bet'] = '5';

					$rows['data'][$i]['max_bet'] = '200';

					$rows['data'][$i]['betpoint_change_time'] = '100';	
					 
  $i++;
					
}

  }else {
	
	$rows['status'] = "0";
$rows['message'] = "No Market Availavle For Play";
 echo (json_encode($rows));
		 exit;
}
    
}else { 
		 	
$rows['status'] = "0";
$rows['message'] = "User not Exits";	
		} 

}

				  echo (json_encode($rows));
exit;

		 