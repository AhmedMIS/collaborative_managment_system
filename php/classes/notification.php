<?php
	include_once("sql_linker.php");
class notification {

	// Constructors
	public function __construct(){
		  
	}
	
	function storeNotification( $users, $typeid, $detailid){
		$query="INSERT INTO notifications (id, typeid, userid, detailid, status, date) VALUES(NULL, '".$typeid."', '".$users."', ".$detailid.", '0', now()) ";		
		if (mysql_query($query)){
			return @$count;
		}
	}
	function storeNotifications( $users, $typeid, $detailid){
		$users = explode('-', $users);
		for($i = 0; $i < count($users); $i++){
			$query="INSERT INTO notifications (id, typeid, userid, detailid, status, date) VALUES(NULL, '".$typeid."', '".$users[$i]."', ".$detailid.", '0', now()) ";		
			mysql_query($query);
		}
		return @$count;
	}
	function storeNotificationsToAll( $reciever, $typeid, $detailid){
		$users = array();
		$query = mysql_query("SELECT id FROM users WHERE usertype_id > 1");
		$count = @mysql_num_rows($query);
		if ($count > 0) {
			while ($row = mysql_fetch_array($query)) {
				$users[] = $row['id'];	
			}
		}
		for($i = 0; $i < count($users); $i++){
			$query="INSERT INTO notifications (id, typeid, userid, detailid, status, date) VALUES(NULL, '".$typeid."', '".$users[$i]."', ".$detailid.", '0', now()) ";		
			mysql_query($query);
		}
		return @$count;
	}
	
	function saveIsRead($userid){
		mysql_query("UPDATE notifications AS notification SET notification.status = 1 WHERE notification.userid = ".$userid);
		return true;
	}
	
	// Getters
	
	function getNotificationsByUserId($userid){
		$result = Array();
		$total = mysql_fetch_assoc(mysql_query("SELECT COUNT(notification.id) AS total FROM notifications AS notification WHERE notification.userid = ".$userid." AND notification.status = 0") )['total'];/* status = 0 (Get all unread notifications)*/
		$result['total'] = $total;
		$query = "SELECT notification.typeid,notification.detailid FROM notifications AS notification WHERE notification.userid = ".$userid." AND notification.status = 0 ORDER BY typeid";
		$notifications = mysql_query($query);
	    $task_query = " SELECT task.* FROM tasks AS task ";
		$meeting_query = " SELECT meeting.* FROM meetings AS meeting ";
		$task_symbol = " WHERE ";
		$meeting_symbol = " WHERE ";
		$task_exist = false;
		$meeting_exist = false;
		
		while( $notification = mysql_fetch_assoc($notifications) ){
			if($notification['typeid'] == 1 ){
				$meeting_exist = true;
				$meeting_query .= $meeting_symbol." meeting.id = ".$notification['detailid'];$meeting_symbol=" OR ";
			}
			if($notification['typeid'] >= 2 ){
				$task_exist = true;
				$task_query .= $task_symbol." task.id = ".$notification['detailid'];$task_symbol=" OR ";
			}
		}
		$final_html = "";
	     if( $task_exist ){
			echo"task exist";
			$tasks = mysql_query($task_query);
			while($task = mysql_fetch_assoc($tasks) ){
				$final_html.='<a href="view_comments.php?taskid='.$task['id'].'">
								<div class="notification">
									<div class="details">Task: '.$task['title'].'</div>
									<div class="created">'.explode(' ',$task['created'])[0].'</div>
								</div>
							</a>';
			}
		}
		if( $meeting_exist ){
			echo"meeting exist";
			$meetings = mysql_query($meeting_query);
			while($meeting = mysql_fetch_assoc($meetings) ){
				$final_html.='<a href="viewmeetings.php?meetingid='.$meeting['id'].'">
								<div class="notification">
									<div class="details">Meeting: '.$meeting['title'].'. Meeting date is '.explode(' ',$meeting['meetingdate'])[0].'</div>
									<div class="created">'.explode(' ',$meeting['created'])[0].'</div>
								</div>
							</a>';
			}
		}
		$result['html'] = $final_html;
		return $result;
	}
	
	
	
	
}

?>