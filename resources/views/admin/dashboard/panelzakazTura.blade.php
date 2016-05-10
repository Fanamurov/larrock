@foreach($zakazTura as $key => $value)
    <div>
        <button type="button" class="btn btn-info btn-block btn-show-full-info btn-{{ str_slug($value->status) }}"
                data-target="{{ $key_panel }}_{{ $key }}">{{ $value->params['name'] }}
            <span class="label label-info label-{{ str_slug($value->status) }}">{{ $value->status }}</span>
            <small class="pull-right">{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$value->created_at)->diffForHumans() }}</small>
        </button>

        <div class="full-info hidden" id="{{ $key_panel }}_{{ $key }}">
            <small class="pull-right text-navy">{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$value->created_at)->diffForHumans() }}</small>
            <strong>{{ $value->params['name'] }} <span class="label label-info">{{ $value->status }}</span></strong>
            <p>{{ $value->params['tel'] }} <a href="mailto:{{ $value->params['email'] }}">{{ $value->params['email'] }}</a></p>
            <blockquote>{{ $value->params['comment'] }}</blockquote>
            <p><a target="_blank" href="{{ $value->params['tour_url'] }}">{{ $value->params['tour_name'] }}</a></p>
            <small class="text-muted">{{ $value->created_at }}</small>
        </div>
    </div>
@endforeach