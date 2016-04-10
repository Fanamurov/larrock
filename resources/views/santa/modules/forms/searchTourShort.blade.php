<form id="form-searchTourShort" class="form-searchTour form-searchTourShort" method="get"
      action="/sletat">
    <p class="h3 text-center">Подбор тура</p>
    <div class="form-group">
        <label class="control-label" for="form-searchTour-cityFromId">Откуда:</label>
        <select name="cityFromId" class="form-control" id="form-searchTour-cityFromId">
            @foreach($GetDepartCities as $item)
                <option @if($item->Name === 'Хабаровск') selected @endif value="{{ $item->Id }}">{{ $item->Name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label class="control-label" for="form-searchTour-countryId">Куда:</label>
        <select name="countryId" class="form-control" id="form-searchTour-countryId">
            @foreach($GetCountries as $item)
                <option value="{{ $item->Id }}">{{ $item->Name }}</option>
            @endforeach
        </select>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label class="control-label" for="form-searchTour-s_nightsMin">Ночей от:</label>
                <select name="s_nightsMin" class="form-control" id="form-searchTour-s_nightsMin">
                    @for($i=1; $i < 30; $i++)
                        <option @if($i === 7) selected @endif value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label class="control-label" for="form-searchTour-s_nightsMax">Ночей до:</label>
                <select name="s_nightsMax" class="form-control" id="form-searchTour-s_nightsMax">
                    @for($i=1; $i < 30; $i++)
                        <option @if($i === 10) selected @endif value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label" for="form-searchTour-date-int">Интервал дат вылета:</label>
        <input type="text" name="date-int" class="form-control daterange" id="form-searchTour-date-int" value="" placeholder="сегодня">
    </div>
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <button type="submit" class="btn btn-default btn-block">Найти</button>
    <div class="clearfix"></div>
</form>