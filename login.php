
<?php
session_start(); // Starting Session
$error=''; // Variable To Store Error Message
$state = 0;

if (isset($_POST['submit'])) {
    if (empty($_POST['username']) || empty($_POST['password'])) { 
        $error = "Username or Password is invalid: EMPTY uname or pw";
    } else {   
        // Define $username and $password
        $username=$_POST['username'];
        $password=$_POST['password'];     
        // Establishing Connection with Server by passing server_name, user_id and password as a parameter
        $connection = mysqli_connect("localhost", "root", "password", "e2l");
        if (mysqli_connect_errno())
        {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
        else
        {
            //echo "Welcome to e2l:";
        
            // To protect MySQL injection for Security purpose
            $username = stripslashes($username);
            $password = stripslashes($password);
            $username = mysqli_real_escape_string($connection, $username);
            $password = mysqli_real_escape_string($connection, $password);
        
	    $rs = mysqli_query($connection, "select role, count(*) as total from users where username = '$username' AND password = '$password'");
       
            while($row = mysqli_fetch_array($rs)){
                //echo $row["total"]."<br>";
                $rows = $row["total"];
		$state = $row['role'];
                $_SESSION['role'] = $row['role'];
                echo var_dump($state);
            }       
            if ($rows == 1) {
                $_SESSION['login_user']=$username; // Initializing Session
                if($state == 0){
		    header("location: profile.php");
		} elseif($state == 1){
		    header("location: educator/dashboard.php");
		} else {
		    header("location: profile.php");
		}

		/*switch($state){
		    case 0 :  
			header("location: profile.php"); // Redirecting To Other Page
			break;
	            case 1 : 
		        header("location: educator/dashboard.php");
			break;
	            default : header("location: profile.php");
		}*/
                //$error = "FOUND ROW ".$rows;
            } else {
                $error = "Username or Password is invalid: NO FOUND! ".$rows;
            }
            mysqli_close($connection); // Closing Connection
        }
    }
}
?>
