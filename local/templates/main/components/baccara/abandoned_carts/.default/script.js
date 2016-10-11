$(document).ready(function() {

    $(document).on("click", '.send_letter-href', function() {
        
        var receiver = $(this).attr('user_id');
        var email_to = $(this).attr('email_to');
        
        //alert(receiver);
        
        $('.cart_letter_text-wrap').show();        
        
        $('.letter_receiver').val(email_to);
        $('.email_to').html(email_to);
        
        $(document).scrollTop($(document).height())
        
        //$(document).scrollTop(0);
    });
});