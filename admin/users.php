<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>View Users</title>
<link rel="stylesheet" type="text/css" href="../include/css/global.css" />
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
				<span id="form_heading">Users List</span>
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
					$users = $user_obj->getUserById( $_GET['userid'] );
				}else{
					$users = $user_obj->getUsers();
				}
			?>
			 <div id="user_holder">
			 <?php if($users){ ?>
				<div class="user_row row_heading">
					<div class="user_cell _text">First&nbsp;Name</div>
					<div class="user_cell _text">Last&nbsp;Name</div>
					<div class="user_cell _text">Username</div>
					<div class="user_cell _text">User&nbsp;Role</div>
					<div class="user_cell _text">Email</div>
					<div class="user_cell _date">Joining&nbsp;Date</div>
					<div class="user_cell _link">&nbsp;</div>
				</div>
				
				<?php while( $user = mysql_fetch_assoc($users) ){ ?>
				<div class="user_row <?php echo ($user['status'] == 0)?"block":"active"; ?>">
					<div class="user_cell _text"><?php echo $user['fname']; ?></div>
					<div class="user_cell _text"><?php echo $user['lname']; ?></div>
					<div class="user_cell _text"><?php echo $user['username']; ?></div>
					<div class="user_cell _text"><?php echo $user['title']; ?></div>
					<div class="user_cell _text"><?php echo $user['email']; ?></div>
					<div class="user_cell _date"><?php echo explode(' ',$user['joiningdate'])[0]; ?></div>
					<div class="user_cell _link">
						<a href="view_user.php?userid=<?php echo $user['id']; ?>"><span title="View User" class="ui-icon ui-icon-clipboard"></span></a>
						<a class="delete-btn" href="../php/deleteuser.php?userid=<?php echo $user['id']; ?>"><span title="Delete User" class="ui-icon ui-icon-trash"></span></a>
						<a href="update_user.php?userid=<?php echo $user['id']; ?>"><span title="Update User" class="ui-icon ui-icon-refresh"></span></a>
                        
						<!--<span class="ui-icon ui-icon-gear"></span> -->
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