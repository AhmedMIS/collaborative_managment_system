<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>All Meetings</title>
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
		 <script type="text/javascript">jQuery(document).ready(function(){ jQuery("div#cssmenu ul li").removeClass("active"); jQuery("li#meeting-menu-btn").addClass("active"); });</script>
		 <div id="body">
			<div class="cb"></div>
			<div class="">
				<span id="form_heading">Meetings List</span>
			</div>
			<?php 
				if(isset($_SESSION['success']) ){
					echo '<div class="alert-box '.(( $_SESSION['success'] )?"success":"error").'">'.$_SESSION['msg'].'</div>';
					unset($_SESSION['msg']);
					unset($_SESSION['success']);
				}
				
				include("../php/classes/meeting.php");
				$meeting_obj = new meeting();
				
				if ($_SERVER['REQUEST_METHOD'] == 'POST'){ 
					$meetings = $meeting_obj->getMeetingsBySearch($_POST);
				}elseif( isset($_GET['meetingid']) ){
					$meetings = $meeting_obj->getMeetingById($_GET['meetingid']);
				}else{
					$meetings = $meeting_obj->getMeetingsBySearch($_POST); 
				}
			?>
			 <div id="project_holder">
			 <?php if($meetings){ 
			 $meetings_arr = array();
			 while( $meeting = mysql_fetch_assoc($meetings) ){ $meetings_arr[] = Array('id'=>$meeting['id'],'description'=>$meeting['description'],'title'=>$meeting['title'],'meetingdate'=>$meeting['meetingdate'],'created'=>$meeting['created'],'status'=>$meeting['status']); }?>
				<div class="project_row row_heading">
					<div class="project_cell _num">Meeting&nbsp;Id</div>
					<div class="project_cell _text">Title</div>
					<div class="project_cell _text">Status</div>
					<div class="project_cell _text">Meeting&nbsp;Date</div>
					<div class="project_cell _text">Created&nbsp;Date</div>
					<div class="project_cell _link"><span id="filter_cntr_btn" title="FILTER"></span></div>
				</div>
				<form action="" method="post">
					<div id="row_filter" style="display:<?php echo (($_SERVER['REQUEST_METHOD'] == 'POST'))?"block":"none"; ?>">
						<div class="project_row info">
							<div class="project_cell _num">Filter</div>
							<?php ?>
							<div class="project_cell _text"><?php if($meetings_arr) { ?><select class="chosen-select" name="meetingid"><option></option><?php foreach( $meetings_arr AS $meeting ){ echo '<option value="'.$meeting['id'].'" '.((isset($_POST) && !empty($_POST['meetingid']) && $_POST['meetingid'] == $meeting['id'] )?"selected":"").'>'.$meeting['title'].'</option>'; } ?></select> <?php }else{ echo"Enter Meetings first";} ?></div>
							<div class="project_cell _text"><select class="chosen-select" name="status"><option ></option><option value="0">Not Held</option><option value="1">Held</option></select></div>
							<div class="project_cell _text"><input name="meetingdate" value="<?php echo ((isset($_POST) && !empty($_POST['meetingdate']) )?$_POST['meetingdate']:""); ?>" type="date" style="font-size: 13px;width: 133px;" /></div>
							<div class="project_cell _text"><input name="created" value="<?php echo ((isset($_POST) && !empty($_POST['created']) )?$_POST['created']:""); ?>" type="date" style="font-size: 13px;width: 133px;" /></div>
							<div class="project_cell _link"><input type="submit" value="Load" /></div>
							<div class="project_cell _text">&nbsp;</div>
						</div>
						<div class="project_row" style="display:none;">
						</div>
					</div>
				</form>
				<?php foreach( $meetings_arr AS $meeting ){ ?>
				<div class="project_row <?php if($meeting['status'] == 2){echo"block";}elseif($meeting['status'] == 1){echo "held";}elseif($meeting['status'] == 0){echo "active";}?>" title="<?php echo ($meeting['status'] == 0)?"This meeting has been stopped.":$meeting['description']; ?>">
					<div class="project_cell _num"><?php echo $meeting['id']; ?></div>
					<div class="project_cell _text"><?php echo $meeting['title']; ?></div>
					<div class="project_cell _text"><?php if($meeting['status'] == 0){echo 'Pending';} elseif($meeting['status'] == 1){echo'Held';}elseif($meeting['status'] == 2){echo 'Cancelled';} ?></div>
					<div class="project_cell _text"><?php echo explode(' ',$meeting['meetingdate'])[0]; ?></div>
					<div class="project_cell _text"><?php echo explode(' ',$meeting['created'])[0]; ?></div>
					<div class="project_cell _link">
						<a href="viewmeetings.php?meetingid=<?php echo $meeting['id'] ?>"><span title="View Meeting" class="ui-icon ui-icon-clipboard"></span></a>
                         <a href="update_meeting.php?meetingid=<?php echo $meeting['id']; ?>"><span title="Update Meeting" class="ui-icon ui-icon-refresh"></span></a>
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
