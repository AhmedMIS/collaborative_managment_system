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
	 if (isset($_POST['submit'])){
		 $title			= $_POST['title'];
		 $project_name	= $_POST['project_name'];
		 $description	= $_POST['description'];
		 $startingdate	= $_POST['startingdate'];
		 $query = mysql_query("SELECT assigneeid FROM tasks WHERE id=".$_GET['taskid']);
		 $row	= @mysql_fetch_array($query);
		 $assigneeid=$row['assigneeid'];
		 if ($_POST['projectid'] == 'Pending'){
			 $status = 0;
		 } elseif ($_POST['projectid'] == 'Accepted'){
			 $status = 2;
		 }elseif ($_POST['projectid'] == 'In Review'){
			 $status = 1;
		 }elseif ($_POST['projectid'] == 'Rejected'){
			 $status = 3;
		 }
		$sql	= mysql_query("SELECT title FROM tasks WHERE id=".$_GET['taskid']);
		$row	= mysql_fetch_array($sql);
		$path	= $row['title'];
		rename('../data/projects/'.$project_name.'/'.$path, '../data/projects/'.$project_name.'/'.$title);
		$sql = mysql_query("UPDATE `tasks` SET `title`='$title',`description`='$description', `startingdate`='$startingdate', `status`='$status' WHERE id=".$_GET['taskid']);
			if (!$sql) {
				$_SESSION['success'] = false;
				$error = '<div class="alert-box '.(( $_SESSION['success'] )?"success":"error").'">Could not update.</div>';	
				unset($_SESSION['success']);
			} else {
				include_once("../php/classes/team.php");
				$team_obj = new team();
				$userid = $team_obj->getUserIdByMemberId($assigneeid);
				
				//save notification
				include_once("../php/classes/notification.php");
				$notification_obj = new notification();
				$notification_obj->storeNotifications($userid, 3, $_GET['taskid']);

				$_SESSION['success'] = true;
				$error = '<div class="alert-box '.(( $_SESSION['success'] )?"success":"error").'">Changes were saved.</div>';
				unset($_SESSION['success']);
			}

	 }
?>
	 <script type="text/javascript">jQuery(document).ready(function(){ jQuery("div#cssmenu ul li").removeClass("active"); jQuery("li#new-menu-btn").addClass("active"); });</script>
     <div id="body">
	 <div class="cb"></div>
		<span id="form_heading">Task Form</span>
		<?php
		if (isset($error)) echo $error;
		/*
		include("../php/classes/task.php");
		$task_obj = new task();
		$task_obj->makeDir("nomi");
		$task_obj->makeDir("nomi");
		*/
		$task = false;
		if( isset($_GET['taskid']) ){
			include("../php/classes/task.php");
			$task_obj = new task();
			$taskinfo = $task_obj->getTaskById( $_GET['taskid'] );
			$task = @mysql_fetch_assoc( $taskinfo['task'] );
			$members_arr = Array();
			while($member = @mysql_fetch_assoc( $taskinfo['members'] )){ 
				$members_arr[ $member['id'] ] = Array('userid' => $member['userid'], 'roleid' => $member['roleid']); 
			}
		}
			
		?>
		 <div id="form_holder">
         <?php list($title, $description, $startingdate, $projectid, $assigneeid) = getTaskById_custom($_GET['taskid']);?>
			<form action="" method="post" id="newtask">
				
				<div class="form_row">
					<div class="form_cell_text">Project</div>
					<div class="form_cell_full_width">
						<input type="text" readonly="readonly" value="<?php echo $projectName = getProjectName($_GET['taskid'])?>" />
                        <input type="hidden" name="project_name" value="<?php echo $projectName = getProjectName($_GET['taskid'])?>" />
					</div>
				</div>
				
				<div class="form_row">
					<div class="form_cell_text">Task&nbsp;Title</div>
					<div class="form_cell_element"><input  type="text" name="title" class="required-field " value="<?php echo $title ?>" /></div>
					<!--
					<div class="form_cell_text">Folder&nbsp;Name</div>
					<div class="form_cell_element"><input  type="text" name="filename" class="required-field " value="" /></div>
				--></div>

				<div class="form_row">
					<div class="form_cell_text">Starting Date</div>
					<div class="form_cell_element">
						<input type="date" name="startingdate" value="<?php echo (($startingdate && isset($startingdate) )?explode(' ',$startingdate)[0]:""); ?>" />
					</div>
					<div class="form_cell_text">Status</div>
					<div class="form_cell_element">
                    <?php $status = getStatus($_GET['taskid']);?>
						<select name="projectid" class="chosen-select-full-width" >
                        <option value="Accepted" <?php if($status == 2) echo 'selected'?>>Accepted</option>
                        <option value="Pending" <?php if($status == 0) echo 'selected'?>>Pending</option>
                        <option value="In Review" <?php if($status == 1) echo 'selected'?>>In Review</option>
                        <option value="Rejected"<?php if($status == 3) echo 'selected'?>>Rejected</option>
                        </select>
					</div>
				</div>

				<div class="form_row">
					<div class="form_cell_text">&nbsp;</div>
					<div class="form_cell_full_width">
						<textarea name="description" placeholder=" Details " rows="10" cols="56"><?php echo $description ?></textarea>
					</div>
				</div>
				
				<div class="form_row">
					<div class="form_cell_text">&nbsp;</div>
					<div class="form_cell_element"></div>
					<div class="form_cell_text">&nbsp;</div>
					<div class="form_cell_element">
						<input type="submit" name="submit" id="submit" value="Update" />
					</div>
				</div>
				<input type="hidden" name="id" value="<?php echo ((isset($task))?$task['id']:""); ?>" />
			</form>
		 </div>
     </div>
	 <script type="text/javascript" src="../include/js/jquery.min.js"></script>
<script type="text/javascript" src="../include/js/chosen.jquery.min.js"></script>
<script type="text/javascript" src="js/newtask.js"></script>
     <?php include("footer.php"); ?>
</div>
</body>
</html>
