<?php
    session_start();
    include('session.php');

///////////////////////////////////////////////////////////////////////////////

    $action = $_POST['function'];
    $_POST['function'] = "";
    switch($action){
        case 'get_all_lessons' :
	    $width = $_POST['width'];
	    $height = $_POST['height'];
	    $uid = $_SESSION['uid'];
	    echo get_all_lessons($uid); break;
	case 'goto_lesson' : 
	    $id = $_POST['id']; 
	    goto_lesson($id);
	    break;
	case 'get_video' : 
	    $id = $_POST['id'];
	    echo get_lesson_video($id);
	    break; 
	case 'get_question' : 
	    $id = $_POST['id'];
	    $q_num = $_POST['q_num'];
	    echo json_encode( get_lesson_question($id, $q_num) );
	    //echo "IN HERE";
	    break;
	case 'get_answers' : 
	    $id = $_POST['id'];
	    echo get_lesson_answers($id);
	    //echo "INIT";
	    break;
	case 'insert_grade' :
	    $aid = $_POST['aid'];
	    $uid = $_SESSION['uid'];
	    $qid = $_POST['qid'];
            $lid = $_POST['lid'];
	    echo insert_grade($uid, $lid, $qid, $aid);
	    break;
        case 'submit_lesson' :
	    $u_id = $_SESSION['uid'];
	    $l_id = $_POST['lid'];	    
	    //echo $l_id;
	    echo update_balance($l_id, $u_id);
	    break;
	case 'get_balance' :
	    $uid = $_POST['uid'];
	    echo get_user_balance($uid);
	    break;
	case 'get_user_tasks' : 
	    $uid = $_POST['uid'];
	    echo get_user_tasks($uid);
            break;
	case 'set_session_data' :
            $_SESSION['tid'] = $_POST['tid'];
	    echo $_SESSION['tid'];
	    break;
	case 'get_start_t_left' :
	    $tid = $_POST['tid'];
	    echo get_start_t_left($tid);
	    break;
	case 'get_start_t_right' :
	    $tid = $_POST['tid'];
	    echo get_start_t_right($tid);
	    break;
	case 'submit_task' : 
	    $tid = $_POST['tid'];
	    $uid = $_SESSION['uid'];
            $time_amt = $_POST['time'];
	    $time_cur = date("Y-m-d H:i:s");
	    echo submit_task($tid, $uid, $time_amt, $time_cur);
	    break;
    }//end switch

///////////////////////////////////////////////////////////////////////////////

    function submit_task($tid, $uid, $time_amt, $time_cur){

        $servername = "localhost";
        $username = "root";
        $password = "password";
        $dbname = "e2l";
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        $ret = "";

	$sql = "INSERT INTO user_tasks (u_id, t_id, time_amt, time_cur) VALUES (".$uid.", ".$tid.", ".$time_amt.", '".$time_cur."')"; 
        $result = mysqli_query($conn, $sql);

        mysqli_close($conn);

        return $sql;
    }

    function get_start_t_left($tid){
        $servername = "localhost";
        $username = "root";
        $password = "password";
        $dbname = "e2l";
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        $ret = "";

	$sql = "select * from tasks where id = ".$tid;
       
        $result = mysqli_query($conn, $sql);
	$entries = mysqli_num_rows($result);

        if($entries > 0){
	    $row = mysqli_fetch_assoc($result);
	    $instr = $row['instructions'];
	    $reward = $row['reward'];

	    $ret = "<div>". 
		       "<div id=\"e2l_task_inst_box\">".$instr."</div>".
		       "<div id=\"e2l_task_reward_box\"><div id=\"e2l_task_txt\">REWARD:</div><div id=\"e2l_task_amt\"> $".$reward."</div></div>".
	           "</div>";
	}

	mysqli_close($conn);
 
        return $ret;
    }

    function get_start_t_right($tid){
        $servername = "localhost";
        $username = "root";
        $password = "password";
        $dbname = "e2l";
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        $ret = 10;

	$sql = "select time from tasks where id = ".$tid;
        $result = mysqli_query($conn, $sql);

	$entries = mysqli_num_rows($result);
	if($entries > 0){
	    $row = mysqli_fetch_assoc($result);
	    $ret = $row['time'];
	}

        mysqli_close($conn);

        return $ret;
    }

    function get_user_tasks($uid){
        $servername = "localhost";
        $username = "root";
        $password = "password";
        $dbname = "e2l";
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        $ret = "";

	//$sql = "select * from tasks";
        $sql = "SELECT t.id, t.task_name, t.reward FROM tasks t, users u WHERE t.creator = u.educator AND u.id = ".$uid;
	

        $result = mysqli_query($conn, $sql);
        $entries = mysqli_num_rows($result);

        if($entries > 0){
	    $ret = "";
	    while($row = mysqli_fetch_assoc($result)){
	        $id = $row['id'];
	        $reward = $row['reward'];
		$name = $row['task_name'];
		
		$ret = $ret."<div id=\"e2l_task_row\" onclick=\"goto_task('".$id."')\"><div id=\"e2l_task_name\">".$name."</div><div id=\"e2l_task_reward\">$".$reward."</div></div>";
	    }
	    $ret = $ret."";
	}
        mysqli_close($conn);

        return $ret;
    }

    function get_user_balance($uid){
        $servername = "localhost";
        $username = "root";
        $password = "password";
        $dbname = "e2l";
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        $ret;

        $sql = "select * from users where id = ".$uid;
	$result = mysqli_query($conn, $sql);

        $row = mysqli_fetch_assoc($result);

        $ret = $row['balance'];

        mysqli_close($conn);
        return $ret;
    }

    function lesson_check($lid, $uid ) {
        $servername = "localhost";
        $username = "root";
        $password = "password";
        $dbname = "e2l";
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        $ret = FALSE;

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $sql = "select count(*) as num from user_lessons where u_id = ".$uid." and l_id = ".$lid;            
	$result = mysqli_query($conn, $sql);

        $row = mysqli_fetch_assoc($result);
	$num = $row['num'];

        if($num > 0){
	    $ret = FALSE; //ENTRY FOUND IN TABLE, DON'T CONTINUE 
	} else {
	    $ret = TRUE;  //ENTRY NOT FOUND IN TABLE, CONTINUE
	}

        mysqli_close($conn);   
        return $ret;
    }


    function update_balance($lid, $uid){
   
        if(lesson_check($lid, $uid ) == FALSE){
	    return "";
	}

        $servername = "localhost";
        $username = "root";
        $password = "password";
        $dbname = "e2l";
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        $ret = "NOT GOOD";

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $sql = "select l.reward, count(uq.grade) as total, sum(uq.grade) as sum ".
	       "from user_questions as uq, lessons as l ".
	       "where uq.l_id = ".$lid." ".
	       "and uq.u_id = ".$uid." ".
	       "and l.id = ".$lid; 

        $result = mysqli_query($conn, $sql);

        $entries = mysqli_num_rows($result);

	if($entries > 0){
	    $row = mysqli_fetch_assoc($result);
	    $total = $row['total'];
	    $sum = $row['sum'];
	    $reward = $row['reward'];
            $precision = 2;
            //$ret = $reward;            
            if($total > 0){
	        $percent = ($sum / $total) * 100;
		$percent = round($percent, $precision );

                $ret = $percent;
                
		    $sql = "select balance from users where id =".$uid;
		    $result = mysqli_query($conn, $sql);

		    $entries = mysqli_num_rows($result);

		    if($entries > 0){
		        $row = mysqli_fetch_assoc($result);
			$balance = $row['balance'];
			$new_balance = $balance + $reward;
                        
			$sql = "UPDATE users SET balance = ".$new_balance." WHERE id = ".$uid;
			$result = mysqli_query($conn, $sql);
/*  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    u_id INT(6) UNSIGNED NOT NULL,
    l_id INT(6) UNSIGNED NOT NULL,
    score INT(6) UNSIGNED NOT NULL,
    total_q INT(6) UNSIGNED NOT NULL,
    earned DECIMAL(10,2) NOT NULL*/
			$sql = "INSERT INTO user_lessons (u_id, l_id, score, total_q, earned) ".
			       "VALUES (".$uid.", ".$lid.", ".$sum.", ".$total.", ".$reward.")";
			$result = mysqli_query($conn, $sql);

			$ret = "GOOD";
		    }
	    }
	}
	
        return $ret;

    }

    function insert_grade($uid, $lid, $qid, $aid){

        if(lesson_check($lid, $uid ) == FALSE){
	    return "";
	}

        $servername = "localhost";
        $username = "root";
        $password = "password";
        $dbname = "e2l";
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        $ret = "";

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $sql = "select * from answers where id = ".$aid;
        $result = mysqli_query($conn, $sql);

        $entries = mysqli_num_rows($result);

	if($entries > 0 ){

	    $row = mysqli_fetch_assoc($result);
	    $correct = $row['correct'];

	    if($correct == TRUE){
	        $grade = 1;
	    } else {
	        $grade = 0;
	    }
          
	    $sql = "INSERT INTO user_questions (u_id, l_id, q_id, grade) VALUES (".$uid.", ".$lid.", ".$qid.", ".$grade.")";
	    $result = mysqli_query($conn, $sql);
	}
        mysqli_close($conn);   
        return $correct;
    }

    function get_lesson_question($id, $q_num){
        $servername = "localhost";
        $username = "root";
        $password = "password";
        $dbname = "e2l";
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        $ret;

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

	//get total number of questions for the lesson;
        $sql = "select * from questions where lid = ".$id;
        $result = mysqli_query($conn, $sql);

        $total_q = mysqli_num_rows($result);
        
	//check if the current question is less than or equal to total number of questions
	if($q_num <= $total_q ){

            //get qid and the text
            $sql = "select * from questions where lid = ".$id." and order_of = ".$q_num;
            $result = mysqli_query($conn, $sql);
  
            $entries = mysqli_num_rows($result);
	
            if($entries > 0){
	        $row = mysqli_fetch_assoc($result); 
	        $qid = $row['id'];
	        $question = $row['the_question'];
                $uid = $_SESSION['uid'];
                //check if the current question is in the grade book.
	        $sql = "select grade from user_questions where u_id = ".$uid." and q_id = ".$qid;
	
	        $inner_result = mysqli_query($conn, $sql);
                $entries = mysqli_num_rows($inner_result);

	        if($entries > 0){
	            $q_num++;
		    $ret = get_lesson_question($id, $q_num); 
	        } else {
                    $ret = array($qid, $question);		   

		}	    
	    }
        } else {
	    $ret = array( "-1", "LESSON COMPLETE. \nNO MORE QUESTIONS TO ANSWER.");
	}
        mysqli_close($conn);   
        return $ret;
    }

    function get_lesson_answers($qid){
    
        $servername = "localhost";
        $username = "root";
        $password = "password";
        $dbname = "e2l";
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        $ret = "";

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        } 
        //$sql = "select a.the_answer from questions as q, answers as a where a.qid = q.id and q.lid = ".$id;
        $sql = "select id, the_answer, correct from answers where qid = ".$qid;
        $result = mysqli_query($conn, $sql);
  
        $entries = mysqli_num_rows($result);

        if($entries > 0){
            $i = 65;
	    $ret = $ret."<div id=\"e2l_answer_container\">";
	    while($row = mysqli_fetch_assoc($result)){
	    
	        $ans = "<div class=\"e2l_answer_box\" id=\"answ_".$row['id']."\" onclick=\"mark_answer('".$row['id']."')\"><div id=\"answer_text\">".chr($i).": ".$row['the_answer']."</div></div>";
		$i++;
	        $ret = $ret.$ans;
	    }
	    $ret = $ret."</div>";
	}

        mysqli_close($conn);   
        return $ret;
    }

    function get_lesson_video($id){
    
        $servername = "localhost";
        $username = "root";
        $password = "password";
        $dbname = "e2l";
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        $ret = "";

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        } 
        $sql = "select * from lessons where id = ".$id;
        $result = mysqli_query($conn, $sql);
  
        $entries = mysqli_num_rows($result);

        if($entries > 0){
	    while($row = mysqli_fetch_assoc($result)){
	        $img = $row['preview'];
		if($img == NULL){
		    $img = "<img id=\"e2l_thumbnail\" src=\"img/lesson.svg\">";
		} else {
		    $img = "<iframe width=\"420\" height=\"315\" src=\"http://www.youtube.com/embed/".$img."?autoplay=0\"></iframe>";
		}
		$ret = $img;
	    }
	}
        mysqli_close($conn);   

        return $ret;
    }

    function goto_lesson($id){
          
    }

    function get_all_lessons($uid){

        $servername = "localhost";
        $username = "root";
        $password = "password";
        $dbname = "e2l";
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        $ret = "";

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
	$sql = "SELECT l.id, l.lesson_name, l.reward, l.preview FROM lessons l, users u WHERE l.creator = u.educator AND u.id = ".$uid;
        //$sql = "select * from lessons";
        $result = mysqli_query($conn, $sql);
  
        $entries = mysqli_num_rows($result);

	if($entries > 0){
	    $ret = $ret."<form id=\"lesson_tile_form\" action=\"preview.php\" method=\"post\">";
	    $tile_count = 0;
	    $max_tiles = 12;
	    //$ret = "<div>";
            //$ret = $ret."<div id=\"tile\">";
            while($row = mysqli_fetch_assoc($result)) {
	        $img = $row['preview'];
		if($img == NULL){
		    $img = "<img id=\"e2l_thumbnail\" src=\"img/lesson.svg\">";
		} else {
		    $img = "<img id=\"e2l_thumbnail\" src=\"http://i1.ytimg.com/vi/".$img."/hqdefault.jpg\">";
		}
                $state = $tile_count;
        	//$tile = "<div id=\"e2l_lesson_box\"><div>".$img."</div><div>".$row['lesson_name']."</div><div>".$row['reward']."</div></div>";
                $tile = "<div id=\"".$row['id']."\" class=\"e2l_lesson_box\" onclick=\"goto_lesson('".$row['id']."')\">".
		            "<div>".$img."</div>".
			    "<div>".$row['lesson_name']."</div>".
			    "<div>".$row['reward']."</div>".
			    "<input type=\"radio\" name=\"radio\" value=\"".$row['id']."\" id=\"radio_".$row['id']."\" style=\"display: none;\" >".
			"</div>";
		$ret = $ret.$tile;
		/*switch($state){
		    //ROW 1  
		    case 0: $ret = $ret."<div>".$tile;                                break;
		    case 1: $ret = $ret.$tile;                                        break;
		    case 2: $ret = $ret.$tile;                                        break;
		    case 3: $ret = $ret.$tile."</div>";                               break;
		    //ROW 2
		    case 4: $ret = $ret."<div>".$tile;                                break;
		    case 5: $ret = $ret.$tile;                                        break;
		    case 6: $ret = $ret.$tile;                                        break;
		    case 7: $ret = $ret.$tile."</div>";                               break;
		    case 8: 
		}*/
                if($tile_count >= $max_tiles){
		    break;
		}
		$tile_count++;
	    }
	    
	    $ret = $ret."<button style=\"display: none;\" type=\"submit\" id=\"haha\"></button></form>";
	}

        mysqli_close($conn);   

        return $ret;
    }

?>
