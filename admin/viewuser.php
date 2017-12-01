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
        </ul>
        <div id="tabs-1">
        	<br/>

<fieldset>
<legend></legend>
<div id="detail" style="margin-top:3%;; margin-left:10%;">              
    <div class="_row">
    	<div class="_cell">
            <div class="_title"><span style="font-family:Verdana, Geneva, sans-serif;"><b>First Name:</b></span></div>
            <div class="_value"><span style="color:#06F; border: solid 2px #999999;">
            <?php echo ( $user && !empty($user['fname']) )?$user['fname'] : ""; ?>
            </span></div>
        </div>
        <div class="_cell">
            <div class="_title"><span style="font-family:Verdana, Geneva, sans-serif;"><b>Last Name:</b></span></div>
            <div class="_value"><span style="color:#06F; border: solid 2px #999999;">
            <?php echo ( $user && !empty($user['lname']) )?$user['lname'] : ""; ?>
            </span></div>
        </div>
    </div>
    <div class="_row">
    	<div class="_cell">
        	<div class="_title"><span style="font-family:Verdana, Geneva, sans-serif;"><b>Email:</b></span></div>
        	<div class="_value"><span style="color:#06F; border: solid 2px #999999;">
			<?php echo ( $user && !empty($user['email']) )?$user['email'] : ""; ?></span></div>
        </div>
        <div class="_cell">
            <div class="_title"><span style="font-family:Verdana, Geneva, sans-serif;"><b>Phone #:</b></span></div>
            <div class="_value"><span style="color:#06F; border: solid 2px #999999;">
            <?php echo ( $user && !empty($user['phone']) )?$user['phone'] : ""; ?>
            </span></div>
        </div>
    </div>
                  
    <div class="_row">   
    	<div class="_cell">
        	<div class="_title"><span style=" font-family:Verdana, Geneva, sans-serif;"><b>Qualification:</b></span></div>
        	<div class="_value"><span style="color:#06F; border: solid 2px #999999;">
        	<?php echo ( $user && !empty($user['qualification']) )?$user['qualification'] : ""; ?>
        	</span></div>
        </div>
        <div class="_cell">
            <div class="_title"><span style="font-family:Verdana, Geneva, sans-serif;"><b>Joining Date:</b></span></div>
            <div class="_value"><span style="color:#06F; border: solid 2px #999999;">
            <?php echo ( $user && !empty($user['joiningdate']) )?explode(' ',$user['joiningdate'])[0] : ""; ?>
            </span></div>
        </div>
    </div>                  
    
    <div class="_row">              
    	<div class="_cell">
            <div class="_title"><span style=" font-family:Verdana, Geneva, sans-serif;"><b>Employ Type:</b></span></div>
            <div class="_value"><span style="color:#06F; border: solid 2px #999999;">
            <?php echo ( $user && !empty($user['typetitle']) )?$user['typetitle'] : ""; ?>
            </span></div>
        </div>
        <div class="_cell">
            <div class="_title"><span style="font-family:Verdana, Geneva, sans-serif;"><b>NIC #:</b></span></div>
            <div class="_value"><span style="color:#06F; border: solid 2px #999999;">
            <?php echo ( $user && !empty($user['nic']) )?$user['nic'] : ""; ?>
            </span></div>
        </div>
	</div>                
    <div class="_row">
    	<div class="_cell" style="width:100%;">
        	<div style="display:inline-block;width:8%;"><span style=" font-family:Verdana, Geneva, sans-serif;"><b>Address:</b></span></div>
        	<div style="display:inline-block; width:70%;"><span style="margin-left:47px; color:#06F; border: solid 2px #999999;">
        	<?php echo ( $user && !empty($user['address']) )?$user['address'] : ""; ?>
        	</span>
         </div>
    </div>    
</div> 
     </div>
     
     <?php include("footer.php"); ?>
</div>
</body>
</html>
