<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>New Project</title>
<link rel="stylesheet" type="text/css" href="../include/css/global.css" />
<link rel="stylesheet" type="text/css" href="../include/css/pmsadmin.css" />
<link rel="stylesheet" type="text/css" href="../include/css/chosen.min.css" />
<link rel="stylesheet" type="text/css" href="css/jquery-ui.css" />
<script type="text/javascript" src="../include/js/jquery.min.js"></script>

</head>
<body>
<div id="wraper">
     <?php include("header.php"); 
	 
function test_input($data) {
  $data = trim($data);
  $data = mysql_real_escape_string($data);
  $data = stripslashes($data);
  $data = strip_tags($data);
  $data = htmlspecialchars($data);
  return $data;
}
	 if (isset($_POST['submit'])) {
		 $title			= test_input($_POST['title']);
		 $field_id 		= $_POST['fieldid'];
		 $assignee_id	= $_POST['assigneeid'];
		 $status		= $_POST['status'];
		 $starting_date	= $_POST['startingdate'];
		 $ending_date	= $_POST['endingdate'];
		 $description	= test_input($_POST['description']);
		 if (empty($title)) {
			 $errors['title'] = 'Enter a title.';
		 } else {
			 $title = preg_split('/[\s]+/', $title);
			 $title = implode(" ",$title);
		 }
		 if (empty($description)) {
			 $errors['description'] = 'Enter a description.';
		 } else {
			 $description = preg_split('/[\s]+/', $description);
			 $description = implode(" ",$description); 
		 }
		 if (empty($starting_date)) {
			 $errors['starting_date'] = 'Enter a Starting Date.';
		 }
		 if (empty($ending_date)) {
			 $errors['ending_date'] = 'Enter an Ending Date.';
		 }
		 if (empty($errors)) {
			include_once("../php/classes/project.php");
			$project_obj = new project();
			if( isset($_POST['id']) && !empty($_POST['id']) ){
				$projectid = $project_obj->updateProject($_POST);
			}else{
				$projectid = $project_obj->storeProject($_POST);
			}
			session_start();
			$_SESSION['success'] = ($projectid)?true:false;
			$_SESSION['msg'] = ($_SESSION['success'])?"Project successfully ".(( isset($_POST['id']) && !empty($_POST['id']) )?"updated":"saved"):"Error in ".(( isset($_POST['id']) && !empty($_POST['id']) )?"update":"save")." project.";
			header('Location: ../'.$_SESSION['user']['fn'].'/projects.php'.(($projectid)?"?projectid=".$projectid:""));
		 }
	 }
	 ?>
	 <script type="text/javascript">jQuery(document).ready(function(){ jQuery("div#cssmenu ul li").removeClass("active"); jQuery("li#new-menu-btn").addClass("active"); });</script>
     <div id="body">     
	 <div class="cb"></div>
		<div class="">
			<span id="form_heading">Project Form</span>
			<div class="alert-box error" style="display:none;">Error</div>
		</div>
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
<table>
  <tr>
    <td width="19%">Title</td>
    <td width="39%"><input type="text" name="title" class="required-field" value="<?php echo ((isset($title))?$title:""); ?>"/><?php if(isset($errors['title'])) echo '<li>'.$errors['title'] . '</li>'?></td>
    <td width="12%">Field</td>
    <td width="30%"><select name="fieldid" class="chosen-select">
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
						</select></td>
  </tr>
  <tr>
    <td>Assign To</td>
    <td><select name="assigneeid" class="chosen-select">
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
						</select></td>
    <td>Status</td>
    <td><input type="radio" name="status" value="1" id="active-btn" checked/><label for="active-btn">Active </label>
						<input type="radio" name="status" value="0" id="block-btn" <?php echo (($project && isset($project['status']) && $project['status'] == 0)?"checked":""); ?>/><label for="block-btn">Block</label></td>
  </tr>
  <tr>
    <td>Starting Date</td>
    <td><input type="text" name="startingdate" id="startingdate" class="required-field" maxlength="10" /><?php if(isset($errors['starting_date'])) echo '<li>'.$errors['starting_date'] . '</li>'?></td>
    <td>Ending Date</td>
    <td><input type="text" name="endingdate" id="endingdate" class="required-field" maxlength="10" /><?php if(isset($errors['ending_date'])) echo '<li>'.$errors['ending_date'] . '</li>'?></td>
  </tr>
  <tr>
  	<td>Description</td>
    <td><textarea name="description" placeholder="  Description" rows="10" cols="26"><?php echo ((isset($description))?$description:""); ?></textarea><?php if(isset($errors['description'])) echo '<li>'.$errors['description'] . '</li>'?></td>
  </tr>
</table><br /><br />
<input type="hidden" name="id" value="<?php echo (( $project && isset($project['id']) && !empty($project['id']) )?$project['id']:""); ?>" />
						<input type="submit" name="submit" id="submit" value="Save"  style="margin-left:100px;"/>
						<input type="reset" value="Reset" />
			</form>
<script type="text/javascript" src="../include/js/jquery.min.js"></script>
<script type="text/javascript" src="../include/js/chosen.jquery.min.js"></script>
<script type="text/javascript" src="js/newproject.js"></script>
<script type="text/javascript" src="js/jquery-ui.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$('#startingdate, #endingdate').datepicker({
		dateFormat: 'yy-mm-dd',
		minDate:0
	}).keyup(function() {
		$(this).val('');
	}).change(function() {
		var starting_date = $('#startingdate').val();
		var ending_date = $('#endingdate').val();
		if (starting_date != '' && ending_date != '') {
			if (starting_date > ending_date) {
				$(this).val('');
			}
		}
	});
	
});
</script>
     <?php include("footer.php"); ?>
</div>
</body>
</html>
