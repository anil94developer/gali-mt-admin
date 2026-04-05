<?php
include('POM_config.php');
$maxDays = date('t');
$limit = $maxDays;
if (isset($_GET['page'])) {
   $page = $_GET['page'];
} else {
   $page = 1;
}
$offset = ($page - 1) * $limit;
?>

<!DOCTYPE html>
<html lang="en-us">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
   <title>Dubai King | Satta king | Gali satta | Satta result | सट्टा किंग | Disawar satta</title>
   <link rel="stylesheet" href="css/style1.css">
   <link rel="stylesheet" href="css/bootstrap.min.css">
   <link rel="stylesheet" href="css/style.css">
   <meta name="viewport" content="width=device-width,initial-scale=1">
   <meta name="description"
      content="Dubai King, Gali satta, satta king, Satta matka, Matka result, Faridabad satta, Gaziyabad satta, Dubai King, Dubai King, sattaking, Matka, matka on line, matka game result, satta, satta chart, satta matka, satta bazar, satta matta matka 143, Indian satta, kalyan chart, kalyan open, Satta result, Disawar satta, Baba satta, Dubai King" />
   <meta name="keywords"
      content="Dubai King, Dubai King, Dubai King, sattaking, Satta, Satta king, Satta result, sattaresult, Gali satta, Disawar satta, Satta king up, Satta result, Satta king result, Satta king online, Gali result, Desawar result, Satta king chart, Satta king live, Gali satta, Deshawar live result, Gali live result, Satta matka, Satta matka king, Satta king up, Satta king 2020 chart, Satta king desawar, Satta king gali, Gali live result, Disawar live result, Satta Number, Satta Game, Gali Number, Delhi Satta king, Satta Bazar, Black satta king, Gali Single Jodi, Black Satta Result, Gali satta king result, Disawar satta king result, Faridabad satta king result, Gaziyabad satta king" />
   <link rel="icon" href="assets/favicon.ico" type="image/x-icon">
   <!-- Google tag (gtag.js) -->
   <script async src="https://www.googletagmanager.com/gtag/js?id=G-0NRW16WKD4"></script>
   <script>
      window.dataLayer = window.dataLayer || [];
      function gtag() { dataLayer.push(arguments); }
      gtag('js', new Date());

      gtag('config', 'G-0NRW16WKD4');
   </script>
   <?PHP
   if (isset($_REQUEST['month'])) {
      $month_name = date("F", strtotime($_REQUEST['month']));
   } else {
      $month_name = date('F');
   }
   ?>
   <style>
      td,
      th {
         min-width: 68px
      }

      html,
      section {
         background: black;
      }
   </style>

</head>

<body>
   <?php
   if(isset($_POST['submit'])){
      // die('pppppp');
   }
   ?>

   </div>
     
   <div class="col-md-12 col-sm-12 col-xs-12" style="padding-top:10px;padding-bottom:10px; text-align:center">
      <!-- <form class="form-group" method="post"> -->
         <div class="row">
            <div class="col-6" style="float:left;margin-left:15%">
               <select name="month" id="month" class="form-control">
                  <option value="">Select Month</option>
                  <?PHP
                  for ($i = 0; $i < 2; $i++) {  ?>
                        <option value="<?= date('Y-m', strtotime("-$i month")) ?>">
                           <?= date('F Y', strtotime("-$i month")) ?>
                        </option>
                        <?PHP
                     }

                  // }
                  ?>
               </select>
            </div>
            <!-- <div class="col-6" style="float:left">
               <button type="button" style="height:35px; padding:5px 20px ;background-color:blue; color:#FFF"
                  class="btn btn-info" name="submit" id="submitfilter" value="submit" onClick={handleFilterSubmit} >Get Result</button>
            </div> -->
         </div>
      <!-- </form> -->

   </div>

   <section style="width:100%; margin: auto;color: white;">
      <span style="color:white; margin-top: 30px; display: block; font-size: 20px;" class="month_cahnge" id="month_cahnge">
      </span>
      <table width="100%" class="rtable" style="border:1px thin; text-align:center;color:white" cellpadding="0"
         cellspacing="0" border="1" align="center;">
         <tbody></tbody>
         <tr>
            <td
               style="background-color:#ffff79; color:#FF0000; font-size:12px; font-weight:bold; padding: 0px 2px 0px 2px;">
               Date</td>
            <td
               style=" border-color:#000; background-color:#ffff79; color:#FF0000; font-size:12px; font-weight:bold; padding: 0px 2px 0px 2px;">
               SHREE GANESH</td>
            <td
               style=" border-color:#000; background-color:#ffff79; color:#FF0000; font-size:12px; font-weight:bold; padding: 0px 2px 0px 2px;">
               RAJDHANI GOLD</td>
            <td
               style=" border-color:#000; background-color:#ffff79; color:#FF0000; font-size:12px; font-weight:bold; padding: 0px 2px 0px 2px;">
               AVADH EXPRESS</td>
            <td
               style=" border-color:#000; background-color:#ffff79; color:#FF0000; font-size:12px; font-weight:bold; padding: 0px 2px 0px 2px;">
               GAZIABAAD</td>
            <td
               style=" border-color:#000; background-color:#ffff79; color:#FF0000; font-size:12px; font-weight:bold; padding: 0px 2px 0px 2px;">
               GALI</td>
            <td
               style=" border-color:#000; background-color:#ffff79; color:#FF0000; font-size:12px; font-weight:bold; padding: 0px 2px 0px 2px;">
               DISAWAR</td>
            <td
               style=" border-color:#000; background-color:#ffff79; color:#FF0000; font-size:12px; font-weight:bold; padding: 0px 2px 0px 2px;">
               FARIDABAAD</td>
            <td
               style=" border-color:#000; background-color:#ffff79; color:#FF0000; font-size:12px; font-weight:bold; padding: 0px 2px 0px 2px;">
               MATKA MARKET</td>
            <td
               style=" border-color:#000; background-color:#ffff79; color:#FF0000; font-size:12px; font-weight:bold; padding: 0px 2px 0px 2px;">
               DUBAI KING</td>
            <td
               style=" border-color:#000; background-color:#ffff79; color:#FF0000; font-size:12px; font-weight:bold; padding: 0px 2px 0px 2px;">
               LAKSHMI DARBAR</td>
            <td
               style=" border-color:#000; background-color:#ffff79; color:#FF0000; font-size:12px; font-weight:bold; padding: 0px 2px 0px 2px;">
               DELHI BAZAAR</td>
            <td
               style=" border-color:#000; background-color:#ffff79; color:#FF0000; font-size:12px; font-weight:bold; padding: 0px 2px 0px 2px;">
               TAJ</td>
         </tr>
         <script type="text/javascript" src="https://code.jquery.com/jquery-1.7.1.min.js"></script>
         <script>
            
            $('#month').on('change',function(){
               var conceptName = $('#month').find(":selected").val();
               document.cookie = "var1="+conceptName;
               // var webView = document.getElementById("webView");
               // webView.contentWindow.location.reload();
               // window.location.reload();
              
               
            "<?php
                $phpVar =  $_COOKIE['var1'];
            ?>";
            });
            
         </script>
       

         <?php

      

         function get_result_by_date_market($date, $mid)
         {
            global $conn;
            $query = "SELECT * FROM results_tbls where date='" . $date . "' and market_id='" . $mid . "'";
            $result = mysqli_query($conn, $query);
            $fetch = mysqli_fetch_assoc($result);
            if (count((array) $fetch) > 0) {
               return $fetch['result'];
            } else {
               return "";
            }


         }
         if ($phpVar) {
            // die('pppp');
            $month = date("m", strtotime($phpVar));
            $monthExtra = date("F", strtotime($phpVar));
            $year = date("Y", strtotime($phpVar));
            echo "<script>$('.month_cahnge').html('".$monthExtra." Month Data');</script>";
         } else {
            $month = date('m');
            $year = date('Y');
            if($month == '02'){
               $alph = "Febuary";
            }
            elseif($month == '03'){
               $alph = "March";
            }
            elseif($month == '04'){
               $alph = "April";
            }
            elseif($month == '05'){
               $alph = "May";
            }
            elseif($month == '06'){
               $alph = "June";
            }
            elseif($month == '07'){
               $alph = "July";
            }
            elseif($month == '08'){
               $alph = "Auguest";
            }
            elseif($month == '09'){
               $alph = "September";
            }
            elseif($month == '10'){
               $alph = "Octomber";
            }
            elseif($month == '11'){
               $alph = "November";
            }
            elseif($month == '12'){
               $alph = "December";
            }
            echo "<script>$('.month_cahnge').html('".$alph." Month Data');</script>";
         }
         $start_date = "01-" . $month . "-" . $year;
         $start_time = strtotime($start_date);

         $end_time = strtotime("+1 month", $start_time);

         $a = 'DISAW';
         $b = 'FARID';
         $c = 'GAZIA';
         $d = 'GALI';
         $e = 'INDIA';
         for ($i = $start_time; $i < $end_time; $i += 86400) {
            ?>
            <tr class="tr1">
               <td height="29" style="background-color:#ffff79;color:black;"><span class="fon"
                     style="font-size:12px;color:#FF0000">
                     <?= date('d-m-Y', $i) ?>
                  </span></td>
               <td>
                  <?= get_result_by_date_market(date('d-m-Y', $i), 'SHREEGANESH') ?>
               </td>
               <td>
                  <?= get_result_by_date_market(date('d-m-Y', $i), 'RAJDHANIGOLD') ?>
               </td>
               <td>
                  <?= get_result_by_date_market(date('d-m-Y', $i), 'AVADHEXPRESS') ?>
               </td>
               <td>
                  <?= get_result_by_date_market(date('d-m-Y', $i), 'GAZIABAAD') ?>
               </td>
               <td>
                  <?= get_result_by_date_market(date('d-m-Y', $i), 'GALI') ?>
               </td>
               <td>
                  <?= get_result_by_date_market(date('d-m-Y', $i), 'DISAWAR') ?>
               </td>
               <td>
                  <?= get_result_by_date_market(date('d-m-Y', $i), 'FARIDABAAD') ?>
               </td>
               <td>
                  <?= get_result_by_date_market(date('d-m-Y', $i), 'MATKAMARKET') ?>
               </td>
               
               <td>
                  <?= get_result_by_date_market(date('d-m-Y', $i), 'LAKSHMIDARBAR') ?>
               </td>
               <td>
                  <?= get_result_by_date_market(date('d-m-Y', $i), 'DELHIBAZAAR') ?>
               </td>
               <td>
                  <?= get_result_by_date_market(date('d-m-Y', $i), 'TAJ') ?>
               </td>
            </tr>
            <?php
         }
         ?>
      </table>
      <!-- <a style="text-align: center;
    color: black;
    font-size: 21px;
    text-transform: uppercase;
    background: black;
    color: white;margin-left: 5%;" href="#">For more result click here>></a> -->
      <h1 style="color:black;opacity:0;">Dubai King</h1>
   </section>

</body>

</html>