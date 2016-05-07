<header class="row">
    <div class="col-xs-8 col-sm-14 col-md-15 col-md-offset-1 header-logo">
        <a href="/">
            <img src="/_assets/_santa/_images/logo.png" alt="Туристическая компания Санта-Авиа Хабаровск" class="pull-left logo">
            <span>Отдыхать - правильно!</span>
        </a>
    </div>
    <div class="col-xs-16 col-sm-10 col-md-8 header-address">
        <p><span class="city">г.Хабаровск</span>, ул.&nbsp;Шеронова,&nbsp;115<br/>
            <a href="tel:84212454546" class="phone">(4212) 45-45-46</a>
    </div>
    <div class="col-xs-24 hidden-md hidden-lg">
        <button type="button" class="btn btn-default btn-block show-mobile-menu hidden-md hidden-lg">Показать меню</button>
        <form action="" method="get" class="menu_mobile">
            <div class="form-group">
                <select name="countrys_menu" class="form-control">
                    <option>Страны</option>
                    @foreach($menu_mobile['countries'] as $key => $item)
                        <option @if(Route::current()->getParameter('category') === $item) selected @endif value="/tours/strany/{{ $item }}">{{ $key }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <select name="vidy_menu" class="form-control">
                    <option>Виды отдыха</option>
                    @foreach($menu_mobile['vidy'] as $key => $item)
                        <option @if(Route::current()->getParameter('category') === $item) selected @endif value="/tours/vidy-otdykha/{{ $item }}">{{ $key }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <select name="uslugi_menu" class="form-control">
                    <option>Наши услуги</option>
                    @foreach($menu_mobile['uslugi'] as $key => $item)
                        <option @if('/page/'. Route::current()->getParameter('url') === $item) selected @endif
                        @if(Route::current()->getParameter('url') === $item) selected @endif
                        value="{{ $item }}">{{ $key }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                @foreach($menu_mobile['other'] as $key => $item)
                    <button type="button" class="btn btn-primary btn-block" data-value="{{ $item }}">{{ $key }}</button>
                @endforeach
            </div>
        </form>
    </div>
    <div class="col-xs-24 div-menu hidden-xs hiddex-sm">
        {!! \MenuApp::render('navbar') !!}
    </div>
</header>