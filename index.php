<!DOCTYPE html>
<html>
<head>
	<title>VAMDB</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script>
	<script type="text/javascript" src="js/login.js"></script>
	
	<link rel="stylesheet" href="css/jquery-ui.min.css">
	<link rel="stylesheet" href="css/bootstrap.css">
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
<h1>Video Aided Mindful Deep Breathing</h1>

<div class="container">
    <div class="row">
        <div class="col-sm-8">
            <div class="form-login">
            <h4>Please Login to Continue Access</h4>
            <input type="text" id="username" class="form-control input-sm chat-input" placeholder="username" />
            </br>
            <input type="password" id="password" class="form-control input-sm chat-input" placeholder="password" />
            </br>
            <div class="wrapper">
            <span class="group-btn">     
                <a href="#" class="btn btn-primary btn-md" onclick="login()">login</a>
            </span>
            </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>