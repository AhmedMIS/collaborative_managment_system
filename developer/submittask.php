<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ADMIN(Assistant)</title>
<link rel="stylesheet" type="text/css" href="../include/css/global.css" />
<link rel="stylesheet" type="text/css" href="../include/css/chosen.min.css" />
<link rel="stylesheet" type="text/css" href="../include/css/components.css" />

</head>
<body>
<div id="wraper">
     <?php include("header.php"); ?>
	 <script type="text/javascript">jQuery(document).ready(function(){ jQuery("div#cssmenu ul li").removeClass("active"); jQuery("li#submit-task-menu-btn").addClass("active"); });</script>
     <div id="body">
	 <div class="cb"></div>
		<span id="form_heading">Task Form</span>
		<hr/>
		<?php
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
			$task = $task_obj->getMyTasks( Array("taskid" => $_GET['taskid'],"userid" => $_SESSION['user']['id'] ) );
			$task = mysql_fetch_assoc( $task );
		}
		?>
		 <div id="form_holder" style="position:relative;">
		 <div id="dropable"></div>
			<form action="../php/submittask.php" method="post" enctype="multipart/form-data" id="taskform">
				<table width="90%">
                  <tr>
                    <td>Project</td>
                    <td style="border-right:none"><?php echo $title = $task['ptitle']; ?></td>
                  </tr>
                  <tr>
                    <td>Task&nbsp;Title</td>
                    <td style="border-right:none"><?php echo $task['title']; ?></td>
                  </tr>
                  <tr>
                    <td>Folder&nbsp;Name</td>
                    <td style="border-right:none"><?php echo $task['filename']; ?></td>
                  </tr>
                  <tr>
                    <td>File(s)</td>
                    <td style="border-right:none"><input type="file" id="files" name="filename[]" multiple /></td>
                  </tr>
                  <tr>
                    <td>Uploading</td>
                    <td style="border-right:none"><div class="progressbar-holder"><div class="progressbar"><label style="top:1px;color:blue;">0%</label><div class="value excelent" ></div></div></div></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td style="border-right:none"><input type="submit" id="savebtn" value="Submit" />
						<input type="reset" value="Reset" /></td>
                  </tr>
                </table>
				<input type="hidden" name="id" id="id" value="<?php echo ((isset($task))?$task['id']:""); ?>" />
                <?php $query = mysql_query("SELECT assigneeid FROM projects WHERE title='$title'"); $row=@mysql_fetch_array($query); $row['assigneeid']?>
                <input type="hidden" name="pmid" id="pmid" value="<?php echo $row['assigneeid'] ?>" />
			</form>
		 </div>
     </div>
	 <script type="text/javascript" src="../include/js/jquery.min.js"></script>
<script type="text/javascript" src="js/submittask.js"></script>
     <?php include("footer.php"); ?>
</div>
</body>
</html>
