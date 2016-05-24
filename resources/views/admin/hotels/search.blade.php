@extends('admin.main')
@section('title') {{ $app['name'] }} admin @endsection

@section('content')
    <div class="ibox float-e-margins">
        <div class="ibox-title background-transparent">
            <h1>Поиск по отелям</h1>
        </div>
    </div>

    <div class="ibox float-e-margins">
        <form action="/admin/hotels/search" method="post">
            <div class="input-group">
                <input type="text" class="form-control" name="search" value="{{ Request::get('search') }}" placeholder="Название отеля">
                    <span class="input-group-btn">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-default">Поиск</button>
                  </span>
            </div>
        </form>
    </div>

    <div class="ibox float-e-margins">
        <div class="ibox-content">
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>Курорт</th>
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
        </div>
    </div>
    <br/>

    <div class="ibox float-e-margins">
        <div class="ibox-content">
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th></th>
                    <th>Тур</th>
                    <th>URL</th>
                    <th width="90">Порядок</th>
                    <th width="93"></th>
                    <th width="90"></th>
                    <th width="90"></th>
                </tr>
                </thead>
                <tbody>
                @include('admin.tours.include-list-tovars', array('data' => $hotels, 'app' => $app))
                </tbody>
            </table>
        </div>
    </div>
@endsection