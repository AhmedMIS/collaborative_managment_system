<?php
	include_once("sql_linker.php");
class team {

	// Constructors
	public function __construct(){
		  
	}
	
	// Create
	
	function storeTeam( $data ){
		if( isset($data['leaderid']) ){
			$query = "INSERT INTO teams (id, title, pmid, leaderid, status, created) VALUES (NULL, '".$data['title']."', '".$data['pmid']."', '".$data['leaderid']."', '".$data['status']."', '".date("Y-m-d H:i:s")."');";
			mysql_query($query);
			$teamid = mysql_insert_id();
			// Insert team members
			$query = "INSERT INTO teammembers (id, teamid, userid, roleid, status, created) VALUES ";
			$qume = "";
			foreach($data['userid'] AS $index => $userid){
				$query .= $qume." (NULL, '".$teamid."', '".$userid."', '".$data['userroleid'][$index]."', '1', '".date('Y-m-d H:i:s')."') ";$qume = ", ";
			}
			mysql_query($query);
			return $teamid;
		}else{ return 0; }
	}
	
	// Read
	function getTeamsBySearch( $data = 0 ){
		$query = "SELECT team.*,user.fname,user.lname, COUNT(member.id) AS totalmembers FROM teams AS team
					LEFT JOIN users AS user ON user.id = team.leaderid
					LEFT JOIN teammembers AS member ON member.teamid = team.id";
		if( isset($data['userid']) && !empty($data['userid']) ) $query .= " WHERE team.pmid = ".$data['userid'];
		$query .= " GROUP BY team.id order by team.created desc";
		return( $result = mysql_query($query) )?$result:false;
	}
	
	function getTeamById($teamid){
		$result = Array();
		
		$query = "SELECT team.*,user.fname,user.lname, COUNT(member.id) AS totalmembers FROM teams AS team
					JOIN users AS user ON user.id = team.leaderid
					JOIN teammembers AS member ON member.teamid = team.id
				WHERE team.id = ".$teamid."
				GROUP BY team.id ";
		$result['team'] = mysql_query($query);
		
		$query = "SELECT member.id,member.userid,member.roleid FROM teammembers AS member WHERE member.teamid = ".$teamid;
		$result['members'] = mysql_query($query);
		
		return( $result )?$result:false;
	}
	
	function getMembersByTeamId( $teamid ){
		return mysql_query("SELECT member.*,user.fname,user.lname FROM teammembers AS member JOIN users AS user ON user.id = member.userid WHERE member.teamid = ".$teamid);
	}
	
	function getUserIdByMemberId( $memberid ){
		return mysql_fetch_assoc( mysql_query("SELECT member.userid FROM teammembers AS member WHERE member.id = ".$memberid) )['userid'];
	}
	// Update
	
	function updateTeam($data){
		$query = "UPDATE  teams SET  
					title =  '".$data['title']."',
					leaderid =  '".$data['leaderid']."',
					status =  '".$data['status']."'
				WHERE  id = ".$data['id'];
		mysql_query($query);
		// Update team members
		mysql_query(" DELETE FROM teammembers WHERE teamid = ".$data['id']);
		$query = "INSERT INTO teammembers (id, teamid, userid, roleid, status, created) VALUES ";
		$qume = "";
		foreach($data['userid'] AS $index => $userid){
			$query .= $qume." (NULL, '".$data['id']."', '".$userid."', '".$data['userroleid'][$index]."', '".$data['status']."', now()) ";
			$qume = ", ";
		}
		mysql_query($query);
		return $data['id'];
	}
	
		
	
}














/*
update team function 
		
		
		$user_cases = "";$role_cases="";
		$quma1 = "";$quma2 = "";$user_ids ="";$role_ids ="";
		foreach( $data['userid'] AS $index => $userid ){
			if( isset( $data['rowids'][$index]) ){
				if( !( $data['ischangeuser'][$index] == 0 ||  $data['ischangeuser'][$index] == $userid ) ){
					$user_cases .= " WHEN ".$data['rowids'][$index]." THEN ".$userid; 
					$user_ids .= $quma1.$data['rowids'][$index];
					$quma1=", ";
				}
				
				if($data['ischangerole'][$index] != 0 && $data['ischangerole'][$index] != $data['userroleid'][$index] ){
					$role_cases .= " WHEN ".$data['rowids'][$index]." THEN ".$data['userroleid'][$index];
					$role_ids .= $quma2.$data['rowids'][$index];
					$quma2=", ";
				}
				
				
			}else{ echo "new user";}
		}
		
		if( $user_cases != "" ){
			$query = "UPDATE teammembers SET userid = CASE id ".$user_cases." END WHERE id IN (". $user_ids ." )";
			echo $query;
		}
		
		if( $role_cases != "" ){
			$query = "UPDATE teammembers SET userid = CASE id ".$role_cases." END WHERE id IN (". $role_ids ." )";
			echo $query;
		}



		echo "<pre>"; print_r($data);exit;

*/
?>