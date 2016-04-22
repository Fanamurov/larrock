@if($GetTours['iTotalDisplayRecords'] < 1)
    @if(isset($full_load))
        <p id="empty-results" class="alert alert-danger">Туров по данным параметрам не найдено, попробуйте изменить данные для поиска.</p>
    @endif
@else
    <p>Найдено {{ $GetTours['iTotalDisplayRecords'] }} туров в {{ $GetTours['hotelsCount'] }} отелях</p>
    <ul class="list-unstyled search-result">
        @foreach($GetTours['aaData'] as $item)
            <li class="row">
                <div class="col-xs-24">
                    <h4 class="h3">{{ $item[7] }} @if($item[8] !== '0.0'){{ $item[8] }}@endif ({{ $item[19] }})</h4>
                    @if($item[8] === '*')
                        <i class="glyphicon glyphicon-star"></i>
                    @elseif($item[8] === '2*')
                        <i class="glyphicon glyphicon-star"></i>
                        <i class="glyphicon glyphicon-star"></i>
                    @elseif($item[8] === '3*')
                        <i class="glyphicon glyphicon-star"></i>
                        <i class="glyphicon glyphicon-star"></i>
                        <i class="glyphicon glyphicon-star"></i>
                    @elseif($item[8] === '4*')
                        <i class="glyphicon glyphicon-star"></i>
                        <i class="glyphicon glyphicon-star"></i>
                        <i class="glyphicon glyphicon-star"></i>
                        <i class="glyphicon glyphicon-star"></i>
                    @elseif($item[8] === '5*')
                        <i class="glyphicon glyphicon-star"></i>
                        <i class="glyphicon glyphicon-star"></i>
                        <i class="glyphicon glyphicon-star"></i>
                        <i class="glyphicon glyphicon-star"></i>
                        <i class="glyphicon glyphicon-star"></i>
                    @endif
                </div>
                <div class="col-sm-4">
                    @if( !empty($item[29]))
                        <img src="{{ $item[29] }}" align="Hotel" class="all-width">
                    @else
                        <img src="/_assets/_santa/_images/empty_big.png" alt="Нет фото" class="categoryImage categoryImage-empty all-width">
                    @endif
                </div>
                <div class="col-sm-6">
                    <div><small>Тур:</small> {{ $item[6] }}</div>
                    <div><small class="muted">Рейтинг отеля:</small>
                        @if($item[35] > 0)
                            {{ $item[35] }}<small class="muted">/10</small>
                        @else
                            не изв.
                        @endif
                    </div>
                    <div><small class="muted">Пляжная линия:</small>
                        @if($item[87] > 0)
                            {{ $item[87] }}
                        @else
                            не изв.
                        @endif
                    </div>
                    @if($item[22] === '1')
                        <div><strong>Перелет включен в стоимость тура</strong></div>
                    @endif
                </div>
                <div class="col-sm-8">
                    <div><small class="muted">Тип размещения:</small> {{ $item[11] }}</div>
                    <div>{{ $item[16] }} взрослых / {{ $item[17] }} детей</div>
                    <div><small class="muted">Тип комнаты:</small> {{ $item[9] }} ({{ $item[37] }})</div>
                    <div><small class="muted">Питание:</small> {{ $item[10] }} ({{ $item[36] }})</div>
                </div>
                <div class="col-sm-6">
                    <div><small class="muted">Вылет:</small> {{ $item[12] }}</div>
                    <div><small class="muted">Ночей:</small> {{ $item[14] }}</div>

                    <p class="cost">{{ $item[42] }} {{ $item[43] }}</p>
                    <form action="{{ route('sletat.ActualizePrice') }}" method="get">
                        <input type="hidden" name="sourceId" value="{{ $item[1] }}">
                        <input type="hidden" name="offerId" value="{{ $item[0] }}">
                        <input type="hidden" name="countryId" value="{{ $item[30] }}">
                        <input type="hidden" name="requestId" value="{{ $GetTours['requestId'] }}">
                        <button type="submit" class="btn btn-default btn-block">Подробнее</button>
                    </form>
                </div>
                <div class="col-xs-24 hotel-description">
                    <div>{{ $item[38] }}</div>
                </div>
                <div class="col-xs-24 hotel-full-description" data-id="">

                </div>
                <div class="clearfix"></div><br/><br/>
            </li>
        @endforeach
    </ul>

    <nav>
        <ul class="pagination pagination-lg">
            <li>
                <a href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            @for($i=1; $i <= $paginator['pages']; $i++)
                <li @if($i === $paginator['current']) class="active" @endif><a href="{{ URL::route('sletat.form') }}">{{ $i }}</a></li>
            @endfor
            <li>
                <a href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
@endif