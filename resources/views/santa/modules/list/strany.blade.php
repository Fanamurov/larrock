<div class="panel-group" id="accordion_listStrany" role="tablist" aria-multiselectable="true">
    @foreach($module_strany as $item)
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="heading{{ $item->id }}">
                <h4 class="panel-title @if($data->id === $item->id) active @endif @foreach($item->get_childActive as $child) @if($data->id === $child->id) active @endif @endforeach">
                    <a role="button" data-toggle="collapse" data-parent="#accordion_listStrany" href="#collapse{{ $item->id }}" aria-expanded="true" aria-controls="collapse{{ $item->id }}">
                        <span class="glyphicon glyphicon-chevron-right"></span> {{ $item->title }}
                    </a>
                </h4>
            </div>
            <div id="collapse{{ $item->id }}" class="panel-collapse collapse
            @if($data->id === $item->id) in @endif @foreach($item->get_childActive as $child) @if($data->id === $child->id) in @endif @endforeach"
                 role="tabpanel" aria-labelledby="heading{{ $item->id }}">
                <div class="panel-body">
                    <ul>
                    @foreach($item->get_childActive as $child)
                        <li @if($data->id === $child->id) class="active" @endif>
                            <a href="/tours/strany/{{ $item->url }}/{{ $child->url }}">
                                {{ $child->title }}
                            </a>
                        </li>
                    @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endforeach
</div>