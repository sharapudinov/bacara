$(document).ready(function() {
    $('#pay_type label').on('click', function() {        
        var pay_id = $(this).parent().attr('pay_id');
        var class_name = 'pay_image';
        if(pay_id == 1) {
            class_name = 'pay_image'
        }
        else if(pay_id == 3 || pay_id == 6) {
            class_name = 'pay_yandex';
        }
        else if(pay_id == 5 || pay_id == 8) {
            class_name = 'pay_sbrf';
        }
        else {
            class_name = 'pay_card';
        }
        
        $('#pay_image').removeClass('pay_image pay_card pay_yandex pay_sbrf').addClass(class_name);
    });
});

function ChangeGenerate(val)
{
	if(val)
		document.getElementById("sof_choose_login").style.display='none';
	else
		document.getElementById("sof_choose_login").style.display='block';

	try{document.order_reg_form.NEW_LOGIN.focus();}catch(e){}
}