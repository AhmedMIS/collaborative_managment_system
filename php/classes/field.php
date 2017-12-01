<?php
	include_once("sql_linker.php");
class field {

	// Constructors
	public function __construct(){
		  
	}
	
	//Setters functions
	function getFields( $include_dependents = false, $fieldstatus = 0){
		$query = "SELECT * FROM fields AS field ".(( $fieldstatus == 0)?"":" WHERE field.status = ".$fieldstatus ).(( ! $include_dependents )?((( $fieldstatus == 0)?" WHERE ":" AND ")." field.dependentid = 0"):"");
		return( $result = mysql_query($query) )?$result:false;
	}
	
	function getFieldsByDependenId( $dependenid, $status = 0){
		$query = "SELECT * FROM fields AS field WHERE field.dependentid = ".$dependenid;
		return( $result = mysql_query($query) )?$result:false;
	}
	
	function getFieldsByUserId($userid){
		$query = "SELECT * FROM userfields AS field WHERE field.userid = ".$userid;
		return( $result = mysql_query($query) )?$result:false;
	}
	
	
	
}

?>