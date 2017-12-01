jQuery(document).ready(function(){
	
	jQuery("input[type=submit]#savebtn").click(function(e){
		e.preventDefault();
		jQuery("div.value").animate({
					width: "100%"
					}, 1000, function() { jQuery("form#taskform").submit(); });
		return false;
	});
});
