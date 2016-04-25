@extends('admin.main')
@section('title') {{ $app['name'] }} admin @endsection

@section('content')
    <div class="ibox float-e-margins">
        <div class="ibox-title background-transparent">
            {!! Breadcrumbs::render('admin.tours.category', $data) !!}
            <a href="/{{ $app['name'] }}/{{ $data->url }}">/{{ $app['name'] }}/{{ $data->url }}</a>
            <div class="add-panel">
                <a class="btn btn-info pull-right" href="/admin/{{ $app['name'] }}/create?category={{ $data->id }}">Добавить тур</a>
                <span class="btn btn-info show-please" data-target="create-category" data-focus="create-category-title">Добавить раздел</span>
                <a class="btn btn-default btn-sm" href="/admin/category/{{ $data->id }}/edit">Изменить раздел</a>
            </div>
        </div>
    </div>

    <div class="ibox float-e-margins">
        <div class="ibox-content">
            @if(count($data) === 0)
                <div class="alert alert-warning">Стран еще нет</div>
                @include('admin.category.include-create-easy', array('parent' => $data->id, 'type' => 'tours'))
            @else
                @if(count($data->get_child) === 0)
                    <table class="table table-striped table-hover">
                        @include('admin.category.include-create-easy', array('parent' => $data->id, 'type' => 'tours'))
                        @include('admin.category.include-list-child-categories', array('data' => $data, 'app' => $app))
                    </table>
                @else
                    <!-- Есть вложенные разделы. Выводим из список -->
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
                        <tr class="table-row-up">
                            <td>
                                <a href="{{ $data->get_parent->url or '/admin/tours' }}" style="font-size: 22px">
                                    <i class="glyphicon glyphicon-level-up"></i>..
                                </a>
                            </td>
                            <td colspan="6">
                                <h2>Курорты</h2>
                            </td>
                        </tr>
                        @include('admin.category.include-create-easy', array('parent' => $data->id, 'type' => 'tours'))
                        @include('admin.category.include-list-child-categories', array('data' => $data, 'app' => $app))
                        </tbody>
                    </table>
                    {!! $paginator->render() !!}
                @endif
            @endif
        </div>
    </div>
    <br/>

    <div class="ibox float-e-margins">
        <div class="ibox-content">
            @if(count($data->get_tours) === 0)
                <div class="alert alert-warning">Туров еще нет</div>
            @else
                <!-- Есть вложенные разделы. Выводим из список -->
                <table class="table table-striped table-hover">
                    <tbody>
                    <tr class="table-row-up">
                        <td colspan="1">
                            <a href="{{ $data->get_parent->url or '/admin/tours' }}" style="font-size: 22px">
                                <i class="glyphicon glyphicon-level-up"></i>..
                            </a>
                        </td>
                        <td colspan="6">
                            <h2>Туры</h2>
                        </td>
                    </tr>
                    @include('admin.tours.include-list-tovars', array('data' => $data->get_tours, 'app' => $app))
                    </tbody>
                </table>
                {!! $paginator->render() !!}
            @endif
        </div>
    </div>
@endsection