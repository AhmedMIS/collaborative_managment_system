jQuery(document).ready(function(){
	jQuery("input#username").focus();
	
	
	jQuery("input#login-btn").click(function(){
		if(jQuery("input#username").val() != "" && jQuery("input#password").val() != "" ){
			jQuery("div#msgbar").html("Verifying usernamee and password");
			jQuery.post("php/adminlogin.php",{username:jQuery("input#username").val(), password:jQuery("input#password").val()},function(data){
				data = jQuery.parseJSON(data);
				jQuery("div#msgbar").html(data['msg']);
				if(data['success'] ){
					window.location.replace(data['user']['fn']);
				}
			});
		}else{
			jQuery("div#error_username").slideUp('fast',function(){ jQuery(this).html(( (jQuery("input#username").val() == "")?"Enter username":"" )).slideDown(); });
			jQuery("div#error_password").slideUp('fast',function(){ jQuery(this).html(( (jQuery("input#password").val() == "")?"Enter password":"" )).slideDown(); });
		}
		return false;
	});
});