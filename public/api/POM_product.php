<?php
include("POM_config.php");

$chk_user = mysqli_query($conn, "SELECT * FROM products");
$row_chk_user = mysqli_fetch_assoc($chk_user);
$count_chk_user = mysqli_num_rows($chk_user);

if ($count_chk_user > 0) {

	$sqler = mysqli_query($conn, "SELECT * FROM products");
	$i = 0;
	while ($row2 = mysqli_fetch_assoc($sqler)) {
		$rows['success'] = "1";
		$rows['message'] = "Product List";
		$rows['url'] = 'https://dubaiking.com/API/public/backend/uploads/product';
		$rows['data'][$i] = $row2;
		$i++;
	}
} else {
	$rows['success'] = '2';
	$rows['message'] = 'Product Not Found';
	echo (json_encode($rows));
	$conn->close();
	exit;
}
echo (json_encode($rows));
$conn->close();
