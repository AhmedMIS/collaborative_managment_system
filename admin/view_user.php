<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ADMIN(Assistant)</title>
<link rel="stylesheet" type="text/css" href="../include/css/global.css" />
<link rel="stylesheet" type="text/css" href="../include/css/chosen.min.css" />

</head>
<body>
<div id="wraper">
     <?php include("header.php");
	 if (isset($_POST['submit'])) {
		 echo $_POST['status'];		 
	 }?>
	 <script type="text/javascript">jQuery(document).ready(function(){ jQuery("div#cssmenu ul li").removeClass("active"); jQuery("li#new-menu-btn").addClass("active"); });</script>
     <div id="body">
	 <div class="cb"></div>
		<div class="">
			<span id="form_heading">User Form</span>
			<div class="alert-box error" style="display:none;">Error</div>
		</div>
		<?php
		$user = false;
		if( isset($_GET['userid']) ){ 
			include("../php/classes/user.php");
			$user_obj = new user();
			if( isset($_GET['userid']) ){
				$users = $user_obj->getUserById( $_GET['userid'] );
			}else{
				$users = $user_obj->getUsersByPM($_SESSION['user']['id']);
			}
			 $user = mysql_fetch_assoc($users);
		}
		?>
		 <div id="form_holder">
         <table id="view_user">
          <tr>
            <td>Username</td>
            <td style=" color:#06F; border-right:none"><?php echo $user['username']; ?></td>
          </tr>
          <tr>
            <td>Full Name</td>
            <td style=" color:#06F; border-right:none"><?php echo $user['fname'] . ' ' . $user['lname']; ?></td>
          </tr>
          <tr>
            <td>User Role</td>
            <td style=" color:#06F; border-right:none"><?php echo $user['title']; ?></td>
          </tr>
          <tr>
            <td>Email</td>
            <td style=" color:#06F; border-right:none"><?php echo $user['email']; ?></td>
          </tr>
          <tr>
            <td>Contact Number</td>
            <td style=" color:#06F; border-right:none"><?php echo $user['phone']; ?></td>
          </tr>
          <tr>
            <td>Address</td>
            <td style=" color:#06F; border-right:none"><?php echo $user['address']; ?></td>
          </tr>
          <tr>
            <td>Qualification</td>
            <td style=" color:#06F; border-right:none"><?php echo $user['qualification']; ?></td>
          </tr>
          <tr>
            <td>Joining Date</td>
            <td style=" color:#06F; border-right:none"><?php echo date("M j, Y",strtotime($user['joiningdate'])); ?></td>
          </tr>
        </table>

		 </div>
     </div>
	 <script type="text/javascript" src="../include/js/jquery.min.js"></script>
<script type="text/javascript" src="../include/js/chosen.jquery.min.js"></script>
<script type="text/javascript" src="js/newteam.js"></script>
     <?php include("footer.php"); ?>
</div>
</body>
</html>
