<div class="moduleCart">
    @if(Cart::count() < 1)
        <p class="empty_cart-text"><i class="fa fa-shopping-cart"></i> Корзина пока пуста</p>
    @else
        <p><a href="/cart">
                <i class="fa fa-shopping-cart"></i>
                Товаров на сумму <span class="total_cart">{!! Cart::total() !!}</span> руб. ({!! Cart::count() !!} шт.)</a></p>
    @endif
</div>


@include('tbkhv.modals.addToCart')