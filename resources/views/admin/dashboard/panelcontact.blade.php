@foreach($contact as $key => $value)
    <div>
        <button type="button" class="btn btn-info btn-block btn-show-full-info btn-{{ str_slug($value->status) }}"
                data-target="{{ $key_panel }}_{{ $key }}">{{ $value->params['name'] }}
            <span class="label label-info label-{{ str_slug($value->status) }}">{{ $value->status }}</span>
            <small class="pull-right">{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$value->created_at)->diffForHumans() }}</small>
        </button>

        <div class="full-info hidden" id="{{ $key_panel }}_{{ $key }}">
            <small class="pull-right text-navy">{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$value->created_at)->diffForHumans() }}</small>
            <strong>{{ $value->params['name'] }} <span class="label label-info">{{ $value->status }}</span></strong>
            <p>{{ $value->params['contact'] }}</p>
            <blockquote>{{ $value->params['comment'] }}</blockquote>
            <small class="text-muted">{{ $value->created_at }}</small>
        </div>
    </div>
@endforeach