<?php
session_start();
include('session.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Earn2Learn: Dashboard</title>
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</head>
<body>
<div id="e2l_container">

    <div id="e2l_navbar">
        <a href="profile.php"><div id="e2l_logo"><img src="img/logo.svg"></div></a>
        <div id="e2l_menu"><b id="logout"><a href="logout.php">Log Out</a></b></div>
    </div> <!-- END e2l_navbar -->
     
    <div id="e2l_tile_wrapper">
        <div id="e2l_tile_row">
            <a href="lessons.php"><div id="e2l_tile"><img id="e2l_img" src="img/lesson.svg"></div></a>
	    <a href="tasks.php"><div id="e2l_tile"><img id="e2l_img" src="img/task.svg"></div></a>
	    <div id="e2l_tile"><img id="e2l_img" src="img/mail.svg"></div>
	</div>

	<div id="e2l_tile_row">
	    <div id="e2l_tile"><img id="e2l_img" src="img/calendar.svg"></div>
	    <div id="e2l_tile"><img id="e2l_img" src="img/reward.svg"></div>
	    <a href="rewards.php"><div id="e2l_tile"><img id="e2l_img" src="img/reward.svg"></div></a>
	</div>
	
    </div> <!--END e2l_tile_wrapper -->
    
</div> <!-- END e2l_container -->
</body>
</html>


