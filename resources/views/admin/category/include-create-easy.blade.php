{{-- Создание раздела --}}
<tr class="create-category hidden">
    <form action="/admin/category/storeEasy" method="post">
        <td colspan="2">
            <div class="form-group create-category-title_div">
                <input type="text" placeholder="Название раздела" class="form-control create-category-title" name="title">
            </div>
        </td>
        <td class="row-position">
            <input type="text" name="position" value="0" class="form-control"
                   data-toggle="tooltip" data-placement="bottom" title="Вес. Чем больше, тем выше в списках">
        </td>
        <td colspan="3">
            <div class="text-center">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <input type="hidden" name="parent" value="{{ $parent or 0 }}">
                <input type="hidden" name="url" value="default_url">
                <input type="hidden" name="type" value="{{ $type }}">
                <button class="btn btn-info btn-xs" name="save_category_easy">Сохранить</button>
            </div>
        </td>
    </form>
</tr>