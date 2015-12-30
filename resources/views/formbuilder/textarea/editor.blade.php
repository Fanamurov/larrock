<div class="form-group form-group-{{ $row_key }} {{ \Illuminate\Support\Arr::get($row_settings, 'css_class_group') }}">
    <label for="{{ $row_key }}" class="control-label">{{ $row_settings['title'] }}</label>
    <textarea name="{{ $row_key }}" class="form-control {{ \Illuminate\Support\Arr::get($row_settings, 'css_class') }}" id="{{ $row_key }}">
        {{ Input::old($row_key, $data->$row_key) }}
    </textarea>
    <button class="btn btn-info btn-xs typo-action" type="button">Типограф для выделенного текста</button>
    @if(array_key_exists('help', $row_settings))
        <p class="help-block">{{ $row_settings['help'] }}</p>
    @endif
</div>