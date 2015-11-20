(function ($) {
    // defining compatibility of upload control object
    var xhrUploadFlag = false;
    if (window.XMLHttpRequest) {
        var testXHR = new XMLHttpRequest();
        xhrUploadFlag = (testXHR.upload != null);
    }

    // utility object for checking browser compatibility
    $.extend($.support, {
        fileSelecting: (window.File != null) && (window.FileList != null),
        fileReading: (window.FileReader != null),
        fileSending: (window.FormData != null),
        uploadControl: xhrUploadFlag
    });

    // generating uniq id
    var uniq = function (length, prefix) {
        length = parseInt(length);
        prefix = prefix || '';
        if ((length == 0) || isNaN(length)) {
            return prefix;
        }
        var ch = String.fromCharCode(Math.floor(Math.random() * 26) + 97);
        return prefix + ch + uniq(--length);
    };

    var checkIsFile = function (item) {
        return (item instanceof File) || (item instanceof Blob);
    };

    ////////////////////////////////////////////////////////////////////////////
    // plugin code
    $.fn.damnUploader2 = function (params) {

        if (this.length == 0) {
            return this;
        } else if (this.length > 1) {
            return this.each(function() {
                $(this).damnUploader2(params);
            });
        }

        // context
        var self = this;

        // locals
        var queue = self._damnUploader2Queue;
        var set = self._damnUploader2Settings || {};

        ////////////////////////////////////////////////////////////////////////
        // initialization
        /* default settings */
        self._damnUploader2Settings = $.extend({
            url: '/admin/ajax/uploadImagesb',
            multiple: true,
            fieldName: 'file',
            dropping: true,
            dropBox: true,
            limit: false,
            onSelect: true,
            onLimitExceeded: false,
            onAllComplete: false
        }, params || {});


        /* private properties */
        self._damnUploader2Queue = {};
        self._damnUploader2ItemsCount = 0;
        queue = self._damnUploader2Queue;
        set = self._damnUploader2Settings;

        /* private items-adding method */
        self._damnUploader2FilesAddMap = function (files, callback) {
            var callbackDefined = $.isFunction(callback);
            if (!$.support.fileSelecting) {
                if (self._damnUploader2ItemsCount === set.limit) {
                    return $.isFunction(set.onLimitExceeded) ? set.onLimitExceeded.call(self) : false;
                }
                var file = {
                    fake: true,
                    name: files.value,
                    inputElement: files
                };
                if (callbackDefined) {
                    if (!callback.call(self, file)) {
                        return true;
                    }
                }
                self.duAdd(file);
                return true;
            }
            if (files instanceof FileList) {
                $.each(files, function (i, file) {
                    if (self._damnUploader2ItemsCount === set.limit) {
                        if (self._damnUploader2ItemsCount === set.limit) {
                            return $.isFunction(set.onLimitExceeded) ? set.onLimitExceeded.call(self) : false;
                        }
                    }
                    if (callbackDefined) {
                        if (!callback.call(self, file)) {
                            return true;
                        }
                    }
                    self.duAdd({ file: file });
                });
            }
            return true;
        };


        /* private file-uploading method */
        self._damnUploader2UploadItem = function (url, item) {
            if (!checkIsFile(item.file)) {
                return false;
            }
            var xhr = new XMLHttpRequest();
            var progress = 0;
            var uploaded = false;

            if (xhr.upload) {
                xhr.upload.addEventListener("progress", function (e) {
                    if (e.lengthComputable) {
                        progress = (e.loaded * 100) / e.total;
                        if ($.isFunction(item.onProgress)) {
                            item.onProgress.call(item, Math.round(progress));
                        }
                    }
                }, false);

                xhr.upload.addEventListener("load", function (e) {
                    progress = 100;
                    uploaded = true;
                }, false);
            } else {
                uploaded = true;
            }

            xhr.onreadystatechange = function () {
                var callbackDefined = $.isFunction(item.onComplete);
                if (this.readyState == 4) {
                    item.cancelled = item.cancelled || false;
                    if (this.status < 400) {
                        if (!uploaded) {
                            if (callbackDefined) {
                                item.onComplete.call(item, false, null, 0);
                            }
                        } else {
                            if ($.isFunction(item.onProgress)) {
                                item.onProgress.call(item, 100);
                            }
                            if (callbackDefined) {
                                item.onComplete.call(item, true, this.responseText);
                            }
                        }
                    } else {
                        if (callbackDefined) {
                            item.onComplete.call(item, false, null, this.status);
                        }
                    }
                }
            };

            var filename = item.replaceName || item.file.name;
            xhr.open("POST", url);

            if ($.support.fileSending) {
                // W3C (Chrome, Safari, Firefox 4+)
                var formData = new FormData();
                formData.append((item.fieldName || 'file'), item.file);
                var type_connect_image = $('#upload_images2').attr('data-type_connect_image');
                var type_image = $('#upload_images2').attr('data-type_image');
                var id_image = $('#upload_images2').attr('data-id_image');
                var group_image = $('input[name=url]').val();
                formData.append("type[]", type_image);
                formData.append("type_connect[]", type_connect_image);
                formData.append("id_image[]", id_image);
                formData.append("group_image[]", group_image);
                xhr.send(formData);
            } else {
                // Other
                xhr.setRequestHeader('Upload-Filename', item.file.name);
                xhr.setRequestHeader('Upload-Size', item.file.size);
                xhr.setRequestHeader('Upload-Type', item.file.type);
                xhr.send(item.file);
            }
            item.xhr = xhr;
        };



        /* binding callbacks */
        var isFileField = ((self.get(0).tagName == 'INPUT') && (this.attr('type') == 'file'));

        if (isFileField) {
            var myName = self.eq(0).attr('name');
            if (!$.support.fileSelecting) {
                if (myName.charAt(myName.length - 1) != ']') {
                    myName += '[]';
                }
                self.attr('name', myName);
                self.attr('multiple', false);
                var action = self.parents('form').attr('action');
                self._damnUploader2FakeForm = $('<form/>').attr({
                    method: 'post',
                    enctype: 'multipart/form-data',
                    action: action
                }).hide().appendTo('body');
            } else {
                self.attr('multiple', true);
            }

            self._damnUploader2ChangeCallback = function () {
                self._damnUploader2FilesAddMap($.support.fileSelecting ? this.files : this, set.onSelect);
            };

            self.on({
                change: self._damnUploader2ChangeCallback
            });
        }

        if (set.dropping) {
            self.on({
                drop: function (e) {
                    self._damnUploader2FilesAddMap(e.originalEvent.dataTransfer.files, set.onSelect);
                    return false;
                }
            });
            if (set.dropBox) {
                $(set.dropBox).on({
                    drop: function (e) {
                        self._damnUploader2FilesAddMap(e.originalEvent.dataTransfer.files, set.onSelect);
                        return false;
                    }
                });
            }
        }

        self.duStart = function () {
            if (!set.url) {
                return self;
            }
            if (!$.support.fileSelecting) {
                self._damnUploader2FakeForm.submit();
                return self;
            }
            $.each(queue, function (queueId, item) {
                var compl = item.onComplete;
                item.fieldName = item.fieldName || set.fieldName;
                item.onComplete = function (successful, data, error) {
                    if (!this.cancelled) {
                        delete queue[queueId];
                        self._damnUploader2ItemsCount--;
                    }
                    if ($.isFunction(compl)) {
                        compl.call(this, successful, data, error);
                    }
                    if ((self._damnUploader2ItemsCount == 0) && ($.isFunction(set.onAllComplete))) {
                        set.onAllComplete.call(self);
                    }
                };
                self._damnUploader2UploadItem(set.url, item);
            });
            return self;
        };

        self.duCancel = function (queueId) {
            if (queueId && self._damnUploader2ItemsCount > 0) {
                if (!$.support.fileSelecting) {
                    var removingItem = $('#' + queueId);
                    if (removingItem.length > 0) {
                        removingItem.remove();
                        self._damnUploader2ItemsCount--;
                    }
                    return self;
                }

                if (queue[queueId] !== undefined) {
                    if (queue[queueId].xhr) {
                        queue[queueId].cancelled = true;
                        queue[queueId].xhr.abort();
                    }
                    delete queue[queueId];
                    self._damnUploader2ItemsCount--;
                }
            }
            return self;
        };

        self.duCancelAll = function () {
            if (!$.support.fileSelecting) {
                self._damnUploader2ItemsCount = 0;
                self._damnUploader2FakeForm.empty();
                return self;
            }
            $.each(queue, function (key, item) {
                self.duCancel(key);
            });
            return self;
        };

        self.duAdd = function (uploadItem) {
            if (!uploadItem || !uploadItem.file) {
                return false;
            }
            var queueId = uniq(5);

            if (uploadItem.file.fake) {
                var input = $(uploadItem.file.inputElement);
                var cloned = $(input).clone();
                $(input).before(cloned);
                $(input).attr('id', queueId);
                $(input).appendTo(self._damnUploader2FakeForm);
                cloned.on({
                    change: self._damnUploader2ChangeCallback
                });
                self._damnUploader2ItemsCount++;
                return queueId;
            }
            if (!checkIsFile(uploadItem.file)) {
                return false;
            }
            queue[queueId] = uploadItem;
            self._damnUploader2ItemsCount++;
            return queueId;
        };

        self.duCount = function () {
            return self._damnUploader2ItemsCount;
        };

        self.duOption = function (name, value) {
            var acceptParams = ['url', 'multiple', 'fieldName', 'limit'];
            if (value === undefined) {
                return self._damnUploader2Settings[name];
            }
            if ($.isPlainObject(name)) {
                $.each(name, function (key, val) {
                    self.duOption(key, val);
                });
            } else {
                $.inArray(name, acceptParams) && (self._damnUploader2Settings[key] = value);
            }
            return self;
        };


        return self;
    };
})(window.jQuery);

$(document).ready(function() {

    // Консоль
    var $console = $("#console2");
    // Инфа о выбранных файлах
    var countInfo = $("#info-count2");
    var sizeInfo = $("#info-size2");
    // ul-список, содержащий миниатюрки выбранных файлов
    var imgList = $('#img-list2');
    // Контейнер, куда можно помещать файлы методом drag and drop
    var dropBox = $('#dropbox2');
    // Счетчик всех выбранных файлов и их размера
    var imgCount = 0;
    var imgSize = 0;
    // Стандарный input для файлов
    var fileInput = $('#file-field2');

    ////////////////////////////////////////////////////////////////////////////
    // Подключаем и настраиваем плагин загрузки

    fileInput.damnUploader2({
        // куда отправлять
        url: '/admin/ajax/uploadImagesb',
        // имитация имени поля с файлом (будет ключом в $_FILES, если используется PHP)
        fieldName:  'images2',
        // дополнительно: элемент, на который можно перетащить файлы (либо объект jQuery, либо селектор)
        dropBox: dropBox,
        // максимальное кол-во выбранных файлов (если не указано - без ограничений)
        //limit: 20,
        autostartOn: true,
        // когда максимальное кол-во достигнуто (вызывается при каждой попытке добавить еще файлы)
        onLimitExceeded: function() {
            log('<div class="alert alert-danger">Допустимое кол-во файлов уже выбрано</div>');
        },
        // ручная обработка события выбора файла (в случае, если выбрано несколько, будет вызвано для каждого)
        // если обработчик возвращает true, файлы добавляются в очередь автоматически
        onSelect: function(file) {
            addFileToQueue(file);
            return false;
        },
        // когда все загружены
        onAllComplete: function() {
            log('<div class="alert alert-success">Все загрузки завершены!</div>');
            imgCount = 0;
            imgSize = 0;
            hidden_action('/admin/ajax/clearCache/true', false, false, false, false, false);
            updateInfo();
            addTriggerNew();
        }
    });

    ////////////////////////////////////////////////////////////////////////////
    // Вспомогательные функции
    // Вывод в консоль
    function log(str) {
        $('<p/>').html(str).prependTo($console);
        if (window.console !== undefined) {
            //window.console.log(str);
        }
    }

    // Вывод инфы о выбранных
    function updateInfo() {
        countInfo.text( (imgCount == 0) ? 'Изображений не выбрано' : ('Изображений выбрано: '+imgCount));
        sizeInfo.text( (imgSize == 0) ? '-' : Math.round(imgSize / 1024));
    }

    // Обновление progress bar'а
    function updateProgress(bar, value) {
        var width = bar.width();
        var bgrValue = -width + (value * (width / 100));
        bar.attr('rel', value).css('background-position', bgrValue+'px center').text(value+'%');
    }

    // Отображение выбраных файлов, создание миниатюр и ручное добавление в очередь загрузки.
    function addFileToQueue(file) {

        // Создаем элемент li и помещаем в него название, миниатюру и progress bar
        var li = $('<li/>').appendTo(imgList);
        var title = $('<div/>').text(file.name+' ').attr({class: 'upload-list-item'}).appendTo(li);
        var cancelButton = $('<a/>').attr({
            href: '#cancel',
            title: 'отменить',
            class: 'btn btn-small remove-upload-list'
        }).text('X').appendTo(title);

        // Если браузер поддерживает выбор файлов (иначе передается специальный параметр fake,
        // обозночающий, что переданный параметр на самом деле лишь имитация настоящего File)
        if(!file.fake) {

            // Отсеиваем не картинки
            var imageType = /image.*/;
            if (!file.type.match(imageType)) {
                log('Файл отсеян: `'+file.name+'` (тип '+file.type+')');
                return true;
            }

            // Добавляем картинку и прогрессбар в текущий элемент списка
            var img = $('<img/>').appendTo(li);
            var pBar = $('<div/>').addClass('progress').attr('rel', '0').text('0%').appendTo(li);

            // Создаем объект FileReader и по завершении чтения файла, отображаем миниатюру и обновляем
            // инфу обо всех файлах (только в браузерах, подерживающих FileReader)
            if($.support.fileReading) {
                var reader = new FileReader();
                reader.onload = (function(aImg) {
                    return function(e) {
                        aImg.attr('src', e.target.result);
                        aImg.attr('width', 150);
                    };
                })(img);
                reader.readAsDataURL(file);
            }

            //log('Картинка добавлена: `'+file.name + '` (' +Math.round(file.size / 1024) + ' Кб)');
            imgSize += file.size;
        } else {
            //log('Файл добавлен: '+file.name);
        }

        imgCount++;
        $('#actions2').removeClass('hidden');
        updateInfo();

        // Создаем объект загрузки
        var uploadItem = {
            file: file,
            onProgress: function(percents) {
                updateProgress(pBar, percents);
            },
            onComplete: function(successfully, data, errorCode) {
                if(successfully) {
                    $('#img-list2').html('');
                    log('<div class="alert alert-success">Файл `'+this.file.name+'` загружен</div>'+data+'<br/>');
                } else {
                    if(!this.cancelled) {
                        log('<div class="alert alert-error">Файл `'+this.file.name+'`: ошибка при загрузке. Код: '+errorCode+'</div>');
                    }
                }
            }
        };

        // ... и помещаем его в очередь
        var queueId = fileInput.duAdd(uploadItem);

        // обработчик нажатия ссылки "отмена"
        cancelButton.click(function() {
            //fileInput.trigger('uploader.test', queueId);
            //fileInput.damnUploader2('cancel', queueId);
            //fileInput.trigger('uploader.cancel', queueId);
            fileInput.duCancel(queueId);
            li.remove();
            imgCount--;
            imgSize -= file.fake ? 0 : file.size;
            updateInfo();
            log(file.name+' удален из очереди');
            return false;
        });
        return uploadItem;
    }

    ////////////////////////////////////////////////////////////////////////////
    // Обработчики событий
    // Обработка событий drag and drop при перетаскивании файлов на элемент dropBox
    dropBox.bind({
        dragenter: function() {
            $(this).addClass('highlighted');
            return false;
        },
        dragover: function() {
            return false;
        },
        dragleave: function() {
            $(this).removeClass('highlighted');
            return false;
        }
    });

    // Обаботка события нажатия на кнопку "Загрузить все".
    // стартуем все загрузки
    $("#upload-all2").click(function() {
        fileInput.duStart();
    });

    // Обработка события нажатия на кнопку "Отменить все"
    $("#cancel-all2").click(function() {
        fileInput.duCancelAll();
        imgCount = 0;
        imgSize = 0;
        updateInfo();
        log('*** Все загрузки отменены ***');
        imgList.empty();
        $('#actions2').addClass('hidden');
    });

    function addTriggerNew(){
        //console.log('addTridder');
        $('.upload_images_trumbs_item_new').find('.image_group').focusout(function(){
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
        /* Изменение веса картинки */
        $('.upload_images_trumbs_item_new').find('.image_position').focusout(function(){
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

        /* Изменение описания картинки */
        $('.upload_images_trumbs_item_new').find('.image_description').focusout(function(){
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

        /* Удаление загруженной картинки */
        $('.upload_images_trumbs_item_new').find('.delete_image').on('click', function(){
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
    function hidden_action(url, send_data, good_message, button, redirect_url) {
        var request = $.ajax({
            data: send_data,
            type: "POST",
            dataType: "json",
            url: url
        });
        request.done(function (msg) {
            if(msg.blank){
                return false;
            }
            if(msg.good){
                if ((good_message !== false) && (good_message !== undefined)) {
                    notify_show('success', good_message);
                }else{
                    notify_show('success', msg.good);
                }
            }
            if(good_message !== false){
                if(msg.error){
                    notify_show('success', msg.error);
                    return false;
                }
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
            //console.log(status);
            if(status == 'parsererror'){
                notify_show('success', 'Ничего не произошло');
                return false;
            }
            notify_show('error', statusText);
            if ((button !== false) && (redirect_url !== undefined)) {
                $(button).removeClass('action_button').removeAttr('disabled');
            }
            //console.error(statusText);
            return false;

        });
    }

    /* Подгрузка существующих галерей */
    $('#exist_gallery2').change(function(){
        $("#my_select2 :selected").remove();
        var param = $('#exist_gallery2 option:selected').val();
        var request = $.ajax({
            data: {param: param},
            type: "POST",
            url: '/admin/ajax/getImageGallery'
        });
        request.done(function (msg) {
            $('#console2').after('<div class="clearfix"></div><br/> '+msg);
            addTriggerNew();
            notify_show('success', 'Галерея подгружена');
            $('#upload_images_trumbs2').find('.alert').hide();
        });
        request.fail(function(){
            notify_show('error', 'Галерею не удалось подгрузить');
        })
    });

    /**
     * Уведомления в сплывающих окнах от процессов
     * string @param type  Тип события (good, error)
     * string @param message   Сообщение на вывод
     */
    function notify_show(type, message) {
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
                layout: 'topRight'
            });
        }
    }
});