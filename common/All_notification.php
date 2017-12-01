<?php include_once '../php/classes/sql_linker.php';
function check_if_pm($user_id) {
	$query = mysql_query("SELECT usertype_id FROM users WHERE id='$user_id' LIMIT 1");
	$count = @mysql_num_rows($query);
	if ($count > 0) {
		$row = mysql_fetch_array($query);
		return $row;
	}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>View Meetings</title>
<link rel="stylesheet" type="text/css" href="../include/css/global.css"/>
<link rel="stylesheet" type="text/css" href="../include/css/pmsadmin.css"/>
<link rel="stylesheet" type="text/css" href="../admin/css/theme/jquery-ui-1.10.4.custom.css"/>
<link rel="stylesheet" type="text/css" href="../include/css/meetingview.css" />
</head>
<body>
<div id="wraper">
     <?php 
	 session_start();
	 $result = check_if_pm($_SESSION['user']['id']);
	 if ($result[0] == 2) {
		 include '../pm/header.php';
	 } else if ($result[0] == 3) {
		 include '../developer/header.php';
	 } else if ($result[0] == 1) {
		 include '../admin/header.php';
	 }
	      
	 ?>
     <br />
      <br />
      
<ul class="project_row row_heading">
     <?php 
	 $user = $_SESSION['user']['id'];
	 $query = mysql_query("SELECT * FROM notifications WHERE userid='$user'");
	 $count = @mysql_num_rows($query);
	 if ($count > 0) {
		 $i = 0;
		 while ($row = mysql_fetch_array($query)) {
			$id[$i]			= $row['id'];
			$type_id[$i]	= $row['typeid'];
			$detail_id[$i]	= $row['detailid'];
			$status[$i] 	= $row['status'];
			$i = $i + 1;
		}
	 }
if (!empty($id)) {
	for ($i = 0; $i < count($id); $i++) {
		if ($type_id[$i] == 4) {
			$query = mysql_query("SELECT id,title FROM tasks WHERE id='$detail_id[$i]'");
			$count = @mysql_num_rows($query);
			if ($count > 0) {
				$row = mysql_fetch_array($query);
				if ($result[0] == 2) {
					echo '<li><a href="../pm/comments.php?taskid=' . $row[0] . '">Task submitted (' . $row['title'] . ')</a>&nbsp;&nbsp;&nbsp;<a href="delete_notification.php?id='.$id[$i].'">Delete</a></li>';
				} else if ($result[0] == 3) {
					echo '<li><a href="../developer/view_comments.php?taskid=' . $row[0] . '">Task submitted1 (' . $row['title'] . ')</a>&nbsp;&nbsp;&nbsp;<a href="delete_notification.php?id='.$id[$i].'">Delete</a></li>';
				}
			}
		}
		if ($type_id[$i] == 3) {
			$query = mysql_query("SELECT id,title FROM tasks WHERE id='$detail_id[$i]'");
			$count = @mysql_num_rows($query);
			if ($count > 0) {
				$row = mysql_fetch_array($query);
				if ($result[0] == 2) {
					echo '<li><a href="../pm/comments.php?taskid=' . $row[0] . '">Task Updated (' . $row['title'] . ')</a>&nbsp;&nbsp;&nbsp;<a href="delete_notification.php?id='.$id[$i].'">Delete</a></li>';
				} else if ($result[0] == 3) {
					echo '<li><a href="../developer/view_comments.php?taskid=' . $row[0] . '">Task Updated (' . $row['title'] . ')</a>&nbsp;&nbsp;&nbsp;<a href="delete_notification.php?id='.$id[$i].'">Delete</a></li>';
				}
			}
		}
		if ($type_id[$i] == 1) {
			$query = mysql_query("SELECT id,title FROM meetings WHERE id='$detail_id[$i]'");
			$count = @mysql_num_rows($query);
			if ($count > 0) {
				$row = mysql_fetch_array($query);
				if ($result[0] == 2) {
					echo '<li><a href="../pm/viewmeetings.php?meetingid=' . $row[0] . '">New Meeting (' . $row['title'] . ')</a>&nbsp;&nbsp;&nbsp;<a href="delete_notification.php?id='.$id[$i].'">Delete</a></li>';
				} else if ($result[0] == 3) {
					echo '<li><a href="../developer/viewmeetings.php?meetingid=' . $row[0] . '">New Meeting (' . $row['title'] . ')</a>&nbsp;&nbsp;&nbsp;<a href="delete_notification.php?id='.$id[$i].'">Delete</a></li>';
				}
			}
		}
		if ($type_id[$i] == 2) {
			$query = mysql_query("SELECT id,title FROM tasks WHERE id='$detail_id[$i]'");
			$count = @mysql_num_rows($query);
			if ($count > 0) {
				$row = mysql_fetch_array($query);
				if ($result[0] == 2) {
					echo '<li><a href="../pm/comments.php?taskid=' . $row[0] . '">New Task (' . $row['title'] . ')</a>&nbsp;&nbsp;&nbsp;<a href="delete_notification.php?id='.$id[$i].'">Delete</a></li>';
				} else if ($result[0] == 3) {
					echo '<li><a href="../developer/view_comments.php?taskid=' . $row[0] . '">New Task (' . $row['title'] . ')</a>&nbsp;&nbsp;&nbsp;<a href="delete_notification.php?id='.$id[$i].'">Delete</a></li>';
				}
			}
		}
	 }
} else {
	echo '<h1>You have no notifications.</h1>';	
}
	 ?>
</ul>
     <?php include("../pm/footer.php"); ?>
</div>	 
