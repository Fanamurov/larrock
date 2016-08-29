<!DOCTYPE html>
<html lang="ru">
@include('tbkhv.sections.head')
<body>
@include('tbkhv.sections.headerLine')
<div class="container container-body body-two-colomn">
    @include('tbkhv.sections.header')

    <div class="row">
        <div class="menu_hidden hidden">
            @include('tbkhv.modules.menu.catalog-left')
        </div>
        <div class="col-xs-24 col-sm-7 col-md-6 colomn-left">
            <section class="block-filters container-fluid">
                @yield('filters')
            </section>
            <section class="block-sub-categories container-fluid">
                @yield('sub-categories')
            </section>
        </div>
        <div class="col-xs-24 col-sm-17 col-md-18">
            @yield('breadcrumbs')

            <section class="row" id="content">
                <div class="col-xs-24">
                    @include('front.errors')
                    @yield('content')
                </div>
            </section>
        </div>
    </div>
</div>
@include('tbkhv.sections.footer')
@include('tbkhv.sections.bottomScripts')
@stack('scripts')
</body>
</html>