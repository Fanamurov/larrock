<div class="form-group">
    <input class="form-control description-image ajax_edit_row" type="text" value="{{ $image->description }}"
           data-table="images" data-row_where="id" data-value_where="{{ $image->id }}" data-row="description"
           placeholder="Alt/description">
</div>
<div class="form-group">
    <input class="form-control param-image ajax_edit_row" type="text" value="{{ $image->param }}"
           data-table="images" data-row_where="id" data-value_where="{{ $image->id }}" data-row="param"
           placeholder="Группа">
</div>
<div class="form-group">
    <input class="form-control position-image ajax_edit_row" type="text" value="{{ $image->position }}"
           data-table="images" data-row_where="id" data-value_where="{{ $image->id }}" data-row="position"
           placeholder="Вес">
</div>
<input type="hidden" class="id-image" value="{{ $image->id }}">