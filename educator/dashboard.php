<?php
    session_start();
    include('../session.php');
    include('db.php');
    $eid = $_SESSION['uid'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Earn2Learn: Educator Dashboard</title>
    <link href="../css/style.css" rel="stylesheet" type="text/css">
    <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</head>
<body onload="initialize()">
<div id="edu_container">

    <div id="e2l_navbar">
        <a href="dashboard.php"><div id="e2l_logo"><img src="../img/logo.svg"></div></a>
        <div id="e2l_menu"><b id="logout"><a href="../logout.php">Log Out</a></b></div>
    </div> <!-- END e2l_navbar -->
    <br>
    <!-- ////////////////////////////////////////////////////////////////// -->
    <div id="student"> 
        <div><b>Manage Students:</b></div><hr>
	<div>Click <b>Edit</b> or <b>Delete</b> to modify a student</div>
       	<div id="stu_table"></div>
	<div id="plus_student" onclick="add_a_student()" style="cursor: pointer;">+add a new student</div>
	<div id="add_student_box" style="display: none;">
	    <br>
	    <div>Create A New Student:</div>
   	    <div>First Name:</div>
	    <input id="new_firstname" type="text" name="firstname" value="">
	    <div>Last Name:</div>
	    <input id="new_lastname" type="text" name="lastname" value="">
	    <div>Email:</div>
	    <input id="new_email" type="text" name="email" value="">
	    <div>Username:</div>
	    <input id="new_username" type="text" name="user_name" value="">
	    <div>New Password:</div>
	    <input id="new_password1" type="password" name="password1" value=""><br>
	    <div>Confirm Password:</div>
	    <input id="new_password2" type="password" name="password2" value=""><br>
	    <input id="new_eid" style="display: none;" type="text" name="educator" value="<?php echo $eid; ?>">
	    <input type="button" value="Save" onclick="save_student()"><input type="button" value="Cancel" onclick="cancel_student()">
	    <div></div>
	    <div></div>
	</div>
	<div id="edit_student"></div>
        <div></div>
    </div>
    <br>
    <!-- ////////////////////////////////////////////////////////////////// -->
    <div id="lesson">
        <div><b>Manage Lessons:</b></div><hr>
	<div id="l_instruct"><b>Select</b> a row to <b>"ADD A QUESTION"</b> or click on <b>Edit</b> or <b>Delete</b> to modify a lesson</div>
        <div id="lesson_table"></div>
	<div id="plus_lesson" onclick="add_a_lesson()" style="cursor: pointer;">+add a new lesson</div>
	<br>
	<div id="add_lesson_box" style="display: none;">
	    <div></div>
    	    <div><input id="new_eid" style="display: none;" type="text" name="eid" value="<?php echo $eid; ?>"></div>
	    <div><b>Create A Lesson:</b></div><hr>
	    <div>Lesson Name:</div>
	    <div><input id="new_lesson_name" type="text" name="lesson_name" value=""></div>
    	    <div>Description:</div>
	    <div><textarea id="new_description" name="description" form="create_lesson_form" rows="14" cols="100"></textarea></div>
	    
	    <div>Reward: $<input id="new_lesson_reward" type="number" name="reward" min="0" value="0" step="0.01"></div>
	    <div>Youtube URL: <span id="url_font">example: https://www.youtube.com/watch?v=abcdefghijk</span></div>
	    <div><input id="new_youtube" type="text" name="youtube" value="" size="55"></div>
	    <div><input type="button" value="Save" onclick="save_lesson()"><input type="button" value="Cancel" onclick="cancel_lesson()"></div>
	</div>
        <div id="edit_lesson"></div>
        <div></div>
    </div>
    <br>
    <!-- ////////////////////////////////////////////////////////////////// -->
    <div id="lesson_assign">
        <div></div>
    </div>
    <br>
    <!-- ////////////////////////////////////////////////////////////////// -->
    <div id="question">
        <div id="q_instruct" style="display: none;"><b>SELECT</b> a row to <b>ADD AN ANSWER</b> or click on <b>EDIT</b> or <b>DELETE</b> to modify a question</div>
        <div id="question_table"></div>
	<div id="plus_question" style="display: none; cursor: pointer;" onclick="add_a_question()">+add a question</div>
        <div id="new_question_box" style="display: none;">
	    <div>Create A New Question:</div>
	    <div>Question Name:</div>
	    <div><input id="new_q_name" type="text" value=""></div>
	    <div>Ask A Question:</div>
	    <div><textarea id="new_the_question"></textarea></div>
	    <div>Order in which the Question will appear:</div>
	    <div><input id="new_q_order_of" type="number" value="1" min="1"></div>
	    <div><input type="button" value="Save" onclick="save_question()"><input type="button" value="Cancel" onclick="cancel_question()"></div>
	</div>
        <div id="edit_question"></div>
    </div>
    <br>
    <!-- ////////////////////////////////////////////////////////////////// -->
    <div id="answer">
        <div id="a_instruct" style="display: none;">Click on <b>Edit</b> or <b>Delete</b> to modify an answer</div>
        <div id="answers_table"></div>
	<div id="plus_answer" style="display: none; cursor: pointer;" onclick="add_an_answer()">+add an answer</div>
        <div id="new_answer_box" style="display: none;">
	    <div>Create A New Answer:</div>
	    <div>Enter an answer</div>
	    <div><textarea id="new_the_answer" value=""></textarea></div>
	    <div>Is this answer CORRECT?</div>
	    <div><input id="new_correct" type="radio" name="correct" value="true">Yes</div>
	    <div><input id="new_correct" type="radio" name="correct" value="false">No</div>
	    <div><input type="button" value="Save" onclick="save_answer()"><input type="button" value="Cancel" onclick="cancel_answer()"></div>
	</div>
        <div id="edit_answer"></div>
    </div>
    <br>
    <!-- ////////////////////////////////////////////////////////////////// -->
    <div id="task">
        <div><b>Manage Tasks:</b></div><hr>
	<div id="t_instruct">Click on <b>Edit</b> or <b>Delete</b> to modify a task</div>
        <div id="tasks_table"></div>
	<div id="plus_task" onclick="add_a_task()" style="cursor: pointer;">+add a new task</div>
        <div id="new_task_box" style="display: none;">
	    <br>
	    <div>Create A New Task:</div>
	    <div><input id="new_eid" style="display: none;" value="<?php echo $eid; ?>"></div>
	    <div>Task Name:</div>
	    <div><input id="new_task_name" type="text" value=""></div>
	    <div>Instructions:</div>
	    <div><textarea id="new_instructions"></textarea></div>
	    
	    <div>Reward: $<input id="new_task_reward" type="number" min="0" step="0.01" value="0"></div>
	    <div>Number Of Minutes Allowed:</div>
	    <div><input id="new_time" type="number" min="1" value="1"></div>
	    <div><input type="button" value="Save" onclick="save_task()"><input type="button" value="Cancel" onclick="cancel_task()"></div>
	</div>
    </div>
    <br>
    <!-- ////////////////////////////////////////////////////////////////// -->
    <div id="task_assign">
        <div></div>
    </div>
    <br>
    <!-- ////////////////////////////////////////////////////////////////// -->
</div>
<script>
///////////////////////////////////////////////////////////////////////////////
    LID = 0;
    QID = 0;
    AID = 0;

    function initialize(){
       get_students(<?php echo $eid; ?>); 
       get_lessons(<?php echo $eid; ?>);
       get_tasks(<?php echo $eid; ?>);
    }
/////////////////////////////////STUDENT///////////////////////////////////////
    function cancel_student(){
        $("#plus_student").css("display", "initial"); 
        $("#add_student_box").css("display", "none");
	$("#edit_student").css("display", "none");
        document.getElementById('new_firstname').value = "";
        document.getElementById('new_lastname').value = "";
	document.getElementById('new_email').value = "";
	document.getElementById('new_username').value = "";
	document.getElementById('new_password1').value = "";
	document.getElementById('new_password2').value = "";
    }

    function save_student(){
        var firstname = document.getElementById('new_firstname').value;
        var lastname = document.getElementById('new_lastname').value;
	var email = document.getElementById('new_email').value;
	var username = document.getElementById('new_username').value;
	var password1 = document.getElementById('new_password1').value;
	var password2 = document.getElementById('new_password2').value;
        var eid = document.getElementById('new_eid').value;

        //alert();

        $("#plus_student").css("display", "initial"); 
        $("#add_student_box").css("display", "none");

        $.ajax({
            url: 'db.php',
            data: {'function' : 'create_student', 
	           'eid' : eid, 
                   'firstname' : firstname, 
		   'lastname' : lastname, 
		   'email' : email, 
		   'user_name' : username,
		   'password1' : password1,
		   'password2' : password2},
	    method: 'POST',
	    success: function(str) {	
	        //alert("return");
	        window.location.assign("dashboard.php");   
            }
        });
	//alert(eid);
    }

    function add_a_student() {
        $("#add_student_box").css("display", "initial" ); 
        $("#plus_student").css("display", "none");
	$("#form_edit_student").css("display", "none");

    }

    function get_students(eid){
        $.ajax({
            url: 'db.php',
            data: {'function' : 'read_students', 'eid' : eid },
	    method: 'POST',
	    success: function(str) {	
	        $("#stu_table").html(str); 
           }
        });  
    }

    function edit_student(uid){
    	$("#edit_student").css("display", "initial");
        $("#form_add_student").css("display", "none");
	$("#plus_student").css("display", "none");
        //alert("EDIT "+uid);
        $.ajax({
            url: 'db.php',
            data: {'function' : 'read_student', 'uid' : uid },
	    method: 'POST',
	    success: function(str) {	
	        $("#edit_student").html(str);           
            }
        });          
    }

    function delete_student(uid){
        $("#form_add_student").css("display", "none");
	$("#form_edit_student").css("display", "none");

        $.ajax({
            url: 'db.php',
            data: {'function' : 'delete_student', 'uid' : uid },
	    method: 'POST',
	    success: function(str) {	
		window.location.assign("dashboard.php");   
            }
        });          
    }

////////////////////////////////LESSON/////////////////////////////////////////
    function select_lesson(lid){
        LID = lid;
	var tag = ".lesson_row"+lid;
	$("._lesson_row").css("background-color", "#999999");
        $(tag).css("background-color", "white");
	$("#plus_question").css("display", "initial");
        $("#question_form").css("display", "none");
        $.ajax({
            url: 'db.php',
            data: {'function' : 'read_questions', 'lid' : lid },
	    method: 'POST',
	    success: function(str) {	
	        $("#question_table").html(str);
		$("#plus_question").css("display", "initial");
		$("#q_instruct").css("display", "initial");
           }
        });        

    }

    function add_a_lesson(){
        //$("#create_lesson_box").css("display", "initial");
	$("#plus_lesson").css("display", "none");
        $("#add_lesson_box").css("display", "initial");

    }

    function edit_lesson(lid){
        //alert(lid);
	$("#plus_lesson").css("display", "none");
        $("#field_create_lesson").css("display", "none");    
        $.ajax({
            url: 'db.php',
            data: {'function' : 'read_lesson', 'lid' : lid },
	    method: 'POST',
	    success: function(str) {	
	        $("#edit_lesson").html(str);
		$("#edit_lesson").css("display", "initial");
           }
        });
    }

    function delete_lesson(lid){
        //alert(lid);
        $("#form_create_lesson").css("display", "none");    
	$("#edit_lesson").css("display", "none");
        $.ajax({
            url: 'db.php',
            data: {'function' : 'delete_lesson', 'lid' : lid },
	    method: 'POST',
	    success: function(str) {	
		window.location.assign("dashboard.php");   
           }
        });
	
    }

    function cancel_lesson(){
        //$("#field_create_lesson").css("display", "none");    
	//$("#edit_lesson").css("display", "none");
	$("#plus_lesson").css("display", "initial");
        $("#add_lesson_box").css("display", "none");

    }

    function save_lesson(){
       	$("#plus_lesson").css("display", "initial");
        $("#add_lesson_box").css("display", "none");

	var lesson_name = document.getElementById('new_lesson_name').value;
	var description = document.getElementById('new_description').value;
	var reward = document.getElementById('new_lesson_reward').value;
	var preview = document.getElementById('new_youtube').value;
	var eid = document.getElementById('new_eid').value;

        $.ajax({
            url: 'db.php',
            data: {'function' : 'create_lesson', 
	           'eid' : eid, 
                   'lesson_name' : lesson_name, 
		   'description' : description, 
		   'reward' : reward, 
		   'preview' : preview },
	    method: 'POST',
	    success: function(str) {	
	        //alert("return");
	        window.location.assign("dashboard.php");   
            }
        });

    }

    function get_lessons(eid){
        $.ajax({
            url: 'db.php',
            data: {'function' : 'read_lessons', 'eid' : eid },
	    method: 'POST',
	    success: function(str) {	
	        $("#lesson_table").html(str); 
           }
        });          
    }
////////////////////////////////LESSON_ASSIGN//////////////////////////////////

//////////////////////////////////QUESTION/////////////////////////////////////
    function edit_question(qid){
        alert(qid);
    }

    function delete_question(qid){
        $.ajax({
            url: 'db.php',
            data: {'function' : 'delete_question', 'qid' : qid},
	    method: 'POST',
	    success: function(str) {	
		window.location.assign("dashboard.php");   
           }
        });
        
    }

    function add_a_question(){
        $("#plus_question").css("display", "none");
	$("#new_question_box").css("display", "initial");
        //show_create_question();
    }

    function cancel_question(){
        $("#new_question_box").css("display", "none");
	$("#plus_question").css("display", "initial");
    }

    function save_question(){
        var q_name = document.getElementById('new_q_name').value;
	var the_question = document.getElementById('new_the_question').value;
	var order_of = document.getElementById('new_q_order_of').value;

        $.ajax({
	    url: 'db.php',
	    data: {'function' : 'create_question', 'q_name' : q_name, 'the_question' : the_question, 'order_of' : order_of, 'lid' : LID},
	    method: 'POST',
	    success: function(str){
	        //alert(str);
                select_lesson(LID);	  
		document.getElementById('new_q_name').value = "";
                document.getElementById('new_the_question').value = "";
                document.getElementById('new_q_order_of').value = "1";

		$("#new_question_box").css("display", "none");
	    }
	});

    }

    function show_create_question(){
        //alert(lid);
        var lid = LID;
	//$("#plus_question").css("display", "none");
        //$("#question_form").css("display", "initial");
	//$("#create_question_field").css("display", "initial");
        $.ajax({
            url: 'db.php',
            data: {'function' : 'show_create_question_form', 'lid' : lid},
	    method: 'POST',
	    success: function(str) {	
	        $("#new_question_box").html(str); 
           }
        });

    }

    function select_question(qid){
    //alert("here"+qid);
        var tag = ".question_row"+qid;
        $("._question_row").css("background-color", "#999999");
	$(tag).css("background-color", "white");

        QID = qid;

	$.ajax({
	    url: 'db.php',
	    data: {'function' : 'read_answers', 'qid' : qid},
	    method: 'POST',
	    success: function(str){
	        //alert(str);
		$("#a_instruct").css("display", "initial");
		$("#answers_table").html(str);
		$("#plus_answer").css("display", "initial");
	    }
	});
    }
///////////////////////////////////ANSWER//////////////////////////////////////
    function add_an_answer(){
        $("#plus_answer").css("display", "none");
	$("#new_answer_box").css("display", "initial"); 
    }

    function save_answer(){
       	$("#plus_answer").css("display", "initial");
        $("#new_answer_box").css("display", "none");   

	var qid = QID;
	var lid = LID;
	var answer = document.getElementById('new_the_answer').value;
	//var correct = document.getElementById('new_correct').value;
	var correct = $("input[name=correct]:checked").val();
//alert(correct);
        $.ajax({
            url: 'db.php',
            data: {'function' : 'create_answer', 
	           'qid' : qid,
		   'lid' : lid,
                   'the_answer' : answer, 
		   'correct' : correct},
	    method: 'POST',
	    success: function(str) {	
	        //alert(str);
		select_question(qid);
	        document.getElementById('new_the_answer').value = "";
            }
        });

    }

    function cancel_answer(){
       	$("#plus_answer").css("display", "initial");
        $("#new_answer_box").css("display", "none");        
    }
////////////////////////////////TASK///////////////////////////////////////////
    function select_task(tid){
        alert(tid);
    }

    function add_a_task(){
    
    }

    function save_task(){
        $("#plus_task").css("display", "initial");
	$("#new_task_box").css("display", "none");

	var task_name = document.getElementById('new_task_name').value;
	var instructions = document.getElementById('new_instructions').value;
	var reward = document.getElementById('new_task_reward').value;
	var time = document.getElementById('new_time').value;
	var eid = document.getElementById('new_eid').value;

        $.ajax({
            url: 'db.php',
            data: {'function' : 'create_task', 
	           'eid' : eid, 
                   'task_name' : task_name, 
		   'instructions' : instructions, 
		   'reward' : reward, 
		   'time' : time },
	    method: 'POST',
	    success: function(str) {	
	        //alert("return");
	        window.location.assign("dashboard.php");   
            }
        });

	
    }

    function cancel_task(){
        $("#plus_task").css("display", "initial");
	$("#new_task_box").css("display", "none");

    }

    function get_tasks(eid){
        $.ajax({
            url: 'db.php',
            data: {'function' : 'read_tasks', 'eid' : eid },
	    method: 'POST',
	    success: function(str) {	
	        $("#tasks_table").html(str); 
           }
        });          
    
    }

    function add_a_task(){
        //alert("ADD TASK"); 
	$("#plus_task").css("display", "none");
	$("#new_task_box").css("display", "initial");
    }

////////////////////////////////TASK_ASSIGN////////////////////////////////////
</script>
</body>
<style>
body {
    background-color: #999999;
}
table, th, td {
    border: 1px solid black;
}
#url_font {
    font-style: italic;
    color: #333333;
}
</style>
</html>
