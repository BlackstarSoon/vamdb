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
        $password = $_POST['psw'];

        if($uname == 'admin' && $password == 'admin'){
            $_SESSION['valid'] = true;
            $_SESSION['timeout'] = time();
            $_SESSION['uname'] = $uname;
            header('Location: html/main.php');
        }
        else{
            echo "Invalid Username or Password";
        }
    }
?>

<!--Footer-->
<?php include ('html/component/footer.php'); ?>
</body>
</html>