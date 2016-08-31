@extends('tbkhv.main')
@section('title') Корзина товаров. Оформление покупки @endsection

@section('content')
    <form class="cart-page" id="cart-page">
        <h1>Корзина товаров <a href="#form-order" class="btn btn-warning pull-right">Перейти к оформлению</a></h1>
        <table class="table">
            <thead>
            <tr>
                <th width="120"></th>
                <th></th>
                <th width="150" class="text-center">кол-во</th>
                <th width="150" class="hidden-xs">цена</th>
                <th width="150" class="hidden-xs">итого</th>
                <th width="100" class="hidden-xs"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($cart as $row)
                <tr data-rowid="{{ $row->rowid }}">
                    <td class="tovar_image">
                        @if(isset($row->options['img']) && !empty($row->options['img']))
                            <a href="/otapi/{{ $tao_items[$row->id]->CategoryId }}/tovar/{{ $tao_items[$row->id]->Id }}">
                                <img src="{{ $row->options['img'] }}" class="all-width" alt="Фото товара">
                            </a>
                        @else
                            <a href="/otapi/{{ $tao_items[$row->id]->CategoryId }}/tovar/{{ $tao_items[$row->id]->Id }}">
                                <img src="{{ $tao_items[$row->id]->MainPictureUrl }}" class="all-width" alt="Фото товара">
                            </a>
                        @endif
                    </td>
                    <td>
                        <a href="/otapi/{{ $tao_items[$row->id]->CategoryId }}/tovar/{{ $tao_items[$row->id]->Id }}">
                            {{ $row->name }}
                        </a>
                        @if(isset($row->options['config']))
                            <br/>{{ $row->options['config'] }}
                        @endif
                    </td>
                    <td>
                        <div class="input-group input-group-qty spinner-qty" data-trigger="spinner" data-cost="{{ $row->price }}" data-rowid="{{ $row->rowid }}">
                            <span class="input-group-addon addon-x" data-spin="down">-</span>
                            <input type="text" class="form-control editQty" id="kolvo-{{ $row->id }}" name="qty_{{ $row->rowid }}" value="{{ $row->qty }}"
                                   data-min="1" step="1" data-rowid="{{ $row->rowid }}">
                            <span class="input-group-addon addon-what" data-spin="up">+</span>
                        </div>
                        <hr class="hidden-sm hidden-md hidden-lg"/>
                        <button type="button" class="removeCartItem btn btn-primary hidden-sm hidden-md hidden-lg btn-block" data-rowid="{{ $row->rowid }}">Удалить</button>
                    </td>
                    <td class="cost-row hidden-xs"><small class="text-muted">x</small> <span class="price-item">{{ $row->price }}</span> <small class="text-muted">=</small></td>
                    <td class="subtotal hidden-xs"><span>{{ $row->subtotal }}</span> руб.</td>
                    <td class="hidden-xs"><button type="button" class="removeCartItem btn btn-primary" data-rowid="{{ $row->rowid }}">Удалить</button></td>
                </tr>
            @endforeach
            <tr>
                <td colspan="6">
                    <p class="text-right row-total h2">Всего к оплате: <strong class="total">{!! Cart::total() !!}</strong> руб.</p>
                </td>
            </tr>
            </tbody>
        </table>
    </form>

    <br/><br/>

    @include('tbkhv.modules.form.zakaz')
@endsection

@push('scripts')
<script>
    rebuild_cost();
</script>
@endpush