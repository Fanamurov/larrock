$(document).ready(function(){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var select_country = $('#form-searchTour-country');
    if(select_country.val() !== ''){
        var country = select_country.val();
        $.ajax({
            url: '/ajax/getResortsByCountry',
            type: 'POST',
            dataType: 'json',
            data: {
                country: country
            },
            success: function(data) {
                var select = $('#form-searchTour-resort');
                select.empty();
                select.append($('<option value="">любой</option>'));
                $.each(data, function(index, res) {
                    select.append($('<option value="'+ res.id +'">'+ res.title +'</option>'))
                });
            }
        })
    }

    select_country.change(function () {
        var country = $(this).val();
        $.ajax({
            url: '/ajax/getResortsByCountry',
            type: 'POST',
            dataType: 'json',
            data: {
                country: country
            },
            success: function(data) {
                var select = $('#form-searchTour-resort');
                select.empty();
                select.append($('<option value="">любой</option>'));
                $.each(data, function(index, res) {
                    select.append($('<option value="'+ res.url +'">'+ res.title +'</option>'))
                });
            }
        })
    });

    $('.toursBlockCategory').matchHeight();
    $('.toursBlockTour').matchHeight();
    $('.blog-item-module').matchHeight();
    $('.news-item-module').matchHeight();
    $('.bestcost-row').matchHeight();
    $('.search-result-photo').matchHeight();
    
    $('.ya-share2').click(function () {
        $.ajax({
            url: '/ajax/sharingCounter',
            type: 'POST',
            data: {
                type: $(this).attr('data-type'),
                id: $(this).attr('data-id')
            },
            success: function() {
                //alert('OK');
            }
        })
    });


    $(".fancybox").fancybox({
        helpers	: {
            thumbs	: {
                width	: 50,
                height	: 50
            }
        }
    });

    $('.menu_mobile').find('select').change(function () {
        window.location = $(this).val();
    });
    $('.menu_mobile').find('button').click(function () {
        window.location = $(this).attr('data-value');
    });
    $('.show-mobile-menu').click(function () {
        $(this).slideUp('fast');
        $('.menu_mobile').slideDown('fast');
        $('.mainpage_tabs').removeClass('hidden-xs').removeClass('hidden-sm');
    });
    
    $('.btn-show-online').click(function () {
        $('#collapsesletatOrderShort').collapse('hide');
    });
    $('.btn-show-office').click(function () {
        $('#collapsesletatOrderFull').collapse('hide');
    });

    $('.load-map').click(function () {
        setTimeout(function(){
            initMap();
            google.maps.event.trigger(map, 'resize');
        }, 50);
    });
    $('select#category_blog').change(function () {
        window.location = $(this).val();
    });

    /* Кнопка НАВЕРХ */
    /*jQuery scrollTopTop v1.0 - 2013-03-15*/
    (function(a){a.fn.scrollToTop=function(c){var d={speed:800};c&&a.extend(d,{speed:c});
        return this.each(function(){var b=a(this);
            a(window).scroll(function(){100<a(this).scrollTop()?b.fadeIn():b.fadeOut()});
            b.click(function(b){b.preventDefault();a("body, html").animate({scrollTop:0},d.speed)})})}})(jQuery);
    $("#toTop").scrollToTop();

    //$('.typeahead').typeahead();
    $('*[data-toggle=tooltip]').tooltip();

    $('input[name=date], input.date, input[type=date]').attr('placeholder', 'Выберите дату');

    $('input[name=date], input.date, input[type=date]').pickadate({
        selectMonths: 6,
        selectYears: 100,
        formatSubmit: 'yyyy-mm-dd',
        firstDay: 1,
        monthsFull: [ 'Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь' ],
        weekdaysShort: [ 'Вск', 'Пон', 'Вт', 'Ср', 'Чт', 'Пт', 'Суб' ],
        format: 'yyyy-mm-dd',
        today: 'Сегодня',
        clear: 'Очистить',
        close: 'Закрыть',
        min: [1935,1,1],
        max: [2020,12,31],
    });

    var today = new Date();
    var month = today.getMonth()+1;
    var month_last = today.getMonth()+2;
    $('input.daterange').daterangepicker({
        selectMonths: 6,
        selectYears: 200,
        locale: {
            format: 'DD/MM/YYYY',
            applyLabel: 'Выбрать'
        },
        startDate: today.getDate() +'/'+ month +'/'+ today.getFullYear(),
        endDate: today.getDate() +'/'+ month_last +'/'+ today.getFullYear(),
        minDate: today.getDate() +'/'+ month +'/'+ today.getFullYear(),
        today: 'Сегодня',
        clear: 'Очистить',
        close: 'Закрыть',
        min: [1935,1,1],
        max: [2020,12,31],
    });

    $('.chosen-select').chosen();

    /*
     * Универсальный обработчик для выделения блока как ссылки
     * Ищет внутри блока ссылку и присваивает ее всему блоку
     */
    $('.link_block').click(function(){window.location = $(this).find('a').attr('href');});
    $('.link_block_this').click(function(){window.location = $(this).attr('data-href');});

    $('.show-please').click(function(){
        var target = $(this).attr('data-target');
        var focus_element = $(this).attr('data-focus');
        $('.'+ target).removeClass('hidden');
        $('.'+ focus_element).focus();
        $(this).remove();
    });

    /** Conform alert. Уверены что хотите сделать это?) */
    $('.please_conform').on('click', function () {
        var href = $(this).attr('href');
        return confirm('Уверены?');
    });
});

/* http://ned.im/noty/#/about */
function noty_show(type, message, container){
    if(container){
        if(type === 'alert'){
            container.noty({
                theme: 'relax',
                layout: 'center',
                text: message,
                type: 'alert',
                modal: true
            })
        }else{
            container.noty({
                theme: 'relax',
                layout: 'topRight',
                text: message,
                type: type,
                timeout: 2500
            })
        }
    }else{
        if(type === 'alert'){
            noty({
                theme: 'relax',
                layout: 'center',
                text: message,
                type: 'alert',
                modal: true
            })
        }else{
            noty({
                theme: 'relax',
                layout: 'topRight',
                text: message,
                type: type,
                timeout: 2500
            })
        }
    }
}

//Ожидание результатов поиска
function GetLoadState(requestId, count) {
    count = parseInt(count);
    if(count > 0){
        $.ajax({
            url: '/sletat/GetLoadState/'+requestId,
            type: 'GET',
            error: function() {
                $('#loadState').addClass('hidden');
                $('.alert-progress').removeClass('alert-warning').addClass('alert-danger').text('Поиск временно не работает. Пожалуйста, зайдите позже');
            },
            success: function(data) {
                if(data === '100'){
                    $('.alert-progress').removeClass('alert-warning').addClass('alert-success').text('Поиск завершен! Обновление результатов');
                    $.ajax({
                        url: '/sletat/GetToursUpdated/'+requestId,
                        type: 'POST',
                        data: $('form#form-searchTourShort').serialize(),
                        error: function() {
                            noty_show('alert', 'Возникла ошибка при обновлении результатов поиска');
                        },
                        success: function(res) {
                            $('.sletatResult').html(res);
                            var today = new Date();
                            var month = today.getMonth()+1;
                            var month_last = today.getMonth()+2;
                            $('input.daterange').daterangepicker({
                                monthSelector: true,
                                yearSelector: true,
                                locale: {
                                    format: 'DD/MM/YYYY',
                                    applyLabel: 'Выбрать'
                                },
                                startDate: today.getDate() +'/'+ month +'/'+ today.getFullYear(),
                                endDate: today.getDate() +'/'+ month_last +'/'+ today.getFullYear(),
                                minDate: today.getDate() +'/'+ month +'/'+ today.getFullYear()
                            });
                        }
                    });
                }else{
                    $('.progress-bar').attr('aria-valuenow', data).attr('style', 'width: '+data+'%;');
                    $('.progress-current').html(data +'%');
                    //Продолжаем ждать результаты
                    setTimeout(function () {
                        GetLoadState(requestId, --count);
                    }, 2000)
                }
            }
        });
    }else{
        $('#loadState').addClass('hidden');
        $('.alert-progress').removeClass('alert-warning').addClass('alert-success').text('Пожалуйста, обновите страницу');
    }
}

function GetLoadStateShort(requestId, count, results) {
    count = parseInt(count);
    if(count > 0){
        $.ajax({
            url: '/sletat/GetLoadState/'+requestId,
            type: 'GET',
            error: function() {
                $('#loadState').addClass('hidden');
                $('.alert-progress').removeClass('alert-warning').addClass('alert-danger').text('Поиск временно не работает. Пожалуйста, зайдите позже');
            },
            success: function(data) {
                if(data === '100'){
                    $('.alert-progress').removeClass('alert-warning').addClass('alert-success').text('Поиск завершен! Обновление результатов');
                    $.ajax({
                        url: '/sletat/GetToursUpdatedShort/'+requestId+'/'+results,
                        type: 'POST',
                        data: {'countryId': $('.sletatResult').attr('data-country-id'), 's_adults': 2},
                        error: function() {
                            noty_show('alert', 'Возникла ошибка при обновлении результатов поиска');
                        },
                        success: function(res) {
                            $('.sletatResult').html(res);
                        }
                    });
                }else{
                    $('.progress-bar').attr('aria-valuenow', data).attr('style', 'width: '+data+'%;');
                    $('.progress-current').html(data +'%');
                    //Продолжаем ждать результаты
                    setTimeout(function () {
                        GetLoadStateShort(requestId, --count, results);
                    }, 2000)
                }
            }
        });
    }else{
        $('#loadState').addClass('hidden');
        $('.alert-progress').removeClass('alert-warning').addClass('alert-success').text('Пожалуйста, обновите страницу');
    }
}