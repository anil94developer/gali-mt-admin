<?php
include("config.php");
$appId = $_POST['app_id'];
$user_id = $_POST['user_id'];
$dev_id = $_POST['dev_id'];


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
$currentHour = date("H", $timestamp);


$currentTime = time() + 3600;

if ($user_id == '' && $appId == '' && $dev_id == '') {

     $rows['success'] = "0";
     $rows['message'] = "Error Plaese Fill All Details";
     echo (json_encode($rows));
     exit;

} else {

     //device_id ='".$dev_id."' AND

     $sqluser = mysqli_query($conn, "SELECT * FROM us_reg_tbl WHERE  user_id='" . $user_id . "' AND app_id = '" . $appId . "'");
     $count = mysqli_num_rows($sqluser);

     if ($count > 0) {

          //$allMarkets = mysqli_query($conn, "CALL GetAllMarket()");
          //$allMarkets = mysqli_query($conn, 'CALL getAllMarket("'.$appId.'")');

          $allMarkets = mysqli_query($conn, "SELECT market_sub_name,market_view_time_open,market_view_time_close,market_name,market_id FROM comx_appmarkets WHERE 
  app_id = '" . $appId . "' and market_type=1");




          $countMarkets = mysqli_num_rows($allMarkets);

          if ($countMarkets > 0) {


               $rows['status'] = "1";
               $rows['message'] = "Successfully Markets Fetched";

               $i = 0;
               while ($marketData = mysqli_fetch_assoc($allMarkets)) {


                    $rows['data'][$i]['SUB_NAME'] = $marketData['market_sub_name'];
                    $rows['data'][$i]['time'] = $marketData['market_view_time_close'];
                    $rows['data'][$i]['open_time'] = $marketData['market_view_time_open'];
                    $results_tbls = mysqli_query($conn, "SELECT * FROM results_tbls WHERE app_id = '" . $appId . "' AND market_id = '" . $marketData['market_id'] . "' AND date = '" . date('d-m-Y') . "'");
                    $results_tblsdata = mysqli_fetch_assoc($results_tbls);
                    // $rows['data'][$i]['result'] = '22';
                    $rows['data'][$i]['result'] = $results_tblsdata['result'];



                    $mtime = $marketData['market_view_time_close'];


                    $time_in_24_hour_format = date("H:i", strtotime($mtime));
                    $time_in_24_hour_format1 = date("H", strtotime($mtime));
                    // $rows['data'][$i]['name'] = $marketData['market_name'];
                    $rows['data'][$i]['name'] = $marketData['market_name'];

                    $mid = $marketData['market_id'];


                    $rows['data'][$i]['id'] = $marketData['market_id'];

                    if ($mid == 'DISAWAR') {
                         //echo $current_time_second_24hours1;
                         if (strtotime($current_time_second_24hours1) >= strtotime('02:20') and strtotime($current_time_second_24hours1) <= strtotime('09:00')) {


                              $rows['data'][$i]['is_play'] = '0';


                         } else {

                              $rows['data'][$i]['is_play'] = '1';


                         }


                    } elseif ($mid == 'KDMnight') {
                         //echo $current_time_second_24hours1;
                         if (strtotime($current_time_second_24hours1) >= strtotime('12:40') and strtotime($current_time_second_24hours1) <= strtotime('07:00')) {


                              $rows['data'][$i]['is_play'] = '0';


                         } else {

                              $rows['data'][$i]['is_play'] = '1';


                         }


                    } else {

                         if (($current_time_second_24hours < $time_in_24_hour_format) && ($currentHour > 6)) {
                              $rows['data'][$i]['is_play'] = '1';

                         } else {

                              $rows['data'][$i]['is_play'] = '0';
                         }








                    }




                    $i++;

               }



          } else {

               $rows['status'] = "0";
               $rows['message'] = "No Market Availavle For Play";
          }







     } else {

          $rows['status'] = "0";
          $rows['message'] = "User Not Available Or Blocked";
     }


}



echo (json_encode($rows));
exit;