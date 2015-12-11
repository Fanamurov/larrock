@extends('admin.layouts.main')

@section('title') {{ $app->name }} admin @endsection
@section('page_h1')
    {{ $data->title }}
@endsection
@section('page_h1_new', 'страницы')
@section('app_name'){{ $app->name }}@endsection
@section('app_title') {{ $app->title }} @endsection

@section('content')
    <div class="ibox float-e-margins">
        <div class="ibox-title background-transparent">
            <h1 class="inline"><span class="text-muted">Ленты/</span>{{ $category->title }}/{{ $data->title }}</h1>
            <a href="/feed/{{ $category->url}}">/feed/{{ $category->url}}/{{ $data->url }}</a>
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
            <form action="/admin/{{ $app->name }}/{{ $data->id }}" method="POST">
                <input name="_method" type="hidden" value="PUT">
                <input name="type_connect" type="hidden" value="{{ $app->name }}">
                <input name="id_connect" type="hidden" value="{{ $id }}">
                <div class="tabbable main-tabbable">
                    <div class="tab-content">
                        @foreach($tabs as $tabs_key => $tabs_value)
                            <div class="tab-pane @if($tabs_key === 'main') active @endif" id="tab{{ $tabs_key }}">
                                {!! $form[$tabs_key] !!}
                            </div>
                        @endforeach
                        @if($tabs_key === 'main')

                        @endif
                    </div>
                </div>

                <div class="form-group text-right">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <button type="submit" class="btn btn-info"><i class="fa fa-pencil"></i> Сохранить</button>
                </div>
            </form>

            <div class="tab-content">
                <div class="tab-pane" id="tabimages">
                    <div class="form-group">
                        <form action="{{ action('Admin\Ajax@UploadImage') }}" method="post" enctype="multipart/form-data" id="plugin_image">
                            <input type="hidden" name="folder" value="{{ $app->name }}">
                            <input type="hidden" name="id_connect" value="{{ $data->id }}">
                            <input type="hidden" name="param" value="{{ $data->url }}">
                            <input type="file" name="images[]" id="upload_image_filer" multiple="multiple">
                            <input type="submit" value="Submit" class="btn btn-info hidden">
                        </form>
                    </div>
                </div>
            </div>

            <div class="tab-content">
                <div class="tab-pane" id="tabfiles">
                    <div class="form-group">
                        <form action="{{ action('Admin\Ajax@UploadFile') }}" method="post" enctype="multipart/form-data" id="plugin_files">
                            <input type="hidden" name="folder" value="{{ $app->name }}">
                            <input type="hidden" name="id_connect" value="{{ $data->id }}">
                            <input type="hidden" name="param" value="{{ $data->url }}">
                            <input type="file" name="files[]" id="upload_file_filer" multiple="multiple">
                            <input type="submit" value="Submit" class="btn btn-info hidden">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection