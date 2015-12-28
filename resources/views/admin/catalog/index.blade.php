@extends('admin.main')
@section('title') {{ $app['name'] }} admin @endsection

@section('content')
    <div class="ibox float-e-margins">
        <div class="ibox-title background-transparent">
            <div>
                <h1 class="inline">{{ $app['title'] }}</h1>
                <a href="/{{ $app['name'] }}/">/{{ $app['name'] }}/</a>
                <div class="add-panel">
                    <a class="btn btn-info pull-right" href="/admin/{{ $app['name'] }}/create?category=0">Добавить товар</a>
                    <span class="btn btn-info show-please" data-target="create-category" data-focus="create-category-title">Добавить раздел</span>
                </div>
            </div>
        </div>
    </div>

    <div class="ibox float-e-margins">
        <div class="ibox-content">
            @if(count($data) === 0)
                <div class="alert alert-warning">Разделов еще нет</div>
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
                    @if(count($data) === 0)
                        <div class="alert alert-warning">Разделов еще нет</div>
                    @else
                        @include('admin.category.include-create-easy', array('parent' => 0, 'type' => 'catalog'))
                        @include('admin.category.include-list-categories', array('data' => $data, 'app' => $app))
                        @foreach($data as $data_value)
                            @include('admin.catalog.include-list-tovars', array('data' => $data_value->get_tovars, 'app' => $app))
                        @endforeach
                    @endif
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection