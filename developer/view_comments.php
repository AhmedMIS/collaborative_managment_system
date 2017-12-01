<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script src="js/script.js"></script>
<script>
$(document).ready(function() {
$("#absend_btn").click(function(){
$("#reason").toggle();
$("#proceed").toggle();
});  
});

</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome</title>
<link rel="stylesheet" type="text/css" href="../include/css/global.css" />
<link rel="stylesheet" type="text/css" href="../include/css/pmsadmin.css" />
</head>
<body>
<div id="wraper">
<?php include("header.php"); include '../pm/functions.php';
$query = mysql_query("SELECT * FROM taskcomments WHERE taskid=".$_GET['taskid']);
$count = @mysql_num_rows($query);
if ($count > 0) {
	$i = 0;
	while ($row = mysql_fetch_array($query)) {
		$comments[$i]	= $row['comment'];	
		$time[$i]		= $row['comment_time'];
		$i = $i + 1;
	}
} else {
	$_SESSION['success'] = false;
	$error = '<div class="alert-box '.(( $_SESSION['success'] )?"success":"error").'">There are no comments yet.</div>';
	unset($_SESSION['success']);	
}

?><br /><br />
<table>
    <tr>
        <td style="border:none">Project:</td>
        <td style="color:#06f; border:none"><?php echo $project_name = getProjectName($_GET['taskid']) ?></td>
    </tr>
    <tr>
        <td style="border:none">Task Title:</td>
        <td style="color:#06f; border:none"><?php echo $task_title = get_task_title($_GET['taskid']) ?></td>
    </tr>
</table>
<fieldset style="width:780px; margin-left:40px; margin-top:30px;">
<legend style="color:#06F;"><b>Task Comments</b></legend>
<table width="100%" border="1" id="view_user">
  
  <?php 
if (!empty($comments)) {
for ($i = 0, $j = 1; $i < count($comments); $i++, $j++) {?>
  <tr>
    <td width="95"><?php if($j==1){echo $j.'st';}elseif($j==2){echo $j.'nd';}elseif($j==3){echo $j.'rd';}else{echo $j.'th';} ?> Comment</td>
    <td style="color:#06f; border-right:none; word-wrap:break-word;"><?php echo $comments[$i] ?></td>
    <td width="100" style="color:#06f; border-right:none; font-size:small;"><?php echo date('M j, Y - h:i a',strtotime($time[$i])) ?></td>
  </tr>
<!--  <tr>
    <td>Comment Time</td>
    <td style="color:#06f; border-right:none"></td>
  </tr> -->
  <?php 
}
}
if (isset($error)) echo $error ?>
</table>
</fieldset>
    
<?php include("footer.php");?>
     
</div>
</body>
</html>
