<form id="form-podbor" class="form-podbor" method="post" action="/forms/podbor">
    <p class="h3 text-center">Подобрать тур</p>
    <div class="form-group">
        <input type="text" class="form-control" id="form-podbor-name" placeholder="Как к вам обращаться" name="name">
    </div>
    <div class="form-group">
        <input type="email" class="form-control" id="form-podbor-email" placeholder="Email" name="email">
    </div>
    <div class="form-group">
        <input type="text" class="form-control" id="form-podbor-tel" placeholder="Email" name="tel">
    </div>
    <div class="form-group">
        <input type="text" class="form-control" id="form-podbor-country" placeholder="Страна отдыха" name="country">
    </div>
    <div class="form-group">
        <label for="form-podbor-date">Предполагаемая дата начала поездки</label>
        <input type="date" name="date" class="form-control" id="form-podbor-date">
    </div>
    <div class="form-group">
        <label for="form-podbor-time">Когда с Вами удобнее связаться</label>
        <select class="form-control" name="time" id="form-podbor-time">
            <option value="утром">утром</option>
            <option value="днем">днем</option>
            <option value="вечером">вечером</option>
        </select>
        <input type="text" class="form-control" id="form-podbor-country" placeholder="Страна отдыха" name="country">
    </div>
    <div class="form-group">
        <textarea class="form-control" name="comment" id="form-podbor-comment" placeholder="Пожелания по туру"></textarea>
    </div>
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <button type="submit" class="btn btn-default pull-right" name="submit_contact">Подобрать тур</button>
    <div class="clearfix"></div>
</form>
{!! JsValidator::formRequest('App\Http\Requests\PodborRequest', '#form-podbor') !!}