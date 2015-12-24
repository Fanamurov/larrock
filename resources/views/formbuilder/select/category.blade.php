<div class="form-group form-group-{{ $row_key }} @if(isset($row_settings['form-group_class'])) {{ $row_settings['form-group_class'] }} @endif">
    <label for="{{ $row_key }}" class="control-label">{{ $row_settings['title'] }}</label>
    <select name="{{ $row_key }}" id="{{ $row_key }}" data-placeholder="Выберите раздел..." style="width: 100%" class="chosen-select" multiple>
        @foreach($row_settings['options'] as  $options_value)
            <option value="{{ $options_value->id }}"
                    @if ($data->id === $options_value->id) disabled @endif
                    @if(Input::old($row_key, $data->$row_key) === $options_value->id) selected @endif>
                {{ $options_value->title }}
            </option>
            @if(isset($options_value->children))
                @foreach($options_value->children as $options_value)
                    <option value="{{ $options_value->id }}"
                            @if ($data->id === $options_value->id) disabled @endif
                            @if(Input::old($row_key, $data->$row_key) === $options_value->id) selected @endif>
                        - {{ $options_value->title }}
                    </option>
                    @if(isset($options_value->children))
                        @if(isset($options_value->children))
                            @foreach($options_value->children as $options_value)
                                <option value="{{ $options_value->id }}"
                                        @if ($data->id === $options_value->id) disabled @endif
                                        @if(Input::old($row_key, $data->$row_key) === $options_value->id) selected @endif>
                                    -- {{ $options_value->title }}
                                </option>
                                @if(isset($options_value->children))
                                    @if(isset($options_value->children))
                                        @foreach($options_value->children as $options_value)
                                            <option value="{{ $options_value->id }}"
                                                    @if ($data->id === $options_value->id) disabled @endif
                                                    @if(Input::old($row_key, $data->$row_key) === $options_value->id) selected @endif>
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