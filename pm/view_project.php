
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
				<div class="form_row">
					
					<div><span id="msg-bar"></span></div>
				</div>
				<div class="form_row">
                <table id="view_user">
                  <tr>
                    <td>Title</td>
                    <td style="border-right:none; color:#06F"><?php echo (( $project && isset($project['title']) && !empty($project['title']) )?$project['title']:""); ?></td>
                  </tr>
                  <tr>
                    <td>Field</td>
                    <td style="border-right:none; color:#06F">
					<?php
						  include_once("../php/classes/field.php");
						  $field_obj = new field();
						  $fields = $field_obj->getFields(false, 1);/* false = not include dependents, 1 = only active fields  */
						  if($fields){
							while( $field = mysql_fetch_assoc($fields) ){
								$dependents = $field_obj->getFieldsByDependenId($field['id'], 1);/* 1 = only active fields  */
								$dependent = mysql_fetch_assoc($dependents);
								$sql = mysql_query("SELECT title FROM fields WHERE id=".$project['fieldid']);
								$row = @mysql_fetch_array($sql);
								echo $row['title'];
								break;
							}
						  }
						  ?></td>
                  </tr>
                  <tr>
                    <td>Assign To</td>
                    <td style="border-right:none; color:#06F">
					<?php
								include_once("../php/classes/user.php");
								$user_obj = new user();
								$users = $user_obj->getUsersByType(2,1);/* 2 = Project manager, 1 = User status*/	
								if($users){
									while( $user = mysql_fetch_assoc($users) ){
										if ($project['assigneeid'] == $user['id']) {
											$sql = mysql_query("SELECT fname,lname FROM users WHERE id=".$user['id']);
											$row = @mysql_fetch_array($sql);
											echo $row['fname'] . ' ' . $row['lname'];	
										}
									}
								}
							?></td>
                  </tr>
                  <tr>
                    <td>Status</td>
                    <td style="border-right:none; color:#06F"><?php if($project['status'] == 1) echo 'Active'; else echo 'Block'; ?></td>
                  </tr>
                  <tr>
                    <td>Starting Date</td>
                    <td style="border-right:none; color:#06F"><?php echo date("M j, Y",strtotime($project['startingdate'])); ?></td>
                  </tr>
                  <tr>
                    <td>Ending Date</td>
                    <td style="border-right:none; color:#06F"><?php echo date("M j, Y",strtotime($project['endingdate'])); ?></td>
                  </tr>
                  <tr>
                    <td>Description</td>
                    <td style="border-right:none; color:#06F"><?php echo (( $project && isset($project['description']) && !empty($project['description']) )?$project['description']:""); ?></td>
                  </tr>
                </table>

		 </div>
     </div>
     <script type="text/javascript" src="../include/js/jquery.min.js"></script>
<script type="text/javascript" src="../include/js/chosen.jquery.min.js"></script>
<script type="text/javascript" src="js/newproject.js"></script>
     <?php include("footer.php"); ?>
</div>
</body>
</html>
