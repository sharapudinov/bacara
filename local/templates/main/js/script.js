$(document).ready(function() {
        $(".fancybox")
        .attr('rel', 'gallery')
        .fancybox({
            beforeLoad: function() {
                this.title = $(this.element).attr('caption');
            }
        });
    
    $('.overlay').on('click', function() {
        $('.all_ok2').fadeOut('100');
    });        
        
    $('.feedback_header').submit(function() {
        $('.error2').remove();
        
        var phone = $('.feedback_header-phone');
        var name = $('.feedback_header-name');
        var email = $('.feedback_header-email');
        var req_form = $('.feedback_header');
        
        console.log(email.val());
        
        if(phone.val() != '' && phone.val() != null && phone.val() != undefined && name.val() != '' && name.val() != null && name.val() != undefined) {
            if(email.val() == '' && email.val() == null && email.val() == undefined) {
                req_form.prepend('<div style="color:red;" class="error2">Необходимо заполнить поле Email</div>');
            }
            else if(!validateEmail(email.val())) {
                req_form.prepend('<div style="color:red;" class="error2">Некорректно заполнено поле Email</div>');
            }
            else {
                $.post('/include/feedback_header.php', {'phone': phone.val(), 'name': name.val(), 'email': email.val()}).done(function(data) {
                    if(data) {                    
                        $('.popup-3').hide();                                      
                        $('.all_ok2').fadeIn('100');
                    }
                    else
                        alert('Произошла ошибка, свяжитесь с нами пожалуйста +79850556360');
                });
            }
        }
        
        return false;
    });
    
     $(document).ready(function() {
                  $(function() {
                    $( "#slider-range" ).slider({
                      range: true,
                      min: 0,
                      max: 500,
                      values: [ 75, 300 ],
                      slide: function( event, ui ) {
                        $( "#amount" ).val(ui.values[ 0 ] + "-" + ui.values[ 1 ] );
                      }
                    });
                    $( "#amount" ).val($( "#slider-range" ).slider( "values", 0 ) +
                      " - " + $( "#slider-range" ).slider( "values", 1 ) );
                  });
              });
    
    //$("#slider_filter").editRangeSlider();
    
/*     $("#slider_filter").editRangeSlider({
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
        $('.filter_form').slideToggle();
    }); */
    
    
/*     $('#foto24').on('click', function() {
        $(this).hide();
    });
    
    setTimeout(function() {
         $('#foto24').fadeOut('slow');
    }, 7000); */
    
    function validateEmail(email) {
        var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
        return re.test(email);
    }

    $(document).on('submit', '.oferta-form', function() {

        $('.oferta-href').removeClass('oferta-error');
        $('.oferta-txt-error').remove();

        if(!$('.checkbox-oferta').is(':checked')) {
            $('.oferta-wrap').before('<p class="oferta-txt-error">Необходимо ознакомиться и принять.</p>');
            $('.oferta-href').addClass('oferta-error');
            return false;
        }
    });

    $(document).on('click', '.label-of-wrap', function() {
        if($('.checkbox-oferta').is(':checked')) {
            $('.submit-ofert').show();
        }
        else {
            $('.submit-ofert').hide();
        }
    });

    /*$(document).on('click', '.oferta-href', function() {
        $(this).closest('.oferta-wrap').find('.oferta-popup').css({
            display: "block",
            opacity: 1,
            visibility: "visible",
            top: "10%",
        });
    });*/

});


