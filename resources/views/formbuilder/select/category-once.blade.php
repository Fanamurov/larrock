<div class="form-group form-group-{{ $row_key }} {{ \Illuminate\Support\Arr::get($row_settings, 'css_class_group') }}">
    <label for="{{ $row_key }}" class="control-label">{{ $row_settings['title'] }}</label>
    <select name="{{ $row_key }}" id="{{ $row_key }}" data-placeholder="Выберите раздел..." style="width: 100%" class="chosen-select">
        <option value="0" @if(count($selected) === 0) selected @endif>Корневой раздел</option>
        @foreach($row_settings['options'] as  $options_value)
            <option value="{{ $options_value->id }}"
                    {{--@if ($data->id === $options_value->id) disabled @endif--}}
                    @if(in_array($options_value->id, $selected, FALSE)) selected @endif>
                {{ $options_value->title }}
            </option>
            @if(isset($options_value->children))
                @foreach($options_value->children as $options_value)
                    <option value="{{ $options_value->id }}"
                            {{--@if ($data->id === $options_value->id) disabled @endif--}}
                            @if(in_array($options_value->id, $selected, FALSE)) selected @endif>
                        - {{ $options_value->title }}
                    </option>
                    @if(isset($options_value->children))
                        @if(isset($options_value->children))
                            @foreach($options_value->children as $options_value)
                                <option value="{{ $options_value->id }}"
                                        {{--@if ($data->id === $options_value->id) disabled @endif--}}
                                        @if(in_array($options_value->id, $selected, FALSE)) selected @endif>
                                    -- {{ $options_value->title }}
                                </option>
                                @if(isset($options_value->children))
                                    @if(isset($options_value->children))
                                        @foreach($options_value->children as $options_value)
                                            <option value="{{ $options_value->id }}"
                                                    {{--@if ($data->id === $options_value->id) disabled @endif--}}
                                                    @if(in_array($options_value->id, $selected, FALSE)) selected @endif>
                                                --- {{ $options_value->title }}
                                            </option>
                                        @endforeach
                                    @endif
                                @endif
                            @endforeach
                        @endif
                    @endif
                @endforeach
            @endif
        @endforeach
    </select>
    @if(array_key_exists('help', $row_settings))
        <p class="help-block">{{ $row_settings['help'] }}</p>
    @endif
</div>