@foreach($data as $image)
    <div class="row" id="image-{{ $image->getFilename() }}">
        <div class="col-xs-4 col-md-2">
            <img src="/image_cache/{{ $image->getFilename() }}" alt="Фото" class="all-width pull-right">
        </div>
        <div class="col-xs-6 col-md-8">
            <div class="form-group">
                <p class="url_link">
                    <span>Url:</span> загружено во временную директорию, сохраните материал
                </p>
            </div>
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-addon">Alt/description:</div>
                    <input class="form-control description-image ajax_edit_media_temp" type="text" value="{{ $image->custom_properties['alt'] or '' }}"
                           data-model_type="{!! strtolower($app['name']) !!}"
                           data-filename="{{ $image->getFilename() }}" data-row="description"
                           placeholder="Alt/description">
                </div>
            </div>
            <div class="row">
                <div class="col-xs-9">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">Группа для галереи:</div>
                            <input class="form-control param-image ajax_edit_media_temp" type="text" value="{{ $image->custom_properties['gallery'] or '' }}"
                                   data-model_type="{!! strtolower($app['name']) !!}"
                                   data-filename="{{ $image->getFilename() }}" data-row="param"
                                   placeholder="Галерея">
                        </div>
                    </div>
                </div>
                <div class="col-xs-2">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">Вес:</div>
                            <input class="form-control position-image ajax_edit_media_temp" type="text" value="{{ $image->custom_properties['position'] or '0' }}"
                                   data-model_type="{!! strtolower($app['name']) !!}"
                                   data-filename="{{ $image->getFilename() }}" data-row="position"
                                   placeholder="Вес" style="width: 50px">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-2">
            <button class="btn btn-danger btn_delete_image_temp" type="button"
                    data-filename="{{ $image->getFilename() }}">Удалить</button>
        </div>
    </div>
    <br/><br/>
    <input name="uploaded_images[]" type="hidden" class="temp-images" value="{{ $image->getFilename() }}">
@endforeach