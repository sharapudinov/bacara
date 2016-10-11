$(document).ready(function() {
    $('.check_balance').on('click', function() {
        
        var cur_date = $('.date_balance > span').html();
        //alert(cur_date);
        //console.log(cur_date);
        $.post('/include/get_balance.php', {'cur_date': cur_date}).done(function(data) {
                        
            //console.log(data);
            
            $('.balance_request').addClass('active').siblings('.balance_phase').removeClass('active').hide();
            
            if(!data) {
                setTimeout(function(){
                    $('.balance_value').text('Баланс обновится в течении 5 минут. Нажмите кнопку "обновить" позднее.');
                    $('.balance_status').addClass('active').show().siblings('.balance_phase').removeClass('active');
                }, 2000);
            }
            else {                
                var json = JSON.parse(data);            
                var sum = json.UF_BALANCE;
                var date = json.UF_DATE_BALANCE;
                
                var balance = (sum == 999999.99) ? 'Вы не зарегистрированы как партнер.' : sum+' руб.';
                var text = (sum == 999999.99) ? '' : 'Данные получены.';
                
                setTimeout(function(){
                    $('.balance_value').text(text);
                    $('.balance_status').addClass('active').show().siblings('.balance_phase').removeClass('active');
                    $('.current_balance > span').html(balance);
                    $('.date_balance > span').html(date);
                }, 2000);
            }
        });
    });
    
/*     $('.check_balance').on('click',function(e){//обновление баланса в личном кабинете.
		e.preventDefault();
		$('.balance_request').addClass('active').siblings('.balance_phase').removeClass('active').hide();
		setTimeout(function(){
			$('.balance_value').text('Баланс обновится в течении 5 минут. Нажмите кнопку "обновить" позднее.');
			$('.balance_status').addClass('active').show().siblings('.balance_phase').removeClass('active');
		}, 2000);
	}); */
    
});