jQuery(document).ready(function(){
	jQuery(".chosen-select").chosen({disable_search_threshold: 5,width:'100%',allow_single_deselect:true});
	jQuery("span#filter_cntr_btn").click(function(){
		if(jQuery("div#row_filter").css('display') == 'block' ){ jQuery("div#row_filter").slideUp(); }
		else{jQuery("div#row_filter").hide().slideDown('slow');}
	});
});
