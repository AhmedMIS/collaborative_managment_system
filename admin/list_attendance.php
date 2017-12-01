<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Attendance List</title>
<link rel="stylesheet" type="text/css" href="../include/css/attendance.css" />
<link rel="stylesheet" type="text/css" href="../include/css/pmsadmin.css" />
<link rel="stylesheet" type="text/css" href="../include/css/liststyle.css" />
<link rel="stylesheet" type="text/css" href="../include/css/theme/jquery-ui-1.10.4.custom.min.css" />
<script type="text/javascript" src="../include/js/jquery.min.js"></script>
<script type="text/javascript" src="../include/js/jquery-ui-1.10.4.custom.min.js"></script>
<script type="text/javascript" src="js/users.js"></script>
</head>
<body>
	<div id="wraper">
		 <?php include("header.php"); ?>
		 <script type="text/javascript">jQuery(document).ready(function(){ jQuery("div#cssmenu ul li").removeClass("active"); jQuery("li#view-menu-btn").addClass("active"); });</script>
		 <div id="body">
			<div class="cb"></div>
			<div class="">
				<span id="form_heading">Employees Attendance</span>
			</div>
			<?php 
				if(isset($_SESSION['success']) ){
					echo '<div class="alert-box '.(( $_SESSION['success'] )?"success":"error").'">'.$_SESSION['msg'].'</div>';
					unset($_SESSION['msg']);
					unset($_SESSION['success']);
				}
				include("../php/classes/user.php");
				$user_obj = new user();
				if( isset($_GET['userid']) ){
					$username = getEmployee();
				}else{
					list($username,$status,$id) = getEmployee();
				}
			?>
			 <div id="user_holder">
			 <?php if(!empty($username)){ ?>
				<div class="user_row row_heading">
                
					<div class="user_cell _text">Username</div>
                    <div class="user_cell _text"><span style="margin-left:35px;">View</span></div>
					<div class="user_cell _link">&nbsp;</div>
				</div>
				
				<?php for ($i = 0; $i < count($username); $i++){ ?>
				<div class="user_row <?php echo ($status == 0)?"block":"active"; ?>">
                
					<div class="user_cell _text"><?php echo $username[$i]; ?></div>
					<div class="user_cell _link">
						<a href="view_attendance.php?userid=<?php echo $id[$i]; ?>">
                        <span title="View Attendance" class="ui-icon ui-icon-clipboard" style="margin-left:50px;"></span></a>
						<!--<a class="delete-btn" href="../php/deleteuser.php?userid=<?php echo $user['id']; ?>"><span title="Delete User" class="ui-icon ui-icon-trash"></span></a>
						<a href="update_user.php?userid=<?php echo $user['id']; ?>"><span title="Update User" class="ui-icon ui-icon-refresh"></span></a>
						<span class="ui-icon ui-icon-gear"></span> -->
					</div>
				</div>
				<?php } ?>
			<?php }else{ ?>
					<div class="alert-box error">No record found !</div>
				<?php } ?>
			 </div>
		 </div>
		 <?php include("footer.php"); ?>
	</div>
</body>
</html>