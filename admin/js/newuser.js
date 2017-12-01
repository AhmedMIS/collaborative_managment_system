jQuery(document).ready(function(){
	jQuery(".chosen-select").chosen({disable_search_threshold: 10});
	jQuery(".chosen-select-full-width").chosen({disable_search_threshold: 10,width:'70%'});
	if( jQuery("select#usertype_id").val() == 1 ){ jQuery("div#pm_selector").hide(); jQuery("div#roles_fields_row").hide();}
	jQuery("span#gen-btn").click(function(){
		var text = "";
		var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
		for( var i=0; i < 8; i++ )
			text += possible.charAt(Math.floor(Math.random() * possible.length));
		jQuery("input[type=text]#password").val( text );
	});
	
	jQuery("select#usertype_id").change(function(){
		var usertype = jQuery(this).val();
		if(usertype != 3) jQuery("div#pm_selector").slideUp();
		if(usertype == 1) jQuery("div#roles_fields_row").slideUp('slow');
		else {if(usertype == 3) jQuery("div#pm_selector").slideDown(); jQuery("div#roles_fields_row").slideDown('slow'); }
	});
	
	
	
	
	var submit = true;
	
});