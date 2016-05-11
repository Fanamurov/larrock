@foreach($data as $image_value)
    <div class="row" id="image-{{ $image_value->id }}">
        <div class="col-xs-4 col-md-2">
            <img src="{{ $image_value->getUrl('110x110') }}" alt="Фото" class="all-width pull-right">
        </div>
        <div class="col-xs-6 col-md-8">
            <div class="form-group">
                <p class="url_link">
                    <span>Url:</span> <a target="_blank" href="{{ $image_value->getUrl() }}">{{ $image_value->getUrl() }}</a> [{{ $image_value->humanReadableSize }}]
                </p>
            </div>
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-addon">Alt/description:</div>
                    <input class="form-control description-image ajax_edit_media" type="text" value="{{ $image_value->custom_properties['alt'] or '' }}"
                           data-model_type="{!! class_basename($image_value->model_type) !!}"
                           data-id="{{ $image_value->id }}" data-row="description"
                           placeholder="Alt/description">
                </div>
            </div>
            <div class="row">
                <div class="col-xs-9">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">Группа для галереи:</div>
                            <input class="form-control param-image ajax_edit_media" type="text" value="{{ $image_value->custom_properties['gallery'] or '' }}"
                                   data-model_type="{!! class_basename($image_value->model_type) !!}"
                                   data-id="{{ $image_value->id }}" data-row="param"
                                   placeholder="Галерея">
                        </div>
                    </div>
                </div>
                <div class="col-xs-2">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">Вес:</div>
                            <input class="form-control position-image ajax_edit_media" type="text" value="{{ $image_value->order_column or '0' }}"
                                   data-model_type="{!! class_basename($image_value->model_type) !!}"
                                   data-id="{{ $image_value->id }}" data-row="position"
                                   placeholder="Вес" style="width: 50px">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-2">
            <button class="btn btn-danger btn_delete_image" type="button"
                    data-id="{{ $image_value->id }}"
                    data-model="{!! class_basename($image_value->model_type) !!}"
                    data-model_id="{{ $image_value->model_id }}">Удалить</button>
        </div>
    </div>
    <br/><br/>
@endforeach