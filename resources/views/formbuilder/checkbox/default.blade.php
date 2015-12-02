<div class="form-group">
    <label for="{{ $row_key }}" class="control-label">{{ $row_settings['title'] }}</label>
    <input type="checkbox" name="{{ $row_key }}" class="form-control" id="{{ $row_key }}"
           @if(Input::old($row_key, $data->$row_key) === 1) checked @endif
           value="1">
    @if(array_key_exists('help', $row_settings))
        <p class="help-block">{{ $row_settings['help'] }}</p>
    @endif
</div>
<div class="clearfix"></div>