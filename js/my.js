	  $(document).ready(function(){
	    // $("a[rel^='prettyPhoto']").prettyPhoto({
	    // 	social_tools: false,
	    // 	deeplinking: false
	    // });
	  	$("a[rel^='prettyPhoto']").fancybox({
	  			// openEffect	: 'none',
	  			// closeEffect	: 'none'
	  			afterLoad: function(){
	  				var fancySkin = $('.fancybox-skin');
	  				fancySkin.append('<span class="fancyNext"></span>');
	  				fancySkin.append('<span class="fancyPrev"></span>');
	  				$('.fancyNext').on('click', function(){
	  					var
	  						subWrapper = $('.sub_photo_scroller'),
	  						itemPhoto = subWrapper.find('.sub_photo'),
	  						fancyboxImg = $('.fancybox-image'),
	  						itemPhotoActive = itemPhoto.filter('.active'),
	  						itemPhotoNext = itemPhotoActive.next(),
	  						itemPhotoFirst = itemPhoto.first(),
	  						itemPhotoFirstHref = itemPhotoFirst.attr('href'),
	  						itemPhotoNextHref = itemPhotoNext.attr('href');
	  					
	  					if(itemPhotoNext.length){
	  						$('.fancybox-image').attr('src', itemPhotoNextHref);
	  						itemPhoto.removeClass('active');
	  						itemPhotoNext.addClass('active');
	  						console.log('aaa')
	  					} else{
	  						$('.fancybox-image').attr('src', itemPhotoFirstHref);
	  						itemPhoto.removeClass('active');
	  						itemPhotoFirst.addClass('active');
	  					}
	  					
	  				})
	  				$('.fancyPrev').on('click', function(){
	  					var
	  						subWrapper = $('.sub_photo_scroller'),
	  						itemPhoto = subWrapper.find('.sub_photo'),
	  						fancyboxImg = $('.fancybox-image'),
	  						itemPhotoActive = itemPhoto.filter('.active'),
	  						itemPhotoPrev = itemPhotoActive.prev(),
	  						itemPhotoLast = itemPhoto.last(),
	  						itemPhotoLastHref = itemPhotoLast.attr('href'),
	  						itemPhotoPrevHref = itemPhotoPrev.attr('href');
	  					if(itemPhotoPrev.length){
	  						$('.fancybox-image').attr('src', itemPhotoPrevHref);
	  						itemPhoto.removeClass('active');
	  						itemPhotoPrev.addClass('active');
	  					} else{
	  						$('.fancybox-image').attr('src', itemPhotoLastHref);
	  						itemPhoto.removeClass('active');
	  						itemPhotoLast.addClass('active');
	  					}
	  				})
	  				$('.fancybox-inner').on('click', function(){
	  					$('.fancyNext').click();
	  				})
	  				if(!$('.sub_photo_scroller').length){
	  					$('.fancyPrev, .fancyNext').hide();
	  				}
	  			}
	  		});
	  	$('.slider8').bxSlider({
	  	   mode: 'vertical',
	  	   slideWidth: 300,
	  	   minSlides: 3,
	  	   slideMargin: 10,
	  	   nextText: 'Еще фото >',
	  	   nextSelector: $('.more_sub'),
	  	   pager: false


	  	 });
	  	var filterProducts = $('.allcheck'),
	  		filterMain = $('.bx_filter_section');
	  	filterProducts.append('<span class="open_filter active">Развернуть фильтр</span>');
	  	//filterMain.hide();
	  	var btnOpenFilter = $('.open_filter')
	  	btnOpenFilter.on('click', function(){
	  		var $this = $(this);
	  		if($this.hasClass('active')){
	  			filterMain.slideDown();
	  			$this.removeClass('active');
	  			btnOpenFilter.text('Свернуть фильтр')
	  		}else{
	  			filterMain.slideUp();
	  			$this.addClass('active');
	  			btnOpenFilter.text('Развернуть фильтр')
	  		}
	  	})
		

	  });

		
		$(document).ready(function() {
		
		
			$('input[name="REGISTER[PERSONAL_PHONE]"], .phone').mask("9-999-999-99-99");
			
			$('input[name="REGISTER[PERSONAL_BIRTHDAY]"]').mask("99.99.9999");
			$('input[name="UF_PASSPORT_GIVE"]').mask("99.99.9999");
			$('input[name="ORDER_PROP_4"]').mask("9-999-999-99-99");
			$('input[name="form_text_2"]').mask("9-999-999-99-99");
	 
			// Хранение переменных
	 
			var accordion_head = $('.accordion > li > a'),
				//accordion_body = $('.accordion li > .sub-menu'),
				accordSumItem = $('.accordion li > .sub-menu').find('li'),
				accordion_link = accordion_head.find('.link');
	 
			// Открытие первой вкладки при загрузке
	 
			// accordion_head.first().addClass('active').next().slideDown('normal');
	 
			// Выбор функции

	 		//$('.accordion').find('.sub-menu').hide();

	 		//accordion_head.removeClass('active');

			accordion_head.on('click', function(event) {
				if(!$(this).hasClass('link')) { 
					// Отключить заголовок ссылки
		 
					event.preventDefault();
		 			
					// Отображение и скрытие вкладок при клике

		 			var accordion_body = $(this).parent().children('.sub-menu');

					if (!$(this).hasClass('active')){
						
						accordion_body.slideDown(300);

						//$(this).next().stop(true,true).slideToggle('normal');

						//$(this).addClass('active');
						$(this).addClass('active');
						console.log('aaaaaa')
					} else {
						$(this).removeClass('active');
						accordion_body.slideUp();
					}
				}
			});
			var accordItem = $("#two");
			if(accordItem.hasClass('active') && accordSumItem.hasClass('active')){
				// accordItem.removeClass('active');
				// accordSumItem.css('padding', '4px 0px 4px 10px');
				//console.log('pppppppp')
			}
	 
		});


$(document).ready(function() {
	$("body").on( "submit", ".system_auth_form_popup", function( event ) {
		event.preventDefault();
		var data = $( this ).serialize();
		var backurl = $('.system_auth_form_popup input[name="backurl"]').val();
		$.post($( this ).attr('action'), data, function( res ) {
			var err = $(res).find(' .errortext');
			
			console.log(backurl);
			if(err.text())
				$('.system_auth_form_popup').html($(res).find('.system_auth_form_popup').html()); 
			else{
				window.location.replace(backurl);
			}
		});
	});

	var basePrice = $('.base_price > span');
	basePrice.html('Цена ( <i></i> )');

	var catalogItems = $('.catalog_items'),
		catalogItem = catalogItems.find('.catalog_item'),
		catalogItemLength = catalogItem.length;
	//catalogItem.find('.catalog_item_info').css('height', 'auto');
	//var i;

	// for(i = 0; i < catalogItemLength; i){

	// 	var itemO = catalogItem.eq(i).find('.catalog_item_info').height(),
	// 		itemT = catalogItem.eq(i+1).find('.catalog_item_info').height(),
	// 		itemL = catalogItem.eq(i+2).find('.catalog_item_info').height(),
	// 		maxH = itemO;
	// 	var artt = catalogItem.eq(catalogItemLength-1).find('.catalog_item_info').find('.catalog_item_prop').eq(0).text();
	// 	console.log(artt)
	// 	if ( itemT > maxH ) {
 //            maxH = itemT;
 //        } else if(itemL > maxH){
 //        	maxH = itemL;
 //        	console.log('item -- ' + itemO + ' -- ' + itemT + ' -- '+ itemL + ' -- ' + maxH + ' -- ' + artt + ' --- ' + catalogItemLength)
 //        }
 //        catalogItem.eq(i).find('.catalog_item_info').height(maxH);
 //        catalogItem.eq(i+1).find('.catalog_item_info').height(maxH);
 //        catalogItem.eq(i+2).find('.catalog_item_info').height(maxH);
	// 	i = i + 3;
	// }
	// catalogItem.eq(catalogItemLength-1).find('.catalog_item_info').height(306);
	// catalogItem.eq(catalogItemLength-2).find('.catalog_item_info').height(306);
	// catalogItem.eq(catalogItemLength-3).find('.catalog_item_info').height(306);

	//варавнивание картинки слайдера при отсутствии превьюшных картинок
	var sliderProducts = $('.main_photo'),
		sliderPreview = $('.sub_photos');
	if(!sliderPreview.length){
		sliderProducts.css({'float': 'none', 'margin-right': '0px'});
	}
	var moreSub = $('.more_sub');
	if(!moreSub.length){
		sliderProducts.css('margin-top', '10px');
		if(sliderPreview.length){
			sliderPreview.css('margin-top', '10px');
		}
	}
	//стили для копеек цены товара
	var priceProducts = $('.base_prise_value'),
		regPrice = /\.+.*/;
	priceProducts.map(function(){
		var $this = $(this),
			priceString = $this.text();
		newPriceCopy = regPrice.exec(priceString);
		if(newPriceCopy != null){
			var newPrice = priceString.replace(newPriceCopy[0], '<span class="price__copy">'+newPriceCopy[0]+'</span>');
			$this.html(newPrice);
		}	
	})
		
	
});	




$(function() {
	$.validator.addMethod("mobile", function(phone_number, element) {
		//phone_number = phone_number.replace(/\(|\)|\s+|-/g, "");
		return  phone_number.match(/^[0-9]-[0-9]{3}-[0-9]{3}-[0-9]{2}-[0-9]{2}$/);
	}, "Введен некорректный Телефон");

	$("form[name='SIMPLE_FORM_1']").validate({
		rules: {
			"form_text_1": {
				required: true,
				minlength: 3
			},
			"form_text_2": {
				required: true,
				mobile: true
			},
		}
	});
	
	$("form[name='fast_order']").validate({
		rules: {
			"NAME": {
				required: true,
				minlength: 3
			},
			"email": {
				required: true,
				minlength: 3
			},			
			"phone": {
				required: true,
				mobile: true
			},
		},
		submitHandler: function(){
			$.post('/include/fast_order.php', $("form[name='fast_order']").serialize(), function(data){
				 $("form[name='fast_order']").html(data);
			});
			return false;
		}
	});	

	$('.manage').click(function()
	{
		if(!$(this).hasClass('active'))
		{
			$('.text-fade').slideDown();
			$(this).addClass('active');
		}else
		{
			$('.text-fade').slideUp();
			$(this).removeClass('active');
		}
			
	});
	

});
$(document).ready(function(){
	$('.carousel').carousel({
	  interval: 4000
	})
})
