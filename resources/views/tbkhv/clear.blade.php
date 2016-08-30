<!DOCTYPE html>
<html lang="ru">
@include('tbkhv.sections.head')
<body>
@include('tbkhv.sections.headerLine')
<div class="container container-body">
    @include('tbkhv.sections.header')

    <section class="row" id="content">
        <div class="col-xs-24">
            @include('tbkhv.errors')
            <div class="col-xs-24">
                @yield('content')
            </div>
        </div>
    </section>
</div>
@include('tbkhv.sections.footer')
@include('tbkhv.sections.bottomScripts')
@stack('scripts')
</body>
</html>