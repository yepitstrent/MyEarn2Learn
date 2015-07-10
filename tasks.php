<?php
    session_start();
    include('session.php');
?> 
<html>
<head>
    <title>Earn2Learn: Manage Rewards</title>
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</head>
<body onload="initialize()">
<div id="e2l_container">
    <div id="e2l_navbar">
        <div id="e2l_logo"><a href="profile.php"><img src="img/logo.svg"></a></div>
        <div id="e2l_menu"><b id="logout"><a href="logout.php">Log Out</a></b></div>
    </div> <!-- END e2l_navbar -->
    <div id="e2l_task_box">
        <div id="e2l_left_task"></div>    
	<div id="e2l_right_task">
	    <center><div id="e2l_task_container"></div></center>
	</div>
    </div>
</div>
<script>
    function initialize(){
        get_user_tasks(<?php echo $_SESSION['uid']?>);    
    }

    function goto_task(tid){
        
        $.ajax({
            url: 'db.php',
            data: {'function' : 'set_session_data', 'tid' : tid},
	    method: 'POST',
	    success: function(str) { 
	        window.location.href = "start_task.php";	        
	    }
        });   
    }

    function get_user_tasks(uid){
        $.ajax({
            url: 'db.php',
            data: {'function' : 'get_user_tasks', 'uid' : uid},
	    method: 'POST',
	    success: function(str) {	
	        $("#e2l_task_container").html(str); 
            }
        });   
    }
</script>
</body>
</html>
