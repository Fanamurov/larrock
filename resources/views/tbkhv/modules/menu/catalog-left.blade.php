<div class="nav-left">
    <ul class="list-unstyled">
        @foreach($menu->level1 as $item)
            @if($item->Active !== false)
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