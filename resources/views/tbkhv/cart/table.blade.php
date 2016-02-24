@extends('tbkhv.main')
@section('title') {{ $seo['title'] }} @endsection

@section('content')
    <div class="page_cart">
        <h1 class="text-center">Оформление заказа</h1><br/>
        <table class="table">
            <tbody>
            @foreach($cart as $row)
                <tr data-rowid="{{ $row->rowid }}">
                    <td width="250px">
                        <a href="/otapi/{{ (string)$tao_items[$row->id]->OtapiItemFullInfo->CategoryId }}/tovar/{{ (string)$tao_items[$row->id]->OtapiItemFullInfo->Id }}">
                            <img src="{{ (string)$tao_items[$row->id]->OtapiItemFullInfo->MainPictureUrl }}" class="all-width" alt="Фото товара">
                        </a>
                        <br/><br/>
                    </td>
                    <td>
                        <p>
                            <a href="/otapi/{{ (string)$tao_items[$row->id]->OtapiItemFullInfo->CategoryId }}/tovar/{{ (string)$tao_items[$row->id]->OtapiItemFullInfo->Id }}">
                                {{ $row->name }}
                            </a>
                        </p>
                        <p>{{ (string)$tao_items[$row->id]->OtapiItemFullInfo->Title }}</p>
                        <p>
                        <p><i><a href="{{ (string)$tao_items[$row->id]->OtapiItemFullInfo->TaobaoItemUrl }}">[Этот товар на таобао]</a></i></p>
                        </p>
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
            <form action="" method="post" class="row">
                <div class="col-sm-8 col-sm-offset-1">
                    <div class="form-group">
                        <label class="control-label">Ваше ФИО:</label>
                        <input type="text" class="form-control" value="">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Номер телефона:</label>
                        <input type="text" class="form-control" value="">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Адрес получателя:</label>
                        <input type="text" class="form-control" value="">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Комментарий к заказу:</label>
                        <textarea class="form-control"></textarea>
                    </div>
                </div>
                <div class="col-sm-9 col-sm-offset-3">
                    <div class="form-group">
                        <label class="control-label">Метод оплаты:</label>
                        <select class="form-control">
                            <option>Пластиковые карты Visa</option>
                            <option>Пластиковые карты Mastercard</option>
                            <option>Yandex.Money</option>
                            <option>Webmoney</option>
                            <option>Перевод на банковский счет</option>
                            <option>Наличный рассчет</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Метод доставки:</label>
                        <select class="form-control">
                            <option>Забрать в нашем пункте выдачи</option>
                            <option>Доставка нашим курьером</option>
                            <option>Доставка EMS</option>
                            <option>Доставка Pony Express</option>
                            <option>Доставка DHL</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label">
                            <input type="checkbox" value="1">
                            Я согласен с <a href="#" target="_blank">пользовательским соглашением</a>
                        </label>
                    </div>
                    <div class="form-group">
                        <label class="control-label">
                            <input type="checkbox" value="1">
                            Я согласен с <a href="#" target="_blank">публичной офертой</a>
                        </label>
                    </div>
                    <hr/>
                    <div class="form-group">
                        <button class="btn btn-success" type="submit">Отправить заявку менеджеру</button>
                        <p>* наш менеджер проверит наличие товара у продавцов и свяжется с Вами</p>
                    </div>
                </div>
            </form>
            <br/>
        </div>
    </div>
@endsection