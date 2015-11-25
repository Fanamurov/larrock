<div class="wrapper">
    <h1 class="inline"><a class="text-capitalize" href="/admin/@yield('app_name')"><i class="fa fa-arrow-left btn-small"></i> @yield('app_title')</a> / @yield('page_h1', 'Default title')</h1>
    <a class="btn btn-default btn-outline pull-right add-panel" href="/admin/@yield('app_name')/create"><i class="fa fa-plus"></i> Создание @yield('page_h1_new')</a>
    @section('title_panel')@endsection
</div>