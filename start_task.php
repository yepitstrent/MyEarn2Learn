<?php
    session_start();
    include('session.php');
    $tid = $_SESSION['tid'];
?>
<html>
<head>
    <title>Earn2Learn: Start Task</title>
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <script src="js/easypiechart.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</head>
<body onload="initialize()">
<div id="e2l_container">
    <div id="e2l_navbar">
        <div id="e2l_logo"><a href="profile.php"><img src="img/logo.svg"></a></div>
        <div id="e2l_menu"><b id="logout"><a href="logout.php">Log Out</a></b></div>
    </div> <!-- END e2l_navbar -->
    
    <div id="e2l_start_task">
        <div id="e2l_start_t_left">
	    <div id="e2l_start_left_header">
	        <img id="e2l_task_icon" src="img/task.svg">
		<div id="e2l_inst">INSTRUCTIONS:</div>
	    </div>
	    <div id="e2l_task_info"></div>
	</div>
	<div id="e2l_start_t_right">
	    <div id="e2l_task_right_wrapper">
	        <center>
	        <span class="chart" data-percent="100">
	            <span style="display: none;" class="percent"></span>
	        </span>	
	        <div id="time">00:00:00</div>
	            <div>
	                <div id="action_btn" onclick="start_stop()">START</div>
	                <div id="done_btn" onclick="finish_task(<?php echo $tid; ?>)">DONE</div>
	            </div>
	        </div>
		</center>
	    </div>	
        </div>
    </div>
    
</div>
<script>

    document.addEventListener('DOMContentLoaded', function() {
        var chart = window.chart = new EasyPieChart(document.querySelector('span'), {
	    easing: 'easeOutElastic',
	    delay: 3000,
	    barColor: 'red',
    	    trackColor: '#ace',
	    scaleColor: false,
	    lineWidth: 20,
	    trackWidth: 16,
	    lineCap: 'butt',
	    size: 250, 
	    onStep: function(from, to, percent) {
	        this.el.children[0].innerHTML = Math.round(percent);
	    }
	});

    });
</script>
<script>
    //var display = document.querySelector('#time');
    STATE = 1;
    INTERVAL = null;
    TIMER = 0;
    TIME = TIMER;
    COUNTER = TIME;
    TID = null;

    function initialize(){
        TID = <?php echo $tid; ?>;
        get_start_task(TID);
	keep_awake();
    }

    function keep_awake(){
        setTimeout(function(){
            var i = 0;
            $.ajax({
                url: 'session.php',
	        success: function() {
		   keep_awake();
                }
            });  
        }, 5000);
    }

    function start_stop() {
        if(STATE == 0){ //STOPPED
            STATE = 1;
	    clearInterval(INTERVAL);
   	    $('#action_btn').css("background-color", "green");
	    $('#action_btn').html("START");

        } else { //STARTED
           
            STATE = 0;
            var display = document.querySelector('#time');
            startTimer(COUNTER, display);
	    $('#action_btn').css("background-color", "red");
            $('#action_btn').html("STOP");
        }        
    }

    function finish_task(tid) {
	clearInterval(INTERVAL);
        submit_task();
    }

    function submit_task() { 

        $.ajax({ url: 'db.php',
            data: { 'function' : 'submit_task', 'time' : COUNTER, 'tid' : TID },
            type: 'POST',
            success: function(str) {     
	          //alert(str);
                  window.location.assign("task_complete.php");
            } 
    });
}


    function get_start_task(tid){
        $.ajax({
            url: 'db.php',
            data: {'function' : 'get_start_t_left', 'tid' : tid},
	    method: 'POST',
	    success: function(str) {	
	        $("#e2l_task_info").html(str); 
            }
        }); 

	$.ajax({
            url: 'db.php',
            data: {'function' : 'get_start_t_right', 'tid' : tid},
	    method: 'POST',
	    success: function(num) {	
                TIME = num * 60;
		COUNTER = TIME;
		set_timer(TIME);
            }
        });
    }

    function startTimer(duration, display) {
        //alert("TOP");
        var timer = duration, hours, minutes, seconds;
        INTERVAL = setInterval(function () {
        
            // extract hours
            hours = Math.floor(timer / (60 * 60));
 
            // extract minutes
            var divisor_for_minutes = timer % (60 * 60);
            minutes = Math.floor(divisor_for_minutes / 60);
 
            // extract the remaining seconds
            var divisor_for_seconds = divisor_for_minutes % 60;
            seconds = Math.ceil(divisor_for_seconds);
            COUNTER = timer;
	    var num = 1 - ( COUNTER / TIME );
	    num = num * 100;
	    if(num > 100){
	        num = 100;
	    }
	    //alert("IN INTERVAL");
            chart.update(num);
	    if (timer-- < 0) {
                //timer = TIME;//FOR NOW...
	        clearInterval(INTERVAL);
	        COUNTER = 0;
	        submit_task();
	        minutes = seconds = hours = 0;
	        //I WANT TO SUBMIT THE ASSIGNMENT AT THE END OF THE CLOCK.
            }
            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;
            hours   = hours   < 10 ? "0" + hours   : hours;
            display.textContent = hours + ":" + minutes + ":" + seconds;
	
        }, 1000);
    }

    function set_timer(duration){
        var display = document.querySelector('#time');
        var timer = duration, hours, minutes, seconds;
 
        // extract hours
        hours = Math.floor(timer / (60 * 60));
 
        // extract minutes
        var divisor_for_minutes = timer % (60 * 60);
        minutes = Math.floor(divisor_for_minutes / 60);
 
        // extract the remaining seconds
        var divisor_for_seconds = divisor_for_minutes % 60;
        seconds = Math.ceil(divisor_for_seconds);
        
        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;
        hours   = hours   < 10 ? "0" + hours   : hours;
        display.textContent = hours + ":" + minutes + ":" + seconds;
    }

</script>
</body>
</html>
