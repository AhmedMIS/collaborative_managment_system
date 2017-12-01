jQuery(document).ready(function(){
	jQuery(".chosen-select").chosen({disable_search_threshold: 10});
	jQuery(".chosen-select-full-width").chosen({disable_search_threshold: 10,width:'70%'});
	
	jQuery("select#teamid").change(function(){
		jQuery.post("../php/getteammembers.php",{teamid:jQuery(this).val()},function(data){
			jQuery("select#assigneeid").html(data).trigger("chosen:updated");
		});
	});
});