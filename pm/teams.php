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
		 <?php include("header.php"); ?>
		 <script type="text/javascript">jQuery(document).ready(function(){ jQuery("div#cssmenu ul li").removeClass("active"); jQuery("li#view-menu-btn").addClass("active"); });</script>
		 <div id="body">
			<div class="cb"></div>
			<div class="">
				<span id="form_heading">Teams List</span>
			</div>
			<?php 
				if(isset($_SESSION['success']) ){
					echo '<div class="alert-box '.(( $_SESSION['success'] )?"success":"error").'">'.$_SESSION['msg'].'</div>';
					unset($_SESSION['msg']);
					unset($_SESSION['success']);
				}
				
				include("../php/classes/team.php");
				$team_obj = new team();
				$_POST['userid'] = $_SESSION['user']['id'];
				if ($_SERVER['REQUEST_METHOD'] == 'POST'){
					$teams = $team_obj->getTeamsBySearch($_POST);
				}elseif( isset($_GET['teamid']) ){
					$teams = $team_obj->getTeamById($_GET['teamid'])['team'];
				}else{
					$teams = $team_obj->getTeamsBySearch($_POST); 
				}
			?>
			 <div id="project_holder">
			 <?php if($teams){ 
			 $teams_arr = array();
			 while( $team = mysql_fetch_assoc($teams) ){ $teams_arr[] = Array('id'=>$team['id'],'title'=>$team['title'],'fname'=>$team['fname'],'lname'=>$team['lname'],'created'=>$team['created'],'status'=>$team['status'],'totalmembers'=>$team['totalmembers']); }?>
				<div class="project_row row_heading">
					<div class="project_cell _num">Team&nbsp;Id</div>
					<div class="project_cell _text">Title</div>
					<div class="project_cell _text">Team&nbsp;Leader</div>
					<div class="project_cell _num">Members</div>
					<div class="project_cell _date">Created</div>
<!--					<div class="project_cell _des">Progress</div>-->
					<div class="project_cell _link"><span id="filter_cntr_btn" title="FILTER"></span></div>
				</div>
				<form action="" method="post">
					<div id="row_filter" style="display:<?php echo (($_SERVER['REQUEST_METHOD'] == 'POST'))?"block":"none"; ?>">
						<div class="project_row info">
							<div class="project_cell _num">Filter</div>
							<?php ?>
							<div class="project_cell _text"><?php if($teams_arr) { ?><select class="chosen-select" name="teamid"><option></option><?php foreach( $teams_arr AS $team ){ echo '<option value="'.$team['id'].'" '.((isset($_POST) && !empty($_POST['teamid']) && $_POST['teamid'] == $team['id'] )?"selected":"").'>'.$team['title'].'</option>'; } ?></select> <?php }else{ echo"Enter Teams first";} ?></div>
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
				<?php 
				$width = 122;
				$classes = Array('excelent', 'good','fine','bad'); 
				foreach( $teams_arr AS $index => $team ){ ?>
				<div class="project_row <?php echo ($team['status'] == 0)?"block":"active"; ?>" title="<?php echo ($team['status'] == 0)?"This team has been stopped working.":""; ?>">
					<div class="project_cell _num"><?php echo $team['id']; ?></div>
					<div class="project_cell _text"><?php echo $team['title']; ?></div>
					<div class="project_cell _text"><?php echo $team['fname'].' '.$team['lname']; ?></div>
					<div class="project_cell _num"><?php echo $team['totalmembers']; ?></div>
					<div class="project_cell _date"><?php echo explode(' ',$team['created'])[0]; ?></div>
<!--					<div class="project_cell _des"><div class="progressbar-holder"><div class="progressbar"><label><?php echo $width-25; ?>%</label><div class="value bad" jquery-class="<?php echo $classes[$index]; ?>" jquery-width="<?php echo $width -=25; ?>"></div></div></div></div>
 -->					<div class="project_cell _link">
						<!--<span title="View Team" class="ui-icon ui-icon-clipboard"></span>
						<a class="delete-btn" href="../php/deleteteam.php?teamid=<?php echo $team['id']; ?>"><span title="Delete Team" class="ui-icon ui-icon-trash"></span></a> 
						<span class="ui-icon ui-icon-gear"></span> -->
						<a href="update_team.php?teamid=<?php echo $team['id']; ?>"><span title="Update Team" class="ui-icon ui-icon-refresh"></span></a>
					</div>
				</div>
				<?php } 
				}else{ ?>
					<div class="project_row info" >No team found.</div>
				<?php } ?>
			 </div>
			 <br/>
		 </div>
		 <?php include("footer.php"); ?>
	</div>
<script type="text/javascript" src="../include/js/jquery.min.js"></script>
<script type="text/javascript" src="../include/js/chosen.jquery.min.js"></script>
<script type="text/javascript" src="js/filter.js"></script>	
<script type="text/javascript" src="js/teams.js"></script>	
	
	
</body>
</html>
