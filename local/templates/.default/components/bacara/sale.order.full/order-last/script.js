function ChangeGenerate(val)
{
	if(val)
		document.getElementById("sof_choose_login").style.display='none';
	else
		document.getElementById("sof_choose_login").style.display='block';

	try{document.order_reg_form.NEW_LOGIN.focus();}catch(e){}
}

/* $(document).ready(function() {
    $('.switch_control').on('mouseover', function() {
        $('.call-operator').toggleClass('bold-red')
    });

    $('.switch_control').on('mouseout', function() {
        $('.call-operator').toggleClass('bold-red')
    });

}); */