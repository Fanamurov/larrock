@extends('admin.main')
@section('title') {{ $app['name'] }} admin @endsection

@section('content')
    <div class="ibox float-e-margins">
        <div class="ibox-title background-transparent">
            <div>
                {!! Breadcrumbs::render('admin.news.index') !!}
                <a href="/{{ $app['name'] }}/">/{{ $app['name'] }}/</a>
                <div class="add-panel">
                    <a class="btn btn-info pull-right" href="/admin/{{ $app['name'] }}/create">Добавить материал</a>
                    <span class="btn btn-info show-please" data-target="create-category" data-focus="create-category-title">Добавить раздел</span>
                </div>
            </div>
        </div>
    </div>

    <div class="ibox float-e-margins">
        <div class="ibox-content">
            @if(count($data) === 0)
                <div class="alert alert-warning">Разделов еще нет</div>
                @include('admin.category.include-create-easy', array('parent' => 0, 'type' => 'news'))
            @else
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th></th>
                        <th>Название</th>
                        <th>URL</th>
                        <th width="90">Порядок</th>
                        <th width="93"></th>
                        <th width="90"></th>
                        <th width="90"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($data) === 0)
                        <div class="alert alert-warning">Разделов еще нет</div>
                        @include('admin.category.include-create-easy', array('parent' => 0, 'type' => 'news'))
                    @else
                        @include('admin.category.include-create-easy', array('parent' => 0, 'type' => 'news'))
                        @include('admin.category.include-list-categories', array('data' => $data, 'app' => $app))
                    @endif
                    </tbody>
                </table>
                {!! $data->render() !!}
            @endif
        </div>
    </div>
@endsection