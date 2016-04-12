<div class="moduleCart-menu">
    <p class="cart-empty @if(Cart::count() > 0) hidden @endif"><img src="/_assets/_front/_images/icons/icon_cart_white.png" alt="Перейти в корзину"> Корзина пуста</p>
    <p class="cart-show @if(Cart::count() < 1) hidden @endif">
        <a href="/cart">
            <img src="/_assets/_front/_images/icons/icon_cart_black.png" alt="Перейти в корзину">
            В корзине на сумму <span class="total_cart">{!! Cart::total() !!}</span> р.
        </a>
    </p>
</div>