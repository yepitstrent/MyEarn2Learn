<?php
    session_start();

    // Establishing Connection with Server by passing server_name, user_id and password as a parameter
    $connection = mysqli_connect("localhost", "root", "password", "e2l");
    session_start();// Starting Session

    // Storing Session
    $user_check=$_SESSION['login_user'];

    $query="SELECT * FROM users WHERE username = '$user_check'";
    $_SESSION['uid'] = "";
    $_SESSION['username'] = "";
    $_SESSION['role'] = "";
    // SQL Query To Fetch Complete Information Of User
    $rs=mysqli_query($connection, $query);

    while($row = mysqli_fetch_array($rs)){
        $login_session = $row["username"];
	$_SESSION['uid'] = $row["id"];
	$_SESSION['username'] = $row['username'];
	$_SESSION['role'] = $row['role'];
    }
   //echo "UID: ".$_SESSION['uid'];   
 
    mysqli_close($connection); // Closing Connection

    if(!isset($login_session) ){
        header("Location: http://$_SERVER[HTTP_HOST]/logout.php"); // BETTER SOLUTION IF SOMETHING GOES WRONG.
        //header('Location: index.php'); // Redirecting To Home Page... EXAMPLE CODE 
    }
    
?>
