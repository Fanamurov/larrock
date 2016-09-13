<div class="nav-left">
    <ul class="list-unstyled">
        @foreach($menu->level1 as $key => $item)
            @if($item->Active !== false)
                @if($key === 'otc-3035')
                    @php($zoo_key = 'otc-7656')
                    <li class="first-level" data-id="{{ $zoo_key }}">
                        <a href="/otapi/otc-7656">Зоотовары. Товары для животных</a>
                        <ul class="list-unstyled list-parent row list-parent-{{ $zoo_key }}">
                            @php($parent_flow = 'otc-7256')
                            @foreach($menu->level1->get('otc-7256')->Parents->get('otc-7656')->Parents as $parent_zoo)
                                <li class="second-level"><a href="/otapi/{{ $parent_zoo->Id }}">{{ $parent_zoo->Name }}</a></li>
                                <ul class="row list-unstyled list-parent2">
                                    @if(isset($parent_zoo->Parents))
                                        @foreach($parent_zoo->Parents as $parent2)
                                            @if($parent2->Active !== false AND $parent2->ParentId === $parent->Id)
                                                <li class="col-xs-6 third-level"><a href="/otapi/{{ $parent2->Id }}">{{ $parent2->Name }}</a></li>
                                            @endif
                                        @endforeach
                                    @endif
                                </ul>
                            @endforeach
                        </ul>
                    </li>
                @endif
                <li class="first-level" data-id="{{ $item->Id }}">
                    <a href="/otapi/{{ $item->Id }}">{{ $item->Name }}</a>
                    <ul class="list-unstyled list-parent row list-parent-{{ $item->Id }}">
                        @foreach($item->Parents as $parent)
                            @if($parent->Active !== false AND $parent->ParentId === $item->Id)
                                <li class="second-level"><a href="/otapi/{{ $parent->Id }}">{{ $parent->Name }}</a></li>
                                <ul class="row list-unstyled list-parent2">
                                    @foreach($parent->Parents as $parent2)
                                        @if($parent2->Active !== false AND $parent2->ParentId === $parent->Id)
                                            <li class="col-xs-6 third-level"><a href="/otapi/{{ $parent2->Id }}">{{ $parent2->Name }}</a></li>
                                        @endif
                                    @endforeach
                                </ul>
                            @endif
                        @endforeach
                    </ul>
                </li>
            @endif
        @endforeach
    </ul>
</div>