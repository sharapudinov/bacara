function catalog_items (){// пересчет высоты элементов в каталоге
	catalogH = 0;
	catalogPH = 0;
	if(!$('.catalog_items').hasClass('catalog_list')){
		$('.catalog_item').each(function(){
			if($(this).find('.catalog_item_info').height()>catalogH){
				catalogH = $(this).find('.catalog_item_info').height();
			}
			if($(this).find('.catalog_item_price_block').height()>catalogPH){
				catalogPH = $(this).find('.catalog_item_price_block').height();
			}
		})
		$('.catalog_item_info').height(catalogH);
		$('#catalog-body .catalog_item_price_block').height(catalogPH);
	} else {
		$('.catalog_item_info').css('height','auto');
		$('.catalog_item_price_block').each(function(){
			$(this).height($(this).closest('.catalog_item').height()-29);
		});
	}
};
$(window).on('scroll',function(){
	if($(window).scrollTop()>$(window).height()){
		$('.topbutton').show();
	} else {
		$('.topbutton').hide();
	}
});
$(document).ready(function(){

	   var mh = 0;
	   $(".content .luchshee").each(function () {
		   var h_block = parseInt($(this).height());
		   if(h_block > mh) {
			  mh = h_block;
		   };
	   });
	   $(".content .luchshee").height(mh);
 
	$('.topbutton').on('click',function(e){// плавная прокрутка к началу страницы
		e.preventDefault();
		$('html, body').animate({
			scrollTop : 0
		}, 1000);
	});

	productH = 0;
	$('.product_item .product-title').each(function(){
		if($(this).height()>productH){
			productH = $(this).height();
		}
	})
	$('.product_item .product-title').height(productH);

	specialH = 0;
	$('.product_title').each(function(){
		if($(this).height()>specialH){
			specialH = $(this).height();
		}
	})
	$('.product_title').height(specialH);
	
	catalog_items();

	$('.view_type').on('click',function(e){// переключение режима просмотра каталога плитка/список и пересчет высоты блоков
		e.preventDefault();
		if(!$(this).hasClass('active')){
			$('.view_type').toggleClass('active');
			$('.catalog_items').toggleClass('catalog_list');
			catalog_items();
		}
	});

	$('#opt_options_select').on('click',function(){//выбрать ВСЕ опции в фильтре
		$('#opt_options input').prop('checked', true);
	});
	$('#opt_options_deselect').on('click',function(){//снять выделение ВСЕХ опции в фильтре
		$('#opt_options input').prop('checked', false);
	});

	$('.sub_photo').on('click',function(e){//Смена большой фотографии на детальной странице товара
		e.preventDefault();
		if(!$(this).hasClass('active')){
			$('.sub_photo.active').removeClass('active');
			$(this).addClass('active');
			$('.main_photo').attr('href', $(this).attr('href'));
			$('.main_photo img').attr('src', $(this).attr('href'));
		}
	});

	// $('.more_sub').on('click',function(e){//прокрутка дополнительных фоток на детальной странице товара
	// 	e.preventDefault();
	// 	next_screen_h = $('.sub_photo_scroller').height()-300-Math.abs(parseInt($('.sub_photo_scroller').css('top')));
	// 	if(next_screen_h<=300){
	// 		$('.sub_photo_scroller').append($('.sub_photo_scroller').html());
	// 	}
	// 	screen_number = Math.ceil($('.sub_photo').size()/3);
	// 	current_screen = Math.abs(parseInt($('.sub_photo_scroller').css('top')))/300;
	// 	next_screen = current_screen+1;
	// 	if(next_screen<screen_number){
	// 		$('.sub_photo_scroller').css('top','-'+next_screen*300+'px');				
	// 	}
	// });

	function recalc_total(){// пересчет сыммы заказа в корзине
		/*total = 0;
		$('.basket_items .basket_item_summ .value').each(function(){
			total +=parseInt($(this).text());
		});
		$('.basket_total_value').text(total);*/
	}

	$('.qt_mod').on('keyup',function(){//изменение значения суммы позиции и заказа
		/*summ = parseInt($(this).val())*parseInt($(this).closest('tr').find('.basket_item_cost').text());
		$(this).closest('tr').find('.basket_item_summ .value').text(summ);
		recalc_total();*/
	});

	$('.remove_basket_position').on('click',function(e){//удаление позиции в корзине и пересчет суммы
		//e.preventDefault();
		if(confirm('Вы уверены, что хотите удалить товар из корзины?'))
			$(this).closest('tr').remove();
		else return false;
		//recalc_total();
	});

	$('.switch_control input').on('change',function(){//радои-переключатель
		$(this).closest('.switch_control').addClass('active').siblings('.switch_control').removeClass('active');
		$('.switch_content.'+$(this).closest('.switch_control').attr('id')).addClass('active');
		var id = $(this).closest('.switch_control').attr('id');
		$('.switch_content.' + id ).siblings('.switch_content').removeClass('active');
	});
	$('a.switch_control').on('click',function(e){//ссыльный переключатель
		e.preventDefault();
		$(this).addClass('active').siblings('.switch_control').removeClass('active');
		$('.switch_content.'+$(this).attr('id')).addClass('active').siblings('.switch_content').removeClass('active');
	});

	$('.cart-button a').on('click',function(e){//добавление товара в корзину
        
        var q = $(".quantity"+$(this).attr('rel')).val();
        e.preventDefault();
        var constant_value = $(this).closest('.catalog_item_price_block').find('.cart-goods_count input').attr('count_val');
        
        if(q % constant_value == 0) {
        //	$(this).closest('.cart-button').html('товар добавлен').addClass('add_confirm');//вернуть по успешному добавлению.
            
            $(this).closest('.catalog_item_price_block').find('.cart-goods_count input').val(constant_value);
            $(this).closest('.catalog_item').animate({opacity: 0.3}, 350);                
            
            /* console.log($(this).attr('rel'));
            console.log("input.quantity"+$(this).attr('rel')); */
            
            var item_id = $(this).attr('rel');
            
            $.post('/include/add2basket.php', {'add2basket':'Y', 'id':item_id, 'quantity':q}, function(data){
                
                $('#'+item_id).animate({opacity: 1}, 350);                
                $(".top_basket").html(data);
                $('.top_basket').css('background-color', '#1C5C5E');
                
                setTimeout(function() {
                    $('.top_basket').css('background-color', '#3a9fa2');
                }, 500);
                $('.top_basket').effect('shake', 700);
                
                if($('#'+item_id).length > 0) {
                    $.post('/include/update_item_count.php', {'item_id': item_id}).done(function(data) {
                        if(data) {
                            
                                var count = data + ' шт. в корзине';
                                $('#'+item_id).find('.catalog_item-count').addClass('lenta-act');
                                $('#'+item_id).find('.catalog_item-count').html(count);
                            
                        }
                    });
                }
                
                $('#'+item_id).find('.cart-button').effect('transfer', { to: $('#'+item_id).find('.catalog_item-count'), className: "ui-effects-transfer" }, 500);
                
            //    $('#'+item_id).find('.catalog_item-count').effect('highlight', {color: '#3a9fa2'}, 1100);
                
            });
            
            setTimeout(function() {
                
                    //console.log($('.current_price_category').val());
                    
                    if(parseInt($('.amount_summ-cart').val()) > 50000 || $('.current_price_category').val() == 1)
                        $.post('/include/convert_prices.php').done(function(data) {
                            if(data) {
                                console.log(data);
                                if(data != 'not_auth') {
                                    var json = JSON.parse(data);
                                    console.log(json.action);
                                    $(".total_summ-cart").html(json.summ);
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
                                        $('.price_category-popup-text2').remove();
                                        $('.price_category-request_popup').fadeIn('10').delay('2900').fadeOut('100');
                                        
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

	$('.mod_preset').on('click',function(e){//переключение блока пресета адреса доставки при оформлении заказа в textarea
		e.preventDefault();
		$(this).closest('.preset_addres').html('<div class="input_group"><label>Адрес доставки</label><textarea name="" rows="3">'+$(this).siblings('.preset_addres_value').text()+'</textarea></div>');
	});

/* 	$('.check_balance').on('click',function(e){//обновление баланса в личном кабинете.
		e.preventDefault();
		$('.balance_request').addClass('active').siblings('.balance_phase').removeClass('active').hide();
		setTimeout(function(){
			$('.balance_value').text('23500');
			$('.balance_status').addClass('active').show().siblings('.balance_phase').removeClass('active');
		}, 2000);
	}); */
    
    var plusButton = $('.plus-goods_count');
    var minusButton = $('.minus-goods_count');
    
    plusButton.on('click', function() {
        var constant_count = $(this).prev().attr('count_val');
        var count = parseInt($(this).prev().val()) + parseInt(constant_count);
        $(this).prev().val(count);
    });

    minusButton.on('click', function() {
        var constant_count = $(this).next().attr('count_val');
        if(parseInt($(this).next().val()) > constant_count) {            
            var count = parseInt($(this).next().val()) - parseInt(constant_count);
            $(this).next().val(count);
        }
    });
    
    var h_hght = 150; // высота шапки
      var h_mrg = 0;    // отступ когда шапка уже не видна
      $(function(){
       $(window).scroll(function(){
          var top = $(this).scrollTop();
          var elem = $('.fixpanel-top');
          if (top+h_mrg > h_hght) {
           elem.css('display', 'block');
          } else {
           elem.css('display', 'none');
          }
        });
      });
      
          $("#slider_filter").editRangeSlider({
		//type: "number",
		defaultValues:{min: 30, max: 50},
		//formatter:function(val){
        	//var value = Math.round(val * 5) / 5,
          	//decimal = value - Math.round(val);
		//return decimal == 0 ? value.toString() + ".0" : value.toString();
		//},
		//wheelMode: "zoom",
		wheelSpeed: 30,
		bounds: {min: 0, max: 200}
	});

    setTimeout(function() {
        if($('.slider_filterleft').val() != '' && $('.slider_filterright').val() != '') {
            $('form :input[name=slider_filterleft]').val($('.slider_filterleft').val());
            $('form :input[name=slider_filterright]').val($('.slider_filterright').val());
        }
        
    }, 1000);
    
    $(document).on('click', '.filter_high-button', function() {        
        if($('.filter_high-wrap').css('display') == 'block') {
            $('.filter_high-wrap').slideUp();            
        }
        else {
            $('.filter_high-wrap').slideDown();            
        }
    });
});