<html>
<head>
    <title>Earn2Learn: Educator Signup</title>
    <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</head>
<body>
<center>
<div style="margin-left: auto; margin-right: auto;">
    
    <div><img src="img/logo.svg"></div>
    <div>Sign Up To Become An Educator:</div>
    <div>Enter some quick info and start earning to learn!</div>
    <form method="post" action="signup.php">
    <div><input style="display: none;" type="text" name="role" value="1"></div>
    <div><input style="display: none;" type="text" name="function" value="create_educator"></div>
    <div>First Name:</div>
    <div><input type="text" name="firstname" value=""></div>
    <div>Last Name:</div>
    <div><input type="text" name="lastname" value=""></div>
    <div>Email:</div>
    <div><input type="text" name="email" value=""></div>
    <div>User Name:</div>
    <div><input type="text" name="user_name" value=""></div>
    <div>Choose A Password:</div>
    <div><input type="password" name="password1" value=""></div>
    <div>Confirm Your Password:</div>
    <div><input type="password" name="password2" value=""></div>
    <div><input type="submit" value="Save"><input type="button" value="Cancel" onclick="cancel()"></div>
    </form>
</div>
</center>
<script>
    function cancel(){
        window.location.assign("index.php");     
    }
</script>
</body>
</html>
<style>
body {
    background-color: #006699;
    color: white;
}
</style>
