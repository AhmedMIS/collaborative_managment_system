<div id="heading">
	<link rel="stylesheet" href="../include/css/menustyles.css">
	<script type="text/javascript" src="../include/js/jquery-2.1.1.min.js"></script>
	<script type="text/javascript" src="../include/js/controllsbox.js"></script>
     <h2>Collaborative Project Management Suite</h2>
	 <?php $usertypeid = 1; /* 1 = administrator. */include("../common/notificationbox.php"); ?>
 </div>
<div id="top">
	<div class="header_wrapper">
		<div id="logo"> <a href="index.php">
        <span id="logo_img" style="background-image:url('../include/images/pm.png'); margin-right:16px; border:solid 1px #06F;" /></a> </div>
		<!--<div id="navigation">
			<ul>
				<li><a href="index.php">Home</a></li>
				<li>
					<a href="#">New</a>
					<ul class="submenu">
						<li><a href="#">User</a></li>
						<li><a href="#">Project</a></li>
					</ul>
				</li>
				<li><a href="newproject.php">Create Project</a></li>
				<li><a href="newproject.php">Projects</a></li>
				<li><a href="newuser.php">Create User</a></li>
				<li><a href>Delete User</a></li>
				<li><a href>Update User</a></li>
				<li><a href>Forum</a></li>
			</ul>
		</div> -->
		
		
		<div id='cssmenu'>
			<ul>
			   <li id="home-menu-btn"><a  href='../admin/index.php'><span>Home</span></a></li>
			   <li id="new-menu-btn" class='active has-sub'><a href='#'><span>New</span></a>
				  <ul>
					 <li><a href='../admin/newproject.php'><span>Project</span></a></li>
					 <li><a href='../admin/newuser.php'><span>User</span></a></li>
					 <li><a href='../admin/newmeeting.php'><span>Meeting</span></a></li>
					 <!--<li class='has-sub'><a href='#'><span>Project</span></a>
						<ul>
						   <li><a href='#'><span>Sub Product</span></a></li>
						   <li class='last'><a href='#'><span>Sub Product</span></a></li>
						</ul> 
					 </li>-->
				  </ul>
			   </li>
			   <li id="view-menu-btn" class="has-sub"><a href='#'><span>View</span></a>
				<ul>
					 <li><a href='../admin/projects.php'><span>Projects</span></a></li>
					 <li class='has-sub'><a href='#'><span>User</span></a>
						<ul>
						   <li><a href='viewuser.php'><span>Single User</span></a></li>
						   <li class='last'><a href='../admin/users.php'><span>All Users</span></a></li>
						</ul> 
					 </li>
					 <li><a href='../admin/meetings.php'><span>All Meetings</span></a> </li>
                     <li><a  href='../admin/list_attendance.php'><span>Attendance</span></a></li>
				</ul>
			   </li>
			</ul>
		</div>



	</div>
</div>    
