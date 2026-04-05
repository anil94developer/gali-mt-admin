<?php
include("POM_config.php");
mysqli_set_charset($conn, 'utf8');
// $chk_user = mysqli_query($conn, "SELECT * FROM notices");
// $row_chk_user = mysqli_fetch_assoc($chk_user);
// $count_chk_user = mysqli_num_rows($chk_user);
// if($count_chk_user> 0){
    
//     $i = 0;
//     $data  = [];
//     while($rows2 = mysqli_fetch_assoc($chk_user)){
//         $rows['success'] = "1";
//         $rows['message'] = "Success";
//         $rows['data']['i']['description'] =$row_chk_user['description'];
//         $rows['data']['i']['description'] = str_replace('&nbsp;'," ",strip_tags($row_chk_user['description']));
//         $rows['data']['i']['short_description'] = str_replace('&nbsp;'," ",strip_tags($row_chk_user['short_description']));
//         $i++;
//     }
//     echo (json_encode($rows));
//     exit;
    
// }else{
//     $rows['status'] = 0;
//     $rows['message'] = "Sorry no data found";
//     echo (json_encode($rows));
//     exit; 
// }

date_default_timezone_set('Asia/Kolkata');
$sqluser = mysqli_query($conn, "SELECT * FROM app_notices ");
$count = mysqli_num_rows($sqluser);

if ($count > 0) {

	$i = 0;
	$data = [];
	while ($row2 = mysqli_fetch_assoc($sqluser)) {
		$rt['title'] = $row2['title'];
		$rt['description'] = $row2['description'];
		$rt['description'] = str_replace('&nbsp;'," ",strip_tags($row2['description']));
		$rt['is_display'] = $row2['is_display'];
		$rt['date'] = $row2['created_at'];
		$data[] = $rt;
		$i++;
	}
	$url = $baseUrl;
	echo (json_encode(['status' => 1, 'message' => 'suceess', 'data' => $data]));
	$conn->close();
	
}

?>



