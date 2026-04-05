<?php
date_default_timezone_set('Asia/Kolkata');  
error_reporting(E_ALL & ~E_NOTICE);
$servername = "localhost";
$username = "kduser";
$password = "Krishan001@123";
$database = "kd_game";

 $single_akda_digits = serialize(array(1,2,3,4,5,6,7,8,9,0));
 define('SINGLE', $single_akda_digits);

 $jodi_bet_number = serialize(array(00,01,02,03,04,05,06,07,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64,65,66,67,68,69,70,71,72,73,74,75,76,77,78,79,80,81,82,83,84,85,86,87,88,89,90,91,92,93,94,95,96,97,98,99));
define('JODI', $jodi_bet_number);

 $sp_bet_number = serialize(array(127,235,569,136,370,578,145,389,190,460,280,479,128,290,579,137,380,678,146,470,236,489,245,560,129,246,589,138,345,679,147,390,156,480,237,570,120,247,670,139,256,689,148,346,157,490,238,580,130,248,680,149,257,789,158,347,167,356,239,590,140,258,690,159,267,780,168,348,230,357,249,456,123,259,457,150,268,790,169,349,178,358,240,367,124,278,467,160,340,890,179,359,250,368,269,458,125,279,468,134,350,567,170,369,189,378,260,459,126,289,478,135,360,568,180,379,270,450,234,469));
define('SP', $sp_bet_number);

 $dp_bet_number = serialize(array(226,668,488,118,334,299,550,244,677,100,335,344,119,399,155,588,227,669,200,336,499,110,660,228,688,255,778,300,355,445,166,599,229,779,337,788,400,338,446,112,455,220,699,266,770,500,339,366,113,447,122,799,177,889,600,448,466,114,556,277,880,330,899,700,223,377,115,449,133,557,188,566,800,288,440,116,477,224,558,233,990,900,255,388,117,559,144,577,199,667));

 define('DP', $dp_bet_number);
 $tp_bet_number = serialize(array(9000,111,222,333,444,555,666,777,888,999));
 define('TP', $tp_bet_number);



$conn = new mysqli($servername, $username, $password, $database );

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 



//TEST
//$keyId = 'rzp_test_USH6cE4ebZSkEL';
//$keySecret = 'w9ukWaWywsHobTuI1pLoT4fQ';
//$displayCurrency = 'INR';

//LIVE


//$keyId = 'rzp_test_JNVlAZytuISjxg';
$keyId = 'rzp_live_kioycJ1TzTBnwK';
$keySecret = 'ZEVrhrd5xIDEiDaciqe8nCaC';

$displayCurrency = 'INR';


$cofingmode = "PROD"; //<------------ Change to TEST for test server, PROD for production


 
?> 
