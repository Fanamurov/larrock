<form class="form-searchTour form-siteSearch" action="/tours/search" method="post">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label" for="form-searchTour-vid">Вид отдыха:</label>
                <select name="vid" class="form-control" id="form-searchTour-vid">
                    <option value="">любой</option>
                    @foreach($siteSearch['vidy'] as $item)
                        <option @if(isset($selected_vid))@if($item->url == $selected_vid) selected @endif @endif value="{{ $item->id }}">{{ $item->title }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label" for="form-searchTour-country">Страна:</label>
                <select name="country" class="form-control" id="form-searchTour-country">
                    <option value="">любая</option>
                    @foreach($siteSearch['countries'] as $item)
                        <option value="{{ $item->id }}" @if(isset($selected_country))@if($item->id == $selected_country) selected @endif @endif>{{ $item->title }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-1 hidden-xs hidden-sm">
            <span class="ili">или</span>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label" for="form-searchTour-resort">Курорт:</label>
                <select name="resort" class="form-control" id="form-searchTour-resort">
                    <option value="">любой</option>
                    @foreach($siteSearch['resorts'] as $item)
                        <option value="{{ $item->id }}">{{ $item->title }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-5">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <button type="submit" class="btn btn-default btn-block">Найти тур</button>
        </div>
    </div>
</form>