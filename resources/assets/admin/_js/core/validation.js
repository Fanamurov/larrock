/*ПРОВЕРЯЕМ ФОРМЫ*/
valid_forms();
$('input.notEmpty, input.email, input.captcha, input.articul_in_group').keyup(function(){valid_forms()});
$('input.unique').focusout(function(){valid_forms()});


/*ГЛАВНАЯ ФУНКЦИЯ - РОУТИНГ*/
function valid_forms()
{
    //Перебираем все формы, для которых нужна валидация
    $('form').each(function(){
        $(this).find('.alert-valid').remove();
        $(this).find('[type=submit]').removeAttr('disabled');

        //Проверка уникальных полей
        $(this).find('input.unique').each(function(){
            var input = $(this);
            check_unique(input);
        });

        $(this).find('input.articul_in_group').each(function(){
            var input = $(this);
            check_unique_articul(input);
        });

        //Проверка обязательных полей
        $(this).find('.notEmpty').each(function(){
            var input = $(this);
            check_not_empty(input);
        });

        //Проверка обязательных полей
        $(this).find('.limit').each(function(){
            var input = $(this);
            var limit = $(this).attr('limit');
            check_limit(input, limit);
        });

        //Проверка captcha
        $(this).find('input.captcha').each(function(){
            var input = $(this);
            check_captcha(input);
        });

        //Проверка email
        $(this).find('input.email').each(function(){
            var input = $(this);
            check_email(input);
        });

    });
}

/*ФУНКЦИЯ ПРОВЕРКИ ОБЯЗАТЕЛЬНОГО ПОЛЯ*/
function check_not_empty(input)
{
    $(input).each(function(){
        $(input).attr('placeholder', 'Поле обязательно для заполнения');
        var input_value = $(input).val();
        var input_name = $(input).attr('name');
        var data = 'Поле обязательно для заполнения';
        if (input_value.length == 0){
            $(input).closest('.form-group').addClass('has-error');
            $(input).closest('form').find('[type=submit]').attr('disabled', 'disabled');
            $(input).closest('form').find('div.valid_errors > p')
                .after('<a class="alert-valid alert-'+input_name+'" href="#r-row-'+input_name+'">'+input_name+': '+data+'</a>');
        }else{
            $(input).closest('.form-group').removeClass('has-error');
            $('.alert-'+input_name).remove();
        }
    })
}

function check_limit(input, limit)
{
    $(input).each(function(){
        $(input).attr('placeholder', 'Поле не должно превышать '+limit+' знаков');
        var input_value = $(input).val();
        var input_name = $(input).attr('name');
        var data = 'Поле не должно превышать '+limit+' знаков';
        if (input_value.length > limit){
            $(input).closest('.form-group').addClass('has-error');
            $(input).closest('form').find('*[type=submit]').attr('disabled', 'disabled');
            $(input).closest('form').find('div.valid_errors > p')
                .after('<p class="alert-valid alert alert-error alert-'+input_name+'">'+input_name+': '+data+'</p>');
        }else{
            $('alert-'+input_name+'').remove();
        }
    })
}

/*Проверка каптчи*/
function check_captcha(input)
{
    $(input).attr('placeholder', 'Введите символы с картинки');
    var captcha = $(input).val();
    if (captcha.length === 5){
        var input_name = $(input).attr('name');
        var data = { captcha: captcha };
        var url = '/ajax/ajax/checkcaptcha';
        var request = $.ajax({
            data: data,
            type: "POST",
            url: url
        });
        request.fail(function(){
            $(input).closest('.form-group').addClass('has-error');
            $(input).closest('form').find('*[type=submit]').attr('disabled', 'disabled');
            $(input).closest('form').find('div.valid_errors > p')
                .after('<a class="alert-valid alert-'+input_name+'" href="#r-row-'+input_name+'">'+input_name+': Неверная каптча</a>');
        });
        request.success(function(){
            $(input).closest('.form-group').removeClass('has-error');
            $(input).closest('form').find('*[type=submit]').removeAttr('disabled');
        })
    }else{
        var input_name = $(input).attr('name');
        $(input).closest('.form-group').addClass('has-error');
        $(input).closest('form').find('*[type=submit]').attr('disabled', 'disabled');
        $(input).closest('form').find('div.valid_errors > p')
            .after('<a class="alert-valid alert-'+input_name+'" href="#r-row-'+input_name+'">'+input_name+': Неверная каптча</a>');
    }
}

/*Проверка email*/
function check_email(input) {
    var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    var row_check = $(input).val();
    var input_name = $(input).attr('name');
    if(!regex.test(row_check)){
        $(input).closest('.form-group').addClass('has-error');
        $(input).attr('placeholder', 'Некорректный email');
        $(input).closest('form').find('*[type=submit]').attr('disabled', 'disabled');
        $(input).closest('form').find('div.valid_errors > p')
            .after('<a class="alert-valid alert-'+input_name+'" href="#r-row-'+input_name+'">'+input_name+': Не валидный email</a>');
    }
}


/*ПРОВЕРКА НА УНИКАЛЬНОСТЬ ПОЛЯ*/
function check_unique(input)
{
    var table = $(input).attr('data-table');
    var row = $(input).attr('data-row');
    var current_id = $(input).attr('data-id');
    var row_check = $(input).val();
    var input_name = $(input).attr('name');
    if (row_check.length > 0){
        var data = { table:table, row:row, row_check:row_check, current_id:current_id};
        var url = '/admin/ajax/checkUnique';
        var request = $.ajax({
            data: data,
            type: "POST",
            dataType: 'json',
            url: url
        });
        request.fail(function(){
            $(input).closest('.form-group').addClass('has-error');
            $(input).closest('form').find('*[type=submit]').attr('disabled', 'disabled');
            $(input).closest('form').find('div.valid_errors > p')
                .after('<a class="alert-valid alert-'+input_name+'" href="#r-row-'+input_name+'">'+input_name+': '+data.error+'</a>');
        });
        request.success(function(data){
            if(data.good){
                $(input).closest('.form-group').removeClass('has-error');
                $(input).closest('form').find('*[type=submit]').removeAttr('disabled');
            }
            if(data.error){
                $(input).closest('.form-group').addClass('has-error');
                $(input).closest('form').find('*[type=submit]').attr('disabled', 'disabled');
                $(input).closest('form').find('div.valid_errors > p')
                    .after('<a class="alert-valid alert-'+input_name+'" href="#r-row-'+input_name+'">'+input_name+': '+data.error+'</a>');
            }
        });
    }
}

function check_unique_articul(input)
{
    var table = $(input).attr('data-table');
    var row = $(input).attr('data-row');
    var current_id = $(input).attr('data-id');
    var row_check = $(input).val();
    var input_name = $(input).attr('name');
    if (row_check.length > 0){
        var data = { table:table, row:row, row_check:row_check, current_id:current_id};
        var url = '/admin/ajax/checkUniqueArticul';
        var request = $.ajax({
            data: data,
            type: "POST",
            dataType: 'json',
            url: url
        });
        request.fail(function(){
            $(input).closest('.form-group').addClass('has-error');
            $(input).closest('form').find('*[type=submit]').attr('disabled', 'disabled');
            $(input).closest('form').find('div.valid_errors > p')
                .after('<a class="alert-valid alert-'+input_name+'" href="#r-row-'+input_name+'">'+input_name+': '+data.error+'</a>');
        });
        request.success(function(data){
            if(data.good){
                $(input).closest('.form-group').removeClass('has-error');
                $(input).closest('form').find('*[type=submit]').removeAttr('disabled');
            }
            if(data.error){
                $(input).closest('.form-group').addClass('has-error');
                $(input).closest('form').find('*[type=submit]').attr('disabled', 'disabled');
                $(input).closest('form').find('div.valid_errors > p')
                    .after('<a class="alert-valid alert-'+input_name+'" href="#r-row-'+input_name+'">'+input_name+': '+data.error+'</a>');
            }
        });
    }
}