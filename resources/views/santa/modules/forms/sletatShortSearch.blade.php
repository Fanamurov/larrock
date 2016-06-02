<form id="form-searchTourShort" class="form-searchTour form-searchTourShort" method="get" action="/sletat" onsubmit="yaCounter27992118.reachGoal('ShortSearchSletat'); return true;">
    <div class="row">
        <div class="col-xs-12 col-sm-5">
            <div class="form-group">
                <label class="control-label" for="form-searchTour-cityFromId">Откуда:</label>
                <select name="cityFromId" class="form-control" id="form-searchTour-cityFromId">
                    @foreach($GetDepartCities as $item)
                        <option @if($item->Id == Input::get('cityFromId', 1286)) selected @endif value="{{ $item->Id }}">{{ $item->Name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-xs-12 col-sm-5">
            <div class="form-group">
                <label class="control-label" for="form-searchTour-countryId">Куда:</label>
                <select name="countryId" class="form-control" id="form-searchTour-countryId">
                    @foreach($GetCountries as $item)
                        <option @if($item->Id == Input::get('countryId', 113)) selected @endif value="{{ $item->Id }}">{{ $item->Name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-xs-24 col-sm-7 col-md-5">
            <div class="form-group">
                <label class="control-label" for="form-searchTour-date-int">Интервал дат вылета:</label>
                <input type="text" name="date-int" class="form-control daterange" id="form-searchTour-date-int" value="{{ Input::get('date-int') }}">
            </div>
        </div>
        <div class="col-xs-12 col-sm-3 col-md-2">
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
        <div class="col-xs-12 col-sm-3 col-md-2">
            <div class="form-group">
                <label class="control-label" for="form-searchTour-s_kids">Детей:</label>
                <select name="s_kids" class="form-control" id="form-searchTour-s_kids">
                    <option value="">---</option>
                    <option @if(Input::get('s_kids') == 1) selected @endif value="1">1</option>
                    <option @if(Input::get('s_kids') == 2) selected @endif value="2">2</option>
                    <option @if(Input::get('s_kids') == 3) selected @endif value="3">3</option>
                    <option @if(Input::get('s_kids') == 4) selected @endif value="4">4</option>
                </select>
            </div>
        </div>
        <div class="col-xs-24 col-md-5">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <button type="submit" class="btn btn-default btn-block">Найти тур</button>
        </div>
    </div>
</form>