			$(function() {
				$(".button3").click(function(){
					$("#wrapper-bron").toggle("normal");
					$(".wrapper-ofice").hide("normal");
				})
				$(".button2").click(function(){
					$(".wrapper-ofice").toggle("normal");
					$("#wrapper-bron").hide("normal");
				})
				$('#thumbs').carouFredSel({
					synchronise: ['#images', false, true],
					auto: false,
					width: 286,
					items: {
						visible: 5,
						start: -1
					},
					scroll: {
						onBefore: function( data ) {
							data.items.old.eq(1).removeClass('selected');
							data.items.visible.eq(1).addClass('selected');
						}
					},
					prev: '#prev',
					next: '#next'
				});

				$('#images').carouFredSel({
					auto: false,
					items: 1,
					scroll: {
						fx: 'fade'
					}
				});

				$('#thumbs img').click(function() {
					$('#thumbs').trigger( 'slideTo', [this, -1] );
				});
				$('#thumbs img:eq(1)').addClass('selected');
	
			});
			
function saveTourOrder(){
var line = '';
phone = false;
email = false;
user = false;
$('form.saveTourOrder').submit(false);

		$('form.saveTourOrder input').each(function(){
			if($(this).attr('name') == 'user' && $(this).val() == ''){
                            $(this).css('border-color', 'red');
                        }else if($(this).attr('name') == 'user' && $(this).val() != ''){
                            user = $(this).val();
                            $(this).css('border-color', '#C8C9C4');
                        }
                        if($(this).attr('name') == 'email' && $(this).val() == ''){
                            $(this).css('border-color', 'red');
                        }else if($(this).attr('name') == 'email' && $(this).val() != ''){
                            email = $(this).val();
                            $(this).css('border-color', '#C8C9C4');
                        }
                        if($(this).attr('name') == 'phone' && $(this).val() == ''){
                            $(this).css('border-color', 'red');
                        }else if($(this).attr('name') == 'phone' && $(this).val() != ''){
                            phone = $(this).val();
                            $(this).css('border-color', '#C8C9C4'); 
                        }
		});
    if(phone && email && user){ 
                $.ajax({
                type: "POST",
                url: "/sletat/core/saveTourOrder.php",
                data: $('form.saveTourOrder').serialize()+'&auth=true&method=saveTourOrder',
                success: function(e) {
console.log(e);
                        $(".wrapper-ofice").empty();
                        $(".wrapper-ofice").append('<p>Спасибо за Вашу заявку! Наш специалист свяжется с Вами в ближайшее время</p>');
                }
        });
    }
}
