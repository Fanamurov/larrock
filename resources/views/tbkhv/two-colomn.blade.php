<!DOCTYPE html>
<html lang="ru">
@include('tbkhv.sections.head')
<body>
@include('tbkhv.sections.headerLine')
<div class="container container-body body-two-colomn">
    <header class="row">
        <div class="col-xs-5">
            <div class="col-xs-22 col-xs-offset-0">
                <a href="/" class="logo">
                    <img src="/_assets/tbkhv/_images/logo.png" width="225" height="49" alt="Company name">
                </a>
            </div>
        </div>
        <div class="col-xs-offset-1 col-xs-18">
            @include('tbkhv.sections.headBenefits')
        </div>
    </header>

    <div class="header-top_menu">
        <div class="col-xs-6 block-categories pointer show_menu">
            <span class="text-uppercase"><i class="fa fa-reorder"></i> Категории товаров</span>
        </div>
        <div class="col-xs-18 form-search-block">
            @include('tbkhv.modules.form.search-main')
        </div>
    </div>
    <div class="clearfix"></div>

    <div class="row">
        <div class="menu_hidden hidden">
            @include('tbkhv.modules.menu.catalog-left')
        </div>
        <div class="col-xs-24 col-md-6 colomn-left">
            <section class="block-filters container-fluid">
                @yield('filters')
            </section>
        </div>
        <div class="col-xs-24 col-md-18">
            @if(Route::current()->getName() !== 'otapi.index')
                @if(Route::current()->getName() !== 'mainpage')
                    <section class="block-breadcrumbs">
                        @yield('breadcrumbs')
                    </section>
                @endif
            @endif

            <section class="row" id="content">
                <div class="col-xs-24">
                    @include('front.errors')
                    @yield('content')
                </div>
            </section>
        </div>
    </div>
</div>
<a href="#all" title="Переместиться наверх страницы" id="toTop"></a>
@include('tbkhv.sections.footer')
@include('tbkhv.sections.bottomScripts')
@stack('scripts')
</body>
</html>