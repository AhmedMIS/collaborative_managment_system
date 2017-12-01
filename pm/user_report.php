<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Tasks</title>
<script type="text/javascript" src="../include/js/jquery-2.1.1.min.js"></script>
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
		 <?php include("header.php"); include 'functions.php'; $review=0;$pending=0;$rejected=0;$completed=0;?>
		 <script type="text/javascript">jQuery(document).ready(function(){ jQuery("div#cssmenu ul li").removeClass("active"); jQuery("li#task-menu-btn").addClass("active"); });</script>
		 <div id="body">
			<div class="cb"></div>
			<div class="">
				<span id="form_heading">Employee Tasks Report</span>
			</div>
			<?php 
				if(isset($_SESSION['success']) ){
					echo '<div class="alert-box '.(( $_SESSION['success'] )?"success":"error").'">'.$_SESSION['msg'].'</div>';
					unset($_SESSION['msg']);
					unset($_SESSION['success']);
				}
				
				include("../php/classes/task.php");
				$task_obj = new task();
				$_POST['userid'] = $_GET['userid'];
				if( isset($_GET['taskid']) ){
					$_POST['taskid'] = $_GET['taskid'];
				}
				$tasks = $task_obj->getMyTasks($_POST);
			?>
			 <div id="project_holder">
			 <?php if($tasks){ 
			 $tasks_arr = array();
			 while( $task = mysql_fetch_assoc($tasks) ){ $tasks_arr[] = Array('id'=>$task['id'],'title'=>$task['title'],'ptitle'=>$task['ptitle'],'created'=>$task['created'],'status'=>$task['status'],'startingdate'=>$task['startingdate'],'endingdate'=>$task['endingdate']); }
			 $name = get_user_name($_GET['userid']);
			 $total = @count($tasks_arr);
			 ?>
				<div class="project_row row_heading">
					<div class="project_cell _num">Task&nbsp;Id</div>
					<div class="project_cell _text">Title</div>
					<div class="project_cell _text">Project</div>
					<div class="project_cell _date">Created</div>
					<div class="project_cell _date">Started</div>
					<div class="project_cell _num">Progress</div>
				</div>
			
				<?php 
				foreach( $tasks_arr AS $index => $task ){ ?>
				<div class="project_row <?php echo ($task['status'] == 0)?"held":"active"; ?>" title="<?php echo ($task['status'] == 0)?"This task has been stopped working.":""; ?>">
					<div class="project_cell _num"><?php echo $task['id']; ?></div>
					<div class="project_cell _text"><?php echo $task['title']; ?></div>
					<div class="project_cell _text"><?php echo $task['ptitle']; ?></div>
					<div class="project_cell _date"><?php echo explode(' ',$task['created'])[0]; ?></div>
					<div class="project_cell _date"><?php echo explode(' ',$task['startingdate'])[0]; ?></div>
					<div class="project_cell _num">
					<?php  
					if ($task['status'] == 1) {
						echo "In review"; $review++;
					} else if ($task['status'] == 2) {
						echo "Completed"; $completed++;
					} else if ($task['status'] == 3) {
						echo 'Rejected'; $rejected++;
					} else {
						echo 'Pending'; $pending++;
					}
					?>
                    </div>
					
				</div>
				<?php } 
				}else{ ?>
					<div class="project_row block" >No task found.</div>
				<?php } if ($total === 0){echo '<div class="project_row block" style="text-align:center" >No task found.</div>';}?>
			 </div>
			 <br/><br />
<table width="100%" border="0" id="table">
  <tr>
  	<td style="border:none">Employee Task Report</td>
  </tr>
  <tr>
  	<td style="border:none"></td>
  </tr>
  <tr>
    <td>&nbsp;Name</td>
    <td>&nbsp;<?php echo $name['fname'].' '.$name['lname'] ?></td>
  </tr>
  <tr>
  <td>&nbsp;Date</td>
  <td>&nbsp;<?php echo date('d-M-Y'); ?></td>
  </tr>
    <tr>
    <td>&nbsp;Total Tasks</td>
    <td>&nbsp;<?php echo $total ?></td>
  </tr>
  <tr>
    <td>&nbsp;Pending Tasks</td>
    <td>&nbsp;<?php echo $pending ?></td>
  </tr>
  <tr>
    <td>&nbsp;In Review Tasks</td>
    <td>&nbsp;<?php echo $review ?></td>
  </tr>
  <tr>
    <td>&nbsp;Completed Tasks</td>
    <td>&nbsp;<?php echo $completed ?></td>
  </tr>
  <tr>
    <td>&nbsp;Rejected Tasks</td>
    <td>&nbsp;<?php echo $rejected ?></td>
  </tr>
</table>
<p style="text-align:center"><input type="button" id="download" value="View pdf" /></p>
		 </div>
		 <?php include("footer.php"); ?>
	</div>
<script type="text/javascript" src="../include/js/jquery.min.js"></script>
<script type="text/javascript" src="../include/js/chosen.jquery.min.js"></script>
<script type="text/javascript" src="js/filter.js"></script>	
<script type="text/javascript" src="js/tasks.js"></script>	
	
<script type="text/javascript" src="js/js/tableExport.js"></script>
<script type="text/javascript" src="js/js/jquery.base64.js"></script>
<script type="text/javascript" src="js/js/sprintf.js"></script>
<script type="text/javascript" src="js/js/jspdf.js"></script>
<script type="text/javascript" src="js/js/base64.js"></script>
<script type="application/javascript">$('#download').click(function(){$('table').tableExport({type:'pdf',escape:'false'});});</script>
	
</body>
</html>
