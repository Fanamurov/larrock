$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.nav-tabs').find('li.tabimages').click(function(){
        $('.main-tabbable').find('.tab-pane').removeClass('active');
    });

    $('.nav-tabs').find('li:not(.tabimages)').click(function(){
        $('#tabimages').removeClass('active');
    });

    $('.nav-tabs').find('li.tabfiles').click(function(){
        $('.main-tabbable').find('.tab-pane').removeClass('active');
    });

    $('.nav-tabs').find('li:not(.tabfiles)').click(function(){
        $('#tabfiles').removeClass('active');
    });

    function get_loaded_images(id_connect, type)
    {
        $.ajax({
            data: {id_connect: id_connect, type: type},
            type: "POST",
            dataType: "json",
            url: "/admin/ajax/getLoadedImages",
            success: function (data) {
                load_image_plugin(data);
            }
        });
    }

    get_loaded_images($('input[name=id_connect]').val(), $('input[name=folder]').val());

    function load_image_plugin(uploaded_files)
    {
        var params_list;
        $.each(uploaded_files, function (key, val) {
            //items.push(val);
        });

        /* Image upload http://filer.grandesign.md/#download */
        $('#upload_image_filer').filer({
            changeInput: '<div class="jFiler-input-dragDrop">' +
            '<div class="jFiler-input-inner">' +
            '<div class="jFiler-input-icon"><i class="icon-jfi-cloud-up-o"></i></div>' +
            '<div class="jFiler-input-text"><h3>Перетащите фото сюда</h3> ' +
            '<span style="display:inline-block; margin: 15px 0">или</span></div>' +
            '<a class="jFiler-input-choose-btn blue">Выберите фото из проводника</a></div></div>',
            showThumbs: true,
            theme: "dragdropbox",
            addMore: true,
            files: uploaded_files,
            options: {
                param: ["ttrtr", "242342"]
            },
            templates: {
                box: '<ul class="jFiler-items-list jFiler-items-grid"></ul>',
                item: '<li class="jFiler-item">\
                    <div class="jFiler-item-container">\
                        <div class="jFiler-item-inner">\
                            <div class="jFiler-item-thumb">\
                                <div class="jFiler-item-status"></div>\
                                <div class="jFiler-item-info">\
                                    <span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name | limitTo: 25}}</b></span>\
                                    <span class="jFiler-item-others">{{fi-size2}}</span>\
                                </div>\
                                {{fi-image}}\
                                2{{fi-type}}\
                            </div>\
                            <div class="jFiler-item-assets jFiler-row">\
                                <ul class="list-inline pull-left">\
                                    <li>{{fi-progressBar}}</li>\
                                </ul>\
                                <ul class="list-inline pull-right">\
                                    <li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li>\
                                </ul>\
                            </div>\
                        </div>\
                    </div>\
                </li>',
                itemAppend: '<li class="jFiler-item">\
                        <div class="jFiler-item-container">\
                            <div class="jFiler-item-inner">\
                                <div class="jFiler-item-thumb">\
                                    <div class="jFiler-item-status"></div>\
                                    <div class="jFiler-item-info">\
                                        <span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name | limitTo: 25}}</b></span>\
                                        <span class="jFiler-item-others">{{fi-size2}}</span>\
                                    </div>\
                                    {{fi-image}}\
                                    {{fi-param}}\
                                </div>\
                                <div class="jFiler-item-assets jFiler-row">\
                                    <ul class="list-inline pull-left">\
                                        <li><span class="jFiler-item-others">{{fi-param}}{{fi-icon}}</span></li>\
                                    </ul>\
                                    <ul class="list-inline pull-right">\
                                        <li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li>\
                                    </ul>\
                                </div>\
                            </div>\
                        </div>\
                    </li>',
                progressBar: '<div class="bar"></div>',
                itemAppendToEnd: false,
                removeConfirmation: true,
                _selectors: {
                    list: '.jFiler-items-list',
                    item: '.jFiler-item',
                    progressBar: '.bar',
                    remove: '.jFiler-item-trash-action'
                }
            },
            dragDrop: {
                dragEnter: null,
                dragLeave: null,
                drop: null,
            },
            uploadFile: {
                url: "/admin/ajax/UploadImage",
                data: {
                    folder: $('input[name=folder]').val(),
                    id_connect: $('input[name=id_connect]').val(),
                    param: $('input[name=param]').val(),
                },
                type: 'POST',
                enctype: 'multipart/form-data',
                beforeSend: function(){},
                success: function(data, el){
                    var parent = el.find(".jFiler-jProgressBar").parent();
                    el.find(".jFiler-jProgressBar").fadeOut("slow", function(){
                        $("<div class=\"jFiler-item-others text-success\"><i class=\"icon-jfi-check-circle\"></i> Загружено</div>").hide().appendTo(parent).fadeIn("slow");
                    });
                },
                error: function(el){
                    var parent = el.find(".jFiler-jProgressBar").parent();
                    el.find(".jFiler-jProgressBar").fadeOut("slow", function(){
                        $("<div class=\"jFiler-item-others text-error\"><i class=\"icon-jfi-minus-circle\"></i> Ошибка</div>").hide().appendTo(parent).fadeIn("slow");
                    });
                },
                statusCode: null,
                onProgress: null,
                onComplete: null
            },
            onRemove: function(itemEl, file){
                var file = file.name;
                $.post('./php/remove_file.php', {file: file});
            },
            captions: {
                button: "Choose Files",
                feedback: "Choose files To Upload",
                feedback2: "files were chosen",
                drop: "Drop file here to Upload",
                removeConfirmation: "Are you sure you want to remove this file?",
                errors: {
                    filesLimit: "Only {{fi-limit}} files are allowed to be uploaded.",
                    filesType: "Only Images are allowed to be uploaded.",
                    filesSize: "{{fi-name}} is too large! Please upload file up to {{fi-maxSize}} MB.",
                    filesSizeAll: "Files you've choosed are too large! Please upload files up to {{fi-maxSize}} MB."
                }
            }
        });
    }


    /* End image upload */

    paceOptions = {
        restartOnPushState: true,
        restartOnRequestAfter: true,
        ajax: true
    };

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
        $('.'+ target).removeClass('hidden');
        $(this).remove();
    });

    /** Если присвоить класс change-form селекту в форме, то при клике будет происходить сабмит формы */
    $('select.change-form, input[type=checkbox].change-form').change(function(){
        $(this).parents('form').submit();
    });

    $('input[type=text].change-form').focusout(function(){
        $(this).parents('form').submit();
    });


    /**
     * Метод для выполнения ajax-операций
     * string       @param url              URL для вызова
     * array        @param send_data        Пересылаемые данные /false
     * bool/string  @param good_message     Кастомное сообщение об успехе операции /false
     * object       @param button           объект с кнопкой, на которую нажали /false
     * bool/string  @param redirect_url     Если передан string с адресом страницы, то будет выполнен редирект /false
     * bool         @param clearcache       Если true, то очистит кеш сайта /false
     */
    function hidden_action(url, send_data, good_message, button, redirect_url, clearcache) {
        Pace.restart();
        var request = $.ajax({
            data: send_data,
            type: "POST",
            dataType: "json",
            url: url
        });
        request.done(function (msg) {
            if(msg.status === 'blank'){
                return false;
            }

            if(msg.status === 'error'){
                notify_show('error', msg.message);
                return false;
            }

            if(msg.status === 'success'){
                if ((good_message !== false) && (good_message !== undefined)) {
                    notify_show('success', good_message);
                }else{
                    notify_show('success', msg.message);
                }
            }

            if (clearcache === true) {
                clear_cache();
            }
            if ((button !== false) && (redirect_url !== undefined)) {
                $(button).removeClass('action_button').removeAttr('disabled');
            }
            if ((redirect_url !== false) && (redirect_url !== undefined)) {
                window.location = redirect_url;
            }
            return true;
        });
        request.fail(function (jqXHR, status, statusText) {
            notify_show('error', statusText);
            if ((button !== false) && (redirect_url !== undefined)) {
                $(button).removeClass('action_button').removeAttr('disabled');
            }
            Pace.stop();
            return false;
        });
    }

    /**
     * Уведомления в сплывающих окнах от процессов
     * string @param type  Тип события (good, error)
     * string @param message   Сообщение на вывод
     */
    function notify_show(type, message) {
        // http://ned.im/noty/#installation
        if(type == 'error'){
            noty({
                text: message,
                type: type,
                layout: 'top'
            });
        }else{
            noty({
                text: message,
                type: type,
                layout: 'topRight',
                timeout: 2000
            });
        }
    }

    /** Purge site cache function */
    function clear_cache() {
        hidden_action('/admin/ajax/ClearCache', false, false, false, false, false);
    }
    $('#clear_cache').bind('click', function () {
        clear_cache();
    });



    /** Input для редактирования поля */
    $('.ajax_edit_row').on('focusout', function(){
        var value_where = $(this).attr('data-value_where');
        var row_where = $(this).attr('data-row_where');
        var value = $(this).val();
        var row = $(this).attr('name');
        var table = $(this).attr('data-table');
        var event = 'edit';
        var data = { value_where: value_where, row_where: row_where, value: value, row: row, event: event, table: table };
        //hidden_action(url, send_data, good_message, button, redirect_url, clearcache)
        hidden_action('/admin/ajax/EditRow', data, false, false, false, true);
    });

    $('.btn-group_switch_ajax').find('button').click(function(){
        $(this).parent().find('button').toggleClass('btn-outline');
        var value_where = $(this).attr('data-value_where');
        var row_where = $(this).attr('data-row_where');
        var value = $(this).attr('data-value');
        var row = $(this).attr('data-row');
        var table = $(this).attr('data-table');
        var data = { value_where: value_where, row_where: row_where, value: value, row: row, table: table };
        //hidden_action(url, send_data, good_message, button, redirect_url, clearcache)
        hidden_action('/admin/ajax/EditRow', data, false, false, false, true);
    });


    /** Conform alert. Уверены что хотите сделать это?) */
    $('.please_conform, .btn-danger').on('click', function () {
        var href = $(this).attr('href');
        return confirm('Уверены?');
    });

    /**
     * Создание URL для страниц
     * @reference function change_url
     */
    $('input[name=title]').focusout(function(){
        var title = $(this).val();
        var form = $(this).closest('form');
        var url_input = $(form).find('input[name=url]').val();
        if(url_input !== undefined){
            if(url_input.length < 1){
                var table = $(this).attr('data-table');
                change_url(title, table, form);
            }
        }
    });
    $('.refresh-url').click(function () {
        var input = $('input[name=title]');
        var title = input.val();
        var form = $(this).closest('form');
        var table = input.attr('data-table');
        change_url(title, table, form);
    });

    /**
     * Создание url для страницы и вставка значения в input[name=url]
     * string @param title  Текст для транслитерации (обычно input[name=title])
     * string @param table  Имя таблицы для проверки уникальности url (опционально, можно передать пустое значение)
     * string @param form   Форма в которой проводятся операции
     */
    function change_url(title, table, form){
        $.ajax({
            type: "POST",
            data: { words: title, table: table},
            dataType: 'json',
            url: "/admin/ajax/translit",
            success: function (data) {
                var url_input = $(form).find('input[name=url]');
                if (data.good) {
                    url_input.val(data.good);
                    notify_show('info', 'Материалу будет присвоен url: '+data.good);
                    valid_forms();
                }else{
                    url_input.val(data.error);
                    notify_show('info', 'Материалу присвоен url: '+data.error +' с солью');
                    valid_forms();
                }
            }
        });
    }

    /**
     * По нажатию на кнопку .new_list будет создан input с name= data-row-name кнопки
     * Позволяет вносить в списки кастомные значения
     * */
    $('.new_list').click(function () {
        $(this).hide();
        var row_name = $(this).attr('data-row-name');
        $('select[name='+row_name+']').before('<input class="form-control" placeholder="Новое значение" type="text" name="' + row_name + '" value="">').remove();
    });
    $('.new_list_multiply').click(function () {
        $(this).hide();
        var row_name = $(this).attr('data-row-name');
        $('select[id=r-row-'+row_name+']').before('<input class="form-control" placeholder="Новые значения через ;" type="text" name="' + row_name + '_new_list" value="">');
        //$('#r_row_'+row_name+'_chosen').remove();
    });

    /* TODO: wtf Создание полей на лету */
    $('.new_rows').click(function () {
        $(this).hide();
        var exploded_row_name = $(this).attr('data-row-name').split(',');
        var row_name_placeholder = $(this).attr('data-row-placeholder').split(',');
        var items = [];
        var count = 0;
        $(this).prev().remove();
        $.each(exploded_row_name, function () {
            items.push('<input class="form-control" placeholder="' + row_name_placeholder[count] + '" type="text" name="' + this + '" value="">');
            count++;
        });
        $(this).before(items.join(''));
    });

    /** Выделить все чекбоксы для кнопки удалить все  */
    $('input[name=checked_all]:not(.checked)').click(function () {
        $(this).addClass('checked');
        $('input[name^=delete]:visible').attr('checked', 'checked');
    });
});