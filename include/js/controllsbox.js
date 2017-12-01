jQuery(document).ready(function(){
	jQuery("div#userinfo").hide();
	
	jQuery("div#close_btn").click(function(){ jQuery("div#userinfo").slideUp(); });
	
	jQuery("div#usercontrolls_btn").click(function(){
		if( jQuery("div#userinfo").css('display') == 'none' ){
			jQuery("div#userinfo").slideDown();
			jQuery.post("../php/saveisread.php",function(data){
				jQuery( "div#notification_number" ).slideUp();
			});
		}else{
			jQuery("div#userinfo").slideUp();
		}
	});
	
});