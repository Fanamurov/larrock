@extends('front.main')
@section('title') {{ $seo['title'] }} @endsection

@section('content')
    <h1>Корзина товаров </h1>
    <table class="table">
        <thead>
        <tr>
            <th></th>
            <th>Товар</th>
            <th>Количество</th>
            <th>Цена руб./шт.</th>
            <th>Итого</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($cart as $row)
            <tr data-rowid="{{ $row->rowid }}">
                <td>
                    @if(count($row->catalog->get_images) === 0)
                        <img src="/_assets/_front/_images/empty_big.png" alt="Not Photo" width="50">
                    @else
                        @foreach($row->catalog->get_images as $image)
                            <img src="/images/catalog/140-140/{{ $image->name }}" alt="{{ $row->name }}">
                        @endforeach
                    @endif
                </td>
                <td>
                    <p>{{ $row->name }}</p>
                </td>
                <td><input type="text" value="{{ $row->qty }}" class="form-control editQty" data-rowid="{{ $row->rowid }}"></td>
                <td>{{ $row->price }} руб.</td>
                <td class="subtotal"><span>{{ $row->subtotal }}</span> руб.</td>
                <td><button type="button" class="removeCartItem btn btn-primary" data-rowid="{{ $row->rowid }}">Удалить</button></td>
            </tr>
        @endforeach
        <tr>
            <td colspan="6">
                <p class="text-right">Всего к оплате: <strong class="total">{!! Cart::total() !!}</strong> руб.</p>
            </td>
        </tr>
        </tbody>
    </table>
@endsection