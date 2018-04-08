<!DOCTYPE html>
<html>
<head>
	<title>Main Page</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>-->
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.js"></script>
	<script type="text/javascript" src="../js/main.js"></script>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/mystyle.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
</head>

<body>
	<?php
	if (!session_id()) session_start();
	if (!$_SESSION['valid']){ 
		header("Location:../index.php");
		die();
	}
	?>
	<!--Header-->
	<?php include('../html/component/header.php'); ?>

	<?php
		$gender = [
			'M' => 'Male',
			'F' => 'Female',
		];

		$total_sdnn_before = 0;
		$total_sdnn_after = 0;
		$count = 0;
		$average_sdnn_before = 0;
		$average_sdnn_after = 0;
	?>

	<!--php connection-->
	<?php
		
		$servername = "us-cdbr-iron-east-05.cleardb.net";
		$username = "b9b122a16bac23";
		$password = "b2362a60";
		$dbname = "heroku_d8a61c209a03871";

		$conn = new mysqli($servername, $username, $password, $dbname);

		if($conn ->connect_error)
		{
			die("Connection failed : ".$conn ->connect_error);
		}
		
		//prepare statement
		$stmt = $conn ->prepare("SELECT * FROM records order by id desc"); 
		
		//execute statement
		$stmt ->execute();

		//get records
		$records = mysqli_stmt_get_result($stmt);
	?>

	<div class="container">
		<div class="row">
			<p>
				<b>Welcome, <?= $_SESSION['uname'] ?></b> &nbsp;&nbsp;&nbsp;
				<a href="../html/logout.php">Logout</a>
			</p>		
		</div>
		<div class="row">
			<ul class="nav nav-tabs">
			    <li class="active"><a href="../html/main.php">SDNN Records</a></li>
			    <li><a href="../html/statistic.php">Records Statistic</a></li>
		  	</ul>
		</div>
		<div class="row">
			<h1>SDNN Records</h1>
		</div>
		<div class="row col-sm-12">
			<!--Display records-->
			<table id="table_data" class="display nowrap table table-striped" style="width: 100%">
				<thead>
					<tr>
						<th scope="col">No.</th>
						<th scope="col">Age</th>
						<th scope="col">Country</th>
						<th scope="col">Race</th>
						<th scope="col">Gender</th>
						<th scope="col">Weight</th>
						<th scope="col">Height</th>
						<th scope="col">SDNN Before</th>
						<th scope="col">SDNN After</th>
						<th scope="col">Time</th>
					</tr>
				</thead>
				
				<tbody>
				<?php
					if($records ->num_rows >0)
					{
						while($row = mysqli_fetch_array($records))
						{
							$total_sdnn_before += doubleval($row["sdnn_before"]);
							$total_sdnn_after += doubleval($row["sdnn_after"]);
							?>
							<tr>
								<td scope="row"><?= ++$count ?></td>
								<td><?= $row["age"] ?></td>
								<td><?= $row["country"] ?></td>
								<td><?= $row["race"] ?></td>
								<td><?= $gender[$row["gender"]] ?></td>
								<td><?= $row["weight"] ?></td>
								<td><?= $row["height"] ?></td>
								<td><?= $row["sdnn_before"] ?></td>
								<td><?= $row["sdnn_after"] ?></td>
								<td><?= $row["posted"] ?></td>
							</tr>
							<?php
						}
					}

					$stmt ->close();
					$conn ->close();

				?>
				</tbody>
			</table>
		</div>
		<br>
		<div class="row col-sm-12">
			<?php
				$average_sdnn_before = $total_sdnn_before / $count;
				$average_sdnn_after = $total_sdnn_after / $count;
				$average_sdnn_increase = $average_sdnn_after - $average_sdnn_before;
				$efficiency = $average_sdnn_increase / $average_sdnn_before * 100;
			?>

			<table class="table table-striped" style="overflow-x: auto">
				<thead>
					<tr>
						<th scope="col">Total Record</th>
						<th scope="col">Average SDNN Before</th>
						<th scope="col">Average SDNN After</th>
						<th scope="col">Average Increased SDNN</th>
						<th scope="col">Percentage SDNN Increased (%)</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><?= $count ?></td>
						<td><?= round($average_sdnn_before, 3) ?></td>
						<td><?= round($average_sdnn_after, 3) ?></td>
						<td><?= round($average_sdnn_increase, 3) ?></td>
						<td><?= round($efficiency, 2) ?></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
	<br><br><br>
	<?php include('../html/component/footer.php'); ?>
</body>
</html>
