<?php
include("POM_config.php");
$chk_user = mysqli_query($conn, "SELECT is_app_maintainance,is_app_mentinance2,is_app_mentinance3,is_app_mentinance4,is_app_maintenance5 FROM app_controller");
$row_chk_user = mysqli_fetch_assoc($chk_user);
$count_chk_user = mysqli_num_rows($chk_user);
if ($count_chk_user > 0) {
    $rows['success'] = 1;
    $rows['message'] = 'Successfully';
    $rows['is_app_maintainance'] = (int)$row_chk_user['is_app_maintainance'];
    $rows['is_app_mentinance2'] = (int)$row_chk_user['is_app_mentinance2'];
    $rows['is_app_mentinance3'] = (int)$row_chk_user['is_app_mentinance3'];
    $rows['is_app_mentinance4'] = (int)$row_chk_user['is_app_mentinance4'];
    $rows['is_app_maintenance5'] = (int)$row_chk_user['is_app_maintenance5'];
    echo (json_encode($rows));
    $conn->close();
    exit;
} else {
    $rows['status'] = 0;
    $rows['message'] = 'Sorry no data found';
    echo (json_encode($rows));
    $conn->close();
    exit;
}
