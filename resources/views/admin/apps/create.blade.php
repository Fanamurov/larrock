@extends('admin.layouts.main')

@section('title') {{ $apps->name }} admin @endsection
@section('page_h1', 'Создание страницы')
@section('page_h1_new', 'страницы')
@section('app_name'){{ $apps->name }}@endsection
@section('app_title') {{ $apps->title }} @endsection

@section('content')
    <form action="/admin/{{ $apps->name }}" method="POST">
        <div class="tabbable main-tabbable">
            <ul class="nav nav-tabs">
                @foreach($tabs as $tabs_key => $tabs_value)
                    <li class="tab{{ $tabs_key }} @if($tabs_key === 'main') active @endif">><a href="#tab{{ $tabs_key }}" data-toggle="tab"><i class="fa fa-cogs"></i> {{ $tabs_value }}</a></li>
                @endforeach
                <li class="tabimages">
                    <a href="#tabimages" data-toggle="tab">Фото</a>
                </li>
            </ul>
            <div class="clearfix"></div><br/><br/>
            <div class="tab-content">
                @foreach($tabs as $tabs_key => $tabs_value)
                    <div class="tab-pane @if($tabs_key === 'main') active @endif" id="tab{{ $tabs_key }}">
                        @foreach($apps->rows as $rows_key => $rows_value)
                            @if(key($rows_value['in_admin_tab']) === $tabs_key)
                                @if($rows_value['type'] === 'textarea')
                                    <div class="form-group">
                                        <label for="{{ $rows_key }}">{{ $rows_value['title'] }}</label>
                                        <textarea name="{{ $rows_key }}" class="form-control" id="{{ $rows_key }}">
                                            {{ Input::old($rows_key) }}
                                        </textarea>
                                        @if(array_key_exists('help', $rows_value))
                                            <p class="help-block">{{ $rows_value['help'] }}</p>
                                        @endif
                                    </div>
                                    <div class="clearfix"></div>
                                @elseif($rows_value['type'] === 'checkbox')
                                    <div class="form-group">
                                        <label for="{{ $rows_key }}">{{ $rows_value['title'] }}</label>
                                        <input type="checkbox" name="{{ $rows_key }}" class="form-control" id="{{ $rows_key }}"
                                               @if(Input::old($rows_key) === 1) checked @endif
                                               value="1">
                                        @if(array_key_exists('help', $rows_value))
                                            <p class="help-block">{{ $rows_value['help'] }}</p>
                                        @endif
                                    </div>
                                    <div class="clearfix"></div>
                                @elseif($rows_value['type'] === 'select')
                                    Select
                                    @if(array_key_exists('help', $rows_value))
                                        <p class="help-block">{{ $rows_value['help'] }}</p>
                                    @endif
                                    <div class="clearfix"></div>
                                @else
                                    <div class="form-group">
                                        <label for="{{ $rows_key }}">{{ $rows_value['title'] }}</label>
                                        @if(array_key_exists('typo', $rows_value))
                                            <div class="row">
                                                <div class="col-xs-10">
                                                    <input type="{{ $rows_value['type'] or 'text' }}" name="{{ $rows_key }}"
                                                           value="{{ Input::old($rows_key) }}" class="form-control" id="{{ $rows_key }}">
                                                </div>
                                                <div class="col-xs-2">
                                                    <button type="button" class="btn btn-primary btn-outline">Типограф</button>
                                                </div>
                                            </div>
                                        @else
                                            <input type="{{ $rows_value['type'] or 'text' }}" name="{{ $rows_key }}"
                                                   value="{{ Input::old($rows_key) }}" class="form-control" id="{{ $rows_key }}">
                                        @endif
                                        @if(array_key_exists('help', $rows_value))
                                            <p class="help-block">{{ $rows_value['help'] }}</p>
                                        @endif
                                    </div>
                                    <div class="clearfix"></div>
                                @endif
                            @endif
                        @endforeach
                    </div>
                @endforeach


            </div>
        </div>

        <div class="form-group text-right">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <button type="submit" class="btn btn-primary"><i class="fa fa-pencil"></i> Создать</button>
        </div>
    </form>

    <div class="tab-content">
        <div class="tab-pane" id="tabimages">
            <div class="form-group">
                <form action="{{ action('Admin\Ajax@UploadImage') }}" method="post" enctype="multipart/form-data" id="plugin_image">
                    <input type="hidden" name="folder" value="{{ $apps->name }}">
                    <input type="hidden" name="id_connect" value="{{ $next_id }}">
                    <input type="hidden" name="param" value="">
                    <input type="file" name="images[]" id="upload_image_filer" multiple="multiple">
                    <input type="submit" value="Submit" class="btn btn-primary hidden">
                </form>
            </div>
        </div>
    </div>
@endsection