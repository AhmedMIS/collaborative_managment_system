<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>New User</title>
<link rel="stylesheet" type="text/css" href="../include/css/global.css" />
<link rel="stylesheet" type="text/css" href="../include/css/pmsadmin.css" />
<link rel="stylesheet" type="text/css" href="../include/css/chosen.min.css" />
<link rel="stylesheet" type="text/css" href="css/jquery-ui.css" />
<script src="js/jquery-1.10.2.js" type="text/javascript"></script>
<script src="js/jquery.maskedinput.js" type="text/javascript"></script>

</head>
<body>
<div id="wraper">
     <?php include("header.php");
function email_exists($email) {
	$query = mysql_query("SELECT email FROM users WHERE email='$email'");
	$count = @mysql_num_rows($query);
	if ($count > 0) {
		return true;
	} else {
		return false;	
	}
}
function user_exists($username) {
	$query = mysql_query("SELECT username FROM users WHERE username='$username'");
	$count = @mysql_num_rows($query);
	if ($count > 0) {
		return true;
	} else {
		return false;	
	}
}
function cnic_exists($cnic) {
	$query = mysql_query("SELECT nic FROM users WHERE nic='$cnic'");
	$count = @mysql_num_rows($query);
	if ($count > 0) {
		return true;
	} else {
		return false;	
	}
		
}
function test_input($data) {
  $data = trim($data);
  $data = mysql_real_escape_string($data);
  $data = stripslashes($data);
  $data = strip_tags($data);
  $data = htmlspecialchars($data);
  return $data;
}

if (isset($_POST['submit'])) {
	$fname			= test_input($_POST['fname']);
	$lname			= test_input($_POST['lname']);
	$user_name		= test_input($_POST['username']);
	$password		= strip_tags($_POST['password']);
	$gender			= test_input($_POST['gender']);
	$email			= $_POST['email'];
	$phone			= test_input($_POST['phone']);
	$qualification	= test_input($_POST['qualification']);
	$joining_date	= test_input($_POST['joiningdate']);
	$status			= test_input($_POST['status']);
	$pmid			= test_input($_POST['pmid']);
	$address		= test_input($_POST['address']);
	if (empty($fname)) {
		$errors['fname'] = 'Enter a firstname.';	
	} else if (preg_match("/([0-9]+)/", $fname)) {
		$errors['fname'] = 'Only alphabets allowed.';
	} else if (preg_match("/\\s/", $fname) == true) {
		$errors['fname'] = 'First Name must not have spaces';
	} else if (strlen($fname) < 3) {
		$errors['fname'] = 'First Name is too short.';
	}
	if (empty($lname)) {
		$errors['lname'] = 'Enter a lastname.';	
	} else if (preg_match("/([0-9]+)/", $lname)) {
		$errors['lname'] = 'Only alphabets allowed.';
	} else if (preg_match("/\\s/", $lname) == true) {
		$errors['lname'] = 'Last Name must not have spaces';
	} else if (strlen($lname) < 3) {
		$errors['lname'] = 'Last Name is too short.';
	}
	if (empty($user_name)) {
		$errors['username'] = 'Enter a username.';	
	} else if (preg_match("/\\s/", $user_name) == true) {
		$errors['username'] = 'Username must not have spaces';
	} else if (!preg_match("/^[A-Za-z][A-Za-z0-9]*(?:_[A-Za-z0-9]+)*$/", $user_name)) {
		$errors['username'] = 'Username must start with letter optional(digits or underscore).';
	} else if (strlen($user_name) < 10) {
		$errors['username'] = 'Username must be atleast 10 characters.';	
	} else if (user_exists($user_name) === true) {
		$errors['username'] = 'The username \'' . $user_name . '\' is already taken.';
	}
	if (empty($password)) {
		$errors['password'] = 'Enter a password.';	
	} else if (strlen($password) < 4) {
		$errors['password'] = 'Password must be atleast 4 characters.';
	}
	if (empty($email)) {
		$errors['email'] = 'Enter a email.';	
	} else if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
		$errors['email'] = 'A valid email address is required.';
	} else if (email_exists($email) === true) {
		$errors['email'] = 'The email \'' . $email . '\' is already in use.';
	}
	if (empty($phone)) {
		$errors['phone'] = 'Enter a phone number.';	
	}
	if (empty($joining_date)) {
		$errors['joining_date'] = 'Select a joining date.';	
	}
	if (empty($address)) {
		$errors['address'] = 'Enter a street address.';	
	} else {
		$address = preg_split('/[\s]+/', $address);	
		$address = implode(" ",$address);
	}
	if (empty($_POST['nic1']) || empty($_POST['nic2']) || empty($_POST['nic3'])) {
		$errors['cnic'] = 'Enter a CNIC number.';	
	} else if (strlen($_POST['nic1']) < 5 || strlen($_POST['nic2']) < 7 || strlen($_POST['nic3']) < 1) {
		$errors['cnic'] = 'Incomplete CNIC.';
	} else {
		$cnic = $_POST['nic1'] .'-'.$_POST['nic2'] .'-'.$_POST['nic3'];
		if (cnic_exists($cnic) === true) {
			$errors['cnic'] = 'This cnic belongs to another user.';	
		}
	}
	if (empty($qualification)) {
		$errors['qualification'] = 'Enter your qualification.';	
	}
	if (empty($errors)) {
		include_once("../php/classes/user.php");
		$user_obj = new user();
		if( isset($_POST['id']) && !empty($_POST['id']) ){
			$userid = $user_obj->updateUser($_POST);
		} else{
			$userid = $user_obj->storeUser($_POST);
		}
		session_start();
		$_SESSION['success'] = ($userid)?true:false;
		$_SESSION['msg'] = ($_SESSION['success'])?"User successfully ".(( isset($_POST['id']) && !empty($_POST['id']) )?"updated":"registered"):"Error in ".(( isset($_POST['id']) && !empty($_POST['id']) )?"update":"register")." user.";
		header('Location: ../'.$_SESSION['user']['fn'].'/users.php'.(($userid)?"?userid=".$userid:""));
    }
	
}
?>
	 <script type="text/javascript">jQuery(document).ready(function(){ jQuery("div#cssmenu ul li").removeClass("active"); jQuery("li#new-menu-btn").addClass("active"); });</script>
     <div id="body">
	 <div class="cb"></div>
		<div class="">
			<span id="form_heading">User Form</span><br /><br />
			<div class="alert-box error" style="display:none;">Error</div>
		</div>
		<?php
		include("../php/classes/user.php");
		$user_obj = new user();
		if( isset($_GET['userid']) ){
			$user = mysql_fetch_assoc( $user_obj->getUserById( $_GET['userid'] ) );
		}
		?>
		 
			<form action="" method="post" id="newuser">
                <table width="100%" border="0">
                  <tr>
                    <td>First Name</td>
                    <td><input type="text" name="fname" class="required-field" value="<?php echo ((isset($fname))?$fname:""); ?>" onkeypress="return isAlphabetKey(event)" /><?php if(isset($errors['fname'])) echo '<li>'.$errors['fname'] . '</li>'?></td>
                    <td>Last Name</td>
                    <td><input type="text" name="lname" class="required-field" value="<?php echo ((isset($lname))?$lname:""); ?>" onkeypress="return isAlphabetKey(event)" /><?php if(isset($errors['lname'])) echo '<li>'.$errors['lname'] . '</li>'?></td>
                  </tr>
                  <tr>
                    <td>Username</td>
                    <td><input type="text" name="username" class="required-field" maxlength="15" value="<?php echo ((isset($user_name))?$user_name:""); ?>"/><?php if(isset($errors['username'])) echo '<li>'.$errors['username'] . '</li>'?></td>
                    <td>Password</td>
                    <td><input type="password" name="password" class="required-field" id="password" /><span id="gen-btn">Genrate</span	><?php if(isset($errors['password'])) echo '<li>'.$errors['password'] . '</li>'?></td>
                  </tr>
                  <tr>
                    <td>Gender</td>
                    <td><select name="gender" class="chosen-select"><option value="1">Male</option><option value="0">Female</option></select></td>
                    <td>CNIC</td>
                    <td><input type="text" name="nic1" class="required-field numeric-value" maxlength="5" id="nic-1" value="<?php echo ((isset($user))?explode('-',$user['nic'])[0]:""); ?>" onkeypress="return isNumberKey(event)"/>
						<input type="text" name="nic2" class="required-field numeric-value" maxlength="7" id="nic-2" value="<?php echo ((isset($user))?explode('-',$user['nic'])[1]:""); ?>" onkeypress="return isNumberKey(event)"/>
						<input type="text" name="nic3" class="required-field numeric-value" maxlength="1" id="nic-3" value="<?php echo ((isset($user))?explode('-',$user['nic'])[2]:""); ?>" onkeypress="return isNumberKey(event)"/><?php if(isset($errors['cnic'])) echo '<li>'.$errors['cnic'] . '</li>'?></td>
                  </tr>
                  <tr>
                    <td>E-mail</td>
                    <td><input type="text" name="email" class="required-field" value="<?php echo ((isset($email))?$email:""); ?>" maxlength="30"/><?php if(isset($errors['email'])) echo '<li>'.$errors['email'] . '</li>'?></td>
                    <td>Phone</td>
                    <td><input type="text" id="phone" maxlength="11" name="phone" class="required-field" value="<?php echo ((isset($phone))?$phone:""); ?>" onkeypress="return isNumberKey(event)"/><?php if(isset($errors['phone'])) echo '<li>'.$errors['phone'] . '</li>'?></td>
                  </tr>
                  <tr>
                    <td>Qualification</td>
                    <td><input type="text" name="qualification" class="required-field" value="<?php echo ((isset($qualification))?$qualification:""); ?>" maxlength="30"/><?php if(isset($errors['qualification'])) echo '<li>'.$errors['qualification'] . '</li>'?></td>
                    <td>Joining Date</td>
                    <td><input type="text" name="joiningdate" id="joiningdate" class="required-field" value="<?php echo ((isset($joining_date))?explode(' ',$joining_date)[0]:""); ?>"/><?php if(isset($errors['joining_date'])) echo '<li>'.$errors['joining_date'] . '</li>'?></td>
                  </tr>
                  <tr>
                    <td>Employ&nbsp;Type</td>
                    <td><select name="usertype_id" id="usertype_id" class="chosen-select" >
						  <?php
						  include_once("../php/classes/type.php");
						  $type_obj = new type();
						  $types = $type_obj->getTypes(1);/* 1 = only active roles  */
						  if($types){
							while( $type = mysql_fetch_assoc($types) ){
									echo'<option value="'.$type['id'].'" '.((isset($user) && $user['usertype_id'] == $type['id'])?"selected":"").'>'.$type['title'].'</option>';
							}
						  }
						  ?>
						</select><div id="roles_fields_row" >
				
					<div class="form_row" id="pm_selector" >
						<div class="form_cell_text">Manager</div>
						<div class="form_cell_element">
							<select name="pmid" class="chosen-select"><?php
								$pms = $user_obj->getUsersByType(2,1);/* 2 = Project manager, 1 = User status*/	
								if($pms){
									while( $pm = mysql_fetch_assoc($pms) ){
										echo '<option value="'.$pm['id'].'" '.(( $user && isset($user['pmid']) && $user['pmid'] == $pm['pmid'] )?"selected":"").'>'.$pm['fname'].' '.$pm['lname'].'</option>';
									}
								}
							?></select>
						</div>
					</div>
					
					<div class="form_row">
						<div class="form_cell_text">Field(s)</div>
						<div class="form_cell_full_width">
							<select name="fieldid[]" class="chosen-select-full-width" multiple>
							  <?php
							  include_once("../php/classes/field.php");
							  $field_obj = new field();
							  $fields = $field_obj->getFields(false, 1);/* false = not include dependents, 1 = only active fields  */
							  if($fields){
								if( isset($user) ){
									$userfields = $field_obj->getFieldsByUserId($user['id']);
									$userfields_arr = array();
									while( $userfield = mysql_fetch_assoc($userfields) ){
										$userfields_arr[] = $userfield['fieldid'];
									}
								}
								while( $field = mysql_fetch_assoc($fields) ){
									echo '<optgroup label="'.$field['title'].'">';
									$dependents = $field_obj->getFieldsByDependenId($field['id'], 1);/* 1 = only active fields  */
									while( $dependent = mysql_fetch_assoc($dependents) ){
										echo'<option value="'.$dependent['id'].'" '.((isset($userfields) && in_array($dependent['id'],$userfields_arr) )?"selected":"").'>'.$dependent['title'].'</option>';
									}
									echo '</optgroup>';
								}
							  }
							  ?>
							</select>
						</div>
					</div>
					
					<div class="form_row">
						<div class="form_cell_text">User Role</div>
						<div class="form_cell_full_width">
							<select name="userrole[]" class="chosen-select-full-width" multiple>
							  <?php
							  include_once("../php/classes/role.php");
							  $role_obj = new role();
							  $roles = $role_obj->getRoles(1);/* 1 = only active roles  */
							  if($roles){
								$userroles = $role_obj->getRolesByUserId($user['id']);
								$userroles_arr = array();
								while( $userrole = mysql_fetch_assoc($userroles) ){
									$userroles_arr[] = $userrole['roleid'];
								}
								while( $role = mysql_fetch_assoc($roles) ){
										echo'<option value="'.$role['id'].'" '.((isset($userroles) && in_array($role['id'],$userroles_arr) )?"selected":"").'>'.$role['title'].'</option>';
								}
							  }
							  ?>
							</select>
						</div>
					</div>
				</div></td>
                    <td>Status</td>
                    <td><input type="radio" name="status" value="1" id="active-btn" checked/><label for="active-btn">Active </label>
						<input type="radio" name="status" value="0" id="block-btn"/><label for="block-btn">Block</label>
					</div>
					<input type="hidden" name="id" value="<?php echo ((isset($user) && !empty($user['id']))?$user['id']:""); ?>" /></td>
                  </tr>
                  </table>
                  <table>
                  <tr>
                  	<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                  	<td> <textarea name="address" placeholder=" Address" rows="10" cols="36"><?php echo ((isset($address))?$address:""); ?></textarea><?php if(isset($errors['address'])) echo '<li>'.$errors['address'] . '</li>'?></td>
                   <tr>
                  	<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td> <input type="submit" name="submit" id="savebtn" value="Save" />
                    <input type="reset" value="Reset" /></td>
                  </tr>
                  </table>
                  </form>
                </div>
<SCRIPT language=Javascript>	
function MyFunction() {
	document.getElementById('form1').submit();
}
function isAlphabetKey(evt) {
	var charCode = (evt.which) ? evt.which : event.keyCode
	if ((charCode > 64 && charCode < 91) || (charCode > 96&& charCode < 123))
		return true;
		return false;
}
      function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
      }

</SCRIPT>
	 <script type="text/javascript" src="../include/js/jquery.min.js"></script>
<script type="text/javascript" src="../include/js/chosen.jquery.min.js"></script>
<script type="text/javascript" src="js/newuser.js"></script>
<script type="text/javascript" src="js/jquery-ui.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$('#joiningdate').datepicker({
		dateFormat: 'yy-mm-dd',
		minDate:0
	}).keyup(function() {
		$(this).val('');
	});
	
});
</script>

     <?php include("footer.php"); ?>
</div>
</body>
</html>
