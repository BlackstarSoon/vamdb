<!DOCTYPE html>
<html>
<head>
	<title>VAMDB Login</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
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

<div class="container ">
    <div class="row align-items-center justify-content-center">
        <div class="col-sm-6 col-md-4 col-md-offset-4">
            <div class="form-login">
                <div class="row">
                    <div class="center-block">
                        <img class="profile-img center-block"
                            src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=120" alt="">
                    </div>
                </div>

                <h4>Please Login to Continue Access</h4>
                
                <div class="form-group input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                    <input type="text" id="username" class="form-control input-sm chat-input" placeholder="username" />         
                </div>
                <div class="form-group input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                    <input type="password" id="password" class="form-control input-sm chat-input" placeholder="password" />       
                </div>
                
                <div class="wrapper">
                    <span class="group-btn">     
                        <a href="#" class="btn btn-primary btn-md center-block" onclick="login()">login</a>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<!--Footer-->
<?php include ('html/component/footer.php'); ?>
</body>
</html>