<?php
    session_start();
    include('session.php');
    
    $id = $_POST['radio'];
    $_SESSION['lid'] = $id;

?>

<html>
<head>
    <title>Earn2Learn: Begin Lesson</title>
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
</head>
<body>
<div id="e2l_container">
     <div id="e2l_navbar">
        <div id="e2l_logo"><a href="profile.php"><img src="img/logo.svg"></a></div>
        <div id="e2l_menu"><b id="logout"><a href="logout.php">Log Out</a></b></div>
    </div> <!-- END e2l_navbar -->
    <div id="e2l_lesson_preview"></div>
</div>
</body>
<script>
    function enter_lesson(){
        //alert(); 
        $("button").trigger("click");
    }

    function start_lesson(lid){
        //alert(lid);
        window.location.assign("quiz.php");
    }
</script>
</html>
<?php

    if($id != NULL){
        echo begin_lesson($id);
	//echo "<script>$(\"#e2l_confirm_lesson\").html(\"JQUERY\");</script>";
    }

    function begin_lesson($id){ 
        $servername = "localhost";
        $username = "root";
        $password = "password";
        $dbname = "e2l";
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        $ret = "";
	$img = "";

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        } 
        $sql = "select * from lessons as l where l.id = ".$id;
	//echo $sql;
        $result = mysqli_query($conn, $sql);
  
        $entries = mysqli_num_rows($result);

        if($entries > 0){	  
	    while($row = mysqli_fetch_assoc($result)){
	        $img = $row['preview'];
		$desc = $row['description'];
		$name = $row['lesson_name'];
		$reward = $row['reward'];
		$desc = addslashes($desc);
		
		if($img == NULL){
		    $img = "<img id=\"e2l_thumbnail\" src=\"img/lesson.svg\">";
		} else {
		    $img = "<img id=\"_e2l_thumbnail\" src=\"http://i1.ytimg.com/vi/".$img."/hqdefault.jpg\">";
		}
		
		
		$ret = $ret."<div id=\"e2l_lesson_default_txt\" >&nbsp;</div>".
	                    "<div id=\"e2l_lesson_youtube_wrapper\"><div id=\"e2l_lesson_youtube\">".$img."></div></div>".
	                    "<div id=\"e2l_lesson_desc_box\" >".
			        "<div id=\"e2l_lesson_title\">".$name."</div>".
	                        "<div id=\"e2l_lesson_desc\">".$desc."</div>".
				"<div id=\"e2l_lesson_amt\">$".$reward."</div>".
	                        "<center><div id=\"e2l_lesson_preview_btn\" onclick=\"start_lesson(".$id.")\">START QUIZ</div></center>".
	                    "</div>";
			    

	    }
	}

        mysqli_close($conn);   
 
        //echo "<script>$(\"#e2l_confirm_lesson\").html('".$ret."');</script>";	//WORKS!
        $ret = "<script>$(\"#e2l_lesson_preview\").html('".$ret."');</script>";	//WORKS!!

        return $ret;
    }
?>
