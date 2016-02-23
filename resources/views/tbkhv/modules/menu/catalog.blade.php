<ul class="menu-catalog list-unstyled list-inline row" id="menu-catalog">
    @foreach($data->CategoryInfoList->Content->Item as $menu_item)
        <li class="col-sm-4 link_block">
            <a href="/otapi/{{ $menu_item->Id }}">{{ $menu_item->Name }}</a>
        </li>
    @endforeach
</ul>