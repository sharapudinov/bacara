$(document).ready(function() {

    $(document).on('click', '.del_marked', function() {
        var arrGoods = [];
        $("input[type=checkbox]:checked.del_position").each(function() {
            arrGoods.push($(this).val());
        });
                
        if(arrGoods.length > 0) {
            $.post('/include/del_cart_positions.php', {'del_position[]': arrGoods}).done(function(data) {
                if(data) {
                    window.location.href = "/cart/";
                }
                else
                    alert('Произошла ошибка, свяжитесь с нами пожалуйста +79853931418');
            });
        }
    });
    
    $('.quantity_in_cart').on('keyup', function() {
        
            var q = $(this).val();
            var constant_value = $(this).attr('count_val');
            if(q % constant_value == 0) {
        
                var frm = $("#basket_form");
                $.post('/cart/ajax.php', frm.serialize(), function(data){
                    if(data.PRICE) { 
                     $(".basket_total_value").text(data.PRICE);
                     $(".total_summ-cart").html(data.PRICE);
                        for(var key in data.ITEMS)
                        {
                            var price = parseFloat(data.ITEMS[key]);
                            var cop = price - Math.floor(price);
                            $("#all_price"+key).html(Math.floor(price) + '<span class="price__copy">.'+cop+' </span>');
                        }
                    } 
                     


                }, 'json');
                
                setTimeout(function() {
                    
                    if(parseInt($('.total_summ-cart').html()) > 50000 || $('.current_price_category').val() == 1)
                        $.post('/include/convert_prices.php').done(function(data) {
                            if(data) {
                                if(data != 'not_auth') {
                                    var json = JSON.parse(data);
                                    console.log(json.action);
                                    console.log(json.summ);
                                    
                                    var popup_text;
                                    var price_category = ['add_sp', 'add_ko', 'del_sp_and_ko'];
                                    
                                    if($.inArray(json.action, price_category) >= 0) {
                                        
                                        if(json.action == 'add_sp') {
                                            popup_text = 'В качестве категории цен установлена "Специальная цена"';
                                        }
                                        else if(json.action == 'add_ko') {
                                            popup_text = 'В качестве категории цен установлена "Крупный опт"';
                                        }
                                        else {
                                            popup_text = 'В качестве категории цен установлена "Оптовая цена"';
                                        }
                                        
                                        $('.price_category-popup-text').html(popup_text);
                                        $('.price_category-request_popup').fadeIn('10');
                                        
                                    }
                                }
                            }
                            else alert('error');
                        });
                }, 3000);
                
            }
            else {
                alert('Данная позиция продается упаковками. Кол-во должно быть крытным количеству в упаковке ('+constant_value+' шт.)');
            }        
    });
    
    if((parseInt($('.basket_total_value').html()) < 60000 || $('.basket_total_value').length == 0) && $('.current_price_category').val() == 1) {
        $.post('/include/convert_prices.php').done(function(data) {
            if(data) {
                if(data != 'not_auth') {
                    var json = JSON.parse(data);
                    console.log(json.action);
                    console.log(json.summ);
                    
                    var popup_text;
                    var price_category = ['add_sp', 'add_ko', 'del_sp_and_ko'];
                    
                    if($.inArray(json.action, price_category) >= 0) {
                        
                        if(json.action == 'add_sp') {
                            popup_text = 'В качестве категории цен установлена "Специальная цена"';
                        }
                        else if(json.action == 'add_ko') {
                            popup_text = 'В качестве категории цен установлена "Крупный опт"';
                        }
                        else {
                            popup_text = 'В качестве категории цен установлена "Оптовая цена"';
                        }
                        
                        $('.price_category-popup-text').html(popup_text);
                        $('.price_category-request_popup').fadeIn('10');
                        
                    }
                }
            }
            else alert('error');
        });
    }
    
    $('.total_summ-cart').html($('.basket_total_value').html());
    
});

