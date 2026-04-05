<?php
include("POM_config.php");
$appId = $_POST['app_id'];
$user_id = $_POST['user_id'];
$dev_id = $_POST['dev_id'];
$market_id = $_POST['market_id'];
$type = $_POST['type']; /// 1 for all 2 for filter
$from = $_POST['from']; ///ddmmyyyy
$to = $_POST['to'];

// echo $appId . $user_id  . $dev_id  . $market_id ;

if ($user_id == '' && $appId == '' && $dev_id == '' && $market_id == '') {
  $rows['success'] = "0";
  $rows['message'] = "Error Plaese Fill All Details";
  echo (json_encode($rows));
  exit;
} else {
  // echo $conn;
  $sqluser = mysqli_query($conn, "SELECT * FROM us_reg_tbl WHERE device_id ='" . $dev_id . "' AND user_id='" . $user_id . "' AND app_id = '" . $appId . "'");
  $count = mysqli_num_rows($sqluser);

  if ($count > 0) {
    $allMarkets = mysqli_query($conn, "SELECT * FROM comx_appmarkets WHERE app_id = '" . $appId . "' AND market_id = '$market_id'");
    $countMarkets = mysqli_num_rows($allMarkets);
    if ($countMarkets > 0) {
      $rows['status'] = "1";
      $rows['message'] = "Successfully Markets Fetched";
      $marketData = mysqli_fetch_assoc($allMarkets);

      if ($type == '1') {
        $getResult = mysqli_query($conn, "SELECT * FROM results_tbls WHERE app_id = '" . $appId . "' AND market_id = '$market_id'");
      } else if ($type == '2') {
        if ($from != '' || $to == '') {
          $getResult = mysqli_query($conn, "SELECT * FROM results_tbls WHERE app_id = '" . $appId . "' AND market_id = '$market_id' AND date = '$from'");
        }

        if ($from != '' && $to != 'to') {
          // die('pppp');
          // die('pppp');
          /* echo "SELECT * FROM results_tbls WHERE app_id = '".$appId."' AND market_id = '$market_id' AND STR_TO_DATE(date,'%Y-%m-%d')  between '".date('Y-m-d',strtotime($from))."' and '".date('Y-m-d',strtotime($to))."' order by id desc"*/

          $getResult = mysqli_query($conn, "SELECT * FROM results_tbls WHERE app_id = '" . $appId . "' AND market_id = '$market_id' AND date between '$from' and '$to' order by id desc");
        }
      }
      $countResult = mysqli_num_rows($getResult);
      if ($countResult > 0) {

        $i = 0;
        while ($resultData = mysqli_fetch_assoc($getResult)) {
          $rows['data'][$i]['result'] = $resultData['result'];
          $rows['data'][$i]['date'] = $resultData['date'];
          $i++;
        }
      } else {
        $rows['status'] = "0";
        $rows['message'] = "No Chart Result Found In This Date Range";
      }
    } else {
      $rows['status'] = "0";
      $rows['message'] = "No Chart Result Found";
    }
  } else {
    $rows['status'] = "0";
    $rows['message'] = "User Not Available Or Blocked";
  }
}
echo (json_encode($rows));
$conn->close();
exit;

