<!DOCTYPE html>
<html lang="ru">
@include('tbkhv.sections.head')
<body>
@include('tbkhv.sections.headerLine')
<div class="container container-body">
    @include('tbkhv.sections.header')

    <div class="row">
        <div class="menu_hidden hidden">
            @include('tbkhv.modules.menu.catalog-left')
        </div>
        <div class="col-xs-24">
            <section class="block-breadcrumbs">
                @yield('breadcrumbs')
            </section>

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
@include('tbkhv.sections.footer')
@include('tbkhv.sections.bottomScripts')
@stack('scripts')
</body>
</html>