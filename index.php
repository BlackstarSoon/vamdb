<?php
    ob_start();
    session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>VAMDB Login</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="picture/flower.png" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/mystyle.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/login.js"></script>
   
</head>

<style type="text/css">
	.form-login {
    background-color: #EDEDED;
    padding-top: 10px;
    padding-bottom: 20px;
    padding-left: 20px;
    padding-right: 20px;
    border-radius: 15px;
    border-color:#d2d2d2;
    border-width: 5px;
    box-shadow:0 1px 0 #cfcfcf;
	}
</style>

<body>
<!--Header-->
<?php include ('html/component/header.php'); ?>

<div class="container">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <div class="row align-items-center justify-content-center">
            <div class="col-sm-6 col-md-4 col-md-offset-4">
                <div class="form-login">
                    <div class="row">
                        <div class="center-block">
                            <img class="profile-img center-block"
                                src="picture/user.png" alt="">
                        </div>
                    </div>

                    <div class="row text-center">
                        <h4>Please Login to Continue Access</h4>    
                    </div>
                    
                    <div class="form-group input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input type="text" id="username" name="uname" class="form-control input-sm chat-input" placeholder="username" />         
                    </div>
                    <div class="form-group input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input type="password" id="password" name="psw" class="form-control input-sm chat-input" placeholder="password" />       
                    </div>
                    
                    <div class="wrapper">
                        <span class="group-btn">     
                            <button type="submit" name="loginbtn" class="btn btn-primary center-block">login</a>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </form>    
</div>

<?php
    if(isset($_POST['loginbtn']) && !empty($_POST['uname']) && !empty($_POST['psw'])){
        $uname = $_POST['uname'];
        $pw = $_POST['psw'];
     
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
        $stmt = $conn ->prepare("SELECT * FROM admins where username=?"); 
        $stmt->bind_param("s", $uname);
        $stmt->execute();
        $result = mysqli_stmt_get_result($stmt);

        if ($result->num_rows > 0) {
            while($row = mysqli_fetch_array($result)) {
                $pwdb = $row['password'];
                $usernamedb = $row['username'];
                $iddb = $row['id'];
            }
        }
            
        $conn->close();

        if($uname == $usernamedb && $pw == $pwdb){
            $_SESSION['valid'] = true;
            $_SESSION['timeout'] = time();
            $_SESSION['uname'] = $uname;
            $_SESSION['iddb'] = $iddb;
            header('Location: html/main.php');
        }
        else{
            echo "<script type='text/javascript'>alert('Invalid Username or Password');</script>";
        }
    }
    
?>

<!--Footer-->
<?php include ('html/component/footer.php'); ?>
</body>
</html>