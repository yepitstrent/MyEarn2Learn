function get_lesson_content() {
    alert(window.location.href);
    $.ajax({
        url: 'db.php',
        data: {'function" : "get_all_lessons'},
	method: 'POST',
	success: function(str) {	
	    //$("#e2l_lesson_tiles").html(str); 
	    alert("RETURNED");
        }
    });    
}
