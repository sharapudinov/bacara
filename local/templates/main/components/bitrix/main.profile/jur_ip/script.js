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
			"LAST_NAME": {
				required: true,
			},
			"SECOND_NAME": "required",
			"UF_PASSPORT_SERIAL": {
				required: true,
				digits: true
			},
			"UF_PASSPORT_NUMBER": {
				required: true,
				digits: true
			},
			"UF_PASSPORT_FROM": "required",
			"UF_PASSPORT_FCODE": "required",
			"UF_PASSPORT_GIVE":  {
				required: true,
				date: true
			},
			"UF_ADDRESS_REG": "required",
			"PERSONAL_BIRTHDAY": {
				required: true,
				date: true
			},
			"WORK_COMPANY": "required",
			"UF_COMPANY_SHORT": "required",
			"UF_INN": {
				required: true,
				digits: true
			},
			"UF_KPP": {
				required: true,
				digits: true
			},
			"UF_OGRN": {
				required: true,
				digits: true
			},
			"UF_ADDRESS_UR": "required",
			"UF_ADDRESS_POST": "required",
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

