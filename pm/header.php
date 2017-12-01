<div id="heading">
	<link rel="stylesheet" href="../include/css/menustyles.css">
	<script type="text/javascript" src="../include/js/jquery-2.1.1.min.js"></script>
	<script type="text/javascript" src="../include/js/controllsbox.js"></script>
     <h2>Collaborative Project Management Suite</h2>
	<?php $usertypeid = 2; /* 2 = administrator. */include("../common/notificationbox.php"); ?>
 </div>
<div id="top">
	<div class="header_wrapper">
		<div id="logo"> <a href="../index.php">
        <span id="logo_img" style="background-image:url('../include/images/pm.png'); margin-right:16px;" /></a> </div>
		
		<div id='cssmenu'>
			<ul>
			   <li id="home-menu-btn"><a href='../index.php'><span>Home</span></a></li>
			   <li id="new-menu-btn" class='active has-sub'><a href='../'><span>New</span></a>
				  <ul>
					 <li><a href='../pm/newteam.php'><span>Team</span></a></li>
					 <li><a href='../pm/newtask.php'><span>Task</span></a></li>
					 <li><a href='../pm/newmeeting.php'><span>Meeting</span></a></li>
				  </ul>
			   </li>
			   <li id="view-menu-btn" class="has-sub"><a href='../'><span>View</span></a>
				<ul>
					 <li><a href='../pm/tasks.php'><span>Tasks</span></a></li>
					 <li><a href='../pm/teams.php'><span>Teams</span></a></li>
					 <li><a href='../pm/projects.php'><span>Projects</span></a></li>
					 <li><a href='../pm/users.php'><span>Subordinates</span></a></li>
					 <li><a href='../pm/meetings.php'><span>Meetings</span></a></li>
				</ul>
			   </li>
               <li id="setting-menu-btn"><a href='../pm/settings.php' id='lulu'><span>Change Password</span></a></li>
               <!--
			   <li id="update-menu-btn"  class='has-sub'><a href='#'><span>Update</span></a>
				  <ul>
					 <li><a href='update_task.php'><span>Task</span></a></li>
					 <li><a href='newuser.php'><span>Meeting</span></a></li>
				  </ul>
			   </li>
-->			</ul>
		</div>


	</div>
</div>    
