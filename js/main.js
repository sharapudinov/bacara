	$(document).ready(function() {
	


 
		// Хранение переменных
 
		var accordion_head = $('.accordion > li > a'),
			accordion_body = $('.accordion li > .sub-menu');
 
		// Открытие первой вкладки при загрузке
 
		// accordion_head.first().addClass('active').next().slideDown('normal');
 
		// Выбор функции
 
 
 
		accordion_head.on('click', function(event) {

			
			if(!$(this).hasClass('link')) { 
				// Отключить заголовок ссылки
	 
				event.preventDefault();
	 
				// Отображение и скрытие вкладок при клике
	 
				if (!$(this).hasClass('active')){
					accordion_body.slideUp('normal');
					$(this).next().stop(true,true).slideToggle('normal');
					accordion_head.removeClass('active');
					$(this).addClass('active');
				} else {
					$(this).removeClass('active');
					$(this).siblings('ul.sub-menu').slideToggle();
				}
			}
		});
 
	});