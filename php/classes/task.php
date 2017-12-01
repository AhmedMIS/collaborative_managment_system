<?php
	include_once("sql_linker.php");
class task {

	// Constructors
	public function __construct(){
		  
	}
	
	//Setters functions
	function storeTask( $data ){
		$filename = $this->makeDir($data['title'], $data['projectid']);
		$query = "INSERT INTO tasks (id, title, projectid, assigneeid, filename, startingdate, endingdate, description, status, created) VALUES (NULL, '".$data['title']."', '".$data['projectid']."', '".$data['assigneeid']."', '".$filename."', '".$data['startingdate']."', NULL, '".$data['description']."', '".$data['status']."', now());";
		mysql_query($query);
		$taskid = mysql_insert_id();
		
		include_once("team.php");
		$team_obj = new team();
		$userid = $team_obj->getUserIdByMemberId($data['assigneeid']);
		
		//save notification
		include_once("notification.php");
		$notification_obj = new notification();
		$notification_obj->storeNotifications($userid, 2, $taskid);
		return $taskid;
	}
	
	function makeDir($path,$projectid) {
		$sql = mysql_query("SELECT title FROM projects WHERE id='$projectid'");
		$row = mysql_fetch_array($sql);
		$project_title = $row['title'];
		$path = "../data/projects/".$project_title."/".$path;
		echo $temp = $path;
		for( $i=1; $i>0; $i++ ){
			if (!file_exists($path)) { // create logo directory
				mkdir($path, 0755);
				/*
				$ourFileName = $path . '/index.html';
				$ourFileHandle = fopen($ourFileName, 'w') or die("can't open file");
				fclose($ourFileHandle);*/
				return $path;
			}else{
				$path = $temp."_".($i);
			}
		}
    }
	
	function submitTask( $data ){
		if($this->canUpdateTask($data['id'],$data['userid'],$data['usertype_id']) ){
			$this->updateTask(Array('id' => $data['id'],'status' => 1,'endingdate' => date("Y-m-d H:i:s")));// 1 = complete task
			
			foreach($_FILES['filename']['name'] AS $i => $filename ){
				if ($_FILES['filename']['size'][$i] > 0) {
					$file_name = "file_".$data['id']."_".str_replace(' ', '_', $_FILES['filename']['name'][$i]); // file name
					$file_tmp = $_FILES['filename']['tmp_name'][$i]; // actual location
					$task = $this->getTaskById($data['id']);
					$userpath="".mysql_fetch_assoc($task)['filename'];
					move_uploaded_file($file_tmp, $userpath . '/' . $file_name);
				}
			}
		//save notification
		include_once("notification.php");
		$notification_obj = new notification();
		$notification_obj->storeNotifications( $data['pmid'], 4,$data['id']);

		}else{/* Set error and return false*/echo "jhj";}
		
	}
	
	function getTaskById( $taskid ){
		return mysql_query("SELECT task.*,project.title AS ptitle,user.fname,user.lname FROM teams AS team
							JOIN teammembers AS member ON member.teamid = team.id
							JOIN users AS user ON user.id = member.userid
							JOIN tasks AS task ON task.assigneeid = member.id
							JOIN projects AS project ON project.id = task.projectid WHERE task.id = ".(int)$taskid." LIMIT 1");
	}
		
	
	function updateTask( $data ){
	
		$query = "UPDATE tasks SET ";
		$quma = "";
		if( isset( $data['title'] ) && !empty( $data['title'] ) ){ $query .= " title = '".$data['title']."'";  $quma = ", ";}
		//if( isset( $data['projectid'] ) && !empty( $data['projectid'] ) ){ $query .= $quma." projectid = '".$data['projectid']."'";  $quma = ", ";}
		//if( isset( $data['assigneeid'] ) && !empty( $data['assigneeid'] ) ){ $query .= $quma." assigneeid = '".$data['assigneeid']."'";  $quma = ", ";}
		//if( isset( $data['filename'] ) && !empty( $data['filename'] ) ){ $query .= $quma." filename = '".$data['filename']."'";  $quma = ", ";}
		//if( isset( $data['startingdate'] ) && !empty( $data['startingdate'] ) ){ $query .= $quma." startingdate = '".$data['startingdate']."'";  $quma = ", ";}
		//if( isset( $data['endingdate'] ) && !empty( $data['endingdate'] ) ){ $query .= $quma." endingdate = '".$data['endingdate']."'";  $quma = ", ";}
		if( isset( $data['description'] ) && !empty( $data['description'] ) ){ $query .= $quma." description = '".$data['description']."'";  $quma = ", ";}
		if( isset( $data['status'] ) && !empty( $data['status'] ) ){
			echo $data['status'];
			 $query .= $quma." status = '".$data['status']."'";  $quma = ", ";
		}
		//if( isset( $data['created'] ) && !empty( $data['created'] ) ){ $query .= $quma." created = '".$data['created']."'";}
		
		$query .= " WHERE id = ".(int)$data['id']." LIMIT 1";
		mysql_query($query);
		return true;
	}
	
	function canUpdateTask($taskid, $userid, $usertype = 1 ){/* usertype = 1 == administrator (that can update every task ) */
		if($usertype == 1){ return true; /* admin type*/
		}elseif($usertype == 2 ){ /* PM type*/
			$query = "SELECT COUNT(task.id) AS canupdate FROM tasks AS task JOIN projects AS project ON project.id = task.projectid AND project.assigneeid = ".(int)$userid." WHERE task.id = ".(int)$taskid;
			$canupdate = mysql_fetch_assoc ( mysql_query($query) )['canupdate'];
			return( $canupdate == 1 );
		}elseif($usertype == 3){ /* developer type*/
			$query = "SELECT count(task.id) AS canupdate  FROM tasks AS task JOIN teammembers AS member ON member.id = task.assigneeid AND member.userid = ".(int)$userid." WHERE task.id = ".(int)$taskid;
			$canupdate = mysql_fetch_assoc ( mysql_query($query) )['canupdate'];
			return( $canupdate == 1 );
		}else{ return false; /* unknown type*/ }
	}
	
	function getTasksBySearch( $data ){
		$query="SELECT task.*,project.title AS ptitle,user.fname,user.lname FROM teams AS team
					JOIN teammembers AS member ON member.teamid = team.id
					JOIN users AS user ON user.id = member.userid
					JOIN tasks AS task ON task.assigneeid = member.id
					JOIN projects AS project ON project.id = task.projectid";
		$symbol = " WHERE ";
		if( isset($data['pmid']) && !empty($data['pmid'])) { $query .= $symbol." team.pmid = ".$data['pmid']; $symbol=" AND ";}
		if( isset($data['status']) && !empty($data['status'])) { $query .= $symbol." task.status = ".$data['status']; $symbol=" AND ";}
		return mysql_query($query);
	}
	
	function getMyTasks( $data ){
		$query="SELECT task.*,project.title AS ptitle FROM tasks AS task
				JOIN projects AS project ON project.id = task.projectid
				JOIN teammembers AS member ON member.id = task.assigneeid ";
		$symbol = " WHERE ";
		if( isset($data['userid']) && !empty($data['userid']) ) { $query .= $symbol." member.userid = ".(int)$data['userid']; $symbol = " AND ";}
		if( isset($data['taskid']) && !empty($data['taskid']) ) { $query .= $symbol." task.id = ".(int)$data['taskid']; $symbol = " AND ";}
		if( isset($data['projectid']) && !empty($data['projectid']) ) { $query .= $symbol." project.id = ".(int)$data['projectid']; $symbol = " AND ";}
		if( isset($data['stastingdate']) && !empty($data['stastingdate']) ) { $query .= $symbol." task.stastingdate = '".$data['stastingdate']."'"; $symbol = " AND ";}
		if( isset($data['endingdate']) && !empty($data['endingdate']) ) { $query .= $symbol." task.endingdate = '".$data['endingdate']."'"; $symbol = " AND ";}
		if( isset($data['created']) && !empty($data['created']) ) { $query .= $symbol." task.created >= '".$data['created']."'"; $symbol = " AND ";}
		if( isset($data['status']) && !empty($data['status']) ) { $query .= $symbol." task.status = '".$data['status']."'";}
		return mysql_query($query);
	
	}
	
	function getTasksByUserId( $userid){
		
	}
	
	
	
}

?>