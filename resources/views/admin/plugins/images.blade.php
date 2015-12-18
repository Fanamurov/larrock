<div class="form-group">
    <p class="url_link">
        <span>Url:</span> <a href="/images/{{ $image->type }}/big/{{ $image->name }}">/images/{{ $image->type }}/big/{{ $image->name }}</a>
        <span class="label">800x564</span>, <span class="label">300x215</span>
    </p>
</div>
<div class="form-group">
    <div class="input-group">
        <div class="input-group-addon">Alt/description:</div>
        <input class="form-control description-image ajax_edit_row" type="text" value="{{ $image->description }}"
               data-table="images" data-row_where="id" data-value_where="{{ $image->id }}" data-row="description"
               placeholder="Alt/description">
    </div>
</div>
<div class="row">
    <div class="col-xs-9">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon">Группа для галереи:</div>
                <input class="form-control param-image ajax_edit_row" type="text" value="{{ $image->param }}"
                       data-table="images" data-row_where="id" data-value_where="{{ $image->id }}" data-row="param"
                       placeholder="Группа">
            </div>
        </div>
    </div>
    <div class="col-xs-2">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon">Вес:</div>
                <input class="form-control position-image ajax_edit_row" type="text" value="{{ $image->position }}"
                       data-table="images" data-row_where="id" data-value_where="{{ $image->id }}" data-row="position"
                       placeholder="Вес" style="width: 50px">
            </div>
        </div>
    </div>
</div>
<input type="hidden" class="id-image" value="{{ $image->id }}">