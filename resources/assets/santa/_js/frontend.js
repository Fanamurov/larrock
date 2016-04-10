$(document).ready(function(){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.toursBlockCategory').matchHeight();
    $('.toursBlockTour').matchHeight();

    $(".fancybox").fancybox({
        helpers	: {
            thumbs	: {
                width	: 50,
                height	: 50
            }
        }
    });

    
    /* http://maxoffsky.com/code-blog/laravel-shop-tutorial-3-implementing-smart-search/ */
    /* https://github.com/selectize/selectize.js/blob/master/docs/usage.md */
    $('select#searchCatalog').selectize({
        valueField: 'url',
        labelField: 'title',
        searchField: ['title'],
        maxOptions: 10,
        options: [],
        create: false,
        optgroups: [
            {value: 'product', label: 'Products'},
            {value: 'category', label: 'Categories'}
        ],
        optgroupField: 'class_element',
        optgroupOrder: ['product','category'],
        render: {
            option: function(item, escape) {
                return '<div class="seach">' +escape(item.title)+'</div>';
            }
        },
        load: function(query, callback) {
            if (!query.length) return callback();
            $.ajax({
                url: root+'/search/catalog',
                type: 'GET',
                dataType: 'json',
                data: {
                    q: query
                },
                error: function() {
                    callback();
                },
                success: function(res) {
                    callback(res);
                }
            });
        },
        onChange: function(){
            window.location = this.items[0];
        }
    });

    //$('.typeahead').typeahead();
    $('*[data-toggle=tooltip]').tooltip();

    $('input[name=date], input.date, input[type=date]').pickadate({
        monthSelector: true,
        yearSelector: true,
        formatSubmit: 'yyyy-mm-dd',
        firstDay: 1,
        monthsFull: [ 'Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь' ],
        weekdaysShort: [ 'Вск', 'Пон', 'Вт', 'Ср', 'Чт', 'Пт', 'Суб' ],
        format: 'yyyy-mm-dd'
    });

    var today = new Date();
    $('input.daterange').daterangepicker({
        locale: {
            format: 'DD/MM/YYYY'
        },
        startDate: today.getDate() +'/'+ today.getMonth() +'/'+ today.getFullYear()
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

    $('.change_limit:not(.active)').click(function(){
        $.ajax({
            url: '/ajax/editPerPage',
            type: 'POST',
            data: {
                q: $(this).attr('data-value')
            },
            error: function() {
                alert('ERROR!');
            },
            success: function() {
                location.reload();
            }
        })
    });

    $('.change_sort_cost:not(.active)').click(function(){
        $.ajax({
            url: '/ajax/sort',
            type: 'POST',
            data: {
                q: $(this).attr('data-value'),
                type: $(this).attr('data-type')
            },
            error: function() {
                alert('ERROR!');
            },
            success: function() {
                location.reload();
            }
        })
    });

    $('.change_catalog_template:not(.active)').click(function(){
        $.ajax({
            url: '/ajax/vid',
            type: 'POST',
            data: {
                q: $(this).attr('data-value')
            },
            error: function() {
                alert('ERROR!');
            },
            success: function() {
                location.reload();
            }
        })
    });

    /* Cart */
    $('.add_to_cart').click(function(){
        $('#ModalToCart').remove();
        $.ajax({
            url: '/ajax/getTovar',
            type: 'POST',
            dataType: 'html',
            data: {
                id: $(this).attr('data-id'),
                in_template: 'true'
            },
            error: function() {
                alert('ERROR!');
            },
            success: function(res) {
                $('#content').after(res);
                $('#ModalToCart').modal('show');
            }
        });
        return false;
    });

    submit_to_cart();

    $('.removeCartItem').click(function(){
        var rowid = $(this).attr('data-rowid');
        $.ajax({
            url: '/ajax/cartRemove',
            type: 'POST',
            data: {
                rowid: rowid
            },
            error: function() {
                alert('ERROR!');
            },
            success: function(res) {
                if(res < 1){
                    location.reload();
                }else{
                    $('tr[data-rowid='+ rowid +']').remove();
                    $('.total').html(res);
                }
            }
        });
    });

    $('.editQty').change(function(){
        var rowid = $(this).attr('data-rowid');
        var qty = $(this).val();
        if(qty > 0){
            $.ajax({
                url: '/ajax/cartQty',
                type: 'POST',
                dataType: 'json',
                data: {
                    rowid: rowid,
                    qty: qty
                },
                error: function() {
                    noty_show('alert', 'Кол-во не изменено');
                },
                success: function(res) {
                    $('.total').html(res.total);
                    $('tr[data-rowid='+ rowid +']').find('.subtotal span').html(res.subtotal);
                    noty_show('success', 'Кол-во изменено');
                }
            });
        }
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

function submit_to_cart() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('.submit_to_cart').click(function () {
        var action = $(this).attr('data-link');
        $.ajax({
            url: '/ajax/cartAdd',
            type: 'POST',
            data: {
                id: parseInt($(this).attr('data-id')),
                qty: parseInt($('#kolvo-'+ $(this).attr('data-id')).val())
            },
            error: function() {
                noty_show('alert', 'Возникла ошибка при добавлении товара в корзину');
            },
            success: function(res) {
                //TODO: Обновление модуля при "Корзина пуста"
                $('.total_cart').html(res);
                noty_show('message', 'Товар добавлен к корзину');
                if(action === '/cart'){
                    window.location.href = '/cart';
                }else{
                    $('#ModalToCart').modal('hide');
                }
            }
        });
    });
}

function valid_modal_cart(min_kolvo) {
    $("#ModalToCart-form").validate({
        rules: {
            kolvo: {
                required: true,
                min: parseInt(min_kolvo)
            }
        },
        messages: {
            kolvo: {
                min: "Минимальная партия для заказа "+ min_kolvo
            }
        }
    });
}