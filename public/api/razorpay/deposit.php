<?php
include('config.php');
require('razorpay-php/Razorpay.php');
session_start();
 $userid = $_GET['userid'];
$amountn = $_GET['amount'];
$email = $_GET['email'];
$name = $_GET['name'];
$contact = $_GET['contact'];
$getaway = $_GET['getaway']; 
?>
<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width,minimum-scale=1.0, maximum-scale=1.0" />
    <title>Kalyan Star line</title>
	<link rel="stylesheet" href="css/style.css"> 
	<body>
<!-- 	<img style="max-width: 100px;" src="http://eyuktisolution.com/delhisatta/images/klyan-starlineLogo.png">
 -->	
 <?php
echo '<h2>'.$amountn.' INR </h2>'; 
      function generateRandomString($length = 8) {
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
    'receipt'         => 3456,
    'amount'          => $amountn * 100, // 2000 rupees in paise
    'currency'        => 'INR',
    'payment_capture' => 1 // auto capture
];

$razorpayOrder = $api->order->create($orderData);

$razorpayOrderId = $razorpayOrder['id'];

$_SESSION['razorpay_order_id'] = $razorpayOrderId;

$displayAmount = $amount = $orderData['amount'];

if ($displayCurrency !== 'INR')
{
    $url = "https://api.fixer.io/latest?symbols=$displayCurrency&base=INR";
    $exchange = json_decode(file_get_contents($url), true);
    $displayAmount = $exchange['rates'][$displayCurrency] * $amount / 100;
}

  
 
$trnsid='0';
$status='In Process';
$trnstype='desposite';
$newcoins = $amountn; 
$getaway='razorpay';

//$insertquery =mysqli_query($conn,"update users set coins='".$newcoins."' WHERE id='".$userid."'");

 $sqlr="INSERT INTO `payment` (`pid`, `uid`, `orderid`, `trnsid`, `status`, `trnstype`, `amount`, `getway`) VALUES (NULL, '".$userid."','".$orderid."','".$razorpayOrderId."', '".$status."','".$trnstype."','".$newcoins."','".$getaway."')";
 $result = mysqli_query($conn, $sqlr);
 //echo $sqlr;

$data = [
    "key"               => $keyId,
    "amount"            => $amount,
    "name"              => "Babaji Club",
    "description"       => "Babaji Club Shoping",
    "image"             => "",
    "prefill"           => [
    "name"              => $name,
    "email"             => $email,
    "contact"           => $contact,
    ],
    "notes"             => [
    "address"           => "Hello World",
    "merchant_order_id" => "12312321",
    ],
    "theme"             => [
    "color"             => "#F37254"
    ],
    "order_id"          => $razorpayOrderId,
	"userid"             => $userid,
	"horderid"             => $orderid,
	"orderamount"           => $amountn,
	"mobile"           => $contact,
	"emailid"           => $email,
];

if ($displayCurrency !== 'INR')
{
    $data['display_currency']  = $displayCurrency;
    $data['display_amount']    = $displayAmount;
}

$json = json_encode($data);

if($getaway=='cashfree'){ 
require("checkout/cashfree.php");
//echo 'testcnjkmv n,mcv mkxc jlxcv j';
}


 if($getaway=='razorpay'){
require("checkout/automatic.php");
 }
 if($getaway=='paypal'){
	 $paypaldata = [	
	"userid"             => $userid,
	"order_id"             => $orderid,
	"orderamount"           => $amountn,
	"mobile"           => $contact,
	"emailid"           => $email,
	 ];
	 $json = json_encode($paypaldata);
	 
require("checkout/paypal.php");
 }
?> 
 </body>
</html>