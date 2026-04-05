<?php
include("POM_config.php");


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

$userId = $_POST['userId'];


// echo "<pre>";
// print_r($_POST['userId']);
// echo "</pre>";
// die;


$chk_user = mysqli_query($conn, "SELECT * FROM bank_details WHERE userId ='" . $userId . "'");
$row_chk_user = mysqli_fetch_assoc($chk_user);
// $count_chk_user = mysqli_num_rows($chk_user);

// $i = 1;

// while ($row2 = mysqli_fetch_assoc($chk_user)) {


//     $rows['success'] = "1";
//     $rows['message'] = "List Of Bank Details";
//     $rows['data'][$i] = $row2;


//     $i++;
// }

$rows['success'] = "1";
$rows['message'] = "List Of Bank Details";
$rows['data'] = $row_chk_user;

echo (json_encode($rows));
$conn->close();
exit;
