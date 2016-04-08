@extends('admin.main')
@section('title') {{ $app['name'] }} admin @endsection

@section('content')
    <div class="ibox float-e-margins">
        <div class="ibox-title background-transparent">
            <h1 class="inline">
                <a href="/admin/{{ $app['name'] }}">{{ $app['title'] }}</a>/
                /Новый раздел
            </h1>
            <a href="/{{ $app['name'] }}/">/{{ $app['name'] }}/</a>
        </div>

        <div>
            <div class="tabbable main-tabbable">
                <ul class="nav nav-tabs">
                    @foreach($tabs as $tabs_key => $tabs_value)
                        <li class="tab{{ $tabs_key }} @if($tabs_key === 'main') active @endif">
                            <a href="#tab{{ $tabs_key }}" data-toggle="tab">{{ $tabs_value }}</a>
                        </li>
                        @if($tabs_key === 'main')
                            <li class="tabimages">
                                <a href="#tabimages" data-toggle="tab">Фото</a>
                            </li>
                            <li class="tabfiles">
                                <a href="#tabfiles" data-toggle="tab">Файлы</a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="ibox-content">
            <form action="/admin/{{ $app['name'] }}" method="POST">
                <input name="type_connect" type="hidden" value="{{ $app['name'] }}">
                <input name="id_connect" type="hidden" value="{{ $id }}">
                <div class="tabbable main-tabbable">
                    <div class="tab-content">
                        @foreach($tabs as $tabs_key => $tabs_value)
                            <div class="tab-pane @if($tabs_key === 'main') active @endif" id="tab{{ $tabs_key }}">
                                {!! $form[$tabs_key] !!}
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="form-group text-right">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <button type="submit" class="btn btn-info">Сохранить</button>
                </div>
            </form>

            @include('admin.plugins.tabDownloadImage')
            @include('admin.plugins.tabDownloadFile')
        </div>
    </div>
@endsection