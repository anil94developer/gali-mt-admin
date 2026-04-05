<?php
date_default_timezone_set('Asia/Kolkata');
$timestamp = time();
$date_time = date("d-m-Y (D) h:i:s A", $timestamp);
//echo "Current date and local time on this server is $date_time";
$date = date("d-m-Y", $timestamp);
$current_date = date("d-m-Y", $timestamp);
$current_date2 = date("Ymd", $timestamp);
$current_time = date("h:i", $timestamp);
$isPlay = 0;
$current_hours = date("H", $timestamp);
$current_hours_minutes = date("i", $timestamp);
$current_hours_seconds = date("s", $timestamp);
$totalCurrentMinutes = ($current_hours*60)+$current_hours_minutes;
$totalt_current_sec = ($totalCurrentMinutes*60)+$current_hours_seconds;
$currentSlotArray = explode('.',($totalCurrentMinutes/3));
$current_slot = $currentSlotArray[0];
$next_slot=$current_slot+1;



$next_slot_seconds=($next_slot*3)*60;




$remainig_sec=$next_slot_seconds-$totalt_current_sec;

if(($remainig_sec-30)>0){

$remainig_sec_to_close_bet=$remainig_sec-30;
$isPlay = 1;

}else{
$remainig_sec_to_close_bet=0;
$isPlay = 0;

}





$current_time_second = date("h:i:s", $timestamp);
$current_time_second_24hours = date("H:i:s", $timestamp);
$timeampm = date("A", $timestamp);
$currentTime = time() + 3600; 


$PeriodIdSlot = $current_date2.$current_slot;

$insrt = "INSERT INTO `slot_checker`(`slotId`, `date_time`, `is_result_published`, `is_play_on_off`, `result`) VALUES ('$PeriodIdSlot', '$date_time', '0', '1', '')";

$resIns = mysqli_query($conn,$insrt);




         $rows['success'] = '1';
		 $rows['periodid'] = $current_date2.$current_slot; 
		 $rows['remaining_sec'] = "".$remainig_sec; 
		 $rows['bet_close_rem_sec'] = "".$remainig_sec_to_close_bet; 
		 $rows['is_play'] = "".$isPlay; 
		 echo (json_encode($rows));
		 exit;