<div class="module-filter-cost module-filter">
    <span class="vid">Цена:</span>
    <span class="change_sort_cost label link @if(Cookie::get('sort_cost', 'none') === 'asc') active @endif" data-value="asc" data-type="cost">1<span class="divider">→</span>9</span>
    <span class="change_sort_cost label link @if(Cookie::get('sort_cost', 'none') === 'none') active @endif" data-value="none" data-type="cost">Без сортировки</span>
    <span class="change_sort_cost label link @if(Cookie::get('sort_cost', 'none') === 'desc') active @endif" data-value="desc" data-type="cost">9<span class="divider">→</span>1</span>
</div>