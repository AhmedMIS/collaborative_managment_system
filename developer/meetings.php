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
		 <?php include("header.php"); 
		$query = mysql_query("SELECT * FROM meetings WHERE recevier LIKE '%".$_SESSION['user']['id']."%'");
		$count = @mysql_num_rows($query);
		if ($count > 0) {
			$i = 0;
			while ($row = mysql_fetch_array($query)) {
				$id[$i]				= $row['id'];
				$callerid[$i]		= $row['callerid'];
				$title[$i]			= $row['title'];
				$meetingdate[$i]	= $row['meetingdate'];
				$description[$i]	= $row['description'];
				$created[$i]		= $row['created'];
				$status[$i]			= $row['status'];
				$i = $i + 1;
			}
		} else {
			$_SESSION['success'] = false;
			$error = '<div class="alert-box '.(( $_SESSION['success'] )?"success":"error").'">You have no meetings.</div>';	
			unset($_SESSION['success']);
			$id = null;
		}
		 
		 ?>
		 <script type="text/javascript">jQuery(document).ready(function(){ jQuery("div#cssmenu ul li").removeClass("active"); jQuery("li#meeting-menu-btn").addClass("active"); });</script>
		 <div id="body">
			<div class="cb"></div>
			<div class="">
				<span id="form_heading">Meetings</span>
			</div>
			<?php 
				
			?>
			 <div id="project_holder">
				<div class="project_row row_heading">
					<div class="project_cell _num">Meeting&nbsp;Id</div>
					<div class="project_cell _text">Title</div>
					<div class="project_cell _text">Status</div>
					<div class="project_cell _text">Meeting&nbsp;Date</div>
					<div class="project_cell _text">Created&nbsp;Date</div>
					<div class="project_cell _link"><span id="filter_cntr_btn" title="FILTER"></span></div>
				</div>
				
				<?php 
				if (isset($error)) echo $error;
				for ($i = 0; $i < count($id); $i++) { ?>
				<div class="project_row <?php if($status[$i] == 2){echo"block";}elseif($status[$i] == 1){echo "held";}elseif($status[$i] == 0){echo "active";}?>" title="<?php echo ($status[$i] == 0)?"This meeting has been stopped.":$description[$i]; ?>">
					<div class="project_cell _num"><?php echo $id[$i]; ?></div>
					<div class="project_cell _text"><?php echo $title[$i]; ?></div>
					<div class="project_cell _text"><?php if($status[$i] == 0){echo 'Pending';} elseif($status[$i] == 1){echo'Held';}elseif($status[$i] == 2){echo 'Cancelled';} ?></div>
					<div class="project_cell _text"><?php echo explode(' ',$meetingdate[$i])[0]; ?></div>
					<div class="project_cell _text"><?php echo explode(' ',$created[$i])[0]; ?></div>
					<div class="project_cell _link">
						<a href="viewmeetings.php?meetingid=<?php echo $id[$i] ?>"><span title="View Meeting" class="ui-icon ui-icon-clipboard"></span></a>
						<!--<a class="delete-btn" href="../php/deletemeeting.php?meetingid=<?php echo $meeting['id']; ?>"><span title="Delete Meeting" class="ui-icon ui-icon-trash"></span></a> 
						<a href="newmeeting.php?meetingid=<?php echo $meeting['id']; ?>"><span title="Update Meeting" class="ui-icon ui-icon-refresh"></span></a>
						<span class="ui-icon ui-icon-gear"></span> -->
					</div>
				</div>
				<?php } 
				?>
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
