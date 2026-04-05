<?php

include('config.php');
require('razorpay-php/Razorpay.php');
session_start();
$userid = $_GET['user_id'];
$amountn = $_GET['amount'];
$email = $_GET['email'];
$name = $_GET['name'];
$contact = ""; //$_GET['contact'];
$getaway = $_GET['getaway'];
?>
<!doctype html>
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width,minimum-scale=1.0, maximum-scale=1.0" />
	<title>dubaiking</title>
	<link rel="stylesheet" href="css/style.css">

<body>
	<b>इस CODE का स्क्रीन शॉट लेकर किसी भी पेमेंट ऐप से SCAN करके पेमेंट कर सकते हो आप </b>
	<?php
	function generateRandomString($length = 8)
	{
		$characters = '0123456789';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
	$orderid = generateRandomString();


	// Create the Razorpay Order
	
	use Razorpay\Api\Api;

	$api = new Api($keyId, $keySecret);



	//
// We create an razorpay order using orders api
// Docs: https://docs.razorpay.com/docs/orders
//
	$orderData = [
		'receipt' => 3456,
		'amount' => $amountn * 100,
		// 2000 rupees in paise
		'currency' => 'INR',
		'payment_capture' => 1 // auto capture
	];

	$razorpayOrder = $api->order->create($orderData);



	$razorpayOrderId = $razorpayOrder['id'];

	//$_SESSION['razorpay_order_id'] = $razorpayOrderId;
	
	$displayAmount = $amount = $orderData['amount'];

	if ($displayCurrency !== 'INR') {
		$url = "https://api.fixer.io/latest?symbols=$displayCurrency&base=INR";
		$exchange = json_decode(file_get_contents($url), true);
		$displayAmount = $exchange['rates'][$displayCurrency] * $amount / 100;
	}



	$trnsid = '0';
	$status = 'In Process';
	$trnstype = 'desposite';
	$newcoins = $amountn;
	//$getaway='razorpay';
	
	$res1 = mysqli_query($conn, "select mob from us_reg_tbl where user_id='" . $userid . "'");
	$rdata = mysqli_fetch_array($res1);

	//$insertquery =mysqli_query($conn,"update users set coins='".$newcoins."' WHERE id='".$userid."'");
	
	$sqlr = "INSERT INTO `payment` (`pid`, `uid`, `orderid`, `trnsid`, `status`, `trnstype`, `amount`, `getway`) VALUES (NULL, '" . $userid . "','" . $orderid . "','" . $razorpayOrderId . "', '" . $status . "','" . $trnstype . "','" . $newcoins . "','" . $getaway . "')";

	$result = mysqli_query($conn, $sqlr);
	//echo $sqlr;
	
	$data = [
		"key" => $keyId,
		"amount" => $amount,
		"name" => "dubaiking",
		"description" => "dubaiking",
		"image" => "https://dubaiking.com/front/assets/images/logo.png",
		"prefill" => [
			"name" => $name,
			"email" => $email,
			"contact" => $contact,
		],
		"notes" => [
			"address" => "Hello World",
			"merchant_order_id" => "12312321",
		],
		"theme" => [
			"color" => "#F37254"
		],
		"order_id" => $razorpayOrderId,
		"userid" => $userid,
		"horderid" => $orderid,
		"orderamount" => $amountn,
		"mobile" => $contact,
		"emailid" => $email,
	];

	if ($displayCurrency !== 'INR') {
		$data['display_currency'] = $displayCurrency;
		$data['display_amount'] = $displayAmount;
	}

	$json = json_encode($data);



	if ($getaway == 'razorpay') {

		$sqlq = mysqli_query($conn, "SELECT getaway FROM payment_setting WHERE status ='1'");
		$row = mysqli_fetch_assoc($sqlq);
		$gv = $row['getaway'];
		if ($gv == "Cashfree") {
			require("checkout/cashfree.php");
		} elseif ($gv == "CcAvanue") {
			require("ccv/index.php");
		} elseif ($gv == "Strip") {
			require("strip/index.php");
		} elseif ($gv == "UPIGATEWAY") {
			require("upigateway/index.php");
		} elseif ($gv == "MCashfree") {
			header('location:https://mahiclub.co.in/api/deposit.php?userid=' . $userid . '&amount=' . $amountn . '&email=' . $email . '&name=' . $name . '&contact=' . $contact . '&getaway=razorpay');

			//require("mcashfree/cashfree.php");
		} elseif ($gv == "MStrip") {
			require("mstrip/index.php");
		} elseif ($gv == "Instamozo") {
			require("instamozo/payment.php");
		} elseif ($gv == "Minstamozo") {
			require("minstamozo/payment.php");
		} elseif ($gv == "Rinstamozo") {
			require("rinstamozo/payment.php");
		} elseif ($gv == "RRazorpay") {

			header('location:https://rkclub.co.in/api/deposit.php?userid=' . $userid . '&amount=' . $amountn . '&email=' . $email . '&name=' . $name . '&contact=' . $contact . '&getaway=razorpay');

			//require("checkout/automatic.php");
		} elseif ($gv == "A2Technosoft") {

			$oid = rand(111, 999) . rand(11, 99);
			header('location:https://a2technosoft.com/ccv/index.php?amount=' . $amountn . '&user_id=' . $userid . '&name=' . $name . '&orderid=' . $oid . '&getaway=atwo' . '&mob=' . $rdata['mob'] . '');
		} elseif ($gv == "MRazorpay") {

			header('location:https://mahiclub.co.in/api/deposit.php?userid=' . $userid . '&amount=' . $amountn . '&email=' . $email . '&name=' . $name . '&contact=' . $contact . '&getaway=razorpay');

			//require("checkout/automatic.php");
		} elseif ($gv == "RCashfree") {
			header('location:https://rkclub.co.in/api/deposit.php?userid=' . $userid . '&amount=' . $amountn . '&email=' . $email . '&name=' . $name . '&contact=' . $contact . '&getaway=razorpay');
			//require("rcashfree/cashfree.php");
		} elseif ($gv == "MCcAvanue") {
			header('location:https://mahiclub.co.in/api/deposit.php?userid=' . $userid . '&amount=' . $amountn . '&email=' . $email . '&name=' . $name . '&contact=' . $contact . '&getaway=razorpay');
			//require("rcashfree/cashfree.php");
		}



	}
	if ($getaway == 'paypal') {
		$paypaldata = [
			"userid" => $userid,
			"order_id" => $orderid,
			"orderamount" => $amountn,
			"mobile" => $contact,
			"emailid" => $email,
		];
		$json = json_encode($paypaldata);

		require("checkout/paypal.php");
	}
	?>
</body>

</html>