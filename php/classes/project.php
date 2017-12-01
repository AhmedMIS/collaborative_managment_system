<?php
	include_once("sql_linker.php");
class project {

	// Constructors
	public function __construct(){
		  
	}
	
	//Setters functions
	function storeProject( $data ){
		if( !empty($data['title']) && !empty($data['fieldid']) && !empty($data['startingdate']) && !empty($data['assigneeid']) ){
			$filename = $this->makeDirect($data['title']);
			$query = "INSERT INTO projects (id, title, description, fieldid, startingdate, endingdate, assigneeid, status, created) VALUES (NULL, '".$data['title']."', '".$data['description']."', '".$data['fieldid']."', '".$data['startingdate']."', '".((isset($data['endingdate']) && !empty($data['endingdate'] ) )?$data['endingdate']:'null')."', '".$data['assigneeid']."', '1', '".date("Y-m-d H:i:s")."');";
			mysql_query($query);
			return mysql_insert_id();
		}else{  
			return false;  
		}
	}
	function makeDirect($path) {
		$path = "../data/projects/".$path;
		$temp = $path;
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
	
	function updateProject($project){
		$query="UPDATE projects SET 
					title = '".$project['title']."', 
					description = '".$project['description']."', 
					fieldid = '".$project['fieldid']."', 
					startingdate = '".$project['startingdate']."', 
					endingdate = '".$project['endingdate']."', 
					assigneeid = '".$project['assigneeid']."', 
					status = '".$project['status']."'
				WHERE id = ".$project['id'];
		mysql_query($query);
		return $project['id'];
	}
	
	// Getters functions
	function getProjects( $status = 0 ){
		$query = "SELECT project.*,user.fname,user.lname,field.title AS fieldtitle FROM projects AS project
					JOIN users AS user ON user.id = project.assigneeid
					JOIN fields AS field ON field.id = project.fieldid
				".( ( $status == 0 )?"":" WHERE project.status = ".$status)." ORDER BY project.created DESC";
		$projects = mysql_query($query);
		
		return $projects;
		
	}
	
	function getProjectById( $projectid ){
		
		$query = "SELECT project.*,user.fname,user.lname,field.title AS fieldtitle FROM projects AS project
					JOIN users AS user ON user.id = project.assigneeid
					JOIN fields AS field ON field.id = project.fieldid WHERE project.id = ".$projectid;
		return( $result = mysql_query($query) )?$result:false;
	}
	
	function getProjectsBySearch( $data ){
		$symbol = " WHERE ";
		$query = "SELECT project.*,user.fname,user.lname,field.title AS fieldtitle FROM projects AS project
					JOIN users AS user ON user.id = project.assigneeid
					JOIN fields AS field ON field.id = project.fieldid";
		if(isset($data['projectid']) && $data['projectid'] != ""){ $query .= $symbol." project.id = ".$data['projectid']; $symbol = " AND ";}
		if(isset($data['userid']) && $data['userid'] != ""){ $query .= $symbol." user.id = ".$data['userid']; $symbol = " AND ";}
		if(isset($data['fieldid']) && $data['fieldid'] != ""){ $query .= $symbol." field.id = ".$data['fieldid']; $symbol = " AND ";}
		if(isset($data['startingdate']) && $data['startingdate'] != ""){ $query .= $symbol." project.created >= '".$data['startingdate']."'"; $symbol = " AND ";}
		if(isset($data['endingdate']) && $data['endingdate'] != ""){ $query .= $symbol." project.created <= '".$data['endingdate']."'"; }
		
		$query .= " ORDER BY project.created DESC";
		$projects = mysql_query($query);
		return $projects;
		
	}
	
	
}

?>