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
    <div id="e2l_reward_box">
        <center>
        <div id="e2l_reward_amt">
	    <div id="e2l_balance"></div>
	    <div id="e2l_cards"></div>
	</div>	
	</center>
    </div>
</div>
<script>
    function initialize(){
        get_user_balance(<?php echo $_SESSION['uid']?>);    
    }

    function get_user_balance(uid){
        $.ajax({
            url: 'db.php',
            data: {'function' : 'get_balance', 'uid' : uid},
	    method: 'POST',
	    success: function(str) {	
	        $("#e2l_balance").html("<div>$"+str+"</div>"); 
            }
        });   
    }
</script>
</body>
</html>
