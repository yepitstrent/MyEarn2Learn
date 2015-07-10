<?php
    session_start();
    include('session.php');
    //include('db.php');
?>
<html>
<head>
    <title>Earn2Learn: Lessons</title>
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
</head>
<body onload="get_lesson_content()">
<div id="e2l_lesson_container">

     <div id="e2l_navbar">
        <div id="e2l_logo"><a href="profile.php"><img src="img/logo.svg"></a></div>
        <div id="e2l_menu"><b id="logout"><a href="logout.php">Log Out</a></b></div>
    </div> <!-- END e2l_navbar -->

    <div id="e2l_lesson_wrapper">
        <div id="e2l_lesson_left">
	    <div style="color: #006699;"><center>Search</center></div>
	    <div id="e2l_tags"></div>
	</div>
        <div id="e2l_lesson_right">
	    <div style="color: #006699;"><center>Availiable Lessons</center></div>
	    <div id="e2l_lesson_tiles"></div>
	</div>
    <div>
</div>
</body>
</html>
<script>

function goto_lesson(id){
    var tag = "#radio_"+id;
    //alert(tag);
    $(tag).prop("checked", true);
    $("button").trigger("click");
}

function get_lesson_content() {
    //alert(window.location.href);
    var height = $( window ).height();
    var width = $( window ).width()

    $.ajax({
        url: 'db.php',
        data: {'function' : 'get_all_lessons', 'height' : height, 'width' : width },
	method: 'POST',
	success: function(str) {	
	    $("#e2l_lesson_tiles").html("<div>"+str+"</div>"); 
	    //alert(str);
        }
    });   
}
   


/*    screenWidth = window.screen.width,
    screenHeight = window.screen.height;

    console.log( "Height: "+$( '#e2l_lesson_right' ).height() + " :: " + $( '#e2l_lesson_box' ).height() );
    console.log( "Width: "+$( '#e2l_lesson_right' ).width() + " :: " + $( '#e2l_lesson_box' ).width() );

    console.log("WIDTH:"+screenWidth);
    console.log("HEIGHT:"+screenHeight);*/

</script>
