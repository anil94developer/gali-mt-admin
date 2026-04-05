<?php
include("POM_config.php");

	$chk_user = mysqli_query($conn, "SELECT * FROM app_controller");
	$row_chk_user = mysqli_fetch_assoc($chk_user);
	$count_chk_user = mysqli_num_rows($chk_user);
	// echo $count_chk_user;
	// die;
	if ($count_chk_user > 0) {
		//  $row2['admin_contact_mob'];
		//  $row2['whatsapp'];
		//  $row2['min_deposit'];
		//  $row2['min_redeem'];
		 $row2['admin_contact_mob'] = $row_chk_user['admin_contact_mob'];
		 $row2['whatsapp'] = $row_chk_user['whatsapp'];
		 $row2['user_reg_no'] = $row_chk_user['user_reg_no'];
		 $row2['min_deposit'] = $row_chk_user['min_deposit'];
		 $row2['max_deposit'] = $row_chk_user['max_deposit'];
		 $row2['min_redeem'] = $row_chk_user['min_redeem'];
		 $row2['refferlink'] = $row_chk_user['reffer_link'];
		 $row2['how_to_play'] = $row_chk_user['how_to_play'];
		 $row2['telegram'] = $row_chk_user['telegram'];
		 $row2['withdraw_disable'] = $row_chk_user['withdraw_disable'];
		 $row2['deposit_disable'] = $row_chk_user['deposit_disable'];
		 $row2['version'] = $row_chk_user['version'];
}
	echo (json_encode($row2));
	$conn->close();