<form id="form-searchTourShort" class="form-searchTour form-searchTourShort" method="post" action="/forms/searchTour">
    <p class="h3 text-center">Подбор тура</p>
    <div class="form-group">
        <label for="form-searchTour-out">Откуда:</label>
        <select name="out" class="form-control" id="form-searchTour-out">
            <option value="Хабаровск">Хабаровск</option>
        </select>
    </div>
    <div class="form-group">
        <label for="form-searchTour-in">Куда:</label>
        <select name="in" class="form-control" id="form-searchTour-in">
            <option value="Тайланд">Тайланд</option>
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