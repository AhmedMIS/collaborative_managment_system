<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ADMIN(Assistant)</title>
<link rel="stylesheet" type="text/css" href="../include/css/global.css" />
<link rel="stylesheet" type="text/css" href="../include/css/pmsadmin.css" />
<link rel="stylesheet" type="text/css" href="../include/css/view.css" />
<link href="css/theme/jquery-ui-1.10.4.custom.css" rel="stylesheet">
</head>
<body>
<div id="wraper">
     <?php include("header.php"); ?>
	 <script type="text/javascript">
	 	jQuery(document).ready(function(){ 
			jQuery("div#cssmenu ul li").removeClass("active");
			jQuery("li#view-menu-btn").addClass("active"); 
		});
     </script>
     <div id="user_details">
     <script src="js/jquery-1.10.2.js"></script>
	<script src="js/jquery-ui-1.10.4.custom.js"></script>
    <script>
	$(function() {
		$( "#tabs" ).tabs();
		$( "#progressbar" ).progressbar({
			value: 20
		});
	});
	</script>
    
    
    <div class="cb"></div>
    <div id="search_form">
    	<form action="" method="get">
    	<label for="userid" style="font-size:13px">Username : </label>
        <input type="text" id="userid" name="userid" value="<?php echo ( isset($_GET['userid']) && !empty($_GET['userid']) )?$_GET['userid']:""; ?>" />
        <input type="submit" value="View" />
        </form>
        <?php
		
		include("../php/classes/user.php");
		include("../php/classes/task.php");
		$user = null;
		$user_obj = new user();
		$task_obj = new task();
		if( isset($_GET['userid']) ){
			$user = $user_obj->getUserByUsername( $_GET['userid'] ) ;
			$user_tasks = $task_obj->getTasksByUserId( $_GET['userid'] ) ;
		}
		?>
    </div>
    <div id="tabs">
        <ul>
            <li><a href="#tabs-1">User Profile</a></li>
            <li><a href="#tabs-2">User Progress</a></li>
            <li><a href="#tabs-3">Attendance</a></li>
        </ul>
        
     </div>
     
     <?php include("footer.php"); ?>
</div>
</body>
</html>