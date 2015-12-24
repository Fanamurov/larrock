<div class="form-group form-group-{{ $row_key }}">
    <div class="checkbox">
        <label>
            <input type="checkbox" name="{{ $row_key }}" id="{{ $row_key }}"
                   @if(Input::old($row_key, $data->$row_key) === 1) checked @endif
                   value="1"> {{ $row_settings['title'] }}
        </label>
    </div>
    @if(array_key_exists('help', $row_settings))
        <p class="help-block">{{ $row_settings['help'] }}</p>
    @endif
</div>