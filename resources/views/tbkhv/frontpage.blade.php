<!DOCTYPE html>
<html lang="ru">
@include('tbkhv.sections.head')
<body class="mainpage">
@include('tbkhv.sections.headerLine')
<div class="container container-body">
    @include('tbkhv.sections.header')

    <div class="row">
        <div class="col-xs-24 col-sm-6 mainpage-menus">
            @include('tbkhv.modules.menu.catalog-left', ['menu' => $menu])
        </div>
        <div class="col-xs-24 col-sm-18">
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
</body>
</html>