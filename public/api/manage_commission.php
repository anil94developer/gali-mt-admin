<?php
include("POM_config.php");

$devId = $_POST['dev_id'];
$appId = $_POST['app_id'];
$usrId = $_POST['user_id'];

if ($appId == '' || $devId == '' || $usrId == '') {
	$rows['success'] = "0";
	$rows['message'] = "Error Plaese Fill All Details";
	echo (json_encode($rows));
	exit;
} else {

	$chk_user = mysqli_query($conn, "SELECT * FROM user_comissions WHERE user_id = '". $usrId ."'");
	// $chk_user = mysqli_query($conn, "SELECT * FROM user_comissions WHERE user_id = '". $usrId ."' GROUP BY date");
	$row_chk_user = mysqli_fetch_assoc($chk_user);
	$count_chk_user = mysqli_num_rows($chk_user);
	// echo $count_chk_user; die();


	if ($count_chk_user > 0) {

		$sqler = mysqli_query($conn, "SELECT * FROM user_comissions WHERE user_id = '". $usrId ."'");
		// $sqler = mysqli_query($conn, "SELECT * FROM user_comissions WHERE user_id = '". $usrId ."' GROUP BY date");
		$i = 0;
		while ($row2 = mysqli_fetch_assoc($sqler)) {
			$rows['success'] = "1";
			$rows['message'] = "commission List";
			$rows['data'][$i] = $row2;
			$i++;
		}
	} else {
		$rows['success'] = '2';
		$rows['message'] = 'Data Not Found';
		echo (json_encode($rows));
		exit;
	}
}

echo (json_encode($rows));
