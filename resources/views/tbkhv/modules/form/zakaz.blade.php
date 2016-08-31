<div class="form-order" id="form-order">
    <h2 class="text-center">Ваши контактные данные для заказа</h2><br/>
    <form action="/form/order" method="post" class="row" id="form-zakaz">
        <div class="col-sm-8 col-sm-offset-1">
            <div class="form-group">
                <label class="control-label">Ваше ФИО:</label>
                <input type="text" class="form-control" value="" name="name">
            </div>
            <div class="form-group">
                <label class="control-label">Номер телефона:</label>
                <input type="text" class="form-control" value="" name="tel">
            </div>
            <div class="form-group">
                <label class="control-label">Адрес получателя:</label>
                <input type="text" class="form-control" value="" name="address">
            </div>
            <div class="form-group">
                <label class="control-label">Комментарий к заказу:</label>
                <textarea class="form-control" name="comment"></textarea>
            </div>
        </div>
        <div class="col-sm-9 col-sm-offset-3">
            <div class="form-group">
                <label class="control-label">Метод оплаты:</label>
                <select class="form-control" name="method_pay">
                    <option value="Пластиковые карты Visa, Mastercard">Пластиковые карты Visa, Mastercard</option>
                    <option value="Yandex.Money">Yandex.Money</option>
                    <option value="Webmoney">Webmoney</option>
                    <option value="Перевод на банковский счет">Перевод на банковский счет</option>
                    <option value="Наличный рассчет">Наличный рассчет</option>
                </select>
            </div>
            <div class="form-group">
                <label class="control-label">Метод доставки:</label>
                <select class="form-control" name="method_delivery">
                    <option value="Забрать в нашем пункте выдачи">Забрать в нашем пункте выдачи</option>
                    <option value="Доставка нашим курьером">Доставка нашим курьером</option>
                    <option value="Доставка EMS">Доставка EMS</option>
                    <option value="Доставка Pony Express">Доставка Pony Express</option>
                    <option value="Доставка DHL">Доставка DHL</option>
                </select>
            </div>
            <div class="form-group">
                <label class="control-label">
                    <input type="checkbox" value="1" name="sogl">
                    Я согласен с <a href="#" target="_blank">пользовательским соглашением</a>
                </label>
            </div>
            <div class="form-group">
                <label class="control-label">
                    <input type="checkbox" value="1" name="oferta">
                    Я согласен с <a href="#" target="_blank">публичной офертой</a>
                </label>
            </div>
            <hr/>
            <div class="form-group">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <button class="btn btn-warning btn-block btn-lg" type="submit">Отправить заявку менеджеру</button>
                <p class="muted">* наш менеджер проверит наличие товара у продавцов и свяжется с Вами</p>
            </div>
        </div>
    </form>
    <br/>
</div>
@push('scripts')
{!! JsValidator::formRequest('App\Http\Requests\ZakazRequest', '#form-zakaz') !!}
@endpush