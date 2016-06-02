<form action="/forms/sletatOrderFull" method="post" id="form-sletatOrderFull" class="form-sletatOrderFull" onsubmit="yaCounter27992118.reachGoal('SletatOrder'); return true;">
    <p class="h1">Отправить заявку на приобретение тура</p>
    <p class="h2">Туристы:</p>
    @for($i=0; $i < $people+$kids; $i++)
        <div class="row">
            <div class="col-sm-9">
                <div class="form-group">
                    <label class="control-label" for="form-sletatOrderFull-name">Имя(латиницей):</label>
                    <input class="form-control" id="form-sletatOrderFull-name" type="text" name="firstname[]" value="" placeholder="IVAN">
                </div>
            </div>
            <div class="col-sm-9">
                <div class="form-group">
                    <label class="control-label" for="form-sletatOrderFull-name">Фамилия(латиницей):</label>
                    <input class="form-control" id="form-sletatOrderFull-name" type="text" name="lastname[]" value="" placeholder="IVANOV">
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <label class="control-label" for="form-sletatOrderFull-name">Гражд-во:</label>
                    <input class="form-control" id="form-sletatOrderFull-name" type="text" name="citizenship[]" value="RU" placeholder="RU">
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <label class="control-label" for="form-sletatOrderFull-gender">Пол:</label>
                    <select name="gender[]" class="form-control" id="form-sletatOrderFull-gender">
                        <option value="муж">муж</option>
                        <option value="жен">жен</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-9">
                <div class="form-group">
                    <label class="control-label" for="form-sletatOrderFull-birthday">Дата рождения:</label>
                    <input class="form-control" id="form-sletatOrderFull-birthday" type="date" name="birthday[]" value="">
                </div>
            </div>
            <div class="col-sm-9">
                <div class="form-group">
                    <label class="control-label" for="form-sletatOrderFull-seriaZagran">Серия и номер загранпаспорта:</label>
                    <div class="row">
                        <div class="col-xs-12">
                            <input class="form-control" id="form-sletatOrderFull-seriaZagran" type="text" name="seriaZagran[]" value="" placeholder="0044">
                        </div>
                        <div class="col-xs-12">
                            <input class="form-control" id="form-sletatOrderFull-numberZagran" type="text" name="numberZagran[]" value="" placeholder="123456">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <label class="control-label" for="form-sletatOrderFull-name">Дата выдачи:</label>
                    <input class="form-control" id="form-sletatOrderFull-name" type="date" name="dateZagran[]" value="">
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <label class="control-label" for="form-sletatOrderFull-srokZagran">Срок действия:</label>
                    <input class="form-control" id="form-sletatOrderFull-srokZagran" type="date" name="srokZagran[]" value="">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-24">
                <div class="form-group">
                    <label class="control-label" for="form-sletatOrderFull-ktoZagran">Кем выдан:</label>
                    <input class="form-control" id="form-sletatOrderFull-ktoZagran" type="text" name="ktoZagran[]" value="">
                </div>
            </div>
        </div>
        <hr/>
    @endfor

    <p class="h2">Информация о заказчике:</p>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label class="control-label" for="form-sletatOrderFull-fio">ФИО:</label>
                <input class="form-control" id="form-sletatOrderFull-fio" type="text" name="fio" value="">
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group">
                <label class="control-label" for="form-sletatOrderFull-address">Адрес:</label>
                <input class="form-control" id="form-sletatOrderFull-address" type="text" name="address" value="">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label class="control-label" for="form-sletatOrderFull-tel">Телефон:</label>
                <input class="form-control" id="form-sletatOrderFull-tel" type="text" name="tel" value="">
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group">
                <label class="control-label" for="form-sletatOrderFull-email">Email:</label>
                <input class="form-control" id="form-sletatOrderFull-email" type="email" name="email" value="">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label class="control-label" for="form-sletatOrderFull-passport">Серия и номер российского паспорта:</label>
                <input class="form-control" id="form-sletatOrderFull-passport" type="text" name="passport" value="">
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group">
                <label class="control-label" for="form-sletatOrderFull-passportDate">Кем выдан и когда:</label>
                <input class="form-control" id="form-sletatOrderFull-passportDate" type="text" name="passportDate" value="">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-24">
            <div class="form-group">
                <label class="control-label" for="form-sletatOrderFull-comment">Комментарий:</label>
                <textarea class="form-control" id="form-sletatOrderFull-comment" name="comment"></textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <input type="hidden" name="sourceId" value="{{ $request['sourceId'] }}">
                <input type="hidden" name="offerId" value="{{ $request['offerId'] }}">
                <input type="hidden" name="countryId" value="{{ $request['countryId'] }}">
                <input type="hidden" name="requestId" value="{{ $request['requestId'] }}">
                <input type="hidden" name="countryName" value="{{ $countryName }}">
                <input type="hidden" name="cityFromName" value="{{ $cityFromName }}">
                <input type="hidden" name="currencyAlias" value="{{ $currencyAlias }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button type="submit" class="btn btn-default btn-block">Отправить заявку</button>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group">
                <label>
                    <input type="checkbox" name="oferta" value="1"> Я согласен с условиями <a href="#">оферты</a>
                </label>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-24">
            <p>После заказа тура менеджер турагенства проверит состав и стоимость тура у туроператора, затем отправит
                Вам по электронной почте виртуальный счет на оплату тура. Также вы получите СМС оповещение на указанный
                номер мобильного телефона. Оплату вы сможете произвести с помощью своей банковской карты.</p>
        </div>
    </div>
</form>
@push('scripts')
    {!! JsValidator::formRequest('App\Http\Requests\SletatOrderFullRequest', '#form-sletatOrderFull') !!}
@endpush