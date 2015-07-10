<?php
    session_start();
    include('session.php');
?>
<html>
<head>
    <title>Earn2Learn: Task Submitted</title>
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</head>
<body>
<div>
    <div id="e2l_navbar">
        <a href="profile.php"><div id="e2l_logo"><img src="img/logo.svg"></div></a>
        <div id="e2l_menu"><b id="logout"><a href="logout.php">Log Out</a></b></div>
    </div> <!-- END e2l_navbar -->
    <div> 
        <div>TASK COMPLETED</div>
    </div>
</div>    
    <script>
        setTimeout(function(){   
	    window.location.assign("profile.php");   
	}, 5000);
    </script>
</body>
</html>

