$(document).ready(function () {
    tinymce.init({
        selector: "textarea:not(.not-editor)",
        height: 400,
        plugins: [
            "advlist link image lists charmap print hr anchor pagebreak",
            "searchreplace visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
            "save table contextmenu directionality template paste textcolor"
        ],
        language : 'ru',
        toolbar_items_size: 'small',
        //content_css: "/application/views/admin_rocket/_css/admin.css",
        toolbar: "undo redo | styleselect | bold italic | alignleft aligncenter alignright | bullist numlist outdent " +
            "indent | link image media | fullpage | forecolor backcolor | template | code | defis",
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
            url: "/admin/ajax/typo",
            success: function (data) {
                tinyMCE.activeEditor.execCommand('mceReplaceContent',false, ''+data.good);
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
            url: "/admin/ajax/typoCut",
            success: function (data) {
                input.val(data.good);
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
            url: "/admin/ajax/typoCut",
            success: function (data) {
                input.val(data.good);
            }
        });
    })

});

