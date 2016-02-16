$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

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
});