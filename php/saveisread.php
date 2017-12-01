<?php

	session_start();
	include_once("classes/notification.php");
	$noti_obj = new notification();
	$noti_obj->saveIsRead($_SESSION['user']['id']);
	exit;
?>