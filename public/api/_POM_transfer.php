<?php
include("POM_config.php");

$user = $_POST['user_id'];
$dev_id = $_POST['dev_id'];
$appId = $_POST['app_id'];
$mob = $_POST['mob'];
$amount = $_POST['amount'];


$chk_usr_mobile = mysqli_query($conn, "SELECT * FROM us_reg_tbl WHERE mob ='" . $mob . "'");
$count_chk_user = mysqli_fetch_assoc($chk_usr_mobile);
$count = mysqli_num_rows($chk_usr_mobile);
$sum_amt = $count_chk_user['credit'] + $amount;
$name = $count_chk_user['FullName'];
// echo $name; die;

if ($count > 0) {
	if ($appId == '' || $dev_id == '' || $user == '') {
		$rows['success'] = '4';
		$rows['message'] = 'Invalid data iserted try again or if you more wrong try you will block by system';
		echo (json_encode($rows));
		exit;

	} else {


		$chk_user = mysqli_query($conn, "SELECT * FROM us_reg_tbl WHERE user_id ='" . $user . "' AND app_id = '" . $appId . "' AND user_status = '1'");
		$row_chk_user = mysqli_fetch_assoc($chk_user);
		$count_chk_user = mysqli_num_rows($chk_user);


		if ($count_chk_user > 0) {
			if($row_chk_user['credit'] >= $amount)
			{
				$total_amt = $row_chk_user['credit'] - $amount;
				$transfer_amt = mysqli_query($conn, "UPDATE us_reg_tbl SET credit='".$sum_amt."' WHERE mob='".$mob."'");
				$update_amt = mysqli_query($conn, "UPDATE us_reg_tbl SET credit='".$total_amt."' WHERE user_id='".$user."'");
				$rows['success'] = '1';
				$rows['message'] = 'Balance Transfer Successfully';
				$rows['credit'] = (int) $total_amt;
				$rows['FullName'] = $name;
				echo (json_encode($rows));
				exit;
			}else{
				$rows['success'] = '1';
				$rows['message'] = 'Insufficient Balance';
				echo (json_encode($rows));
				exit;
			}

		} else {
			$rows['success'] = '3';
			$rows['message'] = 'User Not Exits Or Blocked Please Check Again';
			echo (json_encode($rows));
			exit;
		}
	}
}else{
	$rows['success'] = '2';
	$rows['message'] = 'User Not Exits';
	echo (json_encode($rows));
	exit;
}