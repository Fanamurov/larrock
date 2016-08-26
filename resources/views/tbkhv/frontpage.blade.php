<!DOCTYPE html>
<html lang="ru">
@include('tbkhv.sections.head')
<body class="mainpage">
@include('tbkhv.sections.headerLine')
<div class="container container-body">
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
        <div class="col-xs-6 mainpage-menus">
            @include('tbkhv.modules.menu.catalog-left', ['menu' => $menu])
        </div>
        <div class="col-xs-18">
            @if(Route::current()->getName() !== 'otapi.index')
                @if(Route::current()->getName() !== 'mainpage')
                    <section class="block-breadcrumbs">
                        <div class="col-xs-24">
                            @yield('breadcrumbs')
                        </div>
                    </section>
                @endif
            @endif

            <section class="block-filters">
                <div class="col-xs-24">
                    @yield('filters')
                </div>
            </section>

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
<style type="text/css">
    .nav-left .menu__item{
        width: auto;
    }
</style>
</body>
</html>