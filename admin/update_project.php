
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ADMIN(Assistant)</title>
<link rel="stylesheet" type="text/css" href="../include/css/global.css" />
<link rel="stylesheet" type="text/css" href="../include/css/pmsadmin.css" />
<link rel="stylesheet" type="text/css" href="../include/css/chosen.min.css" />
<script type="text/javascript" src="../include/js/jquery.min.js"></script>
</head>
<body>
<div id="wraper">
     <?php include("header.php");
if (isset($_POST['submit'])) {
	$title			= $_POST['title'];
	$description	= $_POST['description'];
	$startingdate	= $_POST['startingdate'];
	$endingdate		= $_POST['endingdate'];
	$assigneeid		= $_POST['assigneeid'];
	$fieldid		= $_POST['fieldid'];
	$status			= $_POST['status'];
	$sql	= mysql_query("SELECT title FROM projects WHERE id=".$_GET['projectid']);
	$row	= mysql_fetch_array($sql);
	$path	= $row['title'];
	rename('../data/projects/'.$path, '../data/projects/'.$title);
	$sql = mysql_query("UPDATE `projects` SET `title`='$title',`description`='$description', `startingdate`='$startingdate', `endingdate`='$endingdate', `status`='$status', `assigneeid`='$assigneeid', `fieldid`='$fieldid' WHERE id=".$_GET['projectid']);
	if (!$sql) {
		$_SESSION['success'] = false;
		$error = '<div class="alert-box '.(( $_SESSION['success'] )?"success":"error").'">Could not update.</div>';	
		unset($_SESSION['success']);
	} else {
		$query = mysql_query("SELECT id,title FROM tasks WHERE projectid=".$_GET['projectid']);
		$count = @mysql_num_rows($query);
		$i = 0;
		if ($count > 0) {
			while ($row = @mysql_fetch_array($query)) {
				$task_id[$i]	= $row['id'];
				$task_title[$i] = $row['title'];
				$query = mysql_query("UPDATE tasks SET filename='../data/projects/".$title."/".$task_title[$i]."' WHERE id='".$task_id[$i]."'");
				$i = $i + 1;
			}
		}
		$_SESSION['success'] = true;
		$error = '<div class="alert-box '.(( $_SESSION['success'] )?"success":"error").'">Changes were saved.</div>';
		unset($_SESSION['success']);
	}
}
?>

	 <script type="text/javascript">jQuery(document).ready(function(){ jQuery("div#cssmenu ul li").removeClass("active"); jQuery("li#new-menu-btn").addClass("active"); });</script>
     <div id="body">     
	 <div class="cb"></div>
		<div class="">
			<span id="form_heading">Project Form</span>
			<?php if (isset($error)) echo $error ?>
		</div>
		 <div id="form_holder">
			 <pre>
			<?php
			$project = false;
			if( isset($_GET['projectid']) ){
				include("../php/classes/project.php");
				$project_obj = new project();
				$project = mysql_fetch_assoc( $project_obj->getProjectById( $_GET['projectid'] ) );
			}
			?></pre>
			<form action="" method="post" id="newproject">
				<div class="form_row">
					
					<div><span id="msg-bar"></span></div>
				</div>
				<div class="form_row">
					<div class="form_cell_text">Title</div>
					<div class="form_cell_element"><input type="text" name="title" class="required-field" value="<?php echo (( $project && isset($project['title']) && !empty($project['title']) )?$project['title']:""); ?>"/></div>
					<div class="form_cell_text">Field</div>
					<div class="form_cell_element">
						<select name="fieldid" class="chosen-select">
						  <?php
						  include_once("../php/classes/field.php");
						  $field_obj = new field();
						  $fields = $field_obj->getFields(false, 1);/* false = not include dependents, 1 = only active fields  */
						  if($fields){
							while( $field = mysql_fetch_assoc($fields) ){
								echo '<optgroup label="'.$field['title'].'">';
								$dependents = $field_obj->getFieldsByDependenId($field['id'], 1);/* 1 = only active fields  */
								while( $dependent = mysql_fetch_assoc($dependents) ){
									echo'<option value="'.$dependent['id'].'" '.(( $project && isset($project['fieldid']) && $project['fieldid'] == $dependent['id'] )?"selected":"").'>'.$dependent['title'].'</option>';
								}
								echo '</optgroup>';
							}
						  }
						  ?>
						</select>
					</div>
				</div>
				<div class="form_row">
					<div class="form_cell_text">Assign To</div>
					<div class="form_cell_element">
						<select name="assigneeid" class="chosen-select">
							<?php
								include_once("../php/classes/user.php");
								$user_obj = new user();
								$users = $user_obj->getUsersByType(2,1);/* 2 = Project manager, 1 = User status*/	
								if($users){
									while( $user = mysql_fetch_assoc($users) ){
										echo '<option value="'.$user['id'].'" '.(( $project && isset($project['assigneeid']) && $project['assigneeid'] == $user['id'] )?"selected":"").'>'.$user['fname'].' '.$user['lname'].'</option>';
									}
								}
							?>
						</select>
					</div>
					<div class="form_cell_text">Status</div>
					<div class="form_cell_element">
						<input type="radio" name="status" value="1" id="active-btn" checked/><label for="active-btn">Active </label>
						<input type="radio" name="status" value="0" id="block-btn" <?php echo (($project && isset($project['status']) && $project['status'] == 0)?"checked":""); ?>/><label for="block-btn">Block</label>
					</div>
				</div>
				
				<div class="form_row">
					<div class="form_cell_text">Starting Date</div>
					<div class="form_cell_element"><input type="date" name="startingdate" id="startingdate" class="required-field" value="<?php echo ((isset($project['startingdate']) && !empty($project['startingdate']))?explode(' ',$project['startingdate'])[0]:""); ?>"/></div>
					<div class="form_cell_text">Ending Date</div>
					<div class="form_cell_element"><input type="date" name="endingdate" id="endingdate" value="<?php echo ((isset($project['endingdate']) && !empty($project['endingdate']))?explode(' ',$project['endingdate'])[0]:""); ?>"/></div>
				</div>
				<div class="form_row">
					<div class="form_cell_text">&nbsp;</div>
					<textarea name="description" placeholder="  Description ( optional )" rows="10" cols="56"><?php echo (( $project && isset($project['description']) && !empty($project['description']) )?$project['description']:""); ?></textarea>
				</div>
				
				<div class="form_row">
					<div class="form_cell_text">&nbsp;</div>
					<div class="form_cell_element">
						<input type="hidden" name="id" value="<?php echo (( $project && isset($project['id']) && !empty($project['id']) )?$project['id']:""); ?>" />
						<input type="submit" name="submit" id="submit" value="Update" />
					</div>
				</div>
			</form>
		 </div>
     </div>
     <script type="text/javascript" src="../include/js/jquery.min.js"></script>
<script type="text/javascript" src="../include/js/chosen.jquery.min.js"></script>
<script type="text/javascript" src="js/newproject.js"></script>
     <?php include("footer.php"); ?>
</div>
</body>
</html>
