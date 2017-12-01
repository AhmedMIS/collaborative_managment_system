<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Task Comments</title>
<link rel="stylesheet" type="text/css" href="../include/css/global.css"/>
<link rel="stylesheet" type="text/css" href="../include/css/pmsadmin.css"/>
<link rel="stylesheet" type="text/css" href="../admin/css/theme/jquery-ui-1.10.4.custom.css"/>
<link rel="stylesheet" type="text/css" href="../include/css/comments.css" />
</head>
<body>
<div id="wraper">
     <?php include("header.php"); include('functions.php');
	 $project_name	= getProjectName($_GET['taskid']);
	 $query = mysql_query("SELECT * FROM tasks WHERE id=".$_GET['taskid']);
	 $count = @mysql_num_rows($query);
	 if ($count > 0) {
		 while($row = mysql_fetch_array($query)) {
			 $task_title	= $row['title'];
			 $starting_date = $row['startingdate'];
		 }
	 }
	 if (isset($_POST['submit'])) {
		$comment = $_POST['comment']; 
		//$status  = $_POST['status'];
		$result  = post_comment($comment, $_SESSION['user']['id'], $_GET['taskid']);
		if ($result) {
			$_SESSION['success'] = true;
			$error = '<div class="alert-box '.(( $_SESSION['success'] )?"success":"error").'">Comment posted successfully.</div>';
			unset($_SESSION['success']);	
		} else {
			$_SESSION['success'] = false;
			$error = '<div class="alert-box '.(( $_SESSION['success'] )?"success":"error").'">Could not post comment.</div>';
			unset($_SESSION['success']);	
		}
	 }
	 ?>
     
     <div class="cb"></div>
     <form action="" method="post">
         <fieldset style="width:780px; margin-left:40px; margin-top:30px;">
         <legend style="color:#06F;"><b>Task Comments</b></legend>
         <?php if (isset($error)) echo $error?>
         <div id="task_detail">
         <span>Project Name:</span>
         <span style="margin-left:50px; color:#06F;"><?php echo $project_name ?></span><br /><br />
         <span>Task Title:</span>
         <span style="margin-left:71px; color:#06F;"><?php echo $task_title ?></span><br /><br />
         <span>Assigning Date:</span>
         <span style="margin-left:37px; color:#06F;"><?php echo date('M j, Y',strtotime($starting_date)) ?></span><br /><br />
         <textarea  name="comment" placeholder="Add Comments" style="margin-left:145px; width:350px; height:150px; color:#03F;" ></textarea><br /><br />
         
         <input type="submit" name="submit" value="Post Comment" id="submit" style="margin-left:395px; height:40px;" /><br /><br />
         
         </div>
         </fieldset>
     </form>
     <?php include("footer.php"); ?>
</div>
</body>
</html>