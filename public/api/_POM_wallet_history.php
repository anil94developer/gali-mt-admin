<?php
include("POM_config.php");
$devId     = $_POST['dev_id'];
$appId     = $_POST['app_id'];
$usrId     = $_POST['user_id'];
// $fltDate     = $_POST['flt_date'];
// $tblCode     = $_POST['tbl_code'];
// $dataType     = $_POST['type'];  ///1 = transactions 2 = history 3 me pending withdraw history only

if ($appId == '' || $devId == '' || $usrId == '') {

	$rows['success'] = "0";
	$rows['message'] = "Error Plaese Fill All Details";
	echo (json_encode($rows));
	exit;
} else {


	$chk_user = mysqli_query($conn, "SELECT * FROM us_reg_tbl WHERE user_id ='" . $usrId . "' AND app_id = '" . $appId . "' AND user_status = '1'");
	$row_chk_user = mysqli_fetch_assoc($chk_user);
	$count_chk_user = mysqli_num_rows($chk_user);


	if ($count_chk_user > 0) {

		$sqler = mysqli_query($conn, "SELECT * FROM `point_table` WHERE  app_id = '" . $appId . "' AND user_id = '" . $usrId . "' AND is_deleted = '0' AND tr_nature IN('TRDEPO002','TRWITH003')  ORDER BY id DESC");
		$count = mysqli_num_rows($sqler);

		if ($count > 0) {


			$i = 0;
			while ($row2 = mysqli_fetch_assoc($sqler)) {
				// $table_id =	$row2['game_type'];
				$trans_nature =	$row2['tr_nature'];
				$market_id =	$row2['table_id'];


				// $tblcodeid = mysqli_query($conn, "SELECT * FROM `tbl_types` WHERE  app_id = '" . $appId . "' AND tbl_code = '" . $table_id . "'");
				// $countid = mysqli_num_rows($tblcodeid);

				// $tblcodeData = mysqli_fetch_assoc($tblcodeid);



				//$trns_name = mysqli_query($conn, "SELECT * FROM `tr_type` WHERE  app_id = '" . $appId . "' AND tr_type_code = '" . $trans_nature . "'");

				$trns_name = mysqli_query($conn, "SELECT * FROM `tr_type` WHERE  tr_type_code = '" . $trans_nature . "'");


				$trncount = mysqli_num_rows($trns_name);

				$trnstypeName = mysqli_fetch_assoc($trns_name);



				$slot_name = mysqli_query($conn, "SELECT * FROM `comx_appmarkets` WHERE  app_id = '" . $appId . "' AND market_id = '" . $market_id . "'");
				$slot_count = mysqli_num_rows($slot_name);

				$slotData = mysqli_fetch_assoc($slot_name);


				$rows['success'] = "1";
				$rows['message'] = "PointData details success";
				$rows['data'][$i] = $row2;





				// if ($countid > 0) {
				// 	$rows['data'][$i]['game_type'] = $row2['game_type'];
				// 	// $rows['data'][$i]['game_type'] = $tblcodeData['tbl_name'];
				// } else {
				// 	$rows['data'][$i]['game_type'] = 'Table Not Found';
				// }


				if ($trncount > 0) {
					$rows['data'][$i]['transaction_name'] = $trnstypeName['tr_type_name'];
				} else {
					$rows['data'][$i]['transaction_name'] = 'Other';
				}


				if ($slot_count > 0) {
					$rows['data'][$i]['market_name'] = $slotData['market_name'];
				} else {
					$rows['data'][$i]['market_name'] = 'NFS';
				}






				$i++;
			}
		} else {

			$rows['success'] = "0";
			$rows['message'] = "No data Available Or May Be Something went wrong";
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

echo (json_encode($rows));
