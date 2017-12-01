<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Project Manager</title>
<link rel="stylesheet" type="text/css" href="../include/css/global.css" />
<link rel="stylesheet" type="text/css" href="../include/css/pmsadmin.css" />
</head>
<body>
<div id="wraper">
     <?php include("header.php"); ?>
<script type="text/javascript">jQuery(document).ready(function(){ jQuery("div#cssmenu ul li").removeClass("active"); jQuery("li#home-menu-btn").addClass("active"); });</script>
     <fieldset style="margin-top:50px; margin-left:135px; width:600px; height:325px; text-align:center;">
     <legend style="color:#06F; font-family:Verdana, Geneva, sans-serif;">Project Manager Control Pannel</legend>
     <div id="icons1">
     <a href ="newteam.php"><img src="../include/images/New-Teams.png" img style="margin-left:5px; border: solid 1px #0066FF;"/></a>
     <a href ="newtask.php"><img src="../include/images/Task.png" img style="margin-left:40px; border: solid 1px #0066FF;"/></a>
     <a href ="newmeeting.php"><img src="../include/images/New-Meetings-pm.png" img style="margin-left:40px; border: solid 1px #0066FF;"/></a>
     <a href ="tasks.php"><img src="../include/images/View-Tasks.png" img style="margin-left:40px; border: solid 1px #0066FF;"/></a> 
     </div>
     
     <div id="icons2">
     <a href ="teams.php"><img src="../include/images/View-Teams.png" img style="margin-left:5px; border: solid 1px #0066FF;"/></a>
     <a href ="projects.php"><img src="../include/images/View-Projects-pm.png" img style="margin-left:40px; border: solid 1px #0066FF;"/></a>
     <a href ="users.php"><img src="../include/images/Subordinate.png" img style="margin-left:40px; border: solid 1px #0066FF;"/></a>
     <a href ="meetings.php"><img src="../include/images/View-Meeting-pm.png" img style="margin-left:40px; border: solid 1px #0066FF;"/></a>
     </div>
     </fieldset>

     <?php include("footer.php"); ?>
</div>
</body>
</html>
