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
		$('.catalog_item_price_block').height(catalogPH);
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

	/*Шаблонизатор. в html документе заменяте элементы div.template*/
	$('.template').each(function(){$(this).load('template/'+$(this).attr('rel')+'.html', function(response){$(this).replaceWith(response)});});
	/*Перед усадкой уничтожить. */
 
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

	$('.more_sub').on('click',function(e){//прокрутка дополнительных фоток на детальной странице товара
		e.preventDefault();
		screen_number = Math.ceil($('.sub_photo').size()/3);
		current_screen = Math.abs(parseInt($('.sub_photo_scroller').css('top')))/300;
		next_screen = current_screen+1;
		if(next_screen<screen_number){
			$('.sub_photo_scroller').css('top','-'+next_screen*300+'px');				
		}
	});

	function recalc_total(){// пересчет сыммы заказа в корзине
		total = 0;
		$('.basket_items .basket_item_summ .value').each(function(){
			total +=parseInt($(this).text());
		});
		$('.basket_total_value').text(total);
	}

	$('.qt_mod').on('keyup',function(){//изменение значения суммы позиции и заказа
		summ = parseInt($(this).val())*parseInt($(this).closest('tr').find('.basket_item_cost').text());
		$(this).closest('tr').find('.basket_item_summ .value').text(summ);
		recalc_total();
	});

	$('.remove_basket_position').on('click',function(e){//удаление позиции в корзине и пересчет суммы
		e.preventDefault();
		$(this).closest('tr').remove();
		recalc_total();
	});

	$('.switch_control input').on('change',function(){//переключение вариантов первого шага оформления заказа
		$(this).closest('.switch_control').addClass('active').siblings('.switch_control').removeClass('active');
		$('.switch_content.'+$(this).closest('.switch_control').attr('id')).addClass('active').siblings('.switch_content').removeClass('active');
	});
});