$(function(){
	$('.new_document input').change(function(){
		var ar = $(this).val().split('\\');
		var fileName = ar[ar.length - 1].split('.').splice(-0,1).join("");
		$(this).siblings(".document_title").html(fileName);
	});

	$('.document_item input').change(function(){
		var ar = $(this).val().split('\\');
		var fileName = ar[ar.length - 1].split('.').splice(-0,1).join("");
		$(this).siblings(".document_title").html('<font style="color:#2a9fa2">'+fileName+'</font>');
	});


    if($('.method_type').val() == 'POST') {
        window.location.href = "http://baccara-decor.ru/personal/profile.php"
    }
    
    $(".bx-auth-profile form").validate({
		invalidHandler: function(event, validator) {
			$('.bx-core-waitwindow').css('display','none');
		
		},
		rules: {
			"UF_ADDRESS_FACT": {
				required: true,
				minlength: 10
			}	
		}
	});
    
});