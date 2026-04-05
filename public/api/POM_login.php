<?php
include("POM_config.php");
$mobileNum = $_POST['mobileNum'];
$pss       = $_POST['pss'];
$devId     = $_POST['dev_id'];
$appId     = $_POST['app_id'];

// echo "<pre>";
// echo $mobileNum;
// print_r($mobileNum . $pss . $devId . $appId);
// echo "</pre>";
// die;
$auth = md5(uniqid(rand(100000, 999999), true));

function random_strings($length_of_string)
{

    // String of all alphanumeric character
    $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';

    // Shuffle the $str_result and returns substring
    // of specified length
    return substr(str_shuffle($str_result), 
                       0, $length_of_string);
}



if ($mobileNum == '' && $appId == '' && $pss == '' && $devId == '') {

  $rows['success'] = "0";
  $rows['message'] = "Error Plaese Fill All Details";
  echo (json_encode($rows));
  exit;
} else {

  $sqluser = mysqli_query($conn, "SELECT * FROM us_reg_tbl WHERE mob ='" . $mobileNum . "' AND us_pass='" . $pss . "' AND app_id = '" . $appId . "'");
  $count = mysqli_num_rows($sqluser);

  if ($count > 0) {


    $sqluser1 = mysqli_query($conn, "SELECT * FROM device_block WHERE device_id ='" . $devId . "' AND is_blocked = '1'");
    $count1 = mysqli_num_rows($sqluser1);

    if ($count1 > 0) {


      $rows['success'] = "3";
      $rows['message'] = "Your Device Is Blocked Due To Security Happens You will Contact to admin";
    } else {

      $token = random_strings(40);

      $updt = mysqli_query($conn, "Update `us_reg_tbl` SET device_id = '" . $devId . "',  login_token = '" . $token . "'  WHERE mob = '" . $mobileNum . "' AND us_pass = '" . $pss . "' AND app_id = '" . $appId . "'");

      $udata = mysqli_query($conn, "SELECT * FROM us_reg_tbl WHERE mob = '" . $mobileNum . "' AND app_id = '" . $appId . "'");
      $userData = mysqli_fetch_assoc($udata);

      $rows['success'] = "1";
      $rows['message'] = "User Login Success";
      $rows['user_id'] = $userData['user_id'];
      $rows['device_id'] = $userData['device_id'];
      $rows['name'] = $userData['FullName'];
      $rows['mobile'] = $userData['mob'];
      $rows['login_token'] = $userData['login_token'];
      $rows['is_playstore'] = $userData['is_playstore'];
    
    }
  } else {

    $rows['success'] = "0";
    $rows['message'] = "invalid login details";
  }
}


echo (json_encode($rows));
$conn->close();
exit;
