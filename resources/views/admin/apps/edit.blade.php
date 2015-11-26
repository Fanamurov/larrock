@extends('admin.layouts.main')

@section('title') {{ $apps->name }} admin @endsection
@section('page_h1', 'Редактирование')
@section('page_h1_new', 'материала')
@section('app_name'){{ $apps->name }}@endsection
@section('app_title') {{ $apps->title }} @endsection

@section('content')
    @foreach($data as $data_value)
        <form action="/admin/{{ $apps->name }}/{{ $data_value->id }}" method="POST">
            <input name="_method" type="hidden" value="PUT">
            <div class="tabbable">
                <ul class="nav nav-tabs">
                    @foreach($tabs as $tabs_key => $tabs_value)
                        <li @if($tabs_key === 0) class="active" @endif><a href="#tab{{ $tabs_key }}" data-toggle="tab"><i class="fa fa-cogs"></i> {{ $tabs_value }}</a></li>
                    @endforeach
                </ul>
                <div class="clearfix"></div><br/><br/>
                <div class="tab-content">
                    @foreach($tabs as $tabs_key => $tabs_value)
                        <div class="tab-pane @if($tabs_key === 0) active @endif" id="tab{{ $tabs_key }}">
                            @foreach($apps->rows as $rows_key => $rows_value)
                                @if($rows_value['in_admin_tab'] === $tabs_value)
                                    @if($rows_value['type'] === 'textarea')
                                        <div class="form-group">
                                            <label for="{{ $rows_key }}">{{ $rows_value['title'] }}</label>
                                        <textarea name="{{ $rows_key }}" class="form-control" id="{{ $rows_key }}">
                                            {{ Input::old($rows_key, $data_value->$rows_key) }}
                                        </textarea>
                                        </div>
                                    @elseif($rows_value['type'] === 'checkbox')
                                        <div class="form-group">
                                            <label for="{{ $rows_key }}">{{ $rows_value['title'] }}</label>
                                            <input type="checkbox" name="{{ $rows_key }}" class="form-control" id="{{ $rows_key }}"
                                                   @if(Input::old($rows_key, $data_value->$rows_key) === 1 OR array_key_exists('checked', $rows_value)) checked @endif
                                                   value="1">
                                        </div>
                                    @elseif($rows_value['type'] === 'select')
                                        Select
                                    @else
                                        <div class="form-group">
                                            <label for="{{ $rows_key }}">{{ $rows_value['title'] }}</label>
                                            <input type="{{ $rows_value['type'] or 'text' }}" name="{{ $rows_key }}"
                                                   value="{{ Input::old($rows_key, $data_value->$rows_key) }}" class="form-control" id="{{ $rows_key }}">
                                        </div>
                                    @endif
                                @endif
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="form-group text-right">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <button type="submit" class="btn btn-primary"><i class="fa fa-pencil"></i> Сохранить</button>
            </div>
        </form>
    @endforeach
@endsection