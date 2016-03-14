<div class="form-group form-group-{{ $row_key }} {{ \Illuminate\Support\Arr::get($row_settings, 'css_class_group') }}">
    <label for="{{ $row_key }}" class="control-label">{{ $row_settings['title'] }}</label>
    <select name="{{ $row_key }}" class="form-control" id="{{ $row_key }}">
        @foreach($row_settings['options'] as $options_key => $options_value)
            <option value="@if(\Illuminate\Support\Arr::get($row_settings['options_connect'], 'selected_search') === 'value'){{ $options_value }}@else{{ $options_key }}@endif"
                    @if(\Illuminate\Support\Arr::get($row_settings['options_connect'], 'selected_search') === 'value')
                        @if(Input::old($row_key, $data->$row_key) === $options_value) selected @endif
                    @else
                        @if(Input::old($row_key, $data->$row_key) === $options_key) selected @endif
                    @endif>
                {{ $options_value }}</option>
        @endforeach
    </select>
    @if(array_key_exists('help', $row_settings))
        <p class="help-block">{{ $row_settings['help'] }}</p>
    @endif
</div>