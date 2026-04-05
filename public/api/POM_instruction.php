<?php
include("POM_config.php");
$chk_user = mysqli_query($conn, "SELECT * FROM instructions WHERE id ='1'");
$row_chk_user = mysqli_fetch_assoc($chk_user);
$count_chk_user = mysqli_num_rows($chk_user);
if ($count_chk_user > 0) {
    $rows['success'] = "1";
    $rows['message'] = "Success";
    echo (json_encode($row_chk_user));
    $conn->close();
    exit;
} else {
    $rows['status'] = "0";
    $rows['message'] = "Sorry no data found !!";
}
echo (json_encode($rows));
$conn->close();
exit;

