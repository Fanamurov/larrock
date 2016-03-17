<div class="moduleCart">
    @if(Cart::count() < 1)
        <p><img src="/_assets/_front/_images/icons/icon_cart_black.png" alt="Перейти в корзину"> Корзина пуста</p>
    @else
        <p><a href="/cart">
                <img src="/_assets/_front/_images/icons/icon_cart_black.png" alt="Перейти в корзину">
                @if(Cart::total() < 1)
                    @if(Cart::count() === 1)
                        В корзине {!! Cart::count() !!} товар
                    @elseif(Cart::count() < 6)
                        В корзине {!! Cart::count() !!} товара
                    @else
                        В корзине {!! Cart::count() !!} товаров
                    @endif
                @else
                    Товаров на сумму <span class="total_cart">{!! Cart::total() !!}</span> р.
                @endif
            </a></p>
    @endif
</div>
@include('front.modals.addToCart')