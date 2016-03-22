@foreach($data as $file_item)
    <div class="row" id="file-{{ $file_item->id }}">
        <div class="col-xs-4 col-md-2 text-right">
            <i class="glyphicon glyphicon-file"></i>
        </div>
        <div class="col-xs-6 col-md-8">
            <div class="form-group">
                <p class="url_link">
                    <span>Url:</span> <a href="{{ $file_item->getUrl() }}">{{ $file_item->getUrl() }}</a> [{{ $file_item->humanReadableSize }}]
                </p>
            </div>
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-addon">Alt/description:</div>
                    <input class="form-control description-file ajax_edit_media_files" type="text" value="{{ $file_item->custom_properties['alt'] or '' }}"
                           data-model_type="{!! class_basename($file_item->model_type) !!}"
                           data-id="{{ $file_item->id }}" data-row="description"
                           placeholder="Alt/description">
                </div>
            </div>
            <div class="row">
                <div class="col-xs-9">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">Группа для галереи:</div>
                            <input class="form-control param-file ajax_edit_media_files" type="text" value="{{ $file_item->custom_properties['gallery'] or '' }}"
                                   data-model_type="{!! class_basename($file_item->model_type) !!}"
                                   data-id="{{ $file_item->id }}" data-row="param"
                                   placeholder="Галерея">
                        </div>
                    </div>
                </div>
                <div class="col-xs-2">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">Вес:</div>
                            <input class="form-control position-file ajax_edit_media_files" type="text" value="{{ $file_item->order_column or '0' }}"
                                   data-model_type="{!! class_basename($file_item->model_type) !!}"
                                   data-id="{{ $file_item->id }}" data-row="position"
                                   placeholder="Вес" style="width: 50px">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-2">
            <button class="btn btn-danger btn_delete_file" type="button"
                    data-id="{{ $file_item->id }}"
                    data-model="{!! class_basename($file_item->model_type) !!}"
                    data-model_id="{{ $file_item->model_id }}">Удалить</button>
        </div>
    </div>
    <br/><br/>
@endforeach