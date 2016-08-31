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

    $('.btn-group-sorters').find('button').click(function () {
        var sort = $(this).attr('data-sort');
        $('input[name=sort]').val(sort);
        $('form#form-filter-category').submit();
    });

    $('li.first-level').removeClass('show_menu-please');
    $('li.first-level').hover(function () {
        $(this).toggleClass('show_menu-please');
    });
    
    $('.button_bg-disabled').hover(function () {
        //$('.attributes-config').addClass('please-select');
        //alert('2');
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
                        $('.btn-add-to-cart-fast').attr('disabled', 'disabled');
                        $('.button_bg').addClass('button_bg-disabled');
                        noty_show('error', 'Извините, такого товара нет в наличии');
                    }
                    if(res.status === 'NotFound'){
                        $('.btn-add-to-cart').attr('disabled', 'disabled');
                        $('.btn-add-to-cart-fast').attr('disabled', 'disabled');
                        $('.button_bg').addClass('button_bg-disabled');
                        noty_show('error', 'Ошибка при выборе товара');
                    }
                    if(res.status === 'Update'){
                        $('.btn-add-to-cart').removeAttr('disabled');
                        $('.btn-add-to-cart-fast').removeAttr('disabled');
                        $('.attributes-config').removeClass('please-select');
                        $('.button_bg').removeClass('button_bg-disabled');
                        $('input[name=config_current]').val(res.data.config_current);
                        $('.pricePromo-item').html(res.data.promoPrice); //А что если скидки нет?
                        $('.price-item').html(res.data.Price);
                        $('.quantity-item').html(res.data.Quantity);
                        update_ToCartButton();
                        $('.btn-add-to-cart').attr('data-price', res.data.Price);
                        $('.btn-add-to-cart-fast').attr('data-price', res.data.Price);
                    }
                }
            });
        }else{
            //$('.attributes-config').addClass('please-select');
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

    $('.item-catalog').matchHeight();
    $('.CategoryInfoList-item').matchHeight();
    $('.filter-item').matchHeight();

    $('.show_menu').click(
        function(){
            $('.menu_hidden').toggleClass('hidden');
            $('.close_menu').toggleClass('hidden')
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
                //alert($(this).attr('data-action'));
                if($(this).attr('data-action') === 'to_cart'){
                    window.location.href = '/cart';
                }
                $('.btn-add-to-cart').hide('slow');
                $('.btn-to-cart-link').removeClass('hidden');
                noty_show('success', 'Товар добавлен в корзину');
            }
        });
    });
    $('.btn-add-to-cart-fast').click(function(){
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
                window.location.href = '/cart';
                $('.btn-add-to-cart').hide('slow');
                $('.btn-to-cart-link').removeClass('hidden');
                noty_show('success', 'Товар добавлен в корзину');
            }
        });
    });

    $('*[data-toggle=tooltip]').tooltip();

    /*
     * Универсальный обработчик для выделения блока как ссылки
     * Ищет внутри блока ссылку и присваивает ее всему блоку
     */
    $('.link_block').click(function(){window.location = $(this).find('a').attr('href');});
    $('.link_block_this').click(function(){window.location = $(this).attr('data-href');});
    $('.link_block_this-blank').click(function(){window.open($(this).attr('data-href'), '_blank');});

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

    $('#ModalToCart-form').find('.input-group-qty').spinner('changing', function(e, newVal, oldVal) {
        var rowid = $(this).attr('data-rowid');
        var qty = newVal;
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

function rebuild_cost() {
    $("#modal-spinner")
        .spinner('changing', function(e, newVal, oldVal) {
            var cost = parseFloat($('#ModalToCart-form').find('.cost').attr('data-cost'));
            $('#ModalToCart-form').find('.cost').html(cost*newVal);
        });

    $(".spinner-qty")
        .spinner('changing', function(e, newVal, oldVal) {
            var qty = newVal;
            var cost = parseFloat($(this).attr('data-cost'));
            var rowid = $(this).attr('data-rowid');
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
                        $('.total_cart').html(res.total);
                        $('tr[data-rowid='+ rowid +']').find('.subtotal span').html(res.subtotal);
                        //noty_show('success', 'Кол-во изменено');
                    }
                });
            }
        });

    $('#ModalToCart-form').find('input[name=kolvo]').keyup(function () {
        var cost = parseFloat($('#ModalToCart-form').find('.cost').attr('data-cost'));
        var kolvo = parseInt($(this).val());
        $('#ModalToCart-form').find('.cost').html(cost*kolvo);
    })
}