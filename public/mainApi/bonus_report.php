<?PHP
@ob_start();
function isMobile() {
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}	
include("config.php");

function get_played($user_id)
{
	global $conn;
	$sq12=mysqli_query($conn,"SELECT sum(tr_value) as sum FROM point_table WHERE tr_nature ='TRGAME001' and user_id='".$user_id."' and tr_value_type='Debit'");
	$comm1 = mysqli_fetch_assoc($sq12);
	return $comm1['sum'];
}
$user_id=$_GET['user_id'];
$chk_user=mysqli_query($conn, "SELECT ref_code,ref_bonous,total_played FROM us_reg_tbl WHERE user_id ='".$user_id."'");
$row_chk_user = mysqli_fetch_assoc($chk_user);
$chk_user1=mysqli_query($conn, "SELECT user_id,FullName,mob,total_played,my_played,created_at FROM us_reg_tbl WHERE ref_by ='".$row_chk_user['ref_code']."'");
//$chk_user11=mysqli_query($conn, "SELECT user_id,FullName,mob,created_at FROM us_reg_tbl WHERE ref_by ='".$row_chk_user['ref_code']."'");
$comm=mysqli_query($conn, "SELECT ref_comm FROM app_controller");
$comm = mysqli_fetch_assoc($comm);

$sql1=mysqli_query($conn,"SELECT sum(tr_value) as sum FROM point_table WHERE tr_nature ='TRDEPO002' and user_id='".$user_id."' and tr_remark='redeemed'");
$comm1 = mysqli_fetch_assoc($sql1);
$msg="";
$newcoins=0;
    if(isset($_REQUEST['redeem']))
    {
        
        $orderamount= filter_var($_REQUEST['amount'], FILTER_SANITIZE_STRING);
        $comm=$_REQUEST['comm']; //$oamount
        $userid= $user_id;
        $payid=rand(1234,8907).rand(111,999);
        $order_id=rand(1234,8907).rand(111,999);
        $date = date("d-m-Y");
        date_default_timezone_set('Asia/Kolkata');
        $timestamp = time();
        $date_time = date("d-m-Y (D) h:i:s A", $timestamp);
        
        if((int)$orderamount<=(int)$comm and (int)$orderamount>=500 and (int)$orderamount<=2000)
        {
            
            $sql=mysqli_query($conn, "SELECT * FROM us_reg_tbl WHERE user_id = '".$userid."'");
        
            while($row = mysqli_fetch_assoc($sql)){ 

            $newcoins = (int)$row['credit']+ (int)$orderamount;  
            }
            $insertData1 = "INSERT INTO `point_table`( `app_id`, `user_id`, `transaction_id`, `tr_nature`,  `tr_value`, `tr_value_updated`, `value_update_by`, `tr_value_type`, `tr_device`, `date`, `date_time`, `tr_remark`, `tr_status`, `is_deleted`, `device_type`, `device_id`, `admin_key`) 
                                            VALUES ('com.dubaiking','$userid','$order_id','TRDEPO002','$orderamount','$newcoins','Deposit','Credit','$devName','$date','$date_time','redeemed','Pending','0',' $devType','','ADMIN0001')";
            mysqli_query($conn,$insertData1);
            
			
			
			
			$bonus=(int)$row_chk_user['ref_bonous']-(int)$orderamount;
	        mysqli_query($conn,"update us_reg_tbl set ref_bonous='".$bonus."' WHERE user_id ='".$userid."'");
			
			//$updateBalance = "UPDATE us_reg_tbl SET credit = '$newcoins' Where user_id = '".$userid."' AND app_id = 'com.dubaiking'";
			
            //mysqli_query($conn,$updateBalance);
            $msg="Withdraw Successfully";
            
            header("location:https://dubaiking.com/api/bonus_success.php?user_id=$userid&status=1");
        }
        else
        {
            
            $msg="Withdraw Amount should be Less than equal to commission and you can withdraw max 500";
            header("location:https://dubaiking.com/api/bonus_faild.php?user_id=$userid&status=1");
        }
    }
if(isMobile()==0)
{
	die;
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Bonus Report</title>
	<style type="text/css">
		.col-md-2
		{
			width: 16.66%;
		}
		.col-md-12
		{
			width: 100%;
			margin: auto;
		}
		.inline-from .form-control
		{
			width: 20%;
			height: 30px;
		}
		.inline-from .submits
		{
			width: 100px;
			height: 35px;
			background-color: #000;
			color: #fff;
			border: 1px solid;
			border-radius: 5px;
		}
		.table_row table {
			  font-family: arial, sans-serif;
			  border-collapse: collapse;
			  width: 100%;
			}

			td, th {
			  border: 1px solid #dddddd;
			  text-align: left;
			  padding: 8px;
			}

			
			.table_row
			{
				margin: 30px 0;
			}
	</style>
	<link
rel="stylesheet"
type="text/css"
href="https://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/css/jquery.dataTables.css"
/>
</head>
<body>

<div id="pageloader">
   <img  alt="processing..." />
</div>
	<div class="main">
	<div id="load"></div>
		<div class="container">
			<div class="row">
				<div class="col-md-12"><center><h2>Bonus Report</h2></center></div>
				<div class="col-md-6">
					<div class="date_form">
						<form action="" class="inline-from">
							<input type="hidden" name="user_id" value="<?=$user_id?>">
							<div class="form-group">
							<?PHP 
							$total_played=$row_chk_user['total_played'];
							$total_comm=$row_chk_user['ref_bonous'];
							
							?>	
							
								<label>Total Played (<?=$total_played?>)</label><br>
								<label>Total Commission (<?=$total_played*$comm['ref_comm']/100?>)</label><br>
								<!--<input type="date" name="from_date" class="form-control">-->
								<label>Remaining Commission (<?=$total_comm?>)</label>
								<!--<input type="date" name="to_date" class="form-control">
								<button type="submit" value="submit" name="submit" class="btn btn-seccess submits">Submit</button>-->
							</div>
						</form>
					</div>
					<div class="col-md-6">
					<div class="date_form">
						<form action="" class="inline-from">
							<input type="hidden" name="user_id" value="<?=$user_id?>">
							<input type="hidden" name="comm" value="<?=$total_comm?>">
							<div class="form-group">
							    <?PHp if(isset($_REQUEST['status'])): ?>
							    <?PHp if($_REQUEST['status']==1): ?>
							    <h4>Withdraw Successfully</h4>
								<?PHp else: ?>
								  <h4><?=@$msg?></h4>
								<?PHp endif;
								endif; ?>
								<label><b>Enter Redeeem Amount(Min - 500 and Max- 2000 can withdraw)</b></label><br>
								
								<input type="number" onkeyup="checkValue(this.value)" name="amount" class="form-control">
								<?PHP
								$vv=$total_comm;
								if($vv>=500):
									?>
								<button type="submit"  value="submit" id="rid" name="redeem" class="btn btn-seccess submits">Redeem</button>
							      <?PHp
								 endif
								   
								?>
							</div>
						</form>
					</div>
					<div class="table_row"  style="overflow-x: auto;">
						<table id="table_id">
							<thead>
								<tr>
									<th>Name</th>
									<th>Mobile</th>
									<th>Total Played</th>
									<th>Comm</th>
									<th>Join Date</th>
								</tr>
								<tbody>
								<?PHP while($row_chk_user1 = mysqli_fetch_assoc($chk_user1)): ?>
									<tr>
										<td><?=$row_chk_user1['FullName']?></td>
										<td><?=$row_chk_user1['mob']?></td>
										
										<td><?=$pmt=$row_chk_user1['my_played']?></td>
										<td><?=($pmt*$comm['ref_comm']/100)?></td>
										<td><?=date('d-m-Y',strtotime($row_chk_user1['created_at']))?></td>
									</tr>
								<?PHP endwhile; ?>	
									
								</tbody>
							</thead>
						</table>
					</div>
				</div>
				<div class="col-md-2"></div>
			</div>
		</div>
	</div>
</body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script
type="text/javascript"
charset="utf8"
src="https://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>
<script>
$(function() {
$("#table_id").dataTable();
});
</script>

<script>
$("body").on("submit", "form", function() {
    $(this).submit(function() {
        return false;
    });
	$("#pageloader").fadeIn();
    return true;
});

function checkValue(value)
{
	if(value=="")
	{
		$("#rid").show()
	}
	else
	{
	var value= parseInt(value);
	if(value>=500 && value<=2000)
	{
		$("#rid").show()
	}
	else
	{
		$("#rid").hide()
	}
	}
}

document.onreadystatechange = function () {
  var state = document.readyState
  if (state == 'complete') {
         document.getElementById('interactive');
         document.getElementById('load').style.visibility="hidden";
  }
}

</script>
<style>
#pageloader
{
  background: rgba( 255, 255, 255, 0.8 );
  display: none;
  height: 100%;
  position: fixed;
  width: 100%;
  z-index: 9999;
}

#pageloader img
{
  left: 50%;
  margin-left: -32px;
  margin-top: -32px;
  position: absolute;
  top: 50%;
}
#load{
    width:10%;
    height:10%;
    position:fixed;
    z-index:9999;
    background:url("loading.gif") no-repeat center center rgba(0,0,0,0.25)
}

</style>
