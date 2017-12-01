<?php
	include_once("sql_linker.php");
class type {

	// Constructors
	public function __construct(){
		  
	}
	
	//Setters functions
	function getTypes( $status = 0){
		$query = "SELECT * FROM usertypes AS type ".(( $status == 0)?"":" WHERE type.status = ".$status );
		return( $result = mysql_query($query) )?$result:false;
	}
	
	
}

?>