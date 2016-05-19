@extends('admin.main')
@section('title') {{ $app['name'] }} admin @endsection

@section('content')
    <div class="ibox float-e-margins">
        <div class="ibox-title background-transparent">
            {!! Breadcrumbs::render('all.tours.admin', $data) !!}
            <div class="add-panel">
                <a class="btn btn-info pull-right" href="/admin/{{ $app['name'] }}/create">Добавить тур</a>
            </div>
        </div>
    </div>

    <div class="ibox float-e-margins">
        <form action="/admin/tours/search" method="post">
            <div class="input-group">
                <input type="text" class="form-control" name="search" value="" placeholder="Название курорта/тура">
                    <span class="input-group-btn">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-default">Поиск</button>
                  </span>
            </div>
        </form>
    </div>

    <div class="ibox float-e-margins">
        <div class="ibox-content">
            @if(count($data) === 0)
                <div class="alert alert-warning">Туров еще нет</div>
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
                    @include('admin.tours.include-list-tovars', array('data' => $data, 'app' => $app))
                    </tbody>
                </table>
                {!! $data->render() !!}
            @endif
        </div>
    </div>
@endsection