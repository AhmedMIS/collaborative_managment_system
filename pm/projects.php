<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ADMIN(Assistant)</title>
<link rel="stylesheet" type="text/css" href="../include/css/global.css" />
<link rel="stylesheet" type="text/css" href="../include/css/pmsadmin.css" />
<link rel="stylesheet" type="text/css" href="../include/css/liststyle.css" />
<link rel="stylesheet" type="text/css" href="../include/css/chosen.min.css" />
<link rel="stylesheet" type="text/css" href="../include/css/theme/jquery-ui-1.10.4.custom.min.css" />
<script type="text/javascript" src="../include/js/jquery.min.js"></script>
</head>
<body>
	<div id="wraper">
		 <?php include("header.php"); ?>
		 <script type="text/javascript">jQuery(document).ready(function(){ jQuery("div#cssmenu ul li").removeClass("active"); jQuery("li#view-menu-btn").addClass("active"); });</script>
		 <div id="body">
			<div class="cb"></div>
			<div class="">
				<span id="form_heading">Projects List</span>
			</div>
			<?php 
				if(isset($_SESSION['success']) ){
					echo '<div class="alert-box '.(( $_SESSION['success'] )?"success":"error").'">'.$_SESSION['msg'].'</div>';
					unset($_SESSION['msg']);
					unset($_SESSION['success']);
				}
				
				include("../php/classes/project.php");
				$project_obj = new project();
				$_POST['userid'] = $_SESSION['user']['id'];
				if($_SERVER['REQUEST_METHOD'] == 'POST'){
					$projects = $project_obj->getProjectsBySearch($_POST);
				}elseif( isset($_GET['projectid']) ){
					$projects = $project_obj->getProjectById($_GET['projectid']);
				}else{
					$projects = $project_obj->getProjectsBySearch($_POST); 
				}
			?>
			 <div id="project_holder">
			 <?php if($projects){ 
			 $projects_arr = array();
			 while( $project = mysql_fetch_assoc($projects) ){ $projects_arr[] = Array('id'=>$project['id'],'description'=>$project['description'],'title'=>$project['title'],'fieldtitle'=>$project['fieldtitle'],'fname'=>$project['fname'],'lname'=>$project['lname'],'startingdate'=>$project['startingdate'],'endingdate'=>$project['endingdate'],'status'=>$project['status']); }?>
				<div class="project_row row_heading">
					<div class="project_cell _num">Project&nbsp;Id</div>
					<div class="project_cell _text">Title</div>
					<div class="project_cell _text">Field</div>
					<div class="project_cell _text">PM</div>
					<div class="project_cell _date">Starting&nbsp;Date</div>
					<div class="project_cell _date">Ending&nbsp;Date</div>
					<div class="project_cell _link"><span id="filter_cntr_btn" title="FILTER"></span></div>
				</div>
				<form action="" method="post">
					<div id="row_filter" style="display:<?php echo (($_SERVER['REQUEST_METHOD'] == 'POST'))?"block":"none"; ?>">
						<div class="project_row info">
							<div class="project_cell _num">Filter</div>
							<?php ?>
							<div class="project_cell _text"><?php if($projects_arr) { ?><select class="chosen-select" name="projectid"><option></option><?php foreach( $projects_arr AS $project ){ echo '<option value="'.$project['id'].'" '.((isset($_POST) && !empty($_POST['projectid']) && $_POST['projectid'] == $project['id'] )?"selected":"").'>'.$project['title'].'</option>'; } ?></select> <?php }else{ echo"Enter Projects first";} ?></div>
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
							<div class="project_cell _text">&nbsp;</div>
							<div class="project_cell _date"><input name="startingdate" value="<?php echo ((isset($_POST) && !empty($_POST['startingdate']) )?$_POST['startingdate']:""); ?>" type="date" /></div>
							<div class="project_cell _date"><input name="endingdate" value="<?php echo ((isset($_POST) && !empty($_POST['endingdate']) )?$_POST['endingdate']:""); ?>" type="date" /></div>
							<div class="project_cell _link"><input type="submit" value="Load" /></div>
						</div>
						<div class="project_row" style="display:none;">
						</div>
					</div>
				</form>
				<?php foreach( $projects_arr AS $project ){ ?>
				<div class="project_row <?php echo ($project['status'] == 0)?"block":"active"; ?>" title="<?php echo ($project['status'] == 0)?"This project has been stopped.":$project['description']; ?>">
					<div class="project_cell _num"><?php echo $project['id']; ?></div>
					<div class="project_cell _text"><?php echo $project['title']; ?></div>
					<div class="project_cell _text"><?php echo $project['fieldtitle']; ?></div>
					<div class="project_cell _text"><?php echo $project['fname'].' '.$project['lname']; ?></div>
					<div class="project_cell _date"><?php echo explode(' ',$project['startingdate'])[0]; ?></div>
					<div class="project_cell _date"><?php echo explode(' ',$project['endingdate'])[0]; ?></div>
					<div class="project_cell _link">
						<a href="view_project.php?projectid=<?php echo $project['id']; ?>"><span title="View Project" class="ui-icon ui-icon-clipboard"></span></a>
						<!--<a class="delete-btn" href="../php/deleteproject.php?projectid=<?php echo $project['id']; ?>"><span title="Delete Project" class="ui-icon ui-icon-trash"></span></a> 
						<a href="newproject.php?projectid=<?php echo $project['id']; ?>"><span title="Update Project" class="ui-icon ui-icon-refresh"></span></a>
						<span class="ui-icon ui-icon-gear"></span> -->
					</div>
				</div>
				<?php } 
				} ?>
			 </div>
			 <br/>
		 </div>
		 <?php include("footer.php"); ?>
	</div>
<script type="text/javascript" src="../include/js/jquery.min.js"></script>
<script type="text/javascript" src="../include/js/chosen.jquery.min.js"></script>
<script type="text/javascript" src="js/filter.js"></script>	
	
	
</body>
</html>
