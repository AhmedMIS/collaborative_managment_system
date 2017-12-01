jQuery(document).ready(function(){
	jQuery(".chosen-select").chosen({disable_search_threshold: 10});
	jQuery(".chosen-select-full-width").chosen({disable_search_threshold: 10,width:'70%'});
	var userno = parseInt(jQuery("span#user-count").attr("jquery-value"),10);
	var subordinates = jQuery("span#subordinates").html();
	var roles = jQuery("span#roles").html();
	jQuery("input#add-user").click(function(){
		var new_row = jQuery("<div>").attr('class','form_row').attr('id',"row"+userno);
		// First column 
		var text_obj_1 = jQuery("<div>").attr('class','form_cell_text');
		if(userno == 1) text_obj_1.html((userno+1)+'nd Member&nbsp;');
		else if (userno == 2) text_obj_1.html((userno+1)+'rd Member&nbsp;');
		else text_obj_1.html((userno+1)+'th Member&nbsp;');
		var eklement_obj_1 = jQuery("<div>").attr('class','form_cell_element').html('&nbsp;');
		var users_dropdown = jQuery('<select>').attr("name","userid["+userno+"]").attr("class","required-field").html( subordinates );
		eklement_obj_1.append( users_dropdown ).append(  jQuery("<input>").attr("type","hidden").attr("name","ischangeuser["+userno+"]").val("0")  );
		
		// Second column element
		var eklement_obj_2 = jQuery("<div>").attr('class','form_cell_element').html('&nbsp;&nbsp;&nbsp;');
		var roles_dropdown = jQuery('<select>').attr("name","userroleid["+userno+"]").attr("class","required-field").html( roles );
		eklement_obj_2.append( roles_dropdown ).append(  jQuery("<input>").attr("type","hidden").attr("name","ischangerole["+userno+"]").val("0")  );;
		var text_obj_2 = jQuery("<div>").attr('class','form_cell_text').html("&nbsp;&nbsp;&nbsp;User Role");
		var del_btn_obj = jQuery("<span>").addClass("del-btn").attr("jquery-rowid",userno).html("x");
		new_row.append( text_obj_1 ).append( eklement_obj_1 ).append( text_obj_2 ).append( eklement_obj_2 ).append( del_btn_obj ).hide();
		jQuery("div#team-members").append(new_row);
		new_row.slideDown();
		
		users_dropdown.chosen({disable_search_threshold: 10});
		roles_dropdown.chosen({disable_search_threshold: 10});
		del_btn_obj.click(function(){ jQuery("div#row"+jQuery(this).attr("jquery-rowid")).slideUp(300,function(){ jQuery(this).remove();});});
		userno++;
	});
	jQuery("span.del-btn").click(function(){ jQuery("div#row"+jQuery(this).attr("jquery-rowid")).slideUp(300,function(){ jQuery(this).remove();});});
	
});