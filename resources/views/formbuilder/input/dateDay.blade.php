<div class="form-group form-group-{{ $row_key }} {{ \Illuminate\Support\Arr::get($row_settings, 'css_class_group') }}">
    <label for="{{ $row_key }}" class="control-label">{{ $row_settings['title'] }}</label>
    @if($data->$row_key > \Carbon\Carbon::createFromFormat('Y-m-d h:s:i', '2015-01-01 00:00:00'))
        <input type="{{ $row_settings['type'] or 'text' }}" name="{{ $row_key }}"
               value="{{ Input::old($row_key, $data->$row_key) }}" class="form-control dateDay" id="{{ $row_key }}">
    @else
        <input type="{{ $row_settings['type'] or 'text' }}" name="{{ $row_key }}"
               value="" class="form-control dateDay" id="{{ $row_key }}">
    @endif
    @if(array_key_exists('help', $row_settings))
        <p class="help-block">{{ $row_settings['help'] }}</p>
    @endif
</div>