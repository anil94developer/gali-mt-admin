<?php
include("POM_config.php");
$id = $_GET['id'];
// echo $id;die;

$sql = "SELECT * FROM `results_tbls` WHERE market_id = '$id' ORDER BY id DESC";
$res = mysqli_query($conn, $sql);
//echo $res;die;
// $run = mysqli_fetch_assoc($res);
// print_r($run);
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css"
		href="https://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/css/jquery.dataTables.css">
	<title>abc</title>
	<style>
		body {
			text-align: center;
			background: #4d0415;
		}

		table {
			width: 100%;
			background: #fff
		}

		table,
		td {
			border-collapse: collapse;
		}

		td {
			border: 1px solid;
		}

		h1 {
			color: #fff;
		}
	</style>
</head>

<body>
	<h1>Matka
		<?php echo $id; ?> Result Chart
	</h1>
	<table border="1" id="result" class="table">
		<?php
		while ($row = mysqli_fetch_assoc($res)) {
			?>
			<tr style="width: 20%;">

				<td>
					<?php echo $row['day_of_result'] ?><br>
					<?php echo $row['date'] ?>
				</td>

			</tr>
			<tr>
				<td>
					<table id="result" class="table">
						<tr>
							<td>
								<?php echo $row['result'] ?>
							</td>
							<td>
								<?php echo $row['result2'] ?>
							</td>
							<td>
								<?php echo $row['result3'] ?>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<?php
		}
		?>

	</table>

	<script type="text/javascript" charset="utf8"
		src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.2.min.js"></script>
	<script type="text/javascript" charset="utf8"
		src="https://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>
	<script>
		$(function () {
			// alert('vcjgguig');
			var cc = $("#E").dataTable();
			alert($cc);
		})
	</script>
</body>

</html>