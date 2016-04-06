<form id="form-searchTourShort" class="form-searchTour form-searchTourShort" method="post"
      action="http://www.santa-avia.ru/goryashchie-tury/townFrom-1286/countryId-113/?nights=10&month=06/04/2016&sta=1">
    <p class="h3 text-center">Подбор тура</p>
    <div class="form-group">
        <label for="form-searchTour-out">Откуда:</label>
        <select name="out" class="form-control" id="form-searchTour-out">
            @foreach($GetDepartCities as $item)
                <option @if($item->Id === 1286) selected @endif value="{{ $item->Id }}">{{ $item->Name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="form-searchTour-in">Куда:</label>
        <select name="in" class="form-control" id="form-searchTour-in">
            @foreach($GetCountries as $item)
                <option value="{{ $item->Id }}">{{ $item->Name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="form-searchTour-long">Продолжительность:</label>
        <select name="long" class="form-control" id="form-searchTour-long">
            <option value="Хабаровск">3-10 ночей</option>
            <option value="Хабаровск">7-14 ночей</option>
            <option value="Хабаровск">10-17 ночей</option>
            <option value="Хабаровск">17-24 ночей</option>
        </select>
    </div>
    <div class="form-group">
        <label for="form-searchTour-date">Дата вылета:</label>
        <input type="date" name="date" class="form-control" id="form-searchTour-date">
    </div>
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <button type="submit" class="btn btn-default btn-block" name="submit_searchTourShort">Найти</button>
    <div class="clearfix"></div>
</form>