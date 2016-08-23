$(document).ready(function(){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(".fancybox").fancybox({
        helpers	: {
            thumbs	: {
                width	: 50,
                height	: 50
            }
        }
    });

    $('li.first-level').hover(
        function () {
            $('li.first-level').removeClass('current');
            $('.list-parent').hide();
            var id_menu = $(this).addClass('current').attr('data-id');
            $('.list-parent-'+id_menu).show();

            $('.list-parent-'+id_menu).hover(
                function () {
                    //$(this).hide();
                },
                function () {
                    $(this).hide();
                    $('li.first-level').removeClass('current');
                }
            )
        }
    );
    
    $('.btn-add-to-cart:disabled').hover(function () {
        $('.attributes-config').addClass('please-select');
    });
    
    $('.change-config-item').click(function () {
        $('.change-config-item-'+$(this).attr('data-pid')).removeClass('active');
        $(this).addClass('active');

        var Vid = $(this).attr('data-vid');
        var Pid = $(this).attr('data-pid');
        $('input#config-'+Pid).val(Vid);

        var all_complete = true;
        $('.current_config').each(function () {
            if ($(this).val() === ''){
                all_complete = false;
            }
        });
        if(all_complete === true){
            $('.btn-add-to-cart').removeAttr('disabled');
            $('.attributes-config').removeClass('please-select');

            $.ajax({
                url: '/otapi/getConfigItem',
                type: 'POST',
                dataType: 'json',
                data: $('form#ItemConfig').serialize(),
                error: function() {
                    alert('ERROR!');
                },
                success: function(res) {
                    if(res.status === 'QuantityZero'){
                        $('.btn-add-to-cart').attr('disabled', 'disabled');
                        noty_show('error', 'Извините, такого товара нет в наличии');
                    }
                    if(res.status === 'NotFound'){
                        $('.btn-add-to-cart').attr('disabled', 'disabled');
                        noty_show('error', 'Ошибка при выборе товара');
                    }
                    if(res.status === 'Update'){
                        $('.btn-add-to-cart').removeAttr('disabled');
                        $('input[name=config_current]').val(res.data.config_current);
                        $('.pricePromo-item').html(res.data.promoPrice); //А что если скидки нет?
                        $('.price-item').html(res.data.Price);
                        $('.quantity-item').html(res.data.Quantity);
                        update_ToCartButton();
                    }
                }
            });

        }else{
            $('.attributes-config').addClass('please-select');
        }
    });

    function update_ToCartButton() {
        var title = '';
        var src = '';
        $('.change-config-item.active').each(function () {
            title += $(this).attr('data-originalName');
            if($(this).attr('data-scr') !== undefined){
                src = $(this).attr('data-scr');
            }
        });
        //var title = $(this).attr('data-originalName');
        $('.btn-add-to-cart').attr('data-config', title);
        $('.btn-add-to-cart').attr('data-src', src);
    }
    
    $('.change-bigImageItem').click(function () {
        var src = $(this).attr('data-scr');
        $('.bigImageItem').attr('href', src);
        $('.bigImageItem').find('img').attr('src', src);
    });

    $('.filter-category').change(function () {
        $('#form-filter-category').submit();
    });

    $('.item-catalog').matchHeight();
    $('.CategoryInfoList-item').matchHeight();
    $('.filter-item').matchHeight();

    $('.show_menu').click(
        function(){
            $('.menu_hidden').toggleClass('hidden');
        }
    );

    $('.btn-add-to-cart').click(function(){
        $.ajax({
            url: '/otapi/AddToCart',
            type: 'POST',
            data: {
                id: $(this).attr('data-id'),
                name: $(this).attr('data-name'),
                price: $(this).attr('data-price'),
                config: $(this).attr('data-config'),
                img: $(this).attr('data-src')
            },
            error: function() {
                alert('ERROR!');
            },
            success: function(res) {
                //TODO: Обновление модуля при "Корзина пуста"
                $('.total_cart').html(res);
                $('.btn-add-to-cart').hide('slow');
                $('.btn-to-cart-link').removeClass('hidden');
            }
        });
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

    $('input[name=date], input.date').pickadate({
        monthSelector: true,
        yearSelector: true,
        formatSubmit: 'yyyy-mm-dd',
        firstDay: 1,
        monthsFull: [ 'Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь' ],
        weekdaysShort: [ 'Вск', 'Пон', 'Вт', 'Ср', 'Чт', 'Пт', 'Суб' ],
        format: 'yyyy-mm-dd'
    });

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
        var modalCart = $('#ModalToCart');
        $.ajax({
            url: '/ajax/getTovar',
            type: 'POST',
            dataType: 'json',
            data: {
                id: $(this).attr('data-id')
            },
            error: function() {
                alert('ERROR!');
            },
            success: function(res) {
                //Вызов всплывающего окна для добавления товара
                modalCart.find('.item-title').html(res.title);
                modalCart.find('.item-description').html(res.description);
                if(typeof(res.get_images[0]) !== "undefined"){
                    modalCart.find('.item-photo').attr('src', '/images/catalog/140-140/'+ res.get_images[0]['name']);
                }else{
                    modalCart.find('.item-photo').attr('src', '/_assets/_front/_images/empty_big.png');
                }
                modalCart.find('.submit_to_cart').attr('data-id', res.id);
                modalCart.modal('show');
            }
        });
        return false;
    });

    $('.submit_to_cart').click(function(){
        var action = $(this).attr('data-link');
        $.ajax({
            url: '/ajax/cartAdd',
            type: 'POST',
            data: {
                id: $(this).attr('data-id')
            },
            error: function() {
                alert('ERROR!');
            },
            success: function(res) {
                //TODO: Обновление модуля при "Корзина пуста"
                $('.total_cart').html(res);
            }
        });
        if(action === '/cart'){
            window.location.href = '/cart';
        }else{
            $('#ModalToCart').modal('hide');
        }
    });

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
                    timeout: 1500
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
                    timeout: 1500
                })
            }
        }
    }
});