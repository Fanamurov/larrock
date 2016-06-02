<form action="/forms/sletatOrderShort" method="post" id="form-sletatOrderShort" class="form-sletatOrderShort" onsubmit="yaCounter27992118.reachGoal('SletatOrder'); return true;">
    <p class="h1">Отправить заявку на бронирование тура</p>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label class="control-label" for="form-sletatOrderShort-name">Ваше имя:</label>
                <input class="form-control" id="form-sletatOrderShort-name" type="text" name="name" value="">
            </div>
            <div class="form-group">
                <label class="control-label" for="form-sletatOrderShort-tel">Телефон:</label>
                <input class="form-control" id="form-sletatOrderShort-tel" type="text" name="tel" value="">
            </div>
            <div class="form-group">
                <label class="control-label" for="form-sletatOrderShort-email">Email:</label>
                <input class="form-control" id="form-sletatOrderShort-email" type="email" name="email" value="">
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group">
                <label class="control-label" for="form-sletatOrderShort-comment">Комментарий:</label>
                <textarea class="form-control" id="form-sletatOrderShort-comment" name="comment"></textarea>
            </div>
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
    </div>
</form>
@push('scripts')
{!! JsValidator::formRequest('App\Http\Requests\SletatOrderShortRequest', '#form-sletatOrderShort') !!}
@endpush