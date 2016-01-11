<div class="form-group">
    <p class="url_link">
        <span>Url:</span> <a href="/files/{{ $file->type_connect }}/{{ $file->name }}">/files/{{ $file->type_connect }}/{{ $file->name }}</a>
    </p>
</div>
<div class="form-group">
    <div class="input-group">
        <div class="input-group-addon">Описание файла:</div>
        <input class="form-control description-image ajax_edit_row" type="text" value="{{ $file->description }}"
               data-table="files" data-row_where="id" data-value_where="{{ $file->id }}" data-row="description"
               placeholder="Описание файла">
    </div>
</div>
<div class="row">
    <div class="col-xs-9">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon">Группа для галереи:</div>
                <input class="form-control param-image ajax_edit_row" type="text" value="{{ $file->param }}"
                       data-table="files" data-row_where="id" data-value_where="{{ $file->id }}" data-row="param"
                       placeholder="Группа">
            </div>
        </div>
    </div>
    <div class="col-xs-2">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon">Вес:</div>
                <input class="form-control position-image ajax_edit_row" type="text" value="{{ $file->position }}"
                       data-table="files" data-row_where="id" data-value_where="{{ $file->id }}" data-row="position"
                       placeholder="Вес" style="width: 50px">
            </div>
        </div>
    </div>
</div>
<input type="hidden" class="id-file" value="{{ $file->id }}">