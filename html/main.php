<!DOCTYPE html>
<html>
<head>
	<title>Main Page</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<!--JavaScript -->
	<script type="text/javascript" src="../js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="../js/bootstrap.js"></script>
	
	<!--Stylesheet-->
	<link rel="stylesheet" href="../css/jquery-ui.min.css">
	<link rel="stylesheet" href="../css/bootstrap.css">
</head>

<body>
	<h1>Main Page</h1>

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

	<!--Display records-->
	<table class="table table-striped">
		<thead class="thead-dark">
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
</body>
</html>
