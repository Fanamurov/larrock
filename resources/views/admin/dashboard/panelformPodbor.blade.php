@foreach($formPodbor as $key => $value)
    <div>
        <button type="button" class="btn btn-info btn-block btn-show-full-info btn-{{ str_slug($value->status) }}"
                data-target="{{ $key_panel }}_{{ $key }}">{{ $value->params['name'] }}
            <span class="label label-info label-{{ str_slug($value->status) }}">{{ $value->status }}</span>
            <small class="pull-right">{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$value->created_at)->diffForHumans() }}</small>
        </button>

        <div class="full-info hidden" id="{{ $key_panel }}_{{ $key }}">
            <p class="h2">Форма подбора тура</p>
            <small class="pull-right text-navy">{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$value->created_at)->diffForHumans() }}</small>
            <strong>{{ $value->params['name'] }} <span class="label label-info">{{ $value->status }}</span></strong>
            <p>{{ $value->params['tel'] }} <a href="mailto:{{ $value->params['email'] }}">{{ $value->params['email'] }}</a></p>
            <p><strong>Страна отдыха:</strong> {{ $value->params['country'] }}</p>
            <p><strong>Предполагаемая дата начала поездки:</strong> {{ $value->params['date'] }}</p>
            <p><strong>Когда удобнее связаться:</strong> {{ $value->params['time'] }}</p>
            <blockquote>{{ $value->params['comment'] }}</blockquote>
            <small class="text-muted">Дата заявки: {{ $value->created_at }}</small>

            <div class="clearfix"></div><br/><br/>

            <div class="row">
                <div class="col-xs-1">
                    <label for="status">Статус заявки:</label>
                </div>
                <div class="edit col-xs-5">
                    <div class="form-group">
                        <select class="form-control" id="status">
                            <option value="Просмотрено">Просмотрено</option>
                            <option value="Обработано: Заказано">Обработано: Заказано</option>
                            <option value="Обработано: Отложено">Обработано: Отложено</option>
                            <option value="Обработано: Отмена заказа">Обработано: Отмена заказа</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
@endforeach