<?PHP
include("POM_config.php");
$user_id=$_GET['user_id'];
$chk_user=mysqli_query($conn, "SELECT * FROM us_reg_tbl WHERE user_id ='".$user_id."'");
$row_chk_user = mysqli_fetch_assoc($chk_user);
$chk_user1=mysqli_query($conn, "SELECT * FROM us_reg_tbl WHERE ref_by ='".$row_chk_user['ref_code']."'");

$comm=mysqli_query($conn, "SELECT ref_comm FROM app_controller");
$comm = mysqli_fetch_assoc($comm);


function check_played_game($id,$from_date='',$to_date='')
{
	
	global $conn;
	$sql="SELECT sum(tr_value) as sum FROM point_table WHERE tr_nature ='TRGAME001' and user_id='".$id."' and tr_value_type='Debit'";
	if($from_date!="")
	{
		$sql.=" and date >= '". date('d-m-Y',strtotime($from_date)) . "' AND date <= '" . date('d-m-Y',strtotime($to_date)) . "'";
	}
  
	$chk_user=mysqli_query($conn,$sql);
    $row_chk_user = mysqli_fetch_assoc($chk_user);
	return $row_chk_user['sum'];
	
	//where('tr_nature','TRGAME001')->where('user_id',$id)->where('tr_value_type',"Debit")->sum('tr_value');
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
</head>
<body>
	<div class="main">
		<div class="container">
			<div class="row">
				<div class="col-md-12"><center><h2>Bonus Report</h2></center></div>
				<div class="col-md-12">
					<div class="date_form">
						<form action="" class="inline-from">
							<input type="hidden" name="user_id" value="<?=$user_id?>">
							<div class="form-group">
								<label>Form</label>
								<input type="date" name="from_date" class="form-control">
								<label>To</label>
								<input type="date" name="to_date" class="form-control">
								<button type="submit" value="submit" name="submit" class="btn btn-seccess submits">Submit</button>
							</div>
						</form>
					</div>
					<div class="table_row" style="overflow-x: auto;">
						<table>
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
										<td><?php echo $played=check_played_game($row_chk_user1['user_id'],@$_GET['from_date'],@$_GET['to_date'])?></td>
										<td><?=($played*$comm['ref_comm']/100)?></td>
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