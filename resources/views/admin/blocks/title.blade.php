<div>
    <h1 class="inline"><a class="text-capitalize" href="/admin/@yield('app_name')">@yield('app_title')</a> / @yield('page_h1', 'Default title')</h1>
    <a class="btn btn-primary pull-right add-panel" href="/admin/@yield('app_name')/create">Создание @yield('page_h1_new')</a>
    @section('title_panel')@endsection
</div>