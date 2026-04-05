<?php
// header('Access-Control-Allow-Origin: *');
// header('Access-Control-Allow-Methods: GET, POST');
// header("Access-Control-Allow-Headers: X-Requested-With");

include("POM_config.php");

$user = $_POST['user_id'];
$name = $_POST['name'];
$dob = $_POST['dob'];
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
if ($user == '' or $name == "" or $dob == "") {
	$rows['success'] = '0';
	$rows['message'] = 'Invalid data iserted try again';
	echo (json_encode($rows));
	exit;
} else {
	if (isset($_FILES["profile"]["name"])) {
		$filename = $_FILES["profile"]["name"];
		$tempname = $_FILES["profile"]["tmp_name"];
		$newfilename = date('dmYHis') . str_replace(" ", "", basename($_FILES["profile"]["name"]));
		$folder = "public/user_profile/" . $newfilename;
		// Now let's move the uploaded image into the folder: image
		if (move_uploaded_file($tempname, $folder)) {
			$video = $newfilename;
		} else {
			$video = "";
		}
	}

	$sqlupdtpss = "UPDATE `us_reg_tbl` SET `dob` = '" . $dob . "' , FullName ='" . $name . "',image='" . $video . "' where user_id='" . $user . "'";
	mysqli_query($conn, $sqlupdtpss);
	$chk_user = mysqli_query($conn, "SELECT FullName,dob,image FROM us_reg_tbl WHERE user_id ='" . $user . "'");
	$row = mysqli_fetch_assoc($chk_user);
	$arrayList = array();

	$array = array();
	$array['name'] = $row['FullName'];
	$array['dob'] = $row['dob'];
	$array['image'] = $row['image'];
	$array['image'] = "https://visa.a2logicgroup.com/kgfmatka/public/user_profile/" . $row['image'];

	$arrayList[] = $array;

	$rows['success'] = '1';
	$rows['message'] = 'Updated success';
	$rows['data'] = $arrayList;
	$rows['name'] = $row['FullName'];
	$rows['dob'] = $row['dob'];
	$rows['image'] = $row['image'];
	$rows['imageFull'] = "https://visa.a2logicgroup.com/kgfmatka/public/user_profile/" . $row['image'];

	echo (json_encode($rows));
	$conn->close();
	exit;

}
