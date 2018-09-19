$(function(){
	$("#user,#pwd").keyup(function(){
		if ( $(this).parent().find("span").length > 0 ) {
			$(this).parent().find("span").remove();
		}
		// if ( $(this).parent().find(".error").length > 0 ) {
		// 	$(this).parent().find(".error").remove();
		// }
		if ( /^[a-zA-Z0-9]{6,20}$/.test( $(this).val() ) ) {
			$(this).parent().append( "<span class='success'>success</span>" );
		}else {
			$(this).parent().append( "<span class='error'>error</span>" );
		}
	});
	$(":submit").click(function(){
		$( "#user" ).triggerHandler("keyup");
		$( "#pwd" ).triggerHandler("keyup");
		if ( $("#reg_login").find(".error").length > 0 ) {
			return false;
		}		
	});
});