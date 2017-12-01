<?php
	include_once("sql_linker.php");
	include_once("notification.php");
	
	
	function user_type_id($user_id) {
		$query = mysql_query("SELECT usertype_id FROM users WHERE id='$user_id'");
		$count = @mysql_num_rows($query);
		if ($count > 0) {
			$row = mysql_fetch_array($query);
			if ($row['usertype_id'] == 1) {
				return true;
			} else {
				return false;	
			}
		} else {
			return false;	
		}
	}
class meeting {

	// Constructors
	public function __construct(){
		  
	}

	
	//Setters functions
	function storeMeeting( $data, $user ){
		$result = user_type_id($user);
		if ($result === true) {
			$reciever = 'all';
		} else {
			if (count($data['userid']) > 1) {
				$reciever = implode('-', $data['userid']);
			} else {
				$reciever = $data['userid'];
			}
		}
		$query ="INSERT INTO meetings (id, callerid, title, meetingdate, description, status,created,recevier) VALUES (NULL, ".$_SESSION['user']['id'].", '".$data['title']."', '".$data['meetingdate']."', '".$data['description']."', '0', now(),'".$reciever."');";
		mysql_query($query);
		
		$meetingid = mysql_insert_id();
		$notification_obj = new notification();
		if (isset($data['userid']) && count($data['userid']) > 1) {
			$notification_obj->storeNotifications($reciever,1, $meetingid);// 1 = typeid = meeting
		} else if ($reciever == 'all') {
			$notification_obj->storeNotificationsToAll($reciever,1, $meetingid);// 1 = typeid = meeting
		} else {
			$notification_obj->storeNotification($reciever,1, $meetingid);// 1 = typeid = meeting
		}
		return ( $meetingid > 0 )?$meetingid:false;
	}
	
	function getMeetingsBySearch( $data = 0 ){
		$query = "SELECT meeting.* FROM meetings AS meeting ";
		$symbol = " WHERE ";
		if( isset($data['userid']) && !empty($data['userid']) ){ $query .= $symbol." meeting.callerid = ".$data['userid']; $symbol=" AND ";} /* search by caller who arrange meeting */
		if( isset($data['meetingid']) && !empty($data['meetingid']) ){ $query .= $symbol." meeting.id = ".$data['meetingid']; $symbol=" AND ";} /* search by title */
		if( isset($data['created']) && !empty($data['created']) ){ $query .= $symbol." meeting.created >= '".$data['created']."'"; $symbol=" AND ";} /* search by created date */
		if( isset($data['status']) && !empty($data['status']) ){ $query .= $symbol." meeting.status = ".$data['status']; $symbol=" AND ";} /* search by Meeting held or not */
		if( isset($data['meetingdate']) && !empty($data['meetingdate']) ){ $query .= $symbol." meeting.meetingdate = '".$data['meetingdate']."'";} /* search by meeting date */
		//echo $query;exit;
		return mysql_query($query);
	}
	
	function getMeetingById( $meetingid ){
		$query = "SELECT meeting.*, COUNT(notification.id) FROM meetings AS meeting 
					JOIN notifications AS notification ON notification.detailid = meeting.id AND notification.typeid = 1
				WHERE meeting.id = ".$meetingid."
				GROUP BY meeting.id";
	}
	// developer function
	function getMyMeetings( $data ){
		$query = "SELECT meeting.*,user.fname, user.lname FROM meetings AS meeting
					JOIN users AS user ON user.id = meeting.callerid
					JOIN notifications AS notification ON notification.typeid = 2 AND notification.detailid = meeting.id AND notification.userid = ".$data['userid'];
		return mysql_query($query);
	}
	
	
	
}

?>