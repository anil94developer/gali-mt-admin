<?php
include("dubaiking.php");

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
$devId = $_POST['dev_id'];
$appId = $_POST['app_id'];
$usrId = $_POST['user_id'];
$tblCode = $_POST['tbl_code'];
$dataType = $_POST['type']; ///1 for live slots  2 for plaed slotes

if ($appId == '' || $devId == '' || $usrId == '' || $tblCode == '') {
  $rows['success'] = "0";
  $rows['message'] = "Error Plaese Fill All Details";
  echo (json_encode($rows));
  exit;
} else {
  $chk_user = mysqli_query($conn, "SELECT * FROM us_reg_tbl WHERE user_id ='" . $usrId . "' AND app_id = '" . $appId . "' AND user_status = '1'");
  $row_chk_user = mysqli_fetch_assoc($chk_user);
  $count_chk_user = mysqli_num_rows($chk_user);

  if ($count_chk_user > 0) {
    if ($dataType == '1') {
      $sqler = mysqli_query($conn, "SELECT * FROM `time_manage` WHERE time > '" . $current_time_second_24hours . "' AND app_id = '" . $appId . "' AND tbl_code = '$tblCode' AND status = '1'");
    }

    if ($dataType == '2') {
      $sqler = mysqli_query($conn, "SELECT * FROM `time_manage` WHERE  app_id = '" . $appId . "' AND tbl_code = '$tblCode' AND status = '1'");
    }

    $count = mysqli_num_rows($sqler);

    if ($count > 0) {
      $i = 0;
      while ($row2 = mysqli_fetch_assoc($sqler)) {
        $rows['success'] = "1";
        $rows['message'] = "Time details success";
        $db_time = strtotime($date . $row2['time']) . "<br>";
        $CurentTime = strtotime($nowdate_time) . "<br>";

        if ($dataType == '1') {
          if ($CurentTime < $db_time) {
            $db_dt = new DateTime();
            $db_dt->setTimestamp($db_time); //<--- Pass a UNIX TimeStamp
            $db_get_time = $db_dt->format('Y-m-d G:i:s') . "<br>";
            $diff = $db_time - $CurentTime;
            $ct_dt = new DateTime();
            $ct_dt->setTimestamp($CurentTime); //<--- Pass a UNIX TimeStamp
            $ct_get_time = $ct_dt->format('Y-m-d G:i:s') . "<br>";
            $numDays = abs($smallestTimestamp - $biggestTimestamp) / 60 / 60 / 24;
            $diff = abs($db_time - strtotime($nowdate_time));

            // To get the year divide the resultant date into
            // total seconds in a year (365*60*60*24)
            $years = floor($diff / (365 * 60 * 60 * 24));
            // To get the month, subtract it with years and
            // divide the resultant date into
            // total seconds in a month (30*60*60*24)
            $months = floor(($diff - $years * 365 * 60 * 60 * 24)
              / (30 * 60 * 60 * 24));


            // To get the day, subtract it with years and 
            // months and divide the resultant date into
            // total seconds in a days (60*60*24)
            $days = floor(($diff - $years * 365 * 60 * 60 * 24 -
              $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));


            // To get the hour, subtract it with years, 
            // months & seconds and divide the resultant
            // date into total seconds in a hours (60*60)
            $hours = floor(($diff - $years * 365 * 60 * 60 * 24
              - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24)
              / (60 * 60));


            // To get the minutes, subtract it with years,
            // months, seconds and hours and divide the 
            // resultant date into total seconds i.e. 60
            $minutes = floor(($diff - $years * 365 * 60 * 60 * 24
              - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24
              - $hours * 60 * 60) / 60);


            // To get the minutes, subtract it with years,
            // months, seconds, hours and minutes 
            $seconds = floor(($diff - $years * 365 * 60 * 60 * 24
              - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24
              - $hours * 60 * 60 - $minutes * 60));

            $rem_time_insec = floor(($diff - $years * 365 * 60 * 60 * 24
              - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24));


            //    
            //       printf("%d years, %d months, %d days, %d hours, "
            //      . "%d minutes, %d seconds", $years, $months,
            //              $days, $hours, $minutes, $seconds)."<br>"."<br><br><br><br>";     

            if (($rem_time_insec - 60) > 0) {
              $rows['data'][$i] = $row2;
              $rows['data'][$i]['remaining_time'] = $hours . ':' . ($minutes - 1) . ':' . $seconds;
              $rows['data'][$i]['remaining_time_in_seconds'] = '' . ($rem_time_insec - 60);
              $rows['data'][$i]['show_remaining_time_to_user'] = $hours . ' Hours' . ($minutes - 1) . ' Minutes ' . $seconds . 'Seconds';
              $rows['data'][$i]['is_time_over'] = 'NO';
              $rows['data'][$i]['points'] = $row_chk_user['credit'];
              $rows['data'][$i]['game_result'] = '22';
            } else {
              $rows['data'][$i] = $row2;
              $rows['data'][$i]['remaining_time'] = '00:' . '00' . '00';
              $rows['data'][$i]['show_remaining_time_to_user'] = 'Time Over';
              $rows['data'][$i]['remaining_time_in_seconds'] = '' . ($rem_time_insec - 60);
              $rows['data'][$i]['is_time_over'] = 'YES';
              $rows['data'][$i]['points'] = $row_chk_user['credit'];
              $rows['data'][$i]['game_result'] = '22';
            }
          } else {
            $rows['success'] = "0";
            $rows['message'] = "No data Available 3";
            echo (json_encode($rows));
            exit;
          }
        } else if ($dataType == '2') {
          if ($CurentTime > $db_time) {
            $rows['data'][$i] = $row2;
            $rows['data'][$i]['remaining_time'] = '00:' . '00' . '00';
            $rows['data'][$i]['show_remaining_time_to_user'] = 'Time Over';
            $rows['data'][$i]['remaining_time_in_seconds'] = '' . ($rem_time_insec - 60);
            $rows['data'][$i]['is_time_over'] = 'YES';
            $rows['data'][$i]['points'] = $row_chk_user['credit'];
            $rows['data'][$i]['game_result'] = '22';
          } else {
            $rows['success'] = "0";
            $rows['message'] = "No data Available 3";
            echo (json_encode($rows));
            $conn->close();
            exit;
          }
        } else {
          $rows['success'] = "0";
          $rows['message'] = "No data Available 3";
          echo (json_encode($rows));
          $conn->close();
          exit;
        }
        $i++;
      }
    } else {
      $rows['success'] = "0";
      $rows['message'] = "No data Available Or May Be Something went wrong";
      echo (json_encode($rows));
      $conn->close();
      exit;
    }
  } else {
    $rows['success'] = '3';
    $rows['message'] = 'User Not Exits Or Blocked Please Check Again';
    echo (json_encode($rows));
    $conn->close();
    exit;
  }
}
echo (json_encode($rows));
$conn->close();


