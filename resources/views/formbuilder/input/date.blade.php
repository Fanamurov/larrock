<div class="form-group form-group-{{ $row_key }} {{ \Illuminate\Support\Arr::get($row_settings, 'css_class_group') }}">
    <label for="{{ $row_key }}" class="control-label">{{ $row_settings['title'] }}</label>
    <input type="{{ $row_settings['type'] or 'text' }}" name="{{ $row_key }}"
           value="{{ Input::old($row_key, $data->$row_key) }}" class="form-control" id="{{ $row_key }}">

    @if(array_key_exists('help', $row_settings))
        <p class="help-block">{{ $row_settings['help'] }}</p>
    @endif
</div>