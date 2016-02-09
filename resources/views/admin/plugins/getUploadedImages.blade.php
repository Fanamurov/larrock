@foreach($data as $image)
    <div class="row" id="image-{{ $image->id }}">
        <div class="col-xs-4 col-md-2">
            <img src="{{ $image->getUrl('110x110') }}" alt="Фото" class="all-width pull-right">
        </div>
        <div class="col-xs-6 col-md-8">
            <div class="form-group">
                <p class="url_link">
                    <span>Url:</span> <a href="/media/{!! strtolower(last(explode('\\', $image->model_type))) !!}/{{ $image->file_name }}">/images/{!! strtolower(last(explode('\\', $image->model_type))) !!}/{{ $image->file_name }}</a>
                </p>
            </div>
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-addon">Alt/description:</div>
                    <input class="form-control description-image ajax_edit_media" type="text" value="{{ $image->custom_properties->alt or '' }}"
                           data-model_type="{!! strtolower(last(explode('\\', $image->model_type))) !!}"
                           data-row_where="id" data-id="{{ $image->id }}" data-row="description"
                           placeholder="Alt/description">
                </div>
            </div>
            <div class="row">
                <div class="col-xs-9">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">Группа для галереи:</div>
                            <input class="form-control param-image ajax_edit_media" type="text" value="{{ $image->custom_properties->group or '' }}"
                                   data-model_type="{!! strtolower(last(explode('\\', $image->model_type))) !!}"
                                   data-row_where="id" data-id="{{ $image->id }}" data-row="param"
                                   placeholder="Группа">
                        </div>
                    </div>
                </div>
                <div class="col-xs-2">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">Вес:</div>
                            <input class="form-control position-image ajax_edit_media" type="text" value="{{ $image->custom_properties->position or '0' }}"
                                   data-model_type="{!! strtolower(last(explode('\\', $image->model_type))) !!}"
                                   data-row_where="id" data-id="{{ $image->id }}" data-row="position"
                                   placeholder="Вес" style="width: 50px">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-2">
            <button class="btn btn-danger btn_delete_image" type="button"
                    data-id="{{ $image->id }}"
                    data-model="{!! strtolower(last(explode('\\', $image->model_type))) !!}"
                    data-model_id="{{ $image->model_id }}">Удалить</button>
        </div>
    </div>
    <br/><br/>
    <input name="uploaded_images[]" type="hidden" class="id-image" value="{{ $image->id }}">
@endforeach