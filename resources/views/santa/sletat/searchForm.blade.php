@extends('santa.main')
@section('title') Купить тур @endsection

@section('content')
    <div class="pageBlogItem">
        <h1 class="text-center h3">Подбор тура</h1>
        <form id="form-searchTourShort" class="form-searchTour form-searchTourShort" method="get" action="">
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label class="control-label" for="form-searchTour-cityFromId">Откуда:</label>
                        <select name="cityFromId" class="form-control" id="form-searchTour-cityFromId">
                            @foreach($GetDepartCities as $item)
                                <option @if($item->Id == Input::get('cityFromId')) selected @endif value="{{ $item->Id }}">{{ $item->Name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group">
                        <label class="control-label" for="form-searchTour-countryId">Куда:</label>
                        <select name="countryId" class="form-control" id="form-searchTour-countryId">
                            @foreach($GetCountries as $item)
                                <option @if($item->Id == Input::get('countryId')) selected @endif value="{{ $item->Id }}">{{ $item->Name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group">
                        <label class="control-label" for="form-searchTour-date-int">Интервал дат вылета:</label>
                        <input type="text" name="date-int" class="form-control daterange" id="form-searchTour-date-int" value="{{ Input::get('date-int') }}">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label" for="form-searchTour-s_adults">Взрослых:</label>
                        <select name="s_adults" class="form-control" id="form-searchTour-s_adults">
                            <option value=""></option>
                            <option @if(Input::get('s_adults') == 1) selected @endif value="1">1</option>
                            <option @if(Input::get('s_adults') == 2) selected @endif value="2">2</option>
                            <option @if(Input::get('s_adults') == 3) selected @endif value="3">3</option>
                            <option @if(Input::get('s_adults') == 4) selected @endif value="4">4</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label" for="form-searchTour-s_kids">Детей:</label>
                        <select name="s_kids" class="form-control" id="form-searchTour-s_kids">
                            <option value=""></option>
                            <option @if(Input::get('s_kids') == 1) selected @endif value="1">1</option>
                            <option @if(Input::get('s_kids') == 2) selected @endif value="2">2</option>
                            <option @if(Input::get('s_kids') == 3) selected @endif value="3">3</option>
                            <option @if(Input::get('s_kids') == 4) selected @endif value="4">4</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label" for="form-searchTour-s_priceMin">Цена от:</label>
                        <input type="text" name="s_priceMin" value="{{ Input::get('s_priceMin') }}" placeholder="любая" id="form-searchTour-s_priceMin" class="form-control">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label" for="form-searchTour-s_priceMax">Цена до:</label>
                        <input type="text" name="s_priceMax" value="{{ Input::get('s_priceMax') }}" placeholder="любая" id="form-searchTour-s_priceMax" class="form-control">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label" for="form-searchTour-s_nightsMin">Ночей от:</label>
                        <select name="s_nightsMin" class="form-control" id="form-searchTour-s_nightsMin">
                            @for($i=1; $i < 30; $i++)
                                <option @if(Input::get('s_nightsMin') == $i) selected @endif value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label" for="form-searchTour-s_nightsMax">Ночей до:</label>
                        <select name="s_nightsMax" class="form-control" id="form-searchTour-s_nightsMax">
                            @for($i=1; $i < 30; $i++)
                                <option @if(Input::get('s_nightsMax') == $i) selected @endif value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label class="control-label" for="form-searchTour-city">Курорт:</label>
                        <select name="city" class="form-control chosen-select" id="form-searchTour-city" data-placeholder="Выберите курорты..." multiple>
                            @forelse($GetCities as $item)
                                <option value="{{ $item->Id }}">{{ $item->Name }}</option>
                            @empty
                                <option value="">Нет доступных курортов</option>
                            @endforelse
                        </select>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group">
                        <label class="control-label" for="form-searchTour-hotel">Отель:</label>
                        <select name="hotel" class="form-control chosen-select" id="form-searchTour-hotel" data-placeholder="Выберите отели..." multiple>
                            @forelse($GetHotels as $item)
                                <option value="{{ $item->Id }}">{{ $item->Name }}</option>
                            @empty
                                <option value="">Нет доступных отелей</option>
                            @endforelse
                        </select>
                    </div>
                </div>
            </div>

            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <button type="submit" class="btn btn-default btn-block">Найти</button>
            <div class="clearfix"></div>
        </form>
    </div>

    @if($GetTours['iTotalDisplayRecords'] < 1)
        <p>Туров по данным параметров не найдено, попробуйте изменить данные для поиска и повторить попытку позже.</p>
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
    @endif
@endsection