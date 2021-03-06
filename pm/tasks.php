	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ADMIN(Assistant)</title>
<link rel="stylesheet" type="text/css" href="../include/css/global.css" />
<link rel="stylesheet" type="text/css" href="../include/css/pmsadmin.css" />
<link rel="stylesheet" type="text/css" href="../include/css/liststyle.css" />
<link rel="stylesheet" type="text/css" href="../include/css/components.css" />
<link rel="stylesheet" type="text/css" href="../include/css/chosen.min.css" />
<link rel="stylesheet" type="text/css" href="../include/css/theme/jquery-ui-1.10.4.custom.min.css" />
<script type="text/javascript" src="../include/js/jquery.min.js"></script>
</head>
<body>
	<div id="wraper">
		 <?php include("header.php"); function getProjectName($id) {
			 $sql = mysql_query("SELECT title FROM projects WHERE id='$id'");
			 $count = @mysql_num_rows($sql);
			 if ($count > 0) {
				 while ($row = mysql_fetch_array($sql)) {
					 $projectName = $row['title'];	 
				 }
				 return $projectName;
			 }else echo 'no';
		 }?>
		 <script type="text/javascript">jQuery(document).ready(function(){ jQuery("div#cssmenu ul li").removeClass("active"); jQuery("li#view-menu-btn").addClass("active"); });</script>
		 <div id="body">
			<div class="cb"></div>
			<div class="">
				<span id="form_heading">Tasks List</span>
			</div>
			<?php 
				if(isset($_SESSION['success']) ){
					echo '<div class="alert-box '.(( $_SESSION['success'] )?"success":"error").'">'.$_SESSION['msg'].'</div>';
					unset($_SESSION['msg']);
					unset($_SESSION['success']);
				}
				
				include("../php/classes/task.php");
				$task_obj = new task();
				$_POST['pmid'] = $_SESSION['user']['id'];
				if ($_SERVER['REQUEST_METHOD'] == 'POST'){
					$tasks = $task_obj->getTasksBySearch($_POST);
				}elseif( isset($_GET['taskid']) ){
					$tasks = $task_obj->getTaskById($_GET['taskid']);
				}else{
					$tasks = $task_obj->getTasksBySearch($_POST); 
				}
			?>
			 <div id="project_holder">
			 <?php if($tasks){ 
			 $tasks_arr = array();
			 
			 while( $task = mysql_fetch_assoc($tasks) ){ $tasks_arr[] = Array('id'=>$task['id'],'projectid'=>$task['projectid'],'title'=>$task['title'],'fname'=>$task['fname'],'lname'=>$task['lname'],'created'=>$task['created'],'status'=>$task['status'],'startingdate'=>$task['startingdate'],'endingdate'=>$task['endingdate']); }
			?>
				<div class="project_row row_heading">
                    <div class="project_cell _pro">Project</div>
					<div class="project_cell _text">Title</div>
					<div class="project_cell _text">Assign&nbsp;To</div>
					<div class="project_cell _date">Created</div><!--
					<div class="project_cell _date">End</div>-->
					<div class="project_cell _num">Progress</div>
					<div class="project_cell _link"><span id="filter_cntr_btn" title="FILTER"></span></div>
				</div>
				<form action="" method="post">
					<div id="row_filter" style="display:<?php echo (($_SERVER['REQUEST_METHOD'] == 'POST'))?"block":"none"; ?>">
						<div class="project_row info">
							<div class="project_cell _num">Filter</div>
							<?php ?>
							<div class="project_cell _text"><?php if($tasks_arr) { ?><select class="chosen-select" name="taskid"><option></option><?php foreach( $tasks_arr AS $task ){ echo '<option value="'.$task['id'].'" '.((isset($_POST) && !empty($_POST['taskid']) && $_POST['taskid'] == $task['id'] )?"selected":"").'>'.$task['title'].'</option>'; } ?></select> <?php }else{ echo"Enter Tasks first";} ?></div>
							<div class="project_cell _text"><?php include_once("../php/classes/field.php"); $field_obj = new field(); $fields = $field_obj->getFields(false, 1);/* false = not include dependents, 1 = only active fields  */
							  if($fields){ ?>
							  <select class="chosen-select" name="fieldid"><option></option>
								<?php while( $field = mysql_fetch_assoc($fields) ){ 
									echo '<optgroup label="'.$field['title'].'">';
									$dependents = $field_obj->getFieldsByDependenId($field['id'], 1);/* 1 = only active fields  */
									while( $dependent = mysql_fetch_assoc($dependents) ){
										echo'<option value="'.$dependent['id'].'" '.((isset($_POST) && !empty($_POST['fieldid']) && $_POST['fieldid'] == $dependent['id'] )?"selected":"").'>'.$dependent['title'].'</option>';
									}
									echo '</optgroup>';
								} ?>
							  </select>
							  <?php }else{ echo"Enter fields first.";} ?>
							  </div>
							<div class="project_cell _date"><input name="created" value="<?php echo ((isset($_POST) && !empty($_POST['created']) )?$_POST['created']:""); ?>" type="date" /></div>
							<div class="project_cell _date"><input name="startingdate" value="<?php echo ((isset($_POST) && !empty($_POST['startingdate']) )?$_POST['startingdate']:""); ?>" type="date" /></div>
							<div class="project_cell _date"><input name="endingdate" value="<?php echo ((isset($_POST) && !empty($_POST['endingdate']) )?$_POST['endingdate']:""); ?>" type="date" /></div>
							<div class="project_cell _num"><input type="submit" value="Load" /></div>
							<div class="project_cell _link">&nbsp;</div>
						</div>
						<div class="project_row" style="display:none;">
						</div>
					</div>
				</form>
				<?php
				foreach( $tasks_arr AS $index => $task ){ ?>
				<div class="project_row <?php echo ($task['status'] == 0)?"held":"active"; ?>" title="<?php echo ($task['status'] == 0)?"This task has been stopped working.":""; ?>">
					<div class="project_cell _pro"><?php  echo $projectName = getProjectName($task['projectid']) ?></div>
					<div class="project_cell _text"><?php echo $task['title']; ?></div>
					<div class="project_cell _text"><?php echo $task['fname'].' '.$task['lname']; ?></div>
					<div class="project_cell _date"><?php echo explode(' ',$task['created'])[0]; ?></div><!--
					<div class="project_cell _date"><?php //echo explode(' ',$task['endingdate'])[0]; ?></div>-->
					<div class="project_cell _num">
					<?php 
					if($task['status'] == 0){
						echo 'Pending';	
					}else if($task['status'] == 1){
						echo 'In Review';	
					}else if($task['status'] == 2){
						echo 'Accepted';	
					}else if($task['status'] == 3){
						echo 'Rejected';	
					}
						?></div>
					<div class="project_cell _link">
						<a href="comments.php?taskid=<?php echo $task['id']; ?>"><span title="Post Comment" class="ui-icon ui-icon-clipboard"></span></a>
                        <a href="update_task.php?taskid=<?php echo $task['id']; ?>"><span title="Update Task" class="ui-icon ui-icon-refresh"></span></a>
                        
					</div>
				</div>
				<?php } 
				}else{ ?>
					<div class="project_row info" >No task found.</div>
				<?php } ?>
			 </div>
			 <br/>
		 </div>
		 <?php include("footer.php"); ?>
	</div>
<script type="text/javascript" src="../include/js/jquery.min.js"></script>
<script type="text/javascript" src="../include/js/chosen.jquery.min.js"></script>
<script type="text/javascript" src="js/filter.js"></script>	
<script type="text/javascript" src="js/tasks.js"></script>	
	
	
</body>
</html>
