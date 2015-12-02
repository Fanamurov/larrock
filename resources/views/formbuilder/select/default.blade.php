<div class="form-group @if(isset($row_settings['form-group_class'])) {{ $row_settings['form-group_class'] }} @endif">
    <label for="{{ $row_key }}" class="control-label">{{ $row_settings['title'] }}</label>
    <select name="{{ $row_key }}" class="form-control" id="{{ $row_key }}">
        @foreach($row_settings['options'] as $options_value)
            <option value="{{ $options_value }}">{{ $options_value }}</option>
        @endforeach
    </select>
</div>
@if(array_key_exists('help', $row_settings))
    <p class="help-block">{{ $row_settings['help'] }}</p>
@endif
<div class="clearfix"></div>