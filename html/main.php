<!DOCTYPE html>
<html>
<head>
	<title>Main Page</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.js"></script>
	<script type="text/javascript" src="../js/main.js"></script>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/mystyle.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
</head>

<body>
	<!--Header-->
	<?php include('../html/component/header.php'); ?>

	

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
		$stmt = $conn ->prepare("SELECT * FROM records"); 
		
		//execute statement
		$stmt ->execute();

		//get records
		$records = mysqli_stmt_get_result($stmt);
	?>

	<div class="container">
		<div class="row">
			<h1>SDNN Records</h1>
		</div>
		<div class="row col-sm-12">
			<!--Display records-->
			<table id="table_data" class="display table table-striped">
				<thead>
					<tr>
						<th scope="col">ID</th>
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
							?>
							<tr>
								<td scope="row"><?= $row["id"] ?></td>
								<td><?= $row["age"] ?></td>
								<td><?= $row["country"] ?></td>
								<td><?= $row["race"] ?></td>
								<td><?= $row["gender"] ?></td>
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
	</div>

	<?php include('../html/component/footer.php'); ?>
</body>
</html>
