<?php

    /*******************************************
     * http://www.formget.com/login-form-in-php/
     ******************************************/
    include('login.php'); // Includes Login Script

    if(isset($_SESSION['login_user'])){
        if($_SESSION['role'] == 0){
            header("location: profile.php"); 
	} elseif ($_SESSION['role'] == 1){
	    header("location: educator/dashboard.php");
	}
    }
?>
<html>
<head>
    <title>Earn2Learn: Login</title>
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>    
</head>
<body>
    <center> 
    <div id="e2l_login_wrapper">
        <form action="" method="post">
	<div >
            <div style="padding: 10px;" ><img style="width: 350px;" src="img/logo.svg"></div>
            <div style="padding: 5px;" id="e2l_text">TAKE A TOUR</div>
	    <div style="padding: 5px; cursor: pointer;" id="e2l_text" onclick="register()">REGISTER</div>
	    <div style="padding: 5px;" id="e2l_text">UN:<input type="text" id="username" name="username"></div>
	    <div id="e2l_text">PW:<input type="password" id="password" name="password"></div>
	    <div><input type="submit" name="submit" value="Log In"></div>
	    <div id="e2l_red_text"><span><?php echo $error; ?></span></div>
	</div>
	</form>
    </div>
    </center>
</body>
<script>
    function register(){
        window.location.assign("register.php");    
    }
</script>
</html>
<style>
body {
    background-color: #006699;
}
</style>
