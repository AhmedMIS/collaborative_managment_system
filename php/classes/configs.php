<?php
	include_once("sql_linker.php");
class configs {

	// Constructors
	public function __construct(){
		  
	}
	
	//Setters functions
	
	function getConfigssByUserId($userid){
		$query = "SELECT * FROM userconfigss AS configs WHERE configs.userid = ".$userid;
		return( $result = mysql_query($query) )?$result:false;
	}
	
	function getNotificationTypes(){
		$query = "SELECT * FROM notificationtypes";
		$types = mysql_query($query);
		$types_arr = Array();
		while( $type = mysql_fetch_assoc( $types ) ){
			$types_arr[$type['id']] = Array();
		}
		
		
		$total = mysql_fetch_assoc(mysql_query("SELECT COUNT(notification.id) AS total FROM notifications AS notification WHERE notification.userid = ".$userid) )['total'];
	}
	
}

?>