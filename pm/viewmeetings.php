<?php
if(isset($_GET['meetingid']))
{
	include_once("../php/classes/sql_linker.php");	
	$val_1		=$_GET['meetingid'];	
	$_tbl_name	="meetings";
	$column_1	="id";
	$qry="SELECT * FROM ".$_tbl_name." WHERE ".$column_1." ='".$val_1."'";	
	$r		=mysql_query($qry) or die("invalid query:" .mysql_error());
	$show	=mysql_fetch_array($r);
	$sender		=$show['callerid'];
	$receiver	=explode('-', $show['recevier']);
	$s=mysql_query("SELECT * FROM users WHERE id='".$sender."'")or die("ni chali");
	$show_sender	=mysql_fetch_array($s);
	for ($i =0; $i < count($receiver); $i++) {
		$t				=mysql_query("SELECT * FROM users WHERE id='".$receiver[$i]."'")or die("ni chali");
		$show_receiver[$i]	=mysql_fetch_array($t);
	}//print_r($show_receiver);
}

 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>View Meetings</title>
<link rel="stylesheet" type="text/css" href="../include/css/global.css"/>
<link rel="stylesheet" type="text/css" href="../include/css/pmsadmin.css"/>
<link rel="stylesheet" type="text/css" href="../admin/css/theme/jquery-ui-1.10.4.custom.css"/>
<link rel="stylesheet" type="text/css" href="../include/css/meetingview.css" />
</head>
<body>
<div id="wraper">
     <?php include("header.php"); ?>
     <div class="cb"></div>
	 <fieldset style="width:780px; margin-left:40px; margin-top:30px;">
     <legend style="color:#06F;"><b>View Meetings</b></legend>
     <div id="meeting_detail">
     <table>
      <tr>
        <td><span>Meeting Date:</span></td>
        <td style="border-right:none"><span style="color:#06F;"><?php echo date("M j, Y",strtotime($show['meetingdate'])); ?></span></td>
      </tr>
      <tr>
        <td><span>Meeting Subject:</span></td>
        <td style="border-right:none"><span style="color:#06F;"><?php echo $show['title']; ?></span></td>
      </tr>
      <tr>
        <td><span>Created By:</span></td>
        <td style="border-right:none"><span style="color:#06F;"><?php echo $show_sender['fname']." ".$show_sender['lname']; ?></span></td>
      </tr>
      <tr>
        <td><span>Recipients List:</span></td>
        <td style="border-right:none"><span style="color:#06F;">
        	<?php 
			 //echo '<input type="text" readonly size="50" style="color:#06F;" value="';
			 for ($i = 0; $i < count($show_receiver); $i++) {
				echo  '<li>' . $show_receiver[$i]['fname'] . ' ' . $show_receiver[$i]['lname'] . '</li>' ;
			 }//echo '">';
		  ?></span>
        </td>
      </tr>
      <tr>
        <td><span>Meeting Description:</span></td>
        <td style="border-right:none"><p style="color:#06F;"><?php echo $show['description']; ?></p></td>
      </tr>
    </table>
     
     </div>
     </fieldset>
     
     <?php include("footer.php"); ?>
</div>
</body>
</html>