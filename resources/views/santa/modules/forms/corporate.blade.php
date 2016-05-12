<form id="form-corporate" class="form-corporate" method="post" action="/forms/corporate">
    <p class="h2">Анкета для заключения договора</p>
    <p class="h4">Информация о компании:</p>
    <div class="row">
        <div class="col-xs-24 col-sm-8">
            <div class="form-group">
                <input type="text" class="form-control" id="form-corporate-name" placeholder="Название организации" name="name">
            </div>
        </div>
        <div class="col-xs-24 col-sm-16">
            <div class="form-group">
                <input type="text" class="form-control" id="form-corporate-address" placeholder="Фактический адрес" name="address">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-24 col-sm-16">
            <div class="form-group">
                <input type="text" class="form-control" id="form-corporate-fio" placeholder="ФИО" name="fio">
            </div>
        </div>
        <div class="col-xs-24 col-sm-8">
            <div class="form-group">
                <input type="text" class="form-control" id="form-corporate-place" placeholder="Должность" name="place">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-24 col-sm-12">
            <div class="form-group">
                <input type="tel" class="form-control" id="form-corporate-tel" placeholder="Телефон" name="tel">
            </div>
        </div>
        <div class="col-xs-24 col-sm-12">
            <div class="form-group">
                <input type="email" class="form-control" id="form-corporate-email" placeholder="Email" name="email">
            </div>
        </div>
    </div>
    <div class="row row-sotr">
        <div class="col-xs-24 col-sm-12">
            <div class="row">
                <div class="col-xs-6">
                    <input type="text" class="form-control" id="form-corporate-peoples" placeholder="25" name="peoples">
                </div>
                <div class="col-xs-18">
                    <label for="form-corporate-peoples">кол-во сотрудников в компании</label>
                </div>
            </div>
        </div>
        <div class="col-xs-24 col-sm-12">
            <div class="row">
                <div class="col-xs-6">
                    <input type="text" class="form-control" id="form-corporate-peoples-active" placeholder="12" name="peoples_active">
                </div>
                <div class="col-xs-18">
                    <label for="form-corporate-peoples-active">в том числе ездят в командировки</label>
                </div>
            </div>
        </div>
    </div>

    <div class="clearfix"></div><hr/>
    <p class="h4">Потребность в услугах:</p>
    <div class="row row-usligi">
        <div class="col-xs-24 col-sm-16">
            <div class="form-group">
                <label for="form-corporate-peoples">
                    <input type="checkbox" id="form-corporate-hotels-ru" placeholder="" name="hotels_ru">
                    Отели по России (сбор за ночь или за бронирование?)
                </label>
            </div>
            <div class="form-group">
                <label for="form-corporate-peoples">
                    <input type="checkbox" id="form-corporate-hotels_mg" placeholder="" name="hotels_mg">
                    Отели за рубежом (сбор за ночь или за бронирование?)
                </label>
            </div>
            <div class="form-group">
                <label for="form-corporate-peoples">
                    <input type="checkbox" id="form-corporate-passport" placeholder="" name="passport">
                    Паспортно-визовые услуги
                </label>
            </div>
            <div class="form-group">
                <label for="form-corporate-peoples">
                    <input type="checkbox" id="form-corporate-mice" placeholder="" name="mice">
                    MICE
                </label>
            </div>
        </div>
        <div class="col-xs-24 col-sm-8">
            <div class="form-group">
                <label for="form-corporate-peoples">
                    <input type="checkbox" id="form-corporate-avia-ru" placeholder="" name="avia_ru">
                    Авиабилеты внутренние
                </label>
            </div>
            <div class="form-group">
                <label for="form-corporate-peoples">
                    <input type="checkbox" id="form-corporate-avia-mg" placeholder="" name="avia_mg">
                    Авиабилеты международные
                </label>
            </div>
            <div class="form-group">
                <label for="form-corporate-peoples">
                    <input type="checkbox" id="form-corporate-jd" placeholder="" name="jd">
                    ЖД билеты
                </label>
            </div>
        </div>
    </div>
    <hr/>
    <div class="form-group">
        <label for="form-corporate-peoples">
            <input type="checkbox" id="form-corporate-subscribe" placeholder="" name="subscribe">
            Я хочу получать рассылку с акциями авиакомпаний
        </label>
    </div>

    <div class="form-group">
        <textarea class="form-control" name="comment" id="form-corporate-comment" placeholder="Комментарии"></textarea>
    </div>
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <button type="submit" class="btn btn-default" name="submit_contact">Отправить анкету</button>
    <div class="clearfix"></div>
</form>
@push('scripts')
{!! JsValidator::formRequest('App\Http\Requests\CorporateRequest', '#form-corporate') !!}
@endpush