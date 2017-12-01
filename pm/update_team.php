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
     <?php include("header.php");
	 if (isset($_POST['submit'])) {
		 echo $_POST['status'];		 
	 }?>
	 <script type="text/javascript">jQuery(document).ready(function(){ jQuery("div#cssmenu ul li").removeClass("active"); jQuery("li#new-menu-btn").addClass("active"); });</script>
     <div id="body">
	 <div class="cb"></div>
		<div class="">
			<span id="form_heading">User Form</span>
			<div class="alert-box error" style="display:none;">Error</div>
		</div>
		<?php
		$team = false;
		if( isset($_GET['teamid']) ){
			include("../php/classes/team.php");
			$team_obj = new team();
			$teaminfo = $team_obj->getTeamById( $_GET['teamid'] );
			$team = mysql_fetch_assoc( $teaminfo['team'] );
			$members_arr = Array();
			while($member = mysql_fetch_assoc( $teaminfo['members'] )){ $members_arr[ $member['id'] ] = Array('userid' => $member['userid'], 'roleid' => $member['roleid']); }
		}
		?>
		 <div id="form_holder">
			<form action="../php/saveteam.php" method="post" id="newteam">
				<div class="form_row">
					<div class="form_cell_text">Title</div>
					<div class="form_cell_element"><input type="text" name="title" class="required-field" value="<?php echo ((isset($team))?$team['title']:""); ?>" /></div>
					<div class="form_cell_text">Team&nbsp;Leader</div>
					<div class="form_cell_element">
						<select name="leaderid" class="chosen-select">
							<?php
								include_once("../php/classes/user.php");
								$user_obj = new user();
								$users = $user_obj->getUsersByPM($_SESSION['user']['id']);
								if($users){
									while( $user = mysql_fetch_assoc($users) ){
										echo '<option value="'.$user['id'].'" '.(( $team && isset($team['leaderid']) && $team['leaderid'] == $user['id'] )?"selected":"").'>'.$user['fname'].' '.$user['lname'].'</option>';
									}
								}
							?>
						</select>
					</div>
				</div>
				
				<div class="form_row">
					<div class="form_cell_text">Status</div>
					<div class="form_cell_element">
						<input type="radio" name="status" value="1" id="active-btn" <?php echo (($team && isset($team['status']) && $team['status'] == 1)?"checked":""); ?>/><label for="active-btn">Active </label>
						<input type="radio" name="status" value="0" id="block-btn" <?php echo (($team && isset($team['status']) && $team['status'] == 0)?"checked":""); ?>/><label for="block-btn">Block</label>
					</div>
				</div>
				
				<hr/ style="width: 80%;margin-left: 0px;">
				<div id="team-members">
					<?php
					// get users array
					$roles_arr = Array();
					$subordinates_arr = Array();
					$subordinates_options =""; $roles_options ="";
					
					$subordinates = $user_obj->getUsersByPM($_SESSION['user']['id'],1);/* get all active users */
					if($subordinates){
						while( $subordinate = mysql_fetch_assoc($subordinates) ){
							$subordinates_arr[] = Array('id' => $subordinate['id'], 'fname' => $subordinate['fname'], 'lname' => $subordinate['lname'] );
							$subordinates_options .= '<option value="'.$subordinate['id'].'" >'.$subordinate['fname'].' '.$subordinate['lname'].'</option>';
						}
					}
					// Get roles array
					
					include_once("../php/classes/role.php");
					$role_obj = new role();
					$roles = $role_obj->getRoles(1);/* 1 = only active roles  */
					if($roles){
						while( $role = mysql_fetch_assoc($roles) ){
							$roles_arr[] = Array('id' => $role['id'], 'title' => $role['title']);
							$roles_options .= '<option value="'.$role['id'].'" >'.$role['title'].'</option>';
						}
					}
					
					$count = 0;
					if(isset($members_arr)){
						foreach( $members_arr AS $id => $userinfo ){ 
							//print_r($userinfo);
							$title = "";
							if($count == 0 ) $title = "1st Member";
							elseif($count == 1 ) $title = "2nd Member";
							elseif($count == 2 ) $title = "3rd Member";
							else $title = ($count+1)."th Member";
						?>
							<div class="form_row" id="row<?php echo $count; ?>">
								<div class="form_cell_text"><?php echo $title; ?></div>
								<div class="form_cell_element"><select name="userid[<?php echo $count; ?>]" id="users-list" class="required-field chosen-select" jquery-effector="ischangeuser<?php echo $count; ?>">
									<?php
										if($subordinates_arr){
											foreach( $subordinates_arr AS $subordinate ){
												echo '<option value="'.$subordinate['id'].'" '.(( $userinfo['userid'] == $subordinate['id'] )?"selected":"").'>'.$subordinate['fname'].' '.$subordinate['lname'].'</option>';
											}
										}
									?>
									</select>
									<input type="hidden" name="rowids[<?php echo $count; ?>]" value="<?php echo $id; ?>"/>
									<input type="hidden" name="ischangeuser[<?php echo $count; ?>]" value="<?php echo $userinfo['userid']; ?>"/>
								</div>
								<div class="form_cell_text">User Role</div>
								<div class="form_cell_element">
									<select name="userroleid[<?php echo $count; ?>]" class="chosen-select" id="userroles" jquery-effector="ischangerole<?php echo $count; ?>">
									  <?php
									  if($roles_arr){
										foreach( $roles_arr AS $role ){
											echo'<option value="'.$role['id'].'" '.(( $userinfo['roleid'] == $role['id'] )?"selected":"").'>'.$role['title'].'</option>';
										}
									  }
									  ?>
									</select>
									<input type="hidden" name="ischangerole[<?php echo $count; ?>]" value="<?php echo $userinfo['roleid']; ?>"/>
								</div>
								<span class="del-btn del-btn-setting" jquery-rowid="<?php echo $count; ?>">x</span>
							</div>
						<?php $count++; } 
					}
					
					?>
				</div>
				<?php echo'<span id="user-count" jquery-value="'.$count.'" ></span><span style="color:white" id="subordinates">'.$subordinates_options.'</span><span style="color:white" id="roles">'.$roles_options.'</span>'; ?>
				<hr/ style="width: 80%;margin-left: 0px;">
				<div class="form_row">
					<div class="form_cell_text">&nbsp;</div>
					<div class="form_cell_element">&nbsp;</div>
					<div class="form_cell_text">&nbsp;</div>
					<div class="form_cell_element"><input type="button" id="add-user" value="Add User" /></div>
				</div>
				<div class="form_row">
					<div class="form_cell_text">&nbsp;</div>
					<div class="form_cell_element">
						<input type="submit" id="submit" name="submit" value="Update" />
					</div>
				</div>
				<input type="hidden" name="id" value="<?php echo ((isset($team))?$team['id']:""); ?>" />
			</form>
		 </div>
     </div>
	 <script type="text/javascript" src="../include/js/jquery.min.js"></script>
<script type="text/javascript" src="../include/js/chosen.jquery.min.js"></script>
<script type="text/javascript" src="js/newteam.js"></script>
     <?php include("footer.php"); ?>
</div>
</body>
</html>
