$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var editor_height = 300;
    tinymce.init({
        selector: "textarea:not(.not-editor)",
        height: editor_height,
        plugins: [
            "advlist link image imagetools lists charmap print hr anchor pagebreak",
            "searchreplace visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
            "save table contextmenu directionality template paste textcolor importcss wordcount"
        ],
        theme: 'modern',
        image_advtab: true,
        content_css: "/_assets/_admin/_css/min/bootstrap.min.css",
        importcss_append: true,
        language : 'ru',
        toolbar_items_size: 'small',
        //content_css: "/application/views/admin_rocket/_css/admin.css",
        toolbar: "undo redo | styleselect | bold italic | alignleft aligncenter alignright | bullist numlist outdent " +
        "indent | link image media | fullpage | forecolor backcolor | template | code | defis",
        imagetools_toolbar: "rotateleft rotateright | flipv fliph | editimage imageoptions",
        style_formats: [
            {title: 'Headers', items: [
                {title: 'h1', block: 'h1'},
                {title: 'h2', block: 'h2'},
                {title: 'h3', block: 'h3'},
                {title: 'h4', block: 'h4'},
                {title: 'h5', block: 'h5'},
                {title: 'h6', block: 'h6'}
            ]},

            {title: 'Blocks', items: [
                {title: 'p', block: 'p'},
                {title: 'div', block: 'div'},
                {title: 'pre', block: 'pre'}
            ]}
        ],
        setup: function(editor) {
            editor.addButton('defis', {
                text: 'Дефис',
                icon: false,
                onclick: function() {
                    editor.insertContent('—');
                }
            });
        },
        templates: [
            {
                title: 'Вставка фото-галереи :: Новости (Одно большое, другие маленькие)',
                description: 'Вставьте после знака "=" имя группы картинок',
                content: '{Фото[news]=}'},
            {
                title: 'Вставка фото-галереи :: Большие фото с описаниями',
                description: 'Вставьте после знака "=" имя группы картинок',
                content: '{Фото[newsDescription]=}'},
            {
                title: 'Вставка фото-галереи :: Одинаковые блоки',
                description: 'Вставьте после знака "=" имя группы картинок',
                content: '{Фото[blocks]=}'},
            {
                title: 'Вставка фото-галереи :: Большие фото',
                description: 'Вставьте после знака "=" имя группы картинок',
                content: '{Фото[blocksBig]=}'},
            {
                title: 'Вставка фото-галереи :: Сертификаты (небольшие фото с описаниями)',
                description: 'Вставьте после знака "=" имя группы картинок',
                content: '{Фото[sert]=}'},
            {
                title: 'Вставка фото-галереи :: Вывод одинаковыми блоками',
                description: 'Вставьте после знака "=" имя группы картинок',
                content: '{Фото[customШиринаxВысота]=}'},
            {
                title: 'Вставка списка разделов сайта',
                description: 'Вставьте после знака "=" URL категории (вставятся и потомки)',
                content: '{Категории=}'},
            {
                title: 'Вставка материалов из документации',
                description: 'Вставьте после знака "=" URL категории',
                content: '{Документы[default]=}'},
            {
                title: 'Вставка прикрепленных к материалу файлов',
                description: 'Вставьте после знака "=" имя группы файлов',
                content: '{Файлы[default]=}'},
            {
                title: 'Вставка файлов из директории',
                description: 'Вставьте после знака "=" имя папки в /public/files/',
                content: '{Файлы[directory]=}'}
        ]
    });
    //Типограф
    $('.typo-action').click(function(){
        var text = tinyMCE.activeEditor.selection.getContent({format : 'html'});
        $.ajax({
            type: "POST",
            data: { text: text},
            dataType: 'json',
            url: "/admin/ajax/TypographLight",
            success: function (data) {
                tinyMCE.activeEditor.execCommand('mceReplaceContent',false, ''+data.text);
            }
        });
    });

    $('.typo-target').click(function(){
        var input_target = $(this).attr('data-target');
        var input = $('input[name='+input_target+']');
        var text = input.val();
        $.ajax({
            type: "POST",
            data: { text: text},
            dataType: 'json',
            url: "/admin/ajax/TypographLight",
            success: function (data) {
                input.val(data.text);
            }
        });
    });

    $('.typo').focusout(function(){
        var input = $(this);
        var text = $(this).val();
        $.ajax({
            type: "POST",
            data: { text: text},
            dataType: 'json',
            url: "/admin/ajax/TypographLight",
            success: function (data) {
                input.val(data.text);
            }
        });
    });


    $('.chosen-select').chosen();

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

    function view_loaded_images_params(uploaded_files)
    {
        $.each(uploaded_files, function (key, val) {
            $.ajax({
                data: {name: val.name},
                type: "POST",
                dataType: "html",
                url: "/admin/ajax/getImageParams",
                success: function (data) {
                    $('.jFiler-item-params[data-image="'+val.name +'"]').html(data);
                    ajax_edit_row();
                }
            });
        });
    }

    if($('input[name=folder]').val() !== undefined){
        get_loaded_images($('input[name=id_connect]').val(), $('input[name=folder]').val());
    }

    function load_image_plugin(uploaded_files)
    {
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
            templates: {
                box: '<ul class="jFiler-items-list jFiler-items-grid"></ul>',
                item: '<li class="jFiler-item col-xs-12">\
                    <div class="jFiler-item-container">\
                        <div class="jFiler-item-inner">\
                            <div class="jFiler-item-thumb col-xs-2">\
                                <div class="jFiler-item-status"></div>\
                                <div class="jFiler-item-info">\
                                    <span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name | limitTo: 25}}</b></span>\
                                    <span class="jFiler-item-others">{{fi-size2}}</span>\
                                </div>\
                                {{fi-image}}\
                            </div>\
                            <div class="jFiler-item-params col-xs-9" data-image="{{fi-name}}">\
                                <div class="jFiler-item-assets jFiler-row">\
                                    <ul class="list-inline pull-left">\
                                        <li>{{fi-progressBar}}</li>\
                                    </ul>\
                                </div>\
                            </div>\
                            <div class="jFiler-item-assets jFiler-row col-xs-1">\
                                <ul class="list-inline pull-right">\
                                    <li><a class="btn btn-danger jFiler-item-trash-action">Удалить</a></li>\
                                </ul>\
                            </div>\
                        </div>\
                    </div>\
                </li>',
                itemAppend: '<li class="col-xs-12 jFiler-item">\
                        <div class="jFiler-item-container">\
                            <div class="jFiler-item-inner">\
                                <div class="jFiler-item-thumb col-xs-2">\
                                    <div class="jFiler-item-status"></div>\
                                    <div class="jFiler-item-info">\
                                        <span class="jFiler-item-title hidden"><b title="{{fi-name}}">{{fi-name | limitTo: 25}}</b></span>\
                                        <span class="jFiler-item-others hidden">{{fi-size2}}</span>\
                                    </div>\
                                    {{fi-image}}\
                                </div>\
                                <div class="jFiler-item-params col-xs-9" data-image="{{fi-name}}"></div>\
                                <div class="jFiler-item-assets jFiler-row col-xs-1">\
                                    <ul class="list-inline pull-right">\
                                        <li><a class="btn btn-danger jFiler-item-trash-action">Удалить</a></li>\
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
                drop: null
            },
            uploadFile: {
                url: "/admin/ajax/UploadImage",
                data: {
                    folder: $('input[name=folder]').val(),
                    id_connect: $('input[name=id_connect]').val(),
                    param: $('input[name=param]').val()
                },
                type: 'POST',
                enctype: 'multipart/form-data',
                beforeSend: function(){},
                success: function(data, el){
                    var parent = el.find(".jFiler-jProgressBar").parent();
                    el.find(".jFiler-jProgressBar").fadeOut("slow", function(){
                        $("<div class=\"jFiler-item-others text-success\"><i class=\"icon-jfi-check-circle\"></i> Загружено</div>").hide().appendTo(parent).fadeIn("slow");
                        var image_name = el.find('.jFiler-item-params').attr('data-image');
                        view_loaded_images_params({loaded: {name: image_name}});
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
                $.post("/admin/ajax/destroyImage", {name: file.name});
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
            },
            afterShow: view_loaded_images_params(uploaded_files)
        });
    }
    /* End image upload */

    function get_loaded_files(id_connect, type)
    {
        $.ajax({
            data: {id_connect: id_connect, type: type},
            type: "POST",
            dataType: "json",
            url: "/admin/ajax/getLoadedFiles",
            success: function (data) {
                load_files_plugin(data);
            }
        });
    }

    function view_loaded_files_params(uploaded_files)
    {
        $.each(uploaded_files, function (key, val) {
            $.ajax({
                data: {name: val.name},
                type: "POST",
                dataType: "html",
                url: "/admin/ajax/getFileParams",
                success: function (data) {
                    $('.jFiler-item-params[data-image="'+val.name +'"]').html(data);
                    ajax_edit_row();
                }
            });
        });
    }

    if($('input[name=folder]').val() !== undefined){
        get_loaded_files($('input[name=id_connect]').val(), $('input[name=folder]').val());
    }

    function load_files_plugin(uploaded_files)
    {
        /* Image upload http://filer.grandesign.md/#download */
        $('#upload_file_filer').filer({
            changeInput: '<div class="jFiler-input-dragDrop">' +
            '<div class="jFiler-input-inner">' +
            '<div class="jFiler-input-icon"><i class="icon-jfi-cloud-up-o"></i></div>' +
            '<div class="jFiler-input-text"><h3>Перетащите файл сюда</h3> ' +
            '<span style="display:inline-block; margin: 15px 0">или</span></div>' +
            '<a class="jFiler-input-choose-btn blue">Выберите файл из проводника</a></div></div>',
            showThumbs: true,
            theme: "dragdropbox",
            addMore: true,
            files: uploaded_files,
            templates: {
                box: '<ul class="jFiler-items-list jFiler-items-grid"></ul>',
                item: '<li class="jFiler-item col-xs-12">\
                    <div class="jFiler-item-container">\
                        <div class="jFiler-item-inner">\
                            <div class="jFiler-item-thumb col-xs-2">\
                                <div class="jFiler-item-status"></div>\
                                <div class="jFiler-item-info">\
                                    <span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name | limitTo: 25}}</b></span>\
                                    <span class="jFiler-item-others">{{fi-size2}}</span>\
                                </div>\
                                {{fi-image}}\
                            </div>\
                            <div class="jFiler-item-params col-xs-9" data-file="{{fi-name}}">\
                                <div class="jFiler-item-assets jFiler-row">\
                                    <ul class="list-inline pull-left">\
                                        <li>{{fi-progressBar}}</li>\
                                    </ul>\
                                </div>\
                            </div>\
                            <div class="jFiler-item-assets jFiler-row col-xs-1">\
                                <ul class="list-inline pull-right">\
                                    <li><a class="btn btn-danger jFiler-item-trash-action">Удалить</a></li>\
                                </ul>\
                            </div>\
                        </div>\
                    </div>\
                </li>',
                itemAppend: '<li class="col-xs-12 jFiler-item">\
                        <div class="jFiler-item-container">\
                            <div class="jFiler-item-inner">\
                                <div class="jFiler-item-thumb col-xs-2">\
                                    <div class="jFiler-item-status"></div>\
                                    <div class="jFiler-item-info">\
                                        <span class="jFiler-item-title hidden"><b title="{{fi-name}}">{{fi-name | limitTo: 25}}</b></span>\
                                        <span class="jFiler-item-others hidden">{{fi-size2}}</span>\
                                    </div>\
                                    {{fi-image}}\
                                </div>\
                                <div class="jFiler-item-params col-xs-9" data-file="{{fi-name}}"></div>\
                                <div class="jFiler-item-assets jFiler-row col-xs-1">\
                                    <ul class="list-inline pull-right">\
                                        <li><a class="btn btn-danger jFiler-item-trash-action">Удалить</a></li>\
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
                drop: null
            },
            uploadFile: {
                url: "/admin/ajax/UploadFile",
                data: {
                    folder: $('input[name=folder]').val(),
                    id_connect: $('input[name=id_connect]').val(),
                    param: $('input[name=param]').val()
                },
                type: 'POST',
                enctype: 'multipart/form-data',
                beforeSend: function(){},
                success: function(data, el){
                    var parent = el.find(".jFiler-jProgressBar").parent();
                    el.find(".jFiler-jProgressBar").fadeOut("slow", function(){
                        $("<div class=\"jFiler-item-others text-success\"><i class=\"icon-jfi-check-circle\"></i> Загружено</div>").hide().appendTo(parent).fadeIn("slow");
                        var image_name = el.find('.jFiler-item-params').attr('data-file');
                        view_loaded_files_params({loaded: {name: image_name}});
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
                $.post("/admin/ajax/destroyFile", {name: file.name});
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
            },
            afterShow: view_loaded_files_params(uploaded_files)
        });
    }
    /* END FILE PLUGIN UPLOADED */

    //$('.typeahead').typeahead();
    $('*[data-toggle=tooltip]').tooltip();

    $('input[name=date], input.date').pickadate({
        monthSelector: true,
        yearSelector: true,
        formatSubmit: 'yyyy-mm-dd',
        firstDay: 1,
        monthsFull: [ 'Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь' ],
        weekdaysShort: [ 'Вск', 'Пон', 'Вт', 'Ср', 'Чт', 'Пт', 'Суб' ],
        format: 'yyyy-mm-dd 00:00:00'
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

    /** Если присвоить класс change-form селекту в форме, то при клике будет происходить сабмит формы */
    $('select.change-form, input[type=checkbox].change-form').change(function(){
        $(this).parents('form').submit();
    });

    $('input[type=text].change-form').focusout(function(){
        $(this).parents('form').submit();
    });

    $('#clear_cache').bind('click', function () {
        clear_cache();
    });

    /** Input для редактирования поля */
    ajax_edit_row();

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
    $('.please_conform').on('click', function () {
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

    /** Типограф на кнопке */
    $('.btn-typo').click(function(){
        var input = $(this).parentsUntil('.form-group').find('input');
        var text = input.val();
        typographLight(text, input);
    });
});

function ajax_edit_row()
{
    /** Input для редактирования поля */
    $('.ajax_edit_row').on('focusout', function(){
        var value_where = $(this).attr('data-value_where');
        var row_where = $(this).attr('data-row_where');
        var value = $(this).val();
        var row = $(this).attr('name');
        if(row == undefined){
            row = $(this).attr('data-row');
        }
        var table = $(this).attr('data-table');
        var event = 'edit';
        var data = { value_where: value_where, row_where: row_where, value: value, row: row, event: event, table: table };
        //hidden_action(url, send_data, good_message, button, redirect_url, clearcache)
        hidden_action('/admin/ajax/EditRow', data, false, false, false, true);
    });
}

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
        return false;
    });
}

function typographLight(text, input)
{
    $.ajax({
        type: "POST",
        data: { text: text },
        dataType: 'json',
        url: "/admin/ajax/TypographLight",
        success: function (data) {
            if (data.text) {
                input.val(data.text);
            }
        }
    });
}

function typograph(text)
{
    var data = {text: text};
    hidden_action('/admin/ajax/typograph', data, false, false, false, false);
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

/**
 * Создание url для страницы и вставка значения в input[name=url]
 * string @param title  Текст для транслитерации (обычно input[name=title])
 * string @param table  Имя таблицы для проверки уникальности url (опционально, можно передать пустое значение)
 * string @param form   Форма в которой проводятся операции
 */
function change_url(title, table, form){
    $.ajax({
        type: "POST",
        data: { text: title, table: table},
        dataType: 'json',
        url: "/admin/ajax/Translit",
        success: function (data) {
            var url_input = $(form).find('input[name=url]');
            if (data.message) {
                url_input.val(data.message);
                notify_show('info', 'Материалу будет присвоен url: '+data.message);
            }
        }
    });
}