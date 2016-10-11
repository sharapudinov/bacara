$(document).ready(function() {
                    
    $('.show_large_whosale').hover(function() {        
            $('.show_large_whosale-text').show();        
    }, function() {        
            $('.show_large_whosale-text').hide(); 
    });
        
    $('.predoplata').on('click', function() {
        
        var item_id = $(this).closest('.catalog_detail').attr('id');
        var summ = $('.base_prise_value input').val();
        var delivery_payment = $('input[name=delivery]:checked').val();
        
        $('.error').remove();
        $('.delivery_payment').css('border', 'none');
        
        if(summ == '' || summ == null || summ == undefined) {
            $('.prepayment-wrap').prepend('<div class="error">Необходимо заполнить сумму</div>');
        }
        else if(delivery_payment == '' || delivery_payment == null || delivery_payment == undefined) {
            $('.delivery_payment').css('border', '1px solid red');
            $('.prepayment-wrap').prepend('<div class="error">Необходимо указать, оплачиваете ли Вы услугу логистики.</div>');
        }
        else {
            $.post('/include/predoplata.php', {'summ': summ, 'item_id': item_id, 'delivery_payment': delivery_payment}).done(function(data) {
                if(data) {
                    document.location.href = '/order/predoplata/?dp='+data;
                }
            });
        }
    });        
        
});