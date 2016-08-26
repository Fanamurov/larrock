<!DOCTYPE html>
<html lang="ru">
@include('tbkhv.sections.head')
<body>
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

    <section class="row" id="content">
        <div class="col-xs-24">
            @include('front.errors')
            <div class="col-xs-24">
                @yield('content')
            </div>
        </div>
    </section>
</div>
<a href="#all" title="Переместиться наверх страницы" id="toTop"></a>
@include('tbkhv.sections.footer')
@include('tbkhv.sections.bottomScripts')
@stack('scripts')
</body>
</html>