@extends('admin.main')
@section('title') {{ $app['name'] }} admin @endsection

@section('content')
    <div class="ibox float-e-margins">
        <div class="ibox-title background-transparent">
            {!! Breadcrumbs::render('admin.catalog.category', $data) !!}
            <a href="/{{ $app['name'] }}/{{ $data->url }}">/{{ $app['name'] }}/{{ $data->url }}</a>
            <div class="add-panel">
                <a class="btn btn-info pull-right" href="/admin/{{ $app['name'] }}/create?category={{ $data->id }}">Добавить товар</a>
                <span class="btn btn-info show-please" data-target="create-category" data-focus="create-category-title">Добавить раздел</span>
            </div>
        </div>
    </div>

    <div class="ibox float-e-margins">
        <div class="ibox-content">
            @if(count($data) === 0)
                <div class="alert alert-warning">Разделов еще нет</div>
            @elseif(count($data->get_child) > 0)
                <!-- Есть вложенные разделы. Выводим из список -->
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>Название</th>
                        <th>URL</th>
                        <th width="90">Вес</th>
                        <th width="93"></th>
                        <th width="90"></th>
                        <th width="90"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="table-row-up">
                        <td colspan="7">
                            <a href="{{ $data->get_parent->url or '/admin/catalog' }}" style="font-size: 22px">
                                <i class="glyphicon glyphicon-level-up"></i>..
                            </a>
                        </td>
                    </tr>
                    @include('admin.category.include-create-easy', array('parent' => $data->id, 'type' => 'catalog'))
                    @include('admin.category.include-list-child-categories', array('data' => $data, 'app' => $app))
                    @include('admin.catalog.include-list-tovars', array('data' => $data->get_tovars, 'app' => $app))
                    </tbody>
                </table>
            @else
                <!-- Таблица товаров, вложенных разделов нет -->
                @if(count($data->get_tovars) === 0)
                    <div class="alert alert-warning">Товаров еще нет</div>
                @else
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>Название</th>
                            <th>URL</th>
                            <th width="90" data-toggle="tooltip" data-placement="bottom" title="Вес. Чем больше, тем выше в списках">Вес</th>
                            <th width="93"></th>
                            <th width="90"></th>
                            <th width="90"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="table-row-up">
                            <td colspan="7">
                                <a href="{{ $data->get_parent->id or '/admin/catalog' }}" style="font-size: 22px">
                                    <i class="glyphicon glyphicon-level-up"></i>..
                                </a>
                            </td>
                        </tr>
                        @include('admin.category.include-create-easy', array('parent' => $data->id, 'type' => 'catalog'))
                        @include('admin.catalog.include-list-tovars', array('data' => $data->get_tovars, 'app' => $app))
                        </tbody>
                    </table>
                @endif
            @endif
        </div>
    </div>
@endsection