@extends('admin.main')
@section('title') {{ $app['name'] }} admin @endsection

@section('content')
    <div class="ibox float-e-margins">
        <div class="ibox-title background-transparent">
            <div>
                {!! Breadcrumbs::render('admin.tours.author') !!}
            </div>
        </div>
    </div>

    <div class="ibox float-e-margins">
        <form action="/admin/tours/searchAuthor" method="post">
            <div class="input-group">
                <input type="text" class="form-control" name="search" value="" placeholder="Имя менеджера">
                    <span class="input-group-btn">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-default">Поиск</button>
                  </span>
            </div>
        </form>
    </div>

    <div class="ibox float-e-margins">
        <div class="ibox-content">
            @if(count($tours) === 0)
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
                    <tbody>
                    <tr class="table-row-up">
                        <td colspan="1">
                        </td>
                        <td colspan="6">
                            <h2>Туры</h2>
                        </td>
                    </tr>
                    @include('admin.tours.include-list-tovars', array('data' => $tours, 'app' => $app))
                    </tbody>
                </table>
                {!! $tours->render() !!}
            @endif
        </div>
    </div>
    <br/>

    <div class="ibox float-e-margins">
        <div class="ibox-content">
            @if(count($categories) === 0)
                <div class="alert alert-warning">У автора нет материалов</div>
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
                    @include('admin.category.include-list-categories', array('data' => $categories, 'app' => $app))
                    </tbody>
                </table>
                {!! $categories->render() !!}
            @endif
        </div>
    </div>
@endsection