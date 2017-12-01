<?php
	include_once("sql_linker.php");
class role {

	// Constructors
	public function __construct(){
		  
	}
	
	//Setters functions
	function getRoles( $status = 0){
		$query = "SELECT * FROM roles AS role ".(( $status == 0)?"":" WHERE role.status = ".$status );
		return( $result = mysql_query($query) )?$result:false;
	}
	
	function getRolesByUserId($userid, $status = 0 ){
		return ($result = mysql_query("SELECT * FROM userroles AS role WHERE role.userid = ".$userid.( ($status != 0)?" role.status = ".$status:"") ) )?$result : false;
	}	
	
}

?>