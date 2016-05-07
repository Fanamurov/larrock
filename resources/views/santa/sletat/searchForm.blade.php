@extends('santa.sletat')
@section('title')
    Купить тур
    @foreach($GetDepartCities as $item)
        @if($item->Id == Input::get('cityFromId')) {{ $item->Name }} @endif
    @endforeach (вылет)
    =>
    @foreach($GetCountries as $item)
        @if($item->Id == Input::get('countryId')) {{ $item->Name }} @endif
    @endforeach (прилет). Поиск тура, отеля. Горящие путевки
@endsection

@section('content')
    <div class="pageBlogItem">
        <h1 class="text-center h3">Подбор пакетного тура</h1>
        <form id="form-searchTourShort" class="form-searchTour form-searchTourShort" method="get" action="">
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label class="control-label" for="form-searchTour-cityFromId">Откуда:</label>
                        <select name="cityFromId" class="form-control" id="form-searchTour-cityFromId">
                            @foreach($GetDepartCities as $item)
                                <option @if($item->Id == Input::get('cityFromId', 1286)) selected @endif value="{{ $item->Id }}">{{ $item->Name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group">
                        <label class="control-label" for="form-searchTour-countryId">Куда:</label>
                        <select name="countryId" class="form-control" id="form-searchTour-countryId">
                            @foreach($GetCountries as $item)
                                <option @if($item->Id == Input::get('countryId', 29)) selected @endif value="{{ $item->Id }}">{{ $item->Name }}</option>
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
                            <option @if(Input::get('s_adults', 2) == 1) selected @endif value="1">1</option>
                            <option @if(Input::get('s_adults', 2) == 2) selected @endif value="2">2</option>
                            <option @if(Input::get('s_adults', 2) == 3) selected @endif value="3">3</option>
                            <option @if(Input::get('s_adults', 2) == 4) selected @endif value="4">4</option>
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
                                <option @if(Input::get('s_nightsMax', 18) == $i) selected @endif value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label class="control-label" for="form-searchTour-cities">Курорт:</label>
                        <select name="cities" class="form-control chosen-select" id="form-searchTour-cities" data-placeholder="Выберите курорты..." multiple>
                            @forelse($GetCities as $item)
                                <option @if(Input::get('cities') == $item->Id) selected @endif value="{{ $item->Id }}">{{ $item->Name }}</option>
                            @empty
                                <option value="">Нет доступных курортов</option>
                            @endforelse
                        </select>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group">
                        <label class="control-label" for="form-searchTour-hotels">Отель:</label>
                        <select name="hotels" class="form-control chosen-select" id="form-searchTour-hotels" data-placeholder="Выберите отели..." multiple>
                            @forelse($GetHotels as $item)
                                <option @if(Input::get('hotels') == $item->Id) selected @endif value="{{ $item->Id }}">{{ $item->Name }}</option>
                            @empty
                                <option value="">Нет доступных отелей</option>
                            @endforelse
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label" for="form-searchTour-meals">Тип питания:</label>
                        <select name="meals" class="form-control" id="form-searchTour-meals">
                            <option value="">любая</option>
                            @foreach($GetMeals as $item)
                                <option @if(Input::get('meals') == $item->Id) selected @endif value="{{ $item->Id }}">{{ $item->Name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label" for="form-searchTour-stars">Звездность:</label>
                        <select name="stars" class="form-control" id="form-searchTour-stars">
                            <option value="">любая</option>
                            @foreach($GetStars as $item)
                                <option @if(Input::get('stars') == $item->Id) selected @endif value="{{ $item->Id }}">{{ $item->Name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <button type="submit" class="btn btn-default btn-block">Найти</button>
            <div class="clearfix"></div>
        </form>
    </div>

    <div class="sletatResult">
        <div class="col-xs-24" id="loadState">
            <div class="progress">
                <div class="progress-bar progress-bar-danger progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 10%;">
                    <span class="progress-current">0%</span>
                </div>
            </div>
        </div>
        <div class="alert alert-warning col-xs-24 alert-progress">Обработка запроса продолжается</div>
        @include('santa.sletat.searchResult')
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function(){
            GetLoadState({{ $GetTours['requestId'] }}, 20);
        });
    </script>
@endsection