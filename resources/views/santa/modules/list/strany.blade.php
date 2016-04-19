<div class="panel-group block-module_listStrany" id="accordion_listStrany" role="tablist" aria-multiselectable="true">
    @foreach($module_strany as $item)
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="heading{{ $item->id }}">
                <p class="panel-title @if(isset($data->id) && $data->id === $item->id) active @endif
                @foreach($item->get_childActive as $child) @if(isset($data->id) && $data->id === $child->id) active @endif @endforeach">
                    <a role="button" data-toggle="collapse" data-parent="#accordion_listStrany" href="#collapse{{ $item->id }}"
                       aria-expanded="true" aria-controls="collapse{{ $item->id }}">
                        <span class="flag-icon flag-icon-{!! mb_strimwidth($item->url, 0, 2) !!}"></span> {{ $item->title }}
                    </a>
                </p>
            </div>
            @if(count($item->get_childActive) > 0)
                <div id="collapse{{ $item->id }}" class="panel-collapse collapse
                @if(isset($data->id) && $data->id === $item->id) in @endif @foreach($item->get_childActive as $child) @if(isset($data->id) && $data->id === $child->id) in @endif @endforeach"
                     role="tabpanel" aria-labelledby="heading{{ $item->id }}">
                    <div class="panel-body">
                        <ul class="list-unstyled">
                        @foreach($item->get_childActive as $child)
                            <li @if(isset($data->id) && $data->id === $child->id) class="active" @endif>
                                <a href="/tours/strany/{{ $item->url }}/{{ $child->url }}">
                                    {{ $child->title }}
                                </a>
                            </li>
                        @endforeach
                        </ul>
                    </div>
                </div>
            @endif
        </div>
    @endforeach
</div>