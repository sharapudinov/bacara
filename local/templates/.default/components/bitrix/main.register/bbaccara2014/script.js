$(function() {

	$.validator.addMethod("mobile", function(phone_number, element) {
		//phone_number = phone_number.replace(/\(|\)|\s+|-/g, "");
		return  phone_number.match(/^[0-9]-[0-9]{3}-[0-9]{3}-[0-9]{2}-[0-9]{2}$/);
	}, "Введен некорректный Телефон");



	$("form.phizik").validate({
		rules: {
			"REGISTER[NAME]": {
				required: true,
				minlength: 3
			},
			"REGISTER[EMAIL]": {
				required: true,
				email: true
			},
			"REGISTER[PERSONAL_PHONE]": {
				required: true,
				mobile: true
			},
			"REGISTER[PASSWORD]": {
				required: true,
				minlength: 6
			},
			"REGISTER[CONFIRM_PASSWORD]": {
			      equalTo: 'form.phizik input[name="REGISTER[PASSWORD]"]'
			}	
		}
	});
    
    $('.ogrn-ip').mask('999999999999999',{placeholder:"*"});
    $('.ogrn-ooo').mask('9999999999999',{placeholder:"*"});

    $('.inn-ip').mask('999999999999',{placeholder:"*"});
    $('.inn-ooo').mask('9999999999',{placeholder:"*"});

    $('.kpp-ooo').mask('999999999',{placeholder:"*"});

	$("form.jur.ooo").validate({
		rules: {
			"REGISTER[NAME]": {
				required: true,
				minlength: 3
			},
			"REGISTER[LAST_NAME]": {
				required: true,
			},
			"REGISTER[SECOND_NAME]": "required",
			"REGISTER[WORK_COMPANY]": "required",
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
			"REGISTER[EMAIL]": {
				required: true,
				email: true
			},
			"REGISTER[PERSONAL_PHONE]": {
				required: true,
				mobile: true
			},
			"REGISTER[PASSWORD]": {
				required: true,
				minlength: 6
			},
			"REGISTER[CONFIRM_PASSWORD]": {
			      equalTo: 'form.jur.ooo input[name="REGISTER[PASSWORD]"]'
			}	
		}
	});

	$("form.jur.ip").validate({
		rules: {
			"REGISTER[NAME]": {
				required: true,
				minlength: 3
			},
			"REGISTER[LAST_NAME]": {
				required: true,
			},
			"REGISTER[SECOND_NAME]": "required",
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
				required: true
	
			},
			"UF_ADDRESS_REG": "required",
			"REGISTER[PERSONAL_BIRTHDAY]": {
				required: true

			},
			"REGISTER[WORK_COMPANY]": "required",
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
			"REGISTER[EMAIL]": {
				required: true,
				email: true
			},
			"REGISTER[PERSONAL_PHONE]": {
				required: true,
				mobile: true
			},
			"REGISTER[PASSWORD]": {
				required: true,
				minlength: 6
			},
			"REGISTER[CONFIRM_PASSWORD]": {
			      equalTo: 'form.jur.ip input[name="REGISTER[PASSWORD]"]'
			}	
		}
	});



});

