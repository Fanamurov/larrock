@extends('front.main')
@section('title') {{ $seo['title'] }} @endsection

@section('content')
    <form class="cart-page" id="cart-page">
        <h1>Корзина товаров </h1>
        <table class="table">
            <thead>
            <tr>
                <th></th>
                <th>Товар</th>
                <th>Количество</th>
                <th>Цена {{ $cart->first()->catalog->what }}</th>
                <th>Итого</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($cart as $row)
                <tr data-rowid="{{ $row->rowid }}">
                    <td>
                        @if( !$image = $row->catalog->getFirstMediaUrl('images', '110x110'))
                            <img src="/_assets/_front/_images/empty_big.png" alt="Not Photo" width="50">
                        @else
                            <img src="{{ $image }}" alt="{{ $row->name }}" width="50">
                        @endif
                    </td>
                    <td>
                        <p>{{ $row->name }}</p>
                    </td>
                    <td><input name="qty_{{ $row->rowid }}" type="text" value="{{ $row->qty }}" class="form-control editQty" data-rowid="{{ $row->rowid }}"></td>
                    <td>{{ $row->price }}</td>
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
    </form>
@endsection

@section('scripts')
    <script src="/_assets/bower_components/jquery-validation/dist/jquery.validate.min.js"></script>
    <script src="/_assets/bower_components/jquery-validation/dist/additional-methods.min.js"></script>
    <script>
        $( "#cart-page" ).validate({
            rules: {
                @foreach($cart as $row)
                qty_{{ $row->rowid }}: {
                    required: true,
                    min: {{ $row->catalog->min_part*1000 }}
                },
                @endforeach
            },
            messages: {
                @foreach($cart as $row)
                qty_{{ $row->rowid }}: {
                    min: "Минимальная партия для заказа {{ $row->catalog->min_part*1000 }}",
                },
                @endforeach
            }
        });
    </script>
@endsection