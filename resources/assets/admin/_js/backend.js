$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    paceOptions = {
        restartOnPushState: true,
        restartOnRequestAfter: true,
        ajax: true
    };

    //$('.typeahead').typeahead();
    $('*[data-toggle=tooltip]').tooltip();
    $('input[type=file]').bootstrapFileInput();

    $('input[name=date], input.date').pickadate({
        monthSelector: true,
        yearSelector: true,
        formatSubmit: 'yyyy-mm-dd',
        firstDay: 1,
        monthsFull: [ 'Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь' ],
        weekdaysShort: [ 'Вск', 'Пон', 'Вт', 'Ср', 'Чт', 'Пт', 'Суб' ],
        format: 'yyyy-mm-dd'
    });

    var config = {
        '.chosen-select'           : {},
        '.chosen-select-deselect'  : {allow_single_deselect:true},
        '.chosen-select-no-single' : {disable_search_threshold:10},
        '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
        '.chosen-select-width'     : {width:"95%"}
    };
    for (var selector in config) {
        $(selector).chosen(config[selector]);
    }

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

    /** Автоподсказчик для поиска разделов */
    function typehead_category() {
        $('#typehead_category').attr('disabled', 'disabled').attr('placeholder', 'Подгрузка списка разделов');
        $.getJSON("/ajax/fastsearch/1/true", function () {})
            .done(function (data) {
                var items = [];
                $.each(data, function (key, val) {
                    items.push(val);
                });
                $('#typehead_category').removeAttr('disabled').attr('placeholder', 'Автоподсказчик разделов').typeahead({
                    source: items,
                    updater: function (obj) {
                        /* Для тех.описаний в каталоге */
                        var select_contains = $("select[name=connect] :contains(" + obj + ")");
                        $('select[name=connect] option:selected').each(function () {
                            this.selected = false;
                            $(this).removeAttr('selected');
                            $("select[name=connect]").val('212');
                        });
                        if (select_contains.is(':disabled') == false) {
                            select_contains.attr("selected", "selected");
                        }
                        else {
                            notify_show('error', 'Раздел не доступен для выбора');
                        }

                        /* Для обычных разделов */
                        $('select[name=catagory] option:selected').each(function () {
                            this.selected = false;
                            $(this).removeAttr('selected');
                            $("select[name=catagory]").val('212');
                        });
                        if (select_contains.is(':disabled') == false) {
                            select_contains.attr("selected", "selected");
                        }
                        else {
                            notify_show('error', 'Раздел не доступен для выбора');
                        }
                    }
                });
            })
            .fail(function () {
                console.log("error: Автоподсказчик не работает");
                $('#typehead_category').attr('placeholder', 'Автоподсказчик не работает');
            })
    }
    $('#typehead_category').on('click', function(){
        typehead_category();
    });

    /** Автоподсказчик для поиска контента */
    function typehead_content(){
        var table = $('#typehead_content').attr('data-table');
        var row = $('#typehead_content').attr('data-row');
        $.getJSON("/ajax/fastsearchContent/"+table+"/"+row, function () {})
            .done(function (data) {
                var items = [];
                $.each(data, function (key, val) {
                    items.push(val);
                });
                $('#typehead_content').removeAttr('disabled').attr('placeholder', 'Автоподсказчик заголовков').typeahead({
                    source: items,
                    updater: function (obj) {
                        window.location = '/admin/'+table+'/?search_word='+obj+'&search_row='+ row +'&search_table='+ table;
                    }
                });
            })
            .fail(function () {
                console.log("error: Автоподсказчик не работает");
                $('#typehead_content').attr('placeholder', 'Автоподсказчик не работает');
            })
    }
    $('#typehead_content').one('click', function(){
        typehead_content();
    });

    /** Автоподсказчик в модуле списка материалов */
    function typehead_module_list_search(){
        var element = $('#typehead_module_list_search');
        var table = element.attr('data-table');
        var row = element.attr('data-row');
        var app = element.attr('data-app');
        $.getJSON("/ajax/fastsearchContent/"+table+"/"+row+"", function () {})
            .done(function (data) {
                var items = [];
                $.each(data, function (key, val) {
                    items.push(val);
                });
                $('#typehead_module_list_search').removeAttr('disabled').attr('placeholder', 'Автоподсказчик заголовков').typeahead({
                    source: items,
                    updater: function (obj) {
                        $.getJSON("/ajax/getData/"+table+"/"+obj+"/id/"+row+"", function () {})
                            .done(function (result) {
                                $('#module_list_search_result').removeClass('hidden');
                                var items_result = [];
                                $.each(result, function (key_result, val_result) {
                                    items_result.push(val_result);
                                    $('#module_list_search_result').find('li')
                                        .after('<li><a href="/admin/'+app+'/edit?id='+val_result+'">'+obj+'</a> <small class="muted">/admin/'+app+'/edit?id='+val_result+'</small></li>');
                                });
                            });
                    }
                });
            })
            .fail(function () {
                console.log("error: Автоподсказчик не работает");
                $('#typehead_content').attr('placeholder', 'Автоподсказчик не работает');
            })
    }

    $('#typehead_module_list_search').one('click', function(){
        typehead_module_list_search();
    });

    /** Если присвоить класс change-form селекту в форме, то при клике будет происходить сабмит формы */
    $('select.change-form, input[type=checkbox].change-form').change(function(){
        $(this).parents('form').submit();
    });

    $('input[type=text].change-form').focusout(function(){
        $(this).parents('form').submit();
    });

    /** Пропуск определенных полей в визарде */
    $('.not-import').click(function () {
        $(this).parents('tr').slideUp('slow').html('');
        var row = $(this).attr('data-row');
        $('tr[data-row=' + row + ']').slideUp('slow').html('');
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



    /* ---  Прошло проверку  ---*/

    /** Удаление контента */
    $('.delete_data').on('click', function () {
        var row = $(this).parents('tr');
        var id = $(this).attr('data-id');
        var table = $(this).attr('data-table');
        var app = $(this).attr('data-app');
        var send_data = { id: id, table: table, app: app};
        if (confirm('Точно удалить?')) {
            //hidden_action(url, send_data, good_message, button, redirect_url, clearcache)
            hidden_action('/admin/ajax/delete', send_data, 'Успешно удалено', false, false, true);
            row.fadeOut('slow').next('tr.edit_tr').fadeOut('slow');
            $('tr[data-id='+id+']').fadeOut();
        }
    });

    /** Изменение веса контента */
    $('td.edit_position_new').find('input').on('focusout', function () {
        var value_where = $(this).parent().attr('data-id');
        var row_where = 'id';
        var value = $(this).val();
        var row = 'position';
        var table = $(this).parent().attr('data-table');
        var event = 'edit';
        var data = { value_where: value_where, row_where: row_where, value: value, row: row, event: event, table: table };
        //hidden_action(url, send_data, good_message, button, redirect_url, clearcache)
        hidden_action('/admin/ajax/changeRow', data, 'Вес изменен', false, false, true);
    });

    /** Изменение веса контента ONLY ASIABUS */
    $('td.edit_position_index').find('input').on('focusout', function () {
        var value_where = $(this).attr('data-id');
        var table       = $(this).attr('data-table');
        var row_where   = 'id';
        var value       = $(this).val();
        var row         = 'position_index';
        var event       = 'edit';
        var data        = { value_where: value_where, row_where: row_where, value: value, row: row, event: event, table: table };
        //hidden_action(url, send_data, good_message, button, redirect_url, clearcache)
        hidden_action('/admin/ajax/changeRow', data, 'Вес изменен', false, false, true);
    });

    $('.image_position').focusout(function () {
        var value_where = $(this).attr('data-id');
        var row_where = 'id';
        var value = $(this).val();
        var row = 'position';
        var table = 'images';
        var event = 'edit';
        var data = { value_where: value_where, row_where: row_where, value: value, row: row, event: event, table: table };
        //hidden_action(url, send_data, good_message, button, redirect_url, clearcache)
        hidden_action('/admin/ajax/changeRow', data, 'Вес изменен', false, false, false);
    });

    /** Изменение описания картинки */
    $('.image_description').focusout(function () {
        var value_where = $(this).attr('data-id');
        var row_where = 'id';
        var value = $(this).val();
        var row = 'description';
        var table = 'images';
        var event = 'edit';
        var data = { value_where: value_where, row_where: row_where, value: value, row: row, event: event, table: table };
        //hidden_action(url, send_data, good_message, button, redirect_url, clearcache)
        hidden_action('/admin/ajax/changeRow', data, 'Описание картинки изменено', false, false, false);
    });

    /** Изменение группы картинки */
    $('.image_group').focusout(function () {
        var value_where = $(this).attr('data-id');
        var row_where = 'id';
        var value = $(this).val();
        var row = 'param';
        var table = 'images';
        var event = 'edit';
        var data = { value_where: value_where, row_where: row_where, value: value, row: row, event: event, table: table };
        //hidden_action(url, send_data, good_message, button, redirect_url, clearcache)
        hidden_action('/admin/ajax/changeRow', data, 'Группа картинки изменена', false, false, false);
    });

    /** Песборка sitemap */
    $('.generate_sitemap').click(function () {
        var data = { showStatus: true };
        //hidden_action(url, send_data, good_message, button, redirect_url, clearcache)
        hidden_action('/admin/ajax/sitemapUpdate', data, 'Sitemap перезаписан', false, false, false);
    });

    /** WIZARD :: Переразбор xls в csv */
    $('.reload-csv').click(function () {
        //hidden_action(url, send_data, good_message, button, redirect_url, clearcache)
        clear_cache();
        hidden_action('/phpExcelReader/exportXLS.php', false, 'Прайс успешно разобран. Обновляем страницу', false, '/admin/wizard/step1', true);
    });

    /** Удаление документа */
    $('.delete').click(function () {
        if (confirm('Точно удалить?')) {
            var id = this.id;
            var table = $(this).parent().find('input[name=table]').val();
            var data = {id: id, table: table };
            //hidden_action(url, send_data, good_message, button, redirect_url, clearcache)
            hidden_action('/admin/ajax/delete', data, 'Удалено', false, false, true);
            $(this).parent().parent().hide('slow');
            $(this).parent().parent().next('tr.edit_tr').html();
        }
    });

    /** WIZARD :: Изменение сопоставления поля импорта */
    $('select.csv_row').change(function () {
        var label = $(this).parent().parent().find('.label-important').hide('slow');
        var id = $(this).attr('data-id');
        var csv_row = $(this).val();
        var data = {id: id, csv_row: csv_row };
        //hidden_action(url, send_data, good_message, button, redirect_url, clearcache)
        hidden_action('/admin/ajax/importChangeConfig', data, 'Сопоставление изменено', false, false, true);
    });

    /** WIZARD :: Изменение типа вывода поля в админке */
    $('input[name=lang], .changeconfigrow').change(function () {
        var config_key = $(this).attr('data-config_key');
        var lang = $(this).parent().parent().find('input.lang').val();
        var type_row = $(this).parent().parent().find('select.type_row').val();
        var filters = $(this).parent().parent().find('select.filters').val();
        var template_output = $(this).parent().parent().find('select.template_output').val();
        var parser = $(this).parent().parent().find('select.parser').val();
        var category_synch = false;
        if ($(this).parent().parent().find('input.category_synch').is(":checked")) {
            category_synch = $(this).parent().parent().find('input.category_synch').val();
        }

        var data = {config_key: config_key, type_row: type_row, filters: filters, template_output: template_output, lang: lang, parser: parser, category_synch: category_synch};
        //hidden_action(url, send_data, good_message, button, redirect_url, clearcache)
        hidden_action('/admin/ajax/changerowconfig', data, 'Конфиг полей изменен', false, false, true);
    });


    /** Удаление загруженной картинки */
    $('.delete_image').on('click', function () {
        if (confirm('Точно удалить из материала?')) {
            var clear = 'false';
            if (confirm('Удалить с сервера?')) {
                clear = 'true';
            }
            var id = $(this).attr('data-imageid');
            var table = $(this).attr('data-table');
            var name = $(this).attr('alt');
            var id_content = $(this).attr('data-id_content');
            var row = $(this).parent().parent();
            var row_desc = $(row).next('.uploaded_image_desc');
            var data = {id: id, clear: clear, table: table, id_content: id_content, name: name};
            //hidden_action(url, send_data, good_message, button, redirect_url, clearcache)
            hidden_action('/admin/ajax/deletePicture', data, 'Фото удалено', false, false, true);

            $(row).fadeOut('slow');
            $(row).parents('.upload_images_trumbs_item').fadeOut('slow');
            $(row).parents('.upload_images_trumbs_item').next().next().fadeOut('slow');
            $(row_desc).fadeOut('slow');
        }
    });

    $('.fileUpload').liteUploader({
        script: '/admin/ajax/uploadFile',
        rules: {
            //allowedFileTypes: 'image/jpeg,image/png,image/gif',
            maxSize: 250000
        }
    })
    .on('lu:errors', function (e, errors) {
        var isErrors = false;
        $('#display').html('');
        $.each(errors, function (i, error) {
            if (error.errors.length > 0) {
                isErrors = true;
                $.each(error.errors, function (i, errorInfo) {
                    $('#display').append('<br />ERROR! File: ' + error.name + ' - Info: ' + JSON.stringify(errorInfo));
                    //notify_show('error', 'Файл не загружен '+ errorInfo);
                });
            }
        });
    })
    .on('lu:before', function (e, files) {
        $('#display').append('<br />Uploading ' + files.length + ' file(s)...');
    })
    .on('lu:progress', function (e, percentage) {
        console.log(percentage);
    })
    .on('lu:cancelled', function () {
        alert('upload aborted!')
    })
    .on('lu:success', function (e, response) {
        var response = $.parseJSON(response);
        $('#previews').html('');
        $.each(response.urls, function(i, url) {
            notify_show('success', 'Файл '+ url +' загружен');
        });
        //$('#display').append(response.message);

        var form = $('.fileUpload');
        var id_connect = form.attr('data-id_connect');
        var type = form.attr('data-type');
        var request = $.ajax({
            data: {id_connect: id_connect, type: type},
            type: "POST",
            dataType: "html",
            url: '/admin/ajax/uploadFileShow'
        });
        request.done(function (msg) {
            $('#file-uploader').html(msg);
            notify_show('success', 'Все загрузки завершены');
            addTriggerFile();
        });
    });

    /** Метод для связывания данных загруженных по ajax(загрузка файлов) и событий на изменения данных о них */
    function addTriggerFile(){
        /** Изменение группы файла */
        $('.file_group').focusout(function () {
            var value_where = $(this).attr('data-id');
            var row_where = 'id';
            var value = $(this).val();
            var row = 'param';
            var table = 'files';
            var event = 'edit';
            var data = { value_where: value_where, row_where: row_where, value: value, row: row, event: event, table: table };
            //hidden_action(url, send_data, good_message, button, redirect_url, clearcache)
            hidden_action('/admin/ajax/changeRow', data, 'Группа файла изменена', false, false, false);
        });

        /** Изменение описания файла */
        $('.file_description').focusout(function () {
            var value_where = $(this).attr('data-id');
            var row_where = 'id';
            var value = $(this).val();
            var row = 'description';
            var table = 'files';
            var event = 'edit';
            var data = { value_where: value_where, row_where: row_where, value: value, row: row, event: event, table: table };
            //hidden_action(url, send_data, good_message, button, redirect_url, clearcache)
            hidden_action('/admin/ajax/changeRow', data, 'Описание файла изменена', false, false, false);
        });

        /** Изменение описания файла */
        $('.file_photo').focusout(function () {
            var value_where = $(this).attr('data-id');
            var row_where = 'id';
            var value = $(this).val();
            var row = 'param_photo';
            var table = 'files';
            var event = 'edit';
            var data = { value_where: value_where, row_where: row_where, value: value, row: row, event: event, table: table };
            //hidden_action(url, send_data, good_message, button, redirect_url, clearcache)
            hidden_action('/admin/ajax/changeRow', data, 'Прикрепленное фото изменено', false, false, false);
        });

        /** Изменение веса файла */
        $('.file_position').focusout(function () {
            var value_where = $(this).attr('data-id');
            var row_where = 'id';
            var value = $(this).val();
            var row = 'position';
            var table = 'files';
            var event = 'edit';
            var data = { value_where: value_where, row_where: row_where, value: value, row: row, event: event, table: table };
            //hidden_action(url, send_data, good_message, button, redirect_url, clearcache)
            hidden_action('/admin/ajax/changeRow', data, 'Вес файла изменен', false, false, false);
        });

        /** Удаление загруженного файла */
        $('.remove_file').on('click', function () {
            var clear = 'false';
            if (confirm('Удалить с сервера?')) {
                clear = 'true';
            }
            var id = $(this).attr('data-id');
            var type = $(this).attr('data-type');
            var folder = $(this).attr('data-folder');
            var filename = $(this).attr('data-filename');
            var id_content = $(this).attr('data-id_content');
            var row = $(this).parents('tr');
            var data = {id: id, clear: clear, type: type, filename: filename, id_content: id_content, folder: folder};
            //hidden_action(url, send_data, good_message, button, redirect_url, clearcache)
            hidden_action('/admin/ajax/deleteFile', data, 'Успешно удалено', false, false, true);
            $(row).fadeOut('slow');
        });
    }
    addTriggerFile();



    /** Alert Подтверждение удаления */
    $('.conform').click(function () {
        if (confirm('Точно удалить?')) {
            window.location = $(this).attr('data-event');
        }else{
            window.location = $(this).attr('data-back');
        }
    });

    /** Открытие строки таблицы */
    $('tr.open_tr').click(function(){
        $(this).next('tr').fadeToggle();
    });
    $('td.open_td, td:has(.icon-edit), td:has(.show-edit)').click(function () {
        $(this).parents('tr').next('tr').show();
    });

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