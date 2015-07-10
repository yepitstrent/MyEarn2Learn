<?php
    session_start();

    $action = $_POST['function'];
    $_POST['function'] = "";

    if($action != null) {
        switch($action){
	    case 'create_educator' : 
	        $firstname = $_POST['firstname']; 
		$lastname = $_POST['lastname'];
		$user_name = $_POST['user_name'];
		$email = $_POST['email'];
		$password1 = $_POST['password1'];
		$password2 = $_POST['password2'];
				
	        echo create_educator($firstname, $lastname, $user_name, $email, $password1, $password2);
		header("Location: confirm.php");
	        break;
	}
    } 

    function create_educator($firstname, $lastname, $user_name, $email, $password1, $password2){

        $servername = "localhost";
        $username = "root";
        $password = "password";
        $dbname = "e2l";
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        $ret = ""; 
/*
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(30) NOT NULL,
    password VARCHAR(30) NOT NULL,
    email VARCHAR(255) NOT NULL, 
    firstname VARCHAR(30) NOT NULL,
    lastname VARCHAR(30) NOT NULL,
    role INT NOT NULL,
    balance DECIMAL(10,2) NOT NULL, 
    educator INT(6) UNSIGNED NOT NULL

*/

        if($password1 != $password2 && $password1 != null){
	    $ret = "ERROR: Password setup failed.";
	} else {
            if($firstname != null && $lastname != null && $user_name != null && $email != null ){

                $sql = "SELECT * FROM users WHERE username = '".$user_name."'";
		$result = mysqli_query($conn, $sql);
		$entries = mysqli_num_rows($result);
		if($entries > 0) {
		    $ret = "Username is not availiable";
		} else {

	            $sql = "INSERT INTO users (username, password, email, firstname, lastname, role, balance, educator) ".
	            "VALUES ('".$user_name."', '".$password1."', '".$email."', '".$firstname."', '".$lastname."', 1 , 0.00, 0)";

	            if(mysqli_query($conn, $sql)){
		        $ret = "Educator created";
		    } else {
		        $ret = "ERROR: User Not Created!";
		    }
		}
	    } else {
	        $ret = "ERROR: Please enter all information on the form.";
	    }	
	}

        mysqli_close($conn);
        return $ret;
    }
?>
