$(document).ready(function(){
    $(".cart-goods_count input").keypress(function(e){
        if(e.keyCode==13){
            $(this).closest('.catalog_item_price_block').find('.cart-button a').click();
        }
    });
    
/*     $('.opt_prices_tip').on('mouseover', function() {
        $(this).closest('.catalog_item_price_block').find('.hide_price').show();
    });    
    
    $('.opt_prices_tip').on('mouseout', function() {
        $(this).closest('.catalog_item_price_block').find('.hide_price').hide();
    });    */ 
    
    //$('.filter_high-wrap').hide();

    //$('.ui-rangeSlider-container').css('width', '660px');
    
    setTimeout(function() {
         $('.filter_high-wrap').slideUp('300');
    }, 500);
    
 });