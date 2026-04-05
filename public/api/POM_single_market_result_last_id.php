<?php
include("POM_config.php");
// include("dubaiking.php");
$appId = $_POST['app_id'];
$userId = $_POST['user_id'];

// $dev_id = $_POST['dev_id'];

if ($appId == '') {
  $rows['success'] = "0";
  $rows['message'] = "Error Plaese Fill All Details";
  echo (json_encode($rows));
  exit;
} else {
  $date = date('Y-m-d');
  $updateee = mysqli_query($conn, "UPDATE us_reg_tbl SET last_seen = '" . $date . "' WHERE user_id = '" . $userId . "';");

  $rows['status'] = "1";
  $rows['message'] = "Successfully Markets Fetched";
  $getResult = mysqli_query($conn, "SELECT market_id,result FROM results_tbls  ORDER BY id DESC");
  $getResult1 = mysqli_fetch_assoc($getResult);
  $rows['data']['result'] = $getResult1['result'];
  $rows['data']['market_id'] = $getResult1['market_id'];
  //  $getResult = mysqli_query($conn, "SELECT * FROM results_tbls  LEFT JOIN comx_appmarkets ON comx_appmarkets.market_id=results_tbls.market_id ORDER BY id DESC");
  // $getResult1 = mysqli_fetch_assoc($getResult);
  // //var_dump($getResult1);die;
  //     $rows['data']['result'] = $getResult1['result'];
  //     $rows['data']['market_id'] = $getResult1['market_id'];
  //     $rows['data']['market_name'] = $getResult1['market_name'];
}
echo (json_encode($rows));
$conn->close();
exit;
