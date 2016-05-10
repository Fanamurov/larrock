<div class="row row-zakazTura row-zakazSert" id="row-zakazSert">
    <div class="col-xs-24 col-sm-12">
        <form id="form-zakazSert" class="form-zakaz" method="post" action="/forms/zakazSert">
            <h2 class="h1">Заказ подарочного сертификата</h2>
            <div class="form-group">
                <label for="form-contact-tel" class="control-label">Ваш телефон<sup>*</sup>:</label>
                <input type="text" class="form-control" id="form-contact-tel" placeholder="Номер телефона" name="tel">
            </div>
            <div class="form-group">
                <label for="form-contact-email" class="control-label">Ваш email<sup>*</sup>:</label>
                <input type="email" class="form-control" id="form-contact-email" placeholder="Email" name="email">
            </div>
            <div class="form-group">
                <label for="form-contact-summa" class="control-label">Номинал сертификата<sup>*</sup>:</label>
                <input type="text" class="form-control" id="form-contact-summa" placeholder="Сумма" name="summa">
            </div>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <button type="submit" class="btn btn-default pull-right" name="submit_zakaz">Оставить заявку</button>
            <div class="clearfix"></div>
            <br/>
            <p>Так же вы можете заказать подарочный сертификат
                по телефону: (4212) 45-45-46
                или заказать <a href="/page/kontakty/">у нас в офисе</a></p>
        </form>
    </div>
    <div class="col-xs-24 col-sm-11 col-sm-offset-1">
        <br/><br/>
        <p>
            <strong>Пожалуйста, прочитайте правила пользования сертификатом:</strong>
        </p>
        <ul>
            <li>Сертификат действителен в течение 1 года с момента приобретения;</li>
            <li>При утере не восстанавливается;</li>
            <li>Сертификат нельзя обменять на денежный эквивалент, указанный в сертификате;</li>
            <li>Сертификат может быть использован один раз, неиспользованный остаток по сумме сгорает;</li>
            <li>При оплате тура заключается договор, регулирующий отношения между сторонами;</li>
            <li>Подарочные сертификаты принимаются в каждом офисе компании ООО «Санта-Авиа Хабаровск».</li>
        </ul>
    </div>
</div>
@push('scripts')
{!! JsValidator::formRequest('App\Http\Requests\ZakazSertRequest', '#form-zakazSert') !!}
@endpush