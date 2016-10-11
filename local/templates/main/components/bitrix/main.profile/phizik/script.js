$(function() {

	$('input[name="EMAIL"]').on('change',function(e){
		$('input[name="LOGIN"]').val($(this).val());
	});

	$.validator.addMethod("mobile", function(phone_number, element) {
		//phone_number = phone_number.replace(/\(|\)|\s+|-/g, "");
		return  phone_number.match(/^[0-9]-[0-9]{3}-[0-9]{3}-[0-9]{2}-[0-9]{2}$/);
	}, "Введен некорректный Телефон");

	$(".bx-auth-profile form").validate({
		invalidHandler: function(event, validator) {
			$('.bx-core-waitwindow').css('display','none');
		
		},
		rules: {
			"NAME": {
				required: true,
				minlength: 3
			},
			"EMAIL": {
				required: true,
				email: true
			},
			"PERSONAL_PHONE": {
				required: true,
				mobile: true
			},
			"NEW_PASSWORD": {
				minlength: 6
			},
			"NEW_PASSWORD_CONFIRM": {
			      equalTo: '.bx-auth-profile form input[name="NEW_PASSWORD"]'
			}	
		}
	});
});

