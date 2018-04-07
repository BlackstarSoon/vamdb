<!DOCTYPE html>
<html>
<head>
	<title>Main Page</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/mystyle.css">
</head>

<body>
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
		$male = 0;
		$female = 0;
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

		//COUNTRY
		$stmt = $conn ->prepare("SELECT DISTINCT country FROM records");
		$stmt -> execute();
		$country_records = mysqli_stmt_get_result($stmt);
		$country = [];
		while($row = mysqli_fetch_array($country_records)){
			array_push($country, $row[0]);
		}
		$count_country = [];
		for($i=0; $i<count($country); $i++){
			$count_country[$country[$i]] = 0;
		}

		//RACE
		$stmt = $conn ->prepare("SELECT DISTINCT race FROM records");
		$stmt -> execute();
		$race_records = mysqli_stmt_get_result($stmt);
		$race = [];
		while($row = mysqli_fetch_array($race_records)){
			array_push($race, $row[0]);
		}
		$count_race = [];
		for($i=0; $i<count($race); $i++){
			$count_race[$race[$i]] = 0;
		}
	?>

	<?php
		if($records ->num_rows >0)
		{
			while($row = mysqli_fetch_array($records))
			{
				$count++;
				$total_sdnn_before += doubleval($row["sdnn_before"]);
				$total_sdnn_after += doubleval($row["sdnn_after"]);

				if($row["gender"] == 'M'){
					$male ++;
				}else{
					$female ++;
				}

				for($i=0; $i<count($country); $i++){
					if($row["country"] == $country[$i]){
						$count_country[$country[$i]]++;
					}
				}

				for($i=0; $i<count($race); $i++){
					if($row["race"] == $race[$i]){
						$count_race[$race[$i]]++;
					}
				}
			}
		}

		$stmt ->close();
		$conn ->close();

		$average_sdnn_before = $total_sdnn_before / $count;
		$average_sdnn_after = $total_sdnn_after / $count;
		$average_sdnn_increase = $average_sdnn_after - $average_sdnn_before;
		$efficiency = $average_sdnn_increase / $average_sdnn_before * 100;

	?>


	<div class="container">
		<div class="row">
			<ul class="nav nav-tabs">
			    <li><a href="../html/main.php">SDNN Records</a></li>
			    <li class="active"><a href="../html/statistic.php">Records Statistic</a></li>
		  	</ul>
		</div>
		<div class="row">
			<h1>Statistic</h1>
		</div>
		<div class="row">
			<div class="col-sm-6" style="border: 1px solid grey;">
				<h4>Country</h4>
				<table class="table table-striped">
					<thead>
						<tr>
							<th scope="col">Country Name</th>
							<th scope="col">Number</th>
						</tr>
					</thead>
					<tbody>
						<?php
							for($i=0; $i<count($country); $i++){
								?>
								<tr>
									<td><?= $country[$i] ?></td>
									<td><?= $count_country[$country[$i]] ?></td>
								</tr>
								<?php
							}
						?>
					</tbody>
				</table>
				<canvas id="bar-chart" height="200"></canvas>
				<br><br>
			</div>
			<div class="col-sm-6" style="border: 1px solid grey;">
				<h4>Race</h4>
				<table class="table table-striped">
					<thead>
						<tr>
							<th scope="col">Race Name</th>
							<th scope="col">Number</th>
						</tr>
					</thead>
					<tbody>
						<?php
							for($i=0; $i<count($race); $i++){
								?>
								<tr>
									<td><?= $race[$i] ?></td>
									<td><?= $count_race[$race[$i]] ?></td>
								</tr>
								<?php
							}
						?>
					</tbody>
				</table>
				<canvas id="doughnut-chart" height="200"></canvas>
				<br><br>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6" style="border: 1px solid grey;">
				<h4>Gender</h4>
				<table class="table table-striped">
					<thead>
						<tr>
							<th scope="col">Gender</th>
							<th scope="col">Number</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Male</td>
							<td><?= $male ?></td>
						</tr>
						<tr>
							<td>Female</td>
							<td><?= $female ?></td>
						</tr>
					</tbody>
				</table>
				<canvas id="pie-chart" height="200"></canvas>
				<br><br>
			</div>
			<div class="col-sm-6" style="border: 1px solid grey;">
				<h4>Average SDNN Before and After</h4>
				<table class="table table-striped">
					<thead>
						<tr>
							<th scope="col">SDNN</th>
							<th scope="col">Millseconds</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Before</td>
							<td><?= round($average_sdnn_before,3) ?></td>
						</tr>
						<tr>
							<td>After</td>
							<td><?= round($average_sdnn_after,3) ?></td>
						</tr>
					</tbody>
				</table>
				<canvas id="bar-chart-horizontal" height="200"></canvas>
				<br><br>
			</div>
		</div>
	</div>
	<br><br><br><br>
	<?php include('../html/component/footer.php'); ?>
</body>

<script>
	// Bar chart
	var country= <?php echo json_encode($count_country ); ?>;
	var country_name = Object.keys(country);
	var country_count = Object.values(country);
	console.log(country);
	console.log(country_name); 
	console.log(country_count);
	new Chart(document.getElementById("bar-chart"), {
	    type: 'bar',
	    data: {
	      labels: country_name,
	      datasets: [
	        {
	          label: "Population (millions)",
	          backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
	          data: country_count
	        }
	      ]
	    },
	    options: {
	      legend: { display: false },
	      title: {
	        display: true,
	        text: 'Country'
	      }
	    }
	});


	var race= <?php echo json_encode($count_race ); ?>;
	var race_name = Object.keys(race);
	var race_count = Object.values(race);
	new Chart(document.getElementById("doughnut-chart"), {
	    type: 'doughnut',
	    data: {
	      labels: race_name,
	      datasets: [
	        {
	          label: "Population (millions)",
	          backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
	          data: race_count
	        }
	      ]
	    },
	    options: {
	      title: {
	        display: true,
	        text: 'Race'
	      }
	    }
	});


	var male = <?php echo $male ?>;
	var female = <?php echo $female ?>;
	new Chart(document.getElementById("pie-chart"), {
	    type: 'pie',
	    data: {
	      labels: ["Male", "Female"],
	      datasets: [{
	        label: "Person",
	        backgroundColor: ["#3e95cd", "#8e5ea2"],
	        data: [male,female]
	      }]
	    },
	    options: {
	      title: {
	        display: true,
	        text: 'Gender of User'
	      }
	    }
	});

	var sdnn_before = <?php echo round($average_sdnn_before,3) ?>;
	var sdnn_after = <?php echo round($average_sdnn_after,3) ?>;
	new Chart(document.getElementById("bar-chart-horizontal"), {
	    type: 'horizontalBar',
	    data: {
	      labels: ["Before", "After"],
	      datasets: [
	        {
	          label: "SDNN (milliseconds)",
	          backgroundColor: ["#3e95cd", "#8e5ea2"],
	          data: [sdnn_before,sdnn_after]
	        }
	      ]
	    },
	    options: {
	      legend: { display: false },
	      title: {
	        display: true,
	        text: 'Aveerage SDNN Before and After Training'
	      }
	    }
	});



</script>