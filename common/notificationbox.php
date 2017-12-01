<?php @session_start(); 
	if( isset( $_SESSION['user'] ) ){
		if($_SESSION['user']['usertype_id'] == $usertypeid ){
			$username = $_SESSION['user']['fname'].' '.$_SESSION['user']['lname']; 
			include("../php/classes/notification.php");
			$noti_obj = new notification();
			$notofications = $noti_obj->getNotificationsByUserId($_SESSION['user']['id'] );
		}else{
			//header('Location: ../'.$_SESSION['user']['fn']);
		}
	}else{
		header('Location: ../');
		exit;
	}
?>
<div id="usercontrolls_box">
	<div id="usercontrolls_btn"><img src="../include/images/photo.jpg" ></div>
	<div id="notification_number"><?php echo ($notofications['total'] > 0)?$notofications['total']:""; ?></div>
	<div id="userinfo" >
		<div id="corner_top"></div>
		
		<div id="namebox"><span id="user_name"><?php echo $username; ?></span>
		<br/><br/>
		<div id="notification_list">
        <?php 
		echo $notofications['html'];
		echo '<br><a href="../common/All_notification.php"><div class="notification" style="line-height: 29px;height: 41px;">All notification</div></a>';
			
		?>
        
        
			<?php //echo ($notofications['total'] > 0)?$notofications['html']:'<div class="notification" style="line-height: 29px;height: 41px;">All notification</div>'; ?></a>
		</div>
			<div id="usercontrolls">
				<a href="../php/logout.php" style="margin-left:280px; color:#03F;"><span>Logout</span></a>
			</div>
		</div>
	</div>
</div>