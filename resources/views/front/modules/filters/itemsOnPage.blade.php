<div class="module-filter-itemsOnPage module-filter">
    <span class="vid">Позиций на стр.:</span>
    <span class="change_limit label link @if(Request::get('perPage', 24) == 12) active @endif" data-value="12" data-token="{{csrf_token()}}">12</span>
    <span class="change_limit label link @if(Request::get('perPage', 24) == 24) active @endif" data-value="24" data-token="{{csrf_token()}}">24</span>
    <span class="change_limit label link @if(Request::get('perPage', 24) == 96) active @endif" data-value="96" data-token="{{csrf_token()}}">96</span>

</div>