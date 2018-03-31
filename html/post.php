<!--php connection-->
<?php
	date_default_timezone_set('Asia/Kuching');
	
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

	/*
	$age = intval($_POST["age"]);
	$country = $_POST["country"];
	$race = $_POST["race"];
	$gender = $gender[$_POST["gender"]];
	$weight = intval($_POST["weight"]);
	$height = intval($_POST["height"]);
	$sdnn_before = $_POST["sdnn_before"];
	$sdnn_after = $_POST["sdnn_after"];
	$posted = date('Y-m-d H:i:s');
	*/

	$age = 20;
	$country = 'Malaysia';
	$race = 'Chinese';
	$gender = 'M';
	$weight = 83;
	$height = 181;
	$sdnn_before = '51.94';
	$sdnn_after = '68.44';
	$posted = date('Y-m-d H:i:s');

	//prepare statement
	$stmt = $conn ->prepare("SELECT * FROM records order by id desc limit 1"); 
	
	//execute statement
	$stmt ->execute();

	//get records
	$records = mysqli_stmt_get_result($stmt);

	var_dump($records);

	if($records ->num_rows >0){
		while($row = mysqli_fetch_array($records)){
			if( $row["sdnn_before"] == $sdnn_before && $row["sdnn_after"] == $sdnn_after){
				//do nothing
				echo "Duplicate result";
			}
			else{
				$stmt = $conn->prepare("INSERT INTO records (age, country, race, gender, weight, height, sdnn_before, sdnn_after, posted) VALUES (?,?,?,?,?,?,?,?,?)");
				$stmt -> bind_param("isssiisss", $age, $country, $race, $gender, $weight, $height, $sdnn_before, $sdnn_after, $posted);
				//execute
				$stmt ->execute();
			}
		}
	}

	$stmt ->close();
	$conn ->close();
?>