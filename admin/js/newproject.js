jQuery(document).ready(function(){
	jQuery(".chosen-select").chosen({disable_search_threshold: 5});
	var submit = true;
	jQuery("input[type=submit]#savebtn").click(function(e){
		e.preventDefault();
		submit = true;
		jQuery("span#msg-bar").html("");
		jQuery(".required-field").each(function(){
			if( jQuery(this).val() == "" ){
				submit = false;
				jQuery(this).css({"border":"1px solid red"}).addClass("error-bar");
				jQuery("span#msg-bar").hide().css({"color":"red"}).append("Fill all required values");
			}
		});
		if( jQuery('input#endingdate').val() < jQuery('input#startingdate').val() ){
			submit = false;
			jQuery('input#endingdate').css({"border":"1px solid red"}).addClass("error-bar"); jQuery('input#startingdate').css({"border":"1px solid red"}).addClass("error-bar");
			jQuery("span#msg-bar").hide().css({"color":"red"}).append("<br/>Starting date is greater then ending date");
		}
		if(submit){
			jQuery("form#newproject").submit();
		}else{
			jQuery("span#msg-bar").slideDown();
			//setTimeout(function(){ jQuery("span#msg-bar").slideUp(); },3000);
		}
		jQuery(".error-bar").focus(function(){ jQuery(this).css({"border":"1px solid #CCC"}).removeClass("error-bar"); });
	});
});