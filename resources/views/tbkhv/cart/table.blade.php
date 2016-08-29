@extends('tbkhv.main')
@section('title') Корзина товаров. Оформление покупки @endsection

@section('content')
    <div class="page_cart">
        <h1 class="text-center">Оформление заказа</h1><br/>
        <table class="table">
            <tbody>
            @foreach($cart as $row)
                <tr data-rowid="{{ $row->rowid }}">
                    <td width="150px">
                        @if(isset($row->options['img']) && !empty($row->options['img']))
                            <a href="/otapi/{{ $tao_items[$row->id]->CategoryId }}/tovar/{{ $tao_items[$row->id]->Id }}">
                                <img src="{{ $row->options['img'] }}" class="all-width" alt="Фото товара">
                            </a>
                        @else
                            <a href="/otapi/{{ $tao_items[$row->id]->CategoryId }}/tovar/{{ $tao_items[$row->id]->Id }}">
                                <img src="{{ $tao_items[$row->id]->MainPictureUrl }}" class="all-width" alt="Фото товара">
                            </a>
                        @endif
                        <br/><br/>
                    </td>
                    <td>
                        <p>
                            <a href="/otapi/{{ $tao_items[$row->id]->CategoryId }}/tovar/{{ $tao_items[$row->id]->Id }}">
                                {{ $row->name }}
                            </a>
                            @if(isset($row->options['config']))
                                <br/><strong>{{ $row->options['config'] }}</strong>
                            @endif
                        </p>
                        <p>{{ $tao_items[$row->id]->Title }}</p>
                        <p><i><a href="{{ $tao_items[$row->id]->TaobaoItemUrl }}">[Этот товар на таобао]</a></i></p>
                    </td>
                    <td width="160px"><span class="strong">{{ $row->price }}</span> <i>руб./шт.</i></td>
                    <td width="135px" class="Qty-col">
                        <span class="pull-left" style="color: grey; font-style: italic">X</span>
                        <input type="text" value="{{ $row->qty }}" class="form-control editQty pull-left" data-rowid="{{ $row->rowid }}">
                        <span class="pull-right" style="color: grey; font-style: italic">=</span>
                    </td>
                    <td width="135px" class="subtotal"><span class="strong-heavy">{{ $row->subtotal }}</span> руб.</td>
                    <td width="55px"><button type="button" class="removeCartItem btn btn-danger btn-sm" data-rowid="{{ $row->rowid }}"><i class="fa fa-remove"></i></button></td>
                </tr>
            @endforeach
            <tr>
                <td colspan="6">
                    <p class="text-right all-cost-cart">Всего к оплате: <strong class="total">{!! Cart::total() !!}</strong> руб.</p>
                </td>
            </tr>
            </tbody>
        </table>

        <br/><br/>

        <div class="form-order">
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
                        <button class="btn btn-success" type="submit">Отправить заявку менеджеру</button>
                        <p>* наш менеджер проверит наличие товара у продавцов и свяжется с Вами</p>
                    </div>
                </div>
            </form>
            <br/>
        </div>
    </div>
@endsection

@push('scripts')
    {!! JsValidator::formRequest('App\Http\Requests\ZakazRequest', '#form-zakaz') !!}
@endpush