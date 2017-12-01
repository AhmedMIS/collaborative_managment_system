jQuery(document).ready(function(){
	$( "div.value" ).each(function(){
		/*jQuery(this).animate({
			width: jQuery(this).attr("jquery-width")+"%"
			}, 1300);
		*/
		 //animation 2
		jQuery(this).animate({
			width: jQuery(this).attr("jquery-width")+"%"
			}, 1000, function() {
			jQuery(this).removeClass("bad").addClass( jQuery(this).attr("jquery-class") );
		});
		// */
	});
});
