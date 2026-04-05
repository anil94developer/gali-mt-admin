<?php
// die('pppp');
include('api/POM_config.php');
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
   <meta name="description" content="Dubai King, Gali satta, satta king, Satta matka, Matka result, Faridabad satta, Gaziyabad satta, babajisatta, baba ji satta, sattaking, Matka, matka on line, matka game result, satta, satta chart, satta matka, satta bazar, satta matta matka 143, Indian satta, kalyan chart, kalyan open, Satta result, Disawar satta, Baba satta, Baba ji satta" />
   <meta name="keywords" content="Dubai King, babajisatta, baba ji satta, sattaking, Satta, Satta king, Satta result, sattaresult, Gali satta, Disawar satta, Satta king up, Satta result, Satta king result, Satta king online, Gali result, Desawar result, Satta king chart, Satta king live, Gali satta, Deshawar live result, Gali live result, Satta matka, Satta matka king, Satta king up, Satta king 2020 chart, Satta king desawar, Satta king gali, Gali live result, Disawar live result, Satta Number, Satta Game, Gali Number, Delhi Satta king, Satta Bazar, Black satta king, Gali Single Jodi, Black Satta Result, Gali satta king result, Disawar satta king result, Faridabad satta king result, Gaziyabad satta king" />
   <link rel="icon" href="assets/favicon.ico" type="image/x-icon">
    <!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-0NRW16WKD4"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-0NRW16WKD4');
</script>
<?PHP
   if(isset($_REQUEST['month']))
{
   $month_name = date("F", strtotime($_REQUEST['month']));
}
else
{
$month_name = date('F');
}
?>
<style>
   td, th{min-width: 68px}
   html, section{background: black;}
</style>

</head>

<body>
  
   </div>

   <div class="col-md-12 col-sm-12 col-xs-12" style="padding-top:10px;padding-bottom:10px; text-align:center">
      <form class="form-group" method="GET" action="">
      <div class="row">   
         <div class="col-6" style="float:left;margin-left:15%">
      <select name="month" class="form-control" >
               <option value="">Select Month</option>
               <?PHP
               for ($i = 0; $i < 2; $i++) {
                  if(date('F', strtotime("-$i month"))==$month_name)
                  {
                     ?>
                     <option selected value="<?=date('Y-m', strtotime("-$i month"))?>"><?=date('F Y', strtotime("-$i month"))?></option>
                     <?PHP
                  }
                  else
                  {
                     ?>
                     <option  value="<?=date('Y-m', strtotime("-$i month"))?>"><?=date('F Y', strtotime("-$i month"))?></option>
                     <?PHP
                  }
                
               }
               ?>
         </select>
            </div>
            <div class="col-6" style="float:left"> 
         <button type="submit" style="height:35px; padding:5px 20px ;background-color:blue; color:#FFF" class="btn btn-info" name="submit">Get Result</button>
            </div>
            </div>
      </form>

   </div>

   <section style="width:100%; margin: auto;color: white;">
   <h1 style="color:white;"> <?=$month_name?> Month Result</h1>
   <table width="100%" class="rtable" style="border:1px thin; text-align:center;color:white" cellpadding="0" cellspacing="0" border="1" align="center;">
         <tbody></tbody>
            <tr>
               <td style="background-color:#ffff79; color:#FF0000; font-size:12px; font-weight:bold; padding: 0px 2px 0px 2px;">Date</td>

               <td style=" border-color:#000; background-color:#ffff79; color:#FF0000; font-size:12px; font-weight:bold; padding: 0px 2px 0px 2px;">MAFIYA NIGHT</td>

               <td style=" border-color:#000; background-color:#ffff79; color:#FF0000; font-size:12px; font-weight:bold; padding: 0px 2px 0px 2px;">DISAWER</td>

               <td style=" border-color:#000; background-color:#ffff79; color:#FF0000; font-size:12px; font-weight:bold; padding: 0px 2px 0px 2px;">FARIDABAD</td>

               <td style=" border-color:#000; background-color:#ffff79; color:#FF0000; font-size:12px; font-weight:bold; padding: 0px 2px 0px 2px;">GAZIYABAD</td>

               <td style=" border-color:#000; background-color:#ffff79; color:#FF0000; font-size:12px; font-weight:bold; padding: 0px 2px 0px 2px;">GALI</td>

               <td style=" border-color:#000; background-color:#ffff79; color:#FF0000; font-size:12px; font-weight:bold; padding: 0px 2px 0px 2px;">INDIA CLUB</td>
               <td style=" border-color:#000; background-color:#ffff79; color:#FF0000; font-size:12px; font-weight:bold; padding: 0px 2px 0px 2px;">SHIV SHAKTI</td>
               <td style=" border-color:#000; background-color:#ffff79; color:#FF0000; font-size:12px; font-weight:bold; padding: 0px 2px 0px 2px;">SHREE GANESH</td>
               <td style=" border-color:#000; background-color:#ffff79; color:#FF0000; font-size:12px; font-weight:bold; padding: 0px 2px 0px 2px;">DEV DARSHAN</td>
               <td style=" border-color:#000; background-color:#ffff79; color:#FF0000; font-size:12px; font-weight:bold; padding: 0px 2px 0px 2px;">DELHI BAZAR</td>
               <td style=" border-color:#000; background-color:#ffff79; color:#FF0000; font-size:12px; font-weight:bold; padding: 0px 2px 0px 2px;">SILVER CITY</td>
               <td style=" border-color:#000; background-color:#ffff79; color:#FF0000; font-size:12px; font-weight:bold; padding: 0px 2px 0px 2px;">LONDON BAZAR</td>
               <td style=" border-color:#000; background-color:#ffff79; color:#FF0000; font-size:12px; font-weight:bold; padding: 0px 2px 0px 2px;">NEPAL BORDER</td>
               <td style=" border-color:#000; background-color:#ffff79; color:#FF0000; font-size:12px; font-weight:bold; padding: 0px 2px 0px 2px;">HR //  20</td>
               <td style=" border-color:#000; background-color:#ffff79; color:#FF0000; font-size:12px; font-weight:bold; padding: 0px 2px 0px 2px;">Morning Start</td>
               
              </tr>
			          <?php

function get_result_by_date_market($date,$mid)
{
	 global $conn;
	 $query = "SELECT * FROM demo_results_tbls where date='".$date."' and market_id='".$mid."'";
     $result = mysqli_query($conn, $query);
	 $fetch = mysqli_fetch_assoc($result);
	 if(count((array)$fetch)>0)
	 {
	  return $fetch['result'];
	 }
	 else
	 {
		return "";
	 }
	 
	 
}
if(isset($_REQUEST['month']))
{
   $month = date("m", strtotime($_REQUEST['month']));
   $year = date("Y", strtotime($_REQUEST['month']));
}
else
{
$month = date('m');
$year = date('Y');
}
$start_date = "01-".$month."-".$year;
$start_time = strtotime($start_date);

$end_time = strtotime("+1 month", $start_time);

                     $a = 'DISAW';
                     $b = 'FARID';
                     $c = 'GAZIA';
                     $d = 'GALI';
                     $e = 'INDIA';
                      for($i=$start_time; $i<$end_time; $i+=86400)
                         {
                  ?>
                     <tr class="tr1">
                        <td height="29" style="background-color:#ffff79;color:black;"><span class="fon" style="font-size:12px;color:#FF0000">
                              <?=date('d-m-Y', $i)?></span></td>
                        <td> <?=get_result_by_date_market(date('Y-m-d', $i),'MAFIY')?> </td>
                         <td> <?=get_result_by_date_market(date('Y-m-d', $i),'DISAW')?> </td>
                        <td> <?=get_result_by_date_market(date('Y-m-d', $i),'FARID')?> </td>
                        <td> <?=get_result_by_date_market(date('Y-m-d', $i),'GAZIA')?> </td>
                        <td> <?=get_result_by_date_market(date('Y-m-d', $i),'GALI')?> </td>
                        <td> <?=get_result_by_date_market(date('Y-m-d', $i),'INDIA')?> </td>
                        <td> <?=get_result_by_date_market(date('Y-m-d', $i),'SHIV')?> </td>
                        <td> <?=get_result_by_date_market(date('Y-m-d', $i),'SHREE')?> </td>
                        
                        <td> <?=get_result_by_date_market(date('Y-m-d', $i),'DEV D')?> </td>
                        <td> <?=get_result_by_date_market(date('Y-m-d', $i),'DELHI')?> </td>
                        <td> <?=get_result_by_date_market(date('Y-m-d', $i),'SILVE')?> </td>
                        <td> <?=get_result_by_date_market(date('Y-m-d', $i),'LONDO')?> </td>
                        <td> <?=get_result_by_date_market(date('Y-m-d', $i),'NEPAL')?> </td>
                        <td> <?=get_result_by_date_market(date('Y-m-d', $i),'HR //')?> </td>
                        <td> <?=get_result_by_date_market(date('Y-m-d', $i),'MORNI ')?> </td>
                        

                     </tr>
                  <?php
                    }
                  ?>
               </table>
               <a style="text-align: center;
    color: black;
    font-size: 21px;
    text-transform: uppercase;
    background: black;
    color: white;margin-left: 5%;" href="https://babajiisatta.com/">For more result click here>></a>
   <h1 style="color:black;opacity:0;">Babaji</h1>
   </section>
   
</body>

</html>