<div class="form-group form-group-{{ $row_key }} {{ \Illuminate\Support\Arr::get($row_settings, 'css_class_group') }}">
    <label for="{{ $row_key }}" class="control-label">{{ $row_settings['title'] }}</label>
    @if(array_key_exists('typo', $row_settings))
        <div class="row">
            <div class="col-xs-8">
                <input type="{{ $row_settings['type'] or 'text' }}" name="{{ $row_key }}"
                       value="{{ Input::old($row_key, $data->$row_key) }}"
                       class="form-control {{ \Illuminate\Support\Arr::get($row_settings, 'css_class') }}" id="{{ $row_key }}"
                @if($row_key === 'title') data-table="{{ $app['table_content'] }}" @endif>
            </div>
            @if($row_key === 'title')
                <div class="col-xs-2">
                    <button type="button" class="btn btn-info btn-outline refresh-url">Создать url</button>
                </div>
            @endif
            <div class="col-xs-2">
                <button type="button" class="btn btn-info btn-outline btn-typo">Типограф</button>
            </div>
        </div>
    @else
        <input type="{{ $row_settings['type'] or 'text' }}" name="{{ $row_key }}"
               value="{{ Input::old($row_key, $data->$row_key) }}"
               class="form-control {{ \Illuminate\Support\Arr::get($row_settings, 'css_class') }}" id="{{ $row_key }}">
    @endif

    @if(array_key_exists('help', $row_settings))
        <p class="help-block">{{ $row_settings['help'] }}</p>
    @endif
</div>