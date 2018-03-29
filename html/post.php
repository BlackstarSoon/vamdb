<!--php connection-->
<?php
	
	$gender = [
		'Male' => 'M',
		'Female' => 'F',
	];

	$servername = "us-cdbr-iron-east-05.cleardb.net";
	$username = "b9b122a16bac23";
	$password = "b2362a60";
	$dbname = "heroku_d8a61c209a03871";

	$conn = new mysqli($servername, $username, $password, $dbname);

	if($conn ->connect_error)
	{
		die("Connection failed : ".$conn ->connect_error);
	}

	$stmt = $conn->prepare("INSERT INTO records (age, country, race, gender, weight, height, sdnn_before, sdnn_after, posted) VALUES (?,?,?,?,?,?,?,?,?)");
	$stmt -> bind_param("isssiisss", $age, $country, $race, $gender, $weight, $height, $sdnn_before, $sdnn_after, $posted);

	//set parameters
	
	$age = 25;
	$country = 'Malaysia';
	$race = 'Chinese';
	$gender = 'M';
	$weight = 80;
	$height = 173;
	$sdnn_before = '58.86';
	$sdnn_after = '79.27';
	$posted = date('Y-m-d H:i:s');
	
	/*
	$age = int($_POST["age"]);
	$country = $_POST["country"];
	$race = $_POST["race"];
	$gender = $gender[$_POST["gender"]];
	$weight = int($_POST["weight"]);
	$height = int($_POST["height"]);
	$sdnn_before = $_POST["sdnn_before"];
	$sdnn_after = $_POST["sdnn_after"];
	$posted = date('Y-m-d H:i:s');
	*/

	//execute
	$stmt ->execute();

	?>
	<p>New record created successfully<p>

	<?php 
	$stmt ->close();
	$conn ->close();
?>