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
        <form class="form-searchTour form-siteSearch" action="" method="get">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="control-label" for="form-searchTour-vid">Вид отдыха:</label>
                        <select name="vid" class="form-control" id="form-searchTour-vid">
                            <option value="">любой</option>
                            @foreach($siteSearch['vidy'] as $item)
                                <option @if(Request::get('vid') == $item->id) selected @endif value="{{ $item->id }}">{{ $item->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label class="control-label" for="form-searchTour-country">Страна:</label>
                        <select name="country" class="form-control" id="form-searchTour-country">
                            <option value="">любая</option>
                            @foreach($siteSearch['countries'] as $item)
                                <option value="{{ $item->url }}" @if($item->url == Request::get('country')) selected @endif>{{ $item->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label class="control-label" for="form-searchTour-resort">Курорт:</label>
                        <select name="resort" class="form-control" id="form-searchTour-resort">
                            <option value="">любой</option>
                            @foreach($siteSearch['resorts'] as $item)
                                <option value="{{ $item->url }}" @if($item->url == Request::get('resort')) selected @endif>{{ $item->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label class="control-label" for="form-searchTour-sort">Сортировка:</label>
                        <select name="sort" class="form-control" id="form-searchTour-sort">
                            <option value="updated_at" @if('updated_at' === Request::get('sort', 'updated_at')) selected @endif>по дате добавления</option>
                            <option value="sharing" @if('sharing' === Request::get('sort')) selected @endif>по шарингу</option>
                            <option value="loads" @if('loads' === Request::get('sort')) selected @endif>по популярности [not work]</option>
                            <option value="actual" @if('actual' === Request::get('sort')) selected @endif>сначала устаревшие</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label></label>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="submit" class="btn btn-default btn-block">Найти туры</button>
                    </div>
                </div>
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
                {!! $paginator->render() !!}
            @endif
        </div>
    </div>
@endsection