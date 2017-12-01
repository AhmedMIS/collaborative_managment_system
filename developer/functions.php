<?php

function get_old_password($user_id) {
	$query = mysql_query("SELECT password FROM users WHERE id='$user_id'");
	$count = @mysql_num_rows($query);
	if ($count > 0) {
		$row = mysql_fetch_array($query);
		$password = $row['password'];
		return $password;
	} else {
		return false;
	}	
}

function get_user_name($user_id) {
	$query = mysql_query("SELECT fname,lname FROM users WHERE id='$user_id'");
	$count = @mysql_num_rows($query);
	if ($count > 0) {
		$row = mysql_fetch_array($query);
		return $row;
	} else echo 'no';

}

function get_task_title($task_id) {
	$query = mysql_query("SELECT title FROM tasks WHERE id='$task_id'");
	$count = @mysql_num_rows($query);
	if ($count > 0) {
		while ($row = mysql_fetch_array($query)) {
			$title = $row['title'];	 
		}
		return $title;
	} else echo 'no';
}

function post_comment($comment, $user_id, $task_id, $status) {
	$query = mysql_query("INSERT INTO `taskcomments`(`taskid`, `userid`, `comment`, `status`, `comment_time`) VALUES ('$task_id', '$user_id', '$comment', '$status', now())");
	if ($query) {
		return true;
	} else {
		return false;	
	}
}
	 function getStatus($id) {
			$sql = mysql_query("SELECT status FROM tasks WHERE id='$id'");
			 $count = @mysql_num_rows($sql);
			 if ($count > 0) {
				 while ($row = mysql_fetch_array($sql)) {
					 $status = $row['status'];	 
				 }
				 return $status;
			 }else echo 'no';
	 }
	 function getProjectName($id) {
			 $sql = mysql_query("SELECT projectid FROM tasks WHERE id='$id'");
			 $count = @mysql_num_rows($sql);
			 if ($count > 0) {
				 while ($row = mysql_fetch_array($sql)) {
					 $projectName = getProjectId($row['projectid']);	 
				 }
				 return $projectName;
			 }else echo 'no';
		 }
		 function getProjectId($id){	
		 	$sql = mysql_query("SELECT title FROM projects WHERE id='$id'");
			 $count = @mysql_num_rows($sql);
			 if ($count > 0) {
				 while ($row = mysql_fetch_array($sql)) {
					 $title = $row['title'];	 
				 }
				 return $title;
			 }else echo 'no';
 
		 }
	function getTaskById_custom( $taskid ){
		$sql = mysql_query("SELECT * FROM tasks WHERE id='$taskid'");
		$count = @mysql_num_rows($sql);
		if($count > 0){
			while($row = mysql_fetch_array($sql)) {
				$title			= $row['title'];	
				$description	= $row['description'];
				$startingdate	= $row['startingdate'];
				$projectid		= $row['projectid'];
				$assigneeid		= $row['assigneeid'];
			}
			return array($title, $description, $startingdate, $projectid, $assigneeid);
		} else echo 'no';
	
	}
    
    ?>
