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
		$query = mysql_query("UPDATE meetings SET meetingdate='".$_POST['meeting_date']."', status='".$_POST['status']."' WHERE id=".$_GET['meetingid']);
		$notification_obj = new notification();
		$receiver = $_POST['receiver'];
		$receiver = rtrim($receiver,'-');
		$notification_obj->storeNotifications($receiver,1, $_GET['meetingid']);
		if (!$query) {
			$_SESSION['success'] = false;
			$error = '<div class="alert-box '.(( $_SESSION['success'] )?"success":"error").'">Could not update.</div>';	
			unset($_SESSION['success']);
		} else {
			$_SESSION['success'] = true;
			$error = '<div class="alert-box '.(( $_SESSION['success'] )?"success":"error").'">Changes were saved.</div>';
			unset($_SESSION['success']);
		}
	 }
	 if (isset($_GET['meetingid'])) {
		 $query = mysql_query("SELECT * FROM meetings WHERE id=".$_GET['meetingid']);
		 $count = @mysql_num_rows($query);
		 if ($count > 0) {
			while ($row = mysql_fetch_array($query)) {
				$caller_id		= $row['callerid'];
				$title			= $row['title'];
				$meeting_date	= $row['meetingdate'];
				$description	= $row['description'];
				$status			= $row['status'];
				$receiver		= $row['recevier'];
			}
		 }
	 }


?>
	 <script type="text/javascript">jQuery(document).ready(function(){ jQuery("div#cssmenu ul li").removeClass("active"); jQuery("li#new-menu-btn").addClass("active"); });</script>
     <div id="body">
	 <div class="cb"></div>
		<span id="form_heading">Meeting Form</span><br /><br />
        <?php if(isset($error)) echo $error ?>
			<form action="" method="post" id="newmeeting">
<?php $user = get_user_name($caller_id);?>
<table style="margin:0 auto" width="70%">
  <tr>
    <td>Title</td>
    <td style="border-right:none"><?php echo $title ?></td>
  </tr>
  <tr>
    <td>Date</td>
    <td style="border-right:none"><input type="date" name="meeting_date" value="<?php echo (($meeting_date && isset($meeting_date) )?explode(' ',$meeting_date)[0]:""); ?>" /></td>
  </tr>
  <tr>
    <td>From</td>
    <td style="border-right:none"><?php echo  $user['fname']. ' ' . $user['lname'] ?></td>
  </tr>
  <tr>
    <td>To</td>
    <td style="border-right:none"><?php $receiver = explode('-',$receiver);
			 for ($i = 0; $i < count($receiver); $i++) { $user = get_user_name($receiver[$i]);
				echo  '<li>' . $user['fname'] . ' ' . $user['lname'] . '</li>' ;
			 }
		  ?></td>
  </tr>
  <tr>
    <td>Description</td>
    <td style="border-right:none"><?php echo $description ?></td>
  </tr>
  <tr>
    <td>Status</td>
    <td style="border-right:none">
    <select name="status" class="chosen-select-full-width" >
    <option value="2" <?php if($status == 2) echo 'selected'?>>Cancelled</option>
	<option value="1" <?php if($status == 1) echo 'selected'?>>Held</option>
	<option value="0" <?php if($status == 0) echo 'selected'?>>Pending</option>
    </select>
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td style="border-right:none"><input type="hidden" value="<?php foreach($receiver as $key=>$value){echo $value.'-';}?>" name="receiver" /><input type="submit" name="submit" value="Save Changes"</td>
  </tr>
</table>

			</form>
     </div>
	 <script type="text/javascript" src="../include/js/jquery.min.js"></script>
<script type="text/javascript" src="../include/js/chosen.jquery.min.js"></script>
<script type="text/javascript" src="js/newtask.js"></script>
     <?php include("footer.php"); ?>
</div>
</body>
</html>
