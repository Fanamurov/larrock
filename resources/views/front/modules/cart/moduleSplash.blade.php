<div class="moduleCart">
    @if(Cart::count() < 1)
        <p><img src="/_assets/_front/_images/icons/icon_cart_black.png" alt="Перейти в корзину"> Корзина пуста</p>
    @else
        <p><a href="/cart">
                <img src="/_assets/_front/_images/icons/icon_cart_black.png" alt="Перейти в корзину">
                Товаров на сумму <span class="total_cart">{!! Cart::total() !!}</span> р.</a></p>
    @endif
</div>


@include('front.modals.addToCart')