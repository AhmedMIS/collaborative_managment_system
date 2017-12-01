<?php
	include_once("sql_linker.php");
function getEmployee( ){
		$query = mysql_query("SELECT id,username,status FROM users WHERE usertype_id='3'");
		$count = @mysql_num_rows($query);
		if ($count > 0) {
			$i = 0;
			while ($row = @mysql_fetch_array($query)) {
				$username[$i] = $row['username'];
				$id[$i] = $row['id'];
				$status[$i] = $row['status'];
				$i = $i + 1;				
			}
		} else echo 'no';
		return array($username,$status, $id);
	}
class user {

	// Constructors
	public function __construct(){
		  
	}
	
	//Setters functions
	function storeUser( $data ){
		if(true){/* check validations */
			$query = "INSERT INTO users (id, fname, lname, gender, nic, email, phone, qualification, joiningdate, username, password, usertype_id, pmid, address, status, created) 
								 VALUES (NULL, '".$data['fname']."', '".$data['lname']."', '".$data['gender']."', '".$data['nic1'].'-'.$data['nic2'].'-'.$data['nic3']."', '".$data['email']."', '".$data['phone']."', '".$data['qualification']."', '".$data['joiningdate']."', '".$data['username']."', '".md5($data['password'])."', '".$data['usertype_id']."','".( ( $data['usertype_id'] == 3)?$data['pmid']:"null" )."', '".$data['address']."', '".$data['status']."', now());";
			mysql_query($query);
			$userid = mysql_insert_id();
			if( $data['usertype_id'] != 1){
				// Insert user fields.
				$query = "INSERT INTO userfields (id, userid, fieldid, status, created) VALUES ";
				$quma = "";
				foreach($data['fieldid'] AS $field){
					$query .= $quma." (NULL, '".$userid."', '".$field."', '1', now())";
					$quma = ",";
				}
				mysql_query($query);
				
				// Insert user roles.
				$query = "INSERT INTO userroles (id, userid, roleid, status, created) VALUES ";
				$quma = "";
				foreach($data['userrole'] AS $role){
					$query .= $quma." (NULL, '".$userid."', '".$role."', '1', now())";
					$quma = ",";
				}
				mysql_query($query);
			}
			return $userid;
		}else{ return false; }
	}
	
	//Getters functions
	function getUserByUsername($username){
		$query = "SELECT user.*,usertype.title AS typetitle,usertype.foldername AS fn FROM users AS user 
					JOIN usertypes AS usertype ON usertype.id = user.usertype_id
				WHERE user.username = '".mysql_real_escape_string($username)."' LIMIT 1";
		$result = mysql_query($query);
		return( $user = mysql_fetch_assoc($result) )?$user:false;
	}
	
	function getUsers( $userstatus = 0){ /* 0 = all users */
		
		$query = "SELECT user.*,usertype.title FROM users AS user 
					JOIN usertypes AS usertype ON usertype.id = user.usertype_id ".(( $userstatus == 0)?"":" WHERE user.status = ".$userstatus );
		return( $result = mysql_query($query) )?$result:false;
	}
	
	function getUserById( $userid ){
		
		$query = "SELECT user.*,usertype.title FROM users AS user 
					JOIN usertypes AS usertype ON usertype.id = user.usertype_id WHERE user.id = ".$userid;
		return( $result = mysql_query($query) )?$result:false;
	}
	
	function getUsersByType( $typeid, $userstatus = 0){ /* 0 = all users */
		
		$query = "SELECT user.id,user.fname,user.lname FROM users AS user WHERE user.usertype_id = ".$typeid.(( $userstatus != 0)?" AND user.status = ".$userstatus:"");
		return( $result = mysql_query($query) )?$result:false;
	}
	function getUsersByType1( $typeid, $userstatus = 0, $pmid){ /* 0 = all users */
		$query = "SELECT user.id,user.fname,user.lname FROM users AS user WHERE pmid='$pmid' AND user.usertype_id = ".$typeid.(( $userstatus != 0)?" AND user.status = ".$userstatus:"");
		return( $result = mysql_query($query) )?$result:false;
	}
	
	function getUsersByPM( $pmid, $userstatus = 0){ /* 0 = all users */
		$query = "SELECT user.*,usertype.title FROM users AS user 
					JOIN usertypes AS usertype ON usertype.id = user.usertype_id WHERE user.pmid = ".$pmid." ".(( $userstatus == 0)?"":" AND user.status = ".$userstatus );
		return ( $result = mysql_query($query) )?$result:false;
	}
	// Update functions
	function updateUser($user){
		$query = "UPDATE  users SET 
					fname =  '".$user['fname']."',
					lname =  '".$user['lname']."',
					gender =  '".$user['gender']."',
					nic =  '".$user['nic1'].'-'.$user['nic2'].'-'.$user['nic3']."',
					email =  '".$user['email']."',
					phone =  '".$user['phone']."',
					qualification =  '".$user['qualification']."',
					joiningdate =  '".$user['joiningdate']."',
					username =  '".$user['username']."',".((isset($user['password']) && !empty($user['password']))?"password =  '".md5($user['password'])."', ":"")."
					usertype_id =  '".$user['usertype_id']."',
					pmid =  '".( ($user['usertype_id'] == 3 )? $user['pmid']:"null")."',
					address =  '".$user['address']."',
					status =  '".$user['status']."' WHERE  id =".$user['id'];
		mysql_query($query);
		
		if( $data['usertype_id'] != 1){
			// Insert user fields.
			mysql_query("DELETE FROM userfields WHERE userid = ".$user['id']);
			$query = "INSERT INTO userfields (id, userid, fieldid, status, created) VALUES ";
			$quma = "";
			foreach($user['fieldid'] AS $field){
				$query .= $quma." (NULL, '".$user['id']."', '".$field."', '1', now())";
				$quma = ",";
			}
			mysql_query($query);
			
			// Insert user roles.
			mysql_query("DELETE FROM userroles WHERE userid = ".$user['id']);
			$query = "INSERT INTO userroles (id, userid, roleid, status, created) VALUES ";
			$quma = "";
			foreach($user['userrole'] AS $role){
				$query .= $quma." (NULL, '".$user['id']."', '".$role."', '1', now())";
				$quma = ",";
			}
			mysql_query($query);
		}
		
		return $user['id'];
	}
	
	//Delete functions
	function deleteUserById($userid){
		$query = "DELETE FROM users WHERE id = ".$userid;
		mysql_query($query);
		return true;
	}
}

?>