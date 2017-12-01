<?php

include_once '../php/classes/sql_linker.php';

if (isset($_GET['id'])) {
	$query = mysql_query("DELETE FROM notifications WHERE id=".$_GET['id']);

	header('Location: All_notification.php');
	exit();
}


?>