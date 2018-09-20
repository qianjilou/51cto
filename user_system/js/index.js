$(function () {
	$("#user_name,#user_password").keyup(function(){
		if ($(this).parent().find(".success").length > 0) {
			$(this).parent().find(".success").remove();
		}
		if ($(this).parent().find(".error").length > 0) {
			$(this).parent().find(".error").remove();
		}
		if (/^\w{6,20}$/.test($(this).val())) {
			$(this).parent().append("<span class='success'>OK</span>")
		}else{
			$(this).parent().append("<span class='error'>ERROR</span>")
		}
	});

	$(":submit").click(function(){
		$("#user_name").triggerHandler("keyup");
		$("#user_password").triggerHandler("keyup");
		if ($("#user_form").find(".error").length > 0) {
			return false;
		}
	});
});