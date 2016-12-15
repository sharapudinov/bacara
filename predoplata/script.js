$(document).ready(function() {
                    
    $('.show_large_whosale').hover(function() {        
            $('.show_large_whosale-text').show();        
    }, function() {        
            $('.show_large_whosale-text').hide(); 
    });
        
        
    $('.predoplata').on('click', function() {

        var item_id = $(this).closest('.catalog_detail').attr('id');
        var summ = $('.base_prise_value input').val();
        
        $.post('/include/predoplata.php', {'summ': summ, 'item_id': item_id}).done(function(data) {
            if(data) {
                document.location.href = '/order/step2/';
            }
        });
    });        
        
});