<?php
/*GET ALL THE TASKS THAT NEED TO BE GRADED: select t.id, t.task_name from tasks t, user_tasks ut where t.id = ut.t_id and t.creator = 7;*/
    session_start();
//echo "IN DB";
    $action = $_POST['function'];
    $_POST['function'] = "";
//echo $action;
    if($action != null) {

        switch($action){
            case 'create_student' : 
	        $user_name = $_POST['user_name'];
	        $password1 = $_POST['password1'];
	        $password2 = $_POST['password2'];
	        $firstname = $_POST['firstname'];
	        $lastname = $_POST['lastname'];
	        $email = $_POST['email']; 
	        $educator = $_POST['eid'];
	        
	        echo create_student($user_name, $password1, $password2, $firstname, $lastname, $email, $educator );
                header("Location: dashboard.php");
	        break;
	    case 'read_students' : 
	        $educator = $_POST['eid'];
		echo read_students($educator);
	        break;
            case 'read_student' : 
                $uid = $_POST['uid'];

		echo read_student($uid);
	        break;
	    case 'update_student' : 
	        $uid = $_POST['uid'];
		$user_name = $_POST['user_name'];
		$email = $_POST['email'];
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$balance = $_POST['balance'];
		$password1 = $_POST['password1'];
		$password2 = $_POST['password2'];
		$educator = $_POST['educator'];
		echo update_student($uid, $user_name, $email, $firstname, $lastname, $balance, $password1, $password2, $educator);
		header("Location: dashboard.php");
	        break;
	    case 'delete_student' : 
	        $uid = $_POST['uid'];
		echo delete_student($uid);
		break;
	    case 'create_lesson' : 
	        $eid = $_POST['eid'];
		$lesson_name = $_POST['lesson_name'];
		$reward = $_POST['reward'];
		$preview = $_POST['preview'];
		$preview = get_youtube_id($preview);
		$description = $_POST['description'];
	        echo create_new_lesson($eid, $lesson_name, $reward, $preview, $description);
		header("Location: dashboard.php");
		break;
	    case 'read_lessons' : 
	        $eid = $_POST['eid'];
		echo read_lessons($eid);
		//echo "14";
	        break;
	    case 'read_lesson' : 
	        $lid = $_POST['lid'];
		echo read_lesson($lid);
	        break;
	    case 'update_lesson' : 
	        $eid = $_POST['eid'];
		$lid = $_POST['lid'];
		$lesson_name = $_POST['lesson_name'];
		$reward = $_POST['reward'];
		$preview = $_POST['preview'];
		$preview = get_youtube_id($preview);
		$description = $_POST['description']; 
	        update_lesson($eid, $lid, $lesson_name, $reward, $preview, $description);
	        break;
	    case 'delete_lesson' : 
	        $lid = $_POST['lid'];
		echo delete_lesson($lid);
	        break;
	    case 'show_create_question_form' : 
	        $lid = $_POST['lid'];
	        echo show_create_question_form($lid);
		//echo "here";
	        break;
            case 'create_question' :
	        $q_name = $_POST['q_name'];
	        $the_question = $_POST['the_question'];
		$order_of = $_POST['order_of'];
		$lid = $_POST['lid'];
		$eid = $_SESSION['uid'];
                echo create_question($q_name, $the_question, $order_of, $lid, $eid);	        
		//echo "CREATE".;
	        break;
	    case 'read_questions' : 
	        $lid = $_POST['lid'];
		echo read_questions($lid);
	        break;
	    case 'read_question' : 
	        $lid = $_POST['lid'];
	        break;
	    case 'update_question' : break;
	    case 'delete_question' : 
	        $qid = $_POST['qid'];
		delete_question($qid);
	        break;
	    case 'create_answer' : 
	        $qid = $_POST['qid'];
		$lid = $_POST['lid'];
		$the_answer = $_POST['the_answer'];
		$correct = $_POST['correct'];
		//echo "HERE";
		echo create_answer($qid, $lid, $the_answer, $correct);
	        break;
    	    case 'read_answers' : 
	        $qid = $_POST['qid'];
		echo read_answers($qid);
		//echo "here";
	        break;
	    case 'read_answer' : break;
	    case 'update_answer' : break;
	    case 'delete_answer' : break;
	    case 'create_assign_lesson' : break;
	    case 'read_assign_lessons' : break;
	    case 'read_assign_lesson' : break;
	    case 'update_assign_lesson' : break;
	    case 'delete_assign_lesson' : break;
	    case 'create_assign_task' : break;
	    case 'read_assign_tasks' : break;
	    case 'read_assign_task' : break;
	    case 'update_assign_task' : break;
    	    case 'delete_assign_task' : break;
	    case 'create_task' : 
	        $eid = $_POST['eid'];
		$task_name = $_POST['task_name'];
		$reward = $_POST['reward'];
		$time = $_POST['time'];
		$instructions = $_POST['instructions'];

                echo create_task($eid, $task_name, $reward, $time, $instructions);

	        break;
	    case 'read_tasks' : 
	        $eid = $_POST['eid'];
	        echo read_tasks($eid);
	        break;
	    case 'update_task' : break;
	    case 'delete_task' : break;
        }
	unset($_POST);//????????
    }
/*     id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    qid INT(6) UNSIGNED NOT NULL,
    lid INT(6) UNSIGNED NOT NULL,
    the_answer VARCHAR(255) NOT NULL,
    correct BOOLEAN NOT NULL
*/

    function create_answer($qid, $lid, $the_answer, $correct){
        $servername = "localhost";
        $username = "root";
        $password = "password";
        $dbname = "e2l";
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        $ret = "answer";

        $sql = "INSERT INTO answers (qid, lid, the_answer, correct) VALUES (".$qid.", ".$lid.", '".$the_answer."', ".$correct." )";

	if(mysqli_query($conn, $sql)){
	    $ret = "INSERT ANSWER";
	} else {
	    $ret = "ERROR: ANSWER NOT INSERTED";
	}

        mysqli_close($conn);
        return $ret; 
    }

    function read_answers($qid){

        $servername = "localhost";
        $username = "root";
        $password = "password";
        $dbname = "e2l";
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        $ret = "answer";

	$sql = "SELECT * FROM answers WHERE qid = ".$qid;
	$result = mysqli_query($conn, $sql);

        $entries = mysqli_num_rows($result);
	if($entries > 0){
	    $ret = "<table>";
	    $ret = $ret."<tr><th>ID#</th><th>Answer</th><th>Correct</th><th>Edit</th><th>Delete</th></tr>";
	    while($row = mysqli_fetch_assoc($result)){

	        $id = $row['id'];
		$the_answer = $row['the_answer'];
		$correct = $row['correct'];
		if($correct == 1){
		    $correct = 'true';
		} else {
		    $correct = 'false';
		}
		$ret = $ret."<tr><td>".$id."</td><td>".$the_answer."</td><td>".$correct."</td><td>Edit</td><td>Delete</td></tr>";
	    }
	    $ret = $ret."</table>";
	} else {
	    $ret = "<table>".
	               "<tr><th>ID#</th><th>Answer</th><th>Correct</th><th>Edit</th><th>Delete</th></tr>".
		       "<tr><td colspan=5>No Answers Found For This Question</td></tr>".
		   "</table>";
	}
/*
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    qid INT(6) UNSIGNED NOT NULL,
    lid INT(6) UNSIGNED NOT NULL,
    the_answer VARCHAR(255) NOT NULL,
    correct BOOLEAN NOT NULL
*/
        mysqli_close();
        return $ret;
    }

    function create_task($eid, $task_name, $reward, $time, $instructions){
        $servername = "localhost";
        $username = "root";
        $password = "password";
        $dbname = "e2l";
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        $ret = "";

        $sql = "INSERT INTO tasks (task_name, creator, reward, instructions, time) VALUES ('".$task_name."', ".$eid.", ".$reward.", '".$instructions."', ".$time.")";

        if(mysqli_query($conn, $sql)) {
	    $ret = "ALL GOOD";
	} else {
	    $ret = "ERROR: Task NOT CREATED";
	}

	mysqli_close();
	return $ret;
    }

    function delete_question($qid){
        $servername = "localhost";
        $username = "root";
        $password = "password";
        $dbname = "e2l";
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        $ret = "";

        $sql = "DELETE FROM questions WHERE id = ".$qid;
	if(mysqli_query($conn, $sql)){
	    $ret = "DELETED: QUESTION"; 
	    $sql = "DELETE FROM answers WHERE qid = ".$qid;
	    if(mysqli_query($conn, $sql)){
	        $ret = $ret." AND ANSWERS";
	    } else {
	        $ret = $ret." BUT NOT ANSWERS";
	    }
	} else {
	    $ret = "ERROR: QUESTION AND ANSWERS NOT DELETED";
	}

        mysqli_close($conn);    
	return $ret;
    }

    function create_question($q_name, $the_question, $order_of, $lid, $eid){
        $servername = "localhost";
        $username = "root";
        $password = "password";
        $dbname = "e2l";
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        $ret = "";

        $sql = "SELECT * FROM questions WHERE lid = ".$lid." AND order_of = ".$order_of;

        $result = mysqli_query($conn, $sql);
	$entries = mysqli_num_rows($result);
	if($entries > 0){
	
            $order_of++;
            create_question($q_name, $the_question, $order_of, $lid, $eid);

	} else {

            $sql = "INSERT INTO questions (q_name, the_question, order_of, lid ) VALUES ('".$q_name."', '".$the_question."', ".$order_of.", ".$lid." )"; 
            if(mysqli_query($conn, $sql)){
	        $ret = "INSERT";
	    } else {
	        $ret = "Not INSERTED";
	    }
        }
        mysqli_close();
        return $ret;
    }

    function show_create_question_form($lid){
        /*$ret = "<fieldset id=\"create_question_field\">".
	           "<form method=\"post\" action=\"\" id=\"create_question_form\">".
    	               "<div><input style=\"display: none;\" type=\"text\" name=\"function\" value=\"create_question\"></div>".
	               "<div><input style=\"display: none;\" type=\"text\" name=\"lid\" value=\"".$lid."\"></div>".
	               "<div><b>Create A Question</b></div><hr>".
	               "<div>Qusetion Name:</div>".
	               "<div><input type=\"text\" name=\"q_name\" value=\"\"></div>".
	               "<div>Ask Question:</div>".
	               "<div><textarea name=\"the_question\" form=\"create_question_form\" rows=\"14\" cols=\"100\"></textarea></div>".
		       "<div>Choose the order in which displayed</div>".
		       "<div><input type=\"number\" name=\"order_of\" value=\"1\" min=\"1\"></div>".
	               "<div><input type=\"submit\" value=\"Save\"><input type=\"button\" value=\"Cancel\" onclick=\"cancel_question()\"></div>".
       	           "</form>".
	       "</fieldset>";*/

        return $ret;
    }

    function read_questions($lid){
        $servername = "localhost";
        $username = "root";
        $password = "password";
        $dbname = "e2l";
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        $ret = "";

        $sql = "SELECT * FROM questions WHERE lid = ".$lid." order by order_of ASC";
        $result = mysqli_query($conn, $sql);
	$entries = mysqli_num_rows($result);
	if($entries > 0){
	    $ret = "<table>";
	    $ret = $ret."<tr><th>ID#</th><th>Question Name</th><th>Question</th><th>Order</th><th>Edit</th><th>Delete</th></tr>";
	    while($row = mysqli_fetch_assoc($result)){
	        $id = $row['id'];
		$q_name = $row['q_name'];
		$the_question = $row['the_question'];
		$order_of = $row['order_of'];
		$ret = $ret."<tr class=\"question_row".$id." _question_row\"><td onclick=\"select_question('".$id."')\">".$id."</td><td onclick=\"select_question('".$id."')\">".$q_name."</td><td onclick=\"select_question('".$id."')\">".$the_question."</td><td onclick=\"select_question('".$id."')\">".$order_of."</td><td onclick=\"edit_question('".$id."')\">Edit</td><td onclick=\"delete_question('".$id."')\">Delete</td></tr>";
	    }
	    $ret = $ret."</table>";
	} else {
	    $ret = "<table><tr><th>ID#</th><th>Question Name</th><th>Question</th><th>Order</th><th>Edit</th><th>Delete</th></tr><tr><td colspan=6 >No Questions Have Been Created For This Lesson</td></tr></table>";
	}
        
	mysqli_close();
	return $ret;
    }

    function update_lesson($eid, $lid, $lesson_name, $reward, $preview, $description){
        $servername = "localhost";
        $username = "root";
        $password = "password";
        $dbname = "e2l";
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        $ret = "";

        $sql = "UPDATE lessons SET lesson_name = '".$lesson_name."', reward = ".$reward.", preview = '".$preview."', description = '".$description."' WHERE id = ".$lid;
   
        if(mysqli_query($conn, $sql)){
	    $ret = "UPDATED Lesson";
	} else {
	    $ret = "ERROR: Lesson Not UPDATED";
	}
        mysqli_close();
        return $ret;
    }

    function delete_lesson($lid){
        $servername = "localhost";
        $username = "root";
        $password = "password";
        $dbname = "e2l";
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        $ret = "";

        $sql = "DELETE FROM lessons WHERE id = ".$lid;
	if(mysqli_query($conn, $sql)){
	    $ret = "Lesson Deleted";
	} else {
	    $ret = "ERROR: Lesson not Deleted";
	}

	mysqli_close($conn);
	return $ret;
    }

    function read_lesson($lid){
        $servername = "localhost";
        $username = "root";
        $password = "password";
        $dbname = "e2l";
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        $ret = "";

        $sql = "SELECT * FROM lessons WHERE id = ".$lid;
	$result = mysqli_query($conn, $sql);
	$entries = mysqli_num_rows($result);

	if($entries > 0){
	    $row = mysqli_fetch_assoc($result);
	    $id = $row['id'];
	    $lesson_name = $row['lesson_name'];
	    $creator = $row['creator'];
	    $reward = $row['reward'];
	    $preview = $row['preview'];
	    $description = $row['description'];

            $ret = "<fieldset>".
	           "<form id=\"edit_lesson_form\" method=\"post\" action=\"\">".
		       "<div><input type=\"text\" style=\"display: none;\" name=\"function\" value=\"update_lesson\"></div>".
		       "<div><input type=\"text\" style=\"display: none;\" name=\"eid\" value=\"".$creator."\"></div>".
		       "<div><input type=\"text\" style=\"display: none;\" name=\"lid\" value=\"".$id."\"></div>".		       
	               "<div>Edit Lesson</div>".
		       "<div>Lesson Name:</div>".
		       "<div><input type=\"text\" name=\"lesson_name\" value=\"".$lesson_name."\"></div>".
		       "<div>Description:</div>".
		       "<div><textarea name=\"description\" form=\"edit_lesson_form\" rows=\"14\" cols=\"100\" >".$description."</textarea></div>".
		       "<div>Reward: $<input type=\"number\" name=\"reward\" value=\"".$reward."\" min=\"0.00\" step=\"0.01\"></div>".
		       "<div>Youtube URL:</div>".
                       "<div><input type=\"text\" name=\"preview\" value=\"https://www.youtube.com/watch?v=".$preview."\" size=\"50\"></div>".
                       "<div><input type=\"submit\" value=\"Save\"><input type=\"button\" value=\"Cancel\" onclick=\"cancel_lesson()\"></div>".
	           "</form>".
		   "</fieldset>";
	}
        mysqli_close();
        return $ret;
    }


    function create_new_lesson($eid, $lesson_name, $reward, $preview, $description){
        $servername = "localhost";
        $username = "root";
        $password = "password";
        $dbname = "e2l";
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        $ret = "";

        $sql = "INSERT INTO lessons (lesson_name, creator, reward, preview, description) ".
               "VALUES ('".$lesson_name."', ".$eid.", ".$reward.", '".$preview."', '".$description."')";


        if($eid == null || $lesson_name == null || $reward == null ){
	   $ret = "ERROR: Something went wrong. Lesson Not Created.";
	} else {
	    if($preview == null){ $preview = " "; }
	    if($description == null) { $description = " "; }

            if( mysqli_query($conn, $sql)) {
	        $ret = "All Good";
	    } else {
	        $ret = "Error: Not inserted.";
	    }
        }
        mysqli_close($conn);
        return $ret;
    }

    /*http://stackoverflow.com/questions/6556559/youtube-api-extract-video-id*/
    function get_youtube_id($url) {
        $pattern = 
            '%^# Match any youtube URL
            (?:https?://)?  # Optional scheme. Either http or https
            (?:www\.)?      # Optional www subdomain
            (?:             # Group host alternatives
              youtu\.be/    # Either youtu.be,
            | youtube\.com  # or youtube.com
              (?:           # Group path alternatives
                /embed/     # Either /embed/
              | /v/         # or /v/
              | /watch\?v=  # or /watch\?v=
              )             # End path alternatives.
            )               # End host alternatives.
            ([\w-]{10,12})  # Allow 10-12 for 11 char youtube id.
            $%x'
            ;
        $result = preg_match($pattern, $url, $matches);
        if (false !== $result) {
            return $matches[1];
        }
        return false;
    }

    function read_tasks($eid){
        $servername = "localhost";
        $username = "root";
        $password = "password";
        $dbname = "e2l";
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        $ret = "";

        $sql = "SELECT * FROM tasks WHERE creator = ".$eid;
	$result = mysqli_query($conn, $sql);
/*
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    task_name VARCHAR(255) NOT NULL,
    creator INT(6) UNSIGNED NOT NULL,
    reward DECIMAL(10, 2) NOT NULL,
    instructions TEXT NOT NULL,
    created TIMESTAMP,
    due TIMESTAMP,
    time INT(6) UNSIGNED NOT NULL
*/
	$entries = mysqli_num_rows($result);
        if($entries > 0){
	    $ret = "<table>";
	    $ret = $ret."<tr><th>ID#</th><th>Task Name</th><th>Instructions</th><th>Reward</th><th>Number Of Minutes</th><th>Edit</th><th>Delete</th></tr>";

            while($row = mysqli_fetch_assoc($result)){
	        $id = $row['id'];
		$task_name = $row['task_name'];
		$reward = $row['reward'];
		$instructions = $row['instructions'];
		$time = $row['time'];

		$ret = $ret."<tr class=\"task_row".$id." _task_row\"><td onclick=\"select_task('".$id."')\" >".$id."</td><td onclick=\"select_task('".$id."')\" >".$task_name."</td><td onclick=\"select_task('".$id."')\" >".$instructions."</td><td onclick=\"select_task('".$id."')\" >$".$reward."</td><td onclick=\"select_task('".$id."')\" >".$time."</td><td>Edit</td><td>Delete</td></tr>";
	    }

	    $ret = $ret."</table>";
	} else {
	    $ret = "<table>".
	               "<tr><th>ID#</th><th>Task Name</th><th>Instructions</th><th>Reward</th><th>Number Of Minutes</th><th>Edit</th><th>Delete</th></tr>".
		       "<tr><td colspan=7 >No Tasks Have Been Created Yet</td></tr>".
		   "</table>";
	}

        mysqli_close($conn);
        //return $ret;
	return $ret;
    }

    function read_lessons($eid){
        $servername = "localhost";
        $username = "root";
        $password = "password";
        $dbname = "e2l";
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        $ret = "";

        $sql = "SELECT * FROM lessons WHERE creator = ".$eid;
	$result = mysqli_query($conn, $sql);
	$entries = mysqli_num_rows($result);

        if($entries > 0){
	    $ret = "<table>";
	    $ret = $ret."<tr><th>ID#</th><th>Lesson Name</th><th>Description</th><th>Reward</th><th>YouTube ID</th><th>Edit</th><th>Delete</th></tr>";
	    while($row = mysqli_fetch_assoc($result)){
	        $id = $row['id'];
                $lesson_name = $row['lesson_name'];
		$reward = $row['reward'];
		$preview = $row['preview'];
		$description = $row['description'];

		$ret = $ret."<tr class=\"lesson_row".$id." _lesson_row\"><td onclick=\"select_lesson('".$id."')\" >".$id."</td><td onclick=\"select_lesson('".$id."')\" >".$lesson_name."</td><td onclick=\"select_lesson('".$id."')\" >".$description."</td><td onclick=\"select_lesson('".$id."')\" >$".$reward."</td><td onclick=\"select_lesson('".$id."')\" >".$preview."</td><td onclick=\"edit_lesson('".$id."')\">Edit</td><td onclick=\"delete_lesson('".$id."')\">Delete</td></tr>";

	    }
	    $ret = $ret."</table>";
	} else {
	    $ret = "<table>".
	               "<tr><th>ID#</th><th>Lesson Name</th><th>Description</th><th>Reward</th><th>YouTube ID</th><th>Edit</th><th>Delete</th></tr>".
		       "<tr><td colspan=7>No Lessons Have Been Created Yet</td></tr>".
	           "</table>";
	}

        mysqli_close($conn);        
	
	return $ret;
    }

    function delete_student($uid){
        $servername = "localhost";
        $username = "root";
        $password = "password";
        $dbname = "e2l";
        $conn = mysqli_connect($servername, $username, $password, $dbname);

	$sql = "DELETE FROM users WHERE id = ".$uid;

        if(mysqli_query($conn, $sql)){
	    $ret = "Student has been DELETED.";
	} else {
	    $ret = "ERROR: Student not DELETED.";
	}
        $ret = "14";
	mysqli_close($conn);
	return $ret;
    
    }

    function update_student($uid, $user_name, $email, $firstname, $lastname, $balance, $password1, $password2, $educator){
        $ret = "";

        if($uid == null || $user_name == null || $email == null || 
	   $firstname == null || $lastname == null || $balance == null || 
	   $password1 == null || $password2 == null || $educator == null) {

	    $ret = "ERROR: Somethig went wrong";
	} else {
            if($password1 != $password2 ){
	        $ret = "ERROR: Passwords don't match. Student not updated.";
	    } else {

                $servername = "localhost";
                $username = "root";
                $password = "password";
                $dbname = "e2l";
                $conn = mysqli_connect($servername, $username, $password, $dbname);
	        $sql = "SELECT * FROM users WHERE username = '".$user_name."'";
		$result = mysqli_query($conn, $sql);
		$entries = mysqli_num_rows($result);
		$row = mysqli_fetch_assoc($result);
		$temp_id = $row['id'];
		if($entries > 0 && $temp_id != $uid){
		    $ret = "USERNAME already exists. Choose a new name and try again.";
		} else {
		    $sql = "UPDATE users ".
		           "SET username = '".$user_name."', ".
			   "password = '".$password1."', ".
			   "email = '".$email."', ".
			   "firstname = '".$firstname."', ".
			   "lastname = '".$lastname."', ".
			   "balance = ".$balance." ".
		           "WHERE id = ".$uid;

	            if( mysqli_query($conn, $sql) ){
		        $ret = "Student has been UPDATED.";
		    } else {
		        $ret = "ERROR: Student not UPDATED.";
		    }
		}
	
	        mysqli_close($conn);
	    }
	}
        return $ret;
    }

    //SINGLE STUDENT
    function read_student($uid){
        $servername = "localhost";
        $username = "root";
        $password = "password";
        $dbname = "e2l";
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        $ret = "";

        $sql = "SELECT * FROM users WHERE id = ".$uid;

	$result = mysqli_query($conn, $sql);
	$entries = mysqli_num_rows($result);

        if($entries > 0){
	    $row = mysqli_fetch_assoc($result);
	    $id = $row['id'];
	    $user_name = $row['username'];
	    $email = $row['email'];
	    $firstname = $row['firstname'];
	    $lastname = $row['lastname'];
	    $balance = $row['balance'];
	    $password = $row['password'];
	    $educator = $row['educator'];

            $ret = "<form id=\"form_edit_student\" action=\"db.php\" method=\"post\">".
	               "<fieldset>".
		       "<div><b>EDIT STUDENT:</b></div>".
	               "<div>ID:".$id."</div>".
		       "<div><input style=\"display: none;\" type=\"text\" name=\"uid\" value=\"".$id."\"></div>".
		       "<div>USERNAME: ".$user_name."</div>".
		       "<div><input style=\"display: none;\" type=\"text\" name=\"user_name\" value=\"".$user_name."\"></div>".
		       "<div>EMAIL:</div>".
		       "<div><input type=\"text\" name=\"email\" value=\"".$email."\"></div>".
                       "<div>FIRST NAME:</div>".
		       "<div><input type=\"text\" name=\"firstname\" value=\"".$firstname."\"></div>".
                       "<div>LAST NAME:<div>".
		       "</div><input type=\"text\" name=\"lastname\" value=\"".$lastname."\"></div>".
		       "<div>Balance: $<input type=\"number\" name=\"balance\" value=\"".$balance."\" min=\"0\" step=\"0.01\"></div>".
		       "<div>PASSWORD:</div>".
		       "<div><input type=\"password\" name=\"password1\" value=\"".$password."\"></div>".
		       "<div><input type=\"password\" name=\"password2\" value=\"".$password."\"></div>".
		       "<div><input style=\"display: none;\" type=\"text\" name=\"educator\" value=\"".$educator."\"></div>".
		       "<div><input style=\"display: none;\" type=\"text\" name=\"function\" value=\"update_student\" ></div>".
		       "<div><input type=\"submit\" value=\"Save\"><input type=\"button\" value=\"Cancel\" onclick=\"cancel_student()\"></div>".
		       "</fieldset>".
	           "</form>";
        }

        return $ret;
    }

    //ALL STUDENTS
    function read_students($educator){
        $servername = "localhost";
        $username = "root";
        $password = "password";
        $dbname = "e2l";
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        $ret = "";

	$sql = "SELECT * FROM users WHERE educator =".$educator;

	$result = mysqli_query($conn, $sql);
	$entries = mysqli_num_rows($result);

	if($entries > 0){
	    $ret = "<table>";
	    $ret = $ret."<tr>".
	                    "<th>ID#</th>".
			    "<th><b>Student</b></th>".
			    "<th><b>USERNAME</b></th>".
			    "<th><b>EMAIL</b></th>".
			    "<th><b>BALANCE</b></th>".
			    "<th>Edit</th>".
			    "<th>Delete</th>".
			"</tr>";
	    
	    while($row = mysqli_fetch_assoc($result)){
	        
	        $firstname = $row['firstname'];
		$lastname = $row['lastname'];
		$user_name = $row['username'];
		$email = $row['email'];
		$balance = $row['balance'];
		$id = $row['id'];

                $ret = $ret."<tr>".
		                "<td><b>".$id."</b></td>".
		                "<td>".$firstname." ".$lastname."</td>".
		                "<td>".$user_name."</td>".
				"<td>".$email."</td>".
			        "<td>$".$balance."</td>".
				"<td onclick=\"edit_student('".$id."')\" style=\"cursor: pointer;\">Edit</td>".
				"<td onclick=\"delete_student('".$id."')\" style=\"cursor: pointer;\">Delete</td>".
			    "</tr>";
	    }
	    $ret = $ret."</table>";
	} else {
	    $ret = "<table>".
	               "<tr>".
	                    "<th>ID#</th>".
			    "<th><b>Student</b></th>".
			    "<th><b>USERNAME</b></th>".
			    "<th><b>EMAIL</b></th>".
			    "<th><b>BALANCE</b></th>".
			    "<th>Edit</th>".
			    "<th>Delete</th>".
			"</tr>".
			"<tr><td colspan=7>No Students Have Been Created Yet</td></tr>".
	           "</table>";
	}
	return $ret;
    }
    
    function create_student($user_name, $password1, $password2, $firstname, $lastname, $email, $educator){

        $ret = "";
	if($user_name == null || $password1 == null || $password2 == null || 
	   $firstname == null || $lastname == null || $email == null || $educator == null ){
	   $ret = "ERROR: Something went wrong. UN: ".$username." PW1: ".$password1." PW2: ".$password2." FN: ".$firstname." LN: ".$lastname." EM: ".$email." EID: ".$educator;

	} elseif($password1 != $password2){
	    $ret = "ERROR: The passwords you entered don't match.";

	} else {

            $servername = "localhost";
            $username = "root";
            $password = "password";
            $dbname = "e2l";
            $conn = mysqli_connect($servername, $username, $password, $dbname);
	    
            $sql = "select username from users where username = '".$user_name."'";

	    $result = mysqli_query($conn, $sql);
	    $entries = mysqli_num_rows($result);

	    if($entries > 0){
	        $ret = "Please pick a new username. Student not created. UN: ".$user_name;
	    } else {
	        $sql = "INSERT INTO users (username, password, email, firstname, lastname, role, balance, educator) ".
		       "VALUES ('".$user_name."', '".$password1."', '".$email."', '".$firstname."', '".$lastname."', 0, 0.00, ".$educator.")";

		$result = mysqli_query($conn, $sql);

	        $ret = "Student Created";
	    }    
	}
        mysqli_close($conn);
	return $ret;
    }

?>


