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
     <?php include("header.php"); include 'functions.php';
if (isset($_POST['submit'])) {
	if (empty($_POST['old_password'])) {
		$error['old_password'] = 'Enter your old password.';	
	} else if (get_old_password($_SESSION['user']['id']) !== md5($_POST['old_password'])) {
		$error['old_password'] = 'Incorrect old password.';	
	}
	if (empty($_POST['new_password'])) {
		$error['new_password'] = 'Enter your new password.';	
	} else if (strlen($_POST['new_password']) < 4) {
		$error['new_password'] = 'Minimum 5 characters allowed.';	
	}
	if (empty($_POST['confirm_password'])) {
		$error['confirm_password'] = 'Confirm your new password.';	
	} else if (strlen($_POST['confirm_password']) < 4) {
		$error['confirm_password'] = 'Minimum 5 characters allowed.';	
	}
	if ($_POST['new_password'] != $_POST['confirm_password']) {
		$error['new_password'] = 'Passwords do not match.';
		$error['confirm_password'] = 'Passwords do not match.';	
	}
	if (empty($error)) {
		$password = md5($_POST['new_password']);
		$query = mysql_query("UPDATE users SET password='$password' WHERE id=".$_SESSION['user']['id']);
		if (!$query) {
			$_SESSION['success'] = false;
			$error['success'] = '<div class="alert-box '.(( $_SESSION['success'] )?"success":"error").'">Could not change password.</div>';	
			unset($_SESSION['success']);
		} else {
			$_SESSION['success'] = true;
			$error['success'] = '<div class="alert-box '.(( $_SESSION['success'] )?"success":"error").'">Password changed.</div>';
			unset($_SESSION['success']);
		}
	}
}
?>
	 <script type="text/javascript">jQuery(document).ready(function(){ jQuery("div#cssmenu ul li").removeClass("active"); jQuery("li#new-menu-btn").addClass("active"); });</script>
     <div id="body">
	 <div class="cb"></div>
		<span id="form_heading">Settings</span><br /><br />
        <?php if (isset($error['success'])) echo $error['success']?>
			<form action="" method="post" id="settings">
<table style="margin:30px" width="50%">
  <tr>
    <td>Old Password</td>
    <td style="border-right:none"><input type="password" name="old_password" /><?php if(isset($error['old_password']))echo '<li>'.$error['old_password'] .'</li>'?></td>
  </tr>
  <tr>
    <td>New Password</td>
    <td style="border-right:none"><input type="password" name="new_password" /><?php  if(isset($error['new_password']))echo '<li>'.$error['new_password'] .'</li>'?></td>
  </tr>
  <tr>
    <td>Confirm Password</td>
    <td style="border-right:none"><input type="password" name="confirm_password" /><?php  if(isset($error['confirm_password']))echo '<li>'.$error['confirm_password'] .'</li>'?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td style="border-right:none"><input type="submit" name="submit" value="Submit" /></td>
  </tr>
</table>

            </form>
     </div>
	 <script type="text/javascript" src="../include/js/jquery.min.js"></script>
<script type="text/javascript" src="../include/js/chosen.jquery.min.js"></script>
<script type="text/javascript" src="js/newtask.js"></script>
<script type="text/javascript" src="js/jquery-2.1.1.min.js" ></script>
<script type="text/javascript">$(document).ready(function(){$('#lulu').css({'background-color':'#1b9bff','color':'white'});$('#new-menu-btn').removeClass('has-sub active');});</script>

     <?php include("footer.php"); ?>
</div>
</body>
</html>
