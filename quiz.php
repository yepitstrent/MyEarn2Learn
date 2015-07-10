<?php
    session_start();
    include('session.php');

    $id = $_SESSION['lid'];
?>
<html>
<head>
    <title>Earn2Learn: Lesson</title>
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
</head>
<body onload="initialize()">
     <div id="e2l_navbar">
        <div id="e2l_logo"><a href="profile.php"><img src="img/logo.svg"></a></div>
        <div id="e2l_menu"><b id="logout"><a href="logout.php">Log Out</a></b></div>
    </div> <!-- END e2l_navbar -->
    <div><br>
        <center>
	<div id="e2l_quiz_wrapper">
            <div>Select the best answer</div>
	    <div id="e2l_quiz_video_wrapper">
	        <div id="e2l_quiz_youtube"></div>
            </div>
	    <div id="e2l_question_answers"></div>
	    <div id="e2l_quiz_question"></div>
	    <div id="e2l_quiz_reward"></div>
	    <div id="e2l_quiz_answers"></div>
            <div id="quiz_button" onclick="next_question(<?php echo $id; ?>)">SUBMIT</div>
	    <div id="button_complete" onclick="submit_lesson(<?php echo $id; ?>)">COMPLETE</div>
        </div>
	</center>
    </div>
    <script>
        Q_ID = -1;
        Q_NUM = 1;
	SELECTED_ANSWER = -1;

        function initialize(){
	    get_video(<?php echo $id; ?>);
	    get_question(<?php echo $id; ?>, Q_NUM);
	}

        function submit_lesson(lid){
	   //alert(lid);
	   $.ajax({
                url: 'db.php',
                data: {'function' : 'submit_lesson', 'lid' : lid},
	        method: 'POST',
	        success: function(str) {	
		    //alert("RETURNED"+ str);
	            window.location.href = "profile.php";	    
                }
            }); 
	}

        function mark_answer(aid){
	    
            SELECTED_ANSWER = aid;

            $(".e2l_answer_box").css("background-color", "white");
	    $(".e2l_answer_box").css("color", "#006699");

	    var id = "#answ_"+aid;
	 
	    $(id).css("background-color", "#006699");
	    $(id).css("color", "white");

	}

	function next_question(lid){
	    if(SELECTED_ANSWER == -1){
	        alert("Please choose an answer \nbefore you press SUBMIT.");
	    } else {
	        var q_id = Q_ID;
		var aid = SELECTED_ANSWER;
                $.ajax({
                    url: 'db.php',
                    data: {'function' : 'insert_grade', 'aid' :  aid, 'qid' : q_id, 'lid' : lid},
	            method: 'POST',
	            success: function(str) {	
 
			//update Q_NUM to display next question.
		        Q_NUM++;
	                var q_num = Q_NUM; 

			get_question(lid, q_num);		        
			SELECTED_ANSWER = -1;
		    }
                });  
            }
	}

        function get_video(id){
	    
            $.ajax({
                url: 'db.php',
                data: {'function' : 'get_video', 'id' : id},
	        method: 'POST',
	        success: function(str) {	
	            $("#e2l_quiz_youtube").html("<div>"+str+"</div>"); 
                }
            });   
	}

	function get_question(lid, q_num){
	    //alert("question");
            $.ajax({
                url: 'db.php',
                data: {'function' : 'get_question', 'id' : lid, 'q_num' : q_num},
	        method: 'POST',
	        success: function(str) { 
		    //alert("RETURN");
		    var ret = JSON.parse(str);
                    //alert(ret); 
                    var qid = ret[0];
		    Q_ID = qid;
		    var ques = ret[1];
		    
		    $("#e2l_quiz_question").html("<div>"+ques+"</div>");  
                    //alert(qid);
		    //if returned -1, the lesson is complete.
                    if( parseInt(qid) != -1){
		        get_answers(qid);
		    } else {
		        $("#e2l_quiz_question").css("display", "none");
			$("#e2l_quiz_reward").css("display", "block");
		        $("#e2l_quiz_answers").html("<div></div>");
			$("#quiz_button").css("display","none");
			$("#button_complete").css("display", "block");
		    }
		}
            }); 	
	}

	function get_answers(qid){
            $.ajax({
                url: 'db.php',
                data: {'function' : 'get_answers', 'id' : qid},
	        method: 'POST',
	        success: function(str) {	
	            $("#e2l_quiz_answers").html("<div>"+str+"</div>"); 
                }
            }); 		
	}

	function update_question(){
	
	}
    </script>
</body>
</html>

