<?php
$time = explode(':',date('G:i'));$time[0]+=4; $time = implode($time);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script src="js/script.js"></script>
<script>
$(document).ready(function() {
$("#absend_btn").click(function(){
$("#reason").toggle();
$("#proceed").toggle();
});  
});

</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Employee</title>
<link rel="stylesheet" type="text/css" href="../include/css/global.css" />
<link rel="stylesheet" type="text/css" href="../include/css/pmsadmin.css" />
</head>
<body>
<div id="wraper">
<?php include("header.php");

$query = mysql_query("SELECT date FROM attendance WHERE date=DATE_FORMAT(NOW(),'%Y-%m-%d') AND user_id=".$_SESSION['user']['id']);
$count = @mysql_num_rows($query);
if ($count < 1 && ($time >= '900' && $time <= 1000)) {
	$query = mysql_query("INSERT INTO attendance (`date`, `working_hours`, `user_id`, `leave`) VALUES (now(),'8',".$_SESSION['user']['id'].",'0')");
	if ($query) {
		$_SESSION['success'] = true;
		$error = '<div class="alert-box '.(( $_SESSION['success'] )?"success":"error").'">Your attendance has been marked.</div>';
		unset($_SESSION['success']);
	}
} else if ($count < 1 && $time >= 1200) {
	//$notification_obj = new notification();
	//$notification_obj->storeNotification($_SESSION['user']['id'],3, 0);
}
	
?><?php if(isset($error)) echo '<br /><br />'.$error ?>
	<script type="text/javascript">jQuery(document).ready(function(){ jQuery("div#cssmenu ul li").removeClass("active"); jQuery("li#home-menu-btn").addClass("active"); });</script>
     <fieldset style="margin-top:50px; margin-left:135px; width:600px; height:200px; text-align:center;">
     <legend style="color:#06F; font-family:Verdana, Geneva, sans-serif;">Employee Control Pannel</legend>
	<div id="icons">
    
    <a href ="tasks.php"><img src="../include/images/Employee-Task.png" img style="margin-left:5px; margin-top:30px; border: solid 1px #0066FF;"/></a>
    <a href ="meetings.php"><img src="../include/images/Emp-Meetings.png" img style="margin-left:40px; margin-top:30px; border: solid 1px #0066FF;"/></a>
    <a href ="view_attendance.php"><img src="../include/images/Attendance.png" img style="margin-left:40px; margin-top:30px; border: solid 1px #0066FF;"/></a>
    <a href ="settings.php"><img src="../include/images/Settings.png" img style="margin-left:40px; margin-top:30px; border: solid 1px #0066FF;"/></a>
        
	</div>
    </fieldset>
<?php include("footer.php");?>
     
</div>
</body>
</html>
