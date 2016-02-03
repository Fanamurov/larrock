$(document).ready(function(){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
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
                if(typeof(res.get_images[0]) !== 'undefined'){
                    modalCart.find('.item-photo').attr('src', res.get_images[0]['title']);
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