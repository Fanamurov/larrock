<div class="row row-podbor" id="row-podbor" onsubmit="yaCounter27992118.reachGoal('PodborTura');
ga('send', 'event', 'Форма','Отправка', 'Заявка на подбор тура'); return true;">
    <div class="col-xs-24 col-md-12">
        <form id="form-podbor" class="form-podbor" method="post" action="/forms/podbor">
            <p class="h1">Подбор тура</p>
            <div class="form-group">
                <label class="control-label" for="form-podbor-name">Как к вам обращаться</label>
                <input type="text" class="form-control" id="form-podbor-name" name="name">
            </div>
            <div class="form-group">
                <label class="control-label" for="form-podbor-email">Ваш email</label>
                <input type="email" class="form-control" id="form-podbor-email" name="email">
            </div>
            <div class="form-group">
                <label class="control-label" for="form-podbor-tel">Номер телефона</label>
                <input type="text" class="form-control" id="form-podbor-tel" name="tel">
            </div>
            <div class="form-group">
                <label class="control-label" for="form-podbor-country">Страна отдыха</label>
                <input type="text" class="form-control" id="form-podbor-country" name="country" value="{{ $countryFind or '' }}">
            </div>
            <div class="form-group">
                <label for="form-podbor-date">Предполагаемая дата начала поездки</label>
                <input type="text" name="date" class="form-control daterange" id="form-podbor-date" value="{{ Input::get('date-int', '') }}">
            </div>
            <div class="form-group">
                <label for="form-podbor-time">Когда с Вами удобнее связаться?</label>
                <select class="form-control" name="time" id="form-podbor-time">
                    <option value="утром">утром</option>
                    <option value="днем">днем</option>
                    <option value="вечером">вечером</option>
                </select>
            </div>
            <div class="form-group">
                <label class="control-label" for="form-podbor-comment">Пожелания по туру</label>
                <textarea class="form-control" name="comment" id="form-podbor-comment"></textarea>
            </div>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <button type="submit" class="btn btn-default pull-right" name="submit_contact">Подобрать тур</button>
            <div class="clearfix"></div>
        </form>
    </div>
    <div class="col-xs-24 col-md-11 col-md-offset-1">
        <ul class="list-unstyled list-profits">
            <li class="row">
                <div class="col-xs-6">
                    <img src="/_assets/_santa/_images/labels/1450095405_Discount.png" alt="discount" class="all-width">
                </div>
                <div class="col-xs-18">
                    <p class="h3">Гарантия лучшей цены</p>
                    <p>Если вы найдете готовый тур дешевле, чем у нас, при одинаковых условиях бронирования, мы предложим его вам по той же или более выгодной цене</p>
                </div>
            </li>
            <li class="row">
                <div class="col-xs-6">
                    <img src="/_assets/_santa/_images/labels/1450095924_Lock.png" alt="discount" class="all-width">
                </div>
                <div class="col-xs-18">
                    <p class="h3">100% гарантия отдыха</p>
                    <p>Чтобы вы чувствовали себя спокойно и уверенно на отдыхе — предлагаем уникальные страховые программы</p>
                </div>
            </li>
            <li class="row">
                <div class="col-xs-6">
                    <img src="/_assets/_santa/_images/labels/1450095369_Like.png" alt="discount" class="all-width">
                </div>
                <div class="col-xs-18">
                    <p class="h3">Только хорошие отзывы</p>
                    <p>98% наших клиентов оставили положительный отзыв</p>
                </div>
            </li>
            <li class="row">
                <div class="col-xs-6">
                    <img src="/_assets/_santa/_images/labels/1450095428_Heart.png" alt="discount" class="all-width">
                </div>
                <div class="col-xs-18">
                    <p class="h3">Проверенные туроператоры</p>
                    <p>Мы предлагаем туры только от проверенных партнеров</p>
                </div>
            </li>
            <li class="row">
                <div class="col-xs-6">
                    <img src="/_assets/_santa/_images/labels/1450095462_Gift.png" alt="discount" class="all-width">
                </div>
                <div class="col-xs-18">
                    <p class="h3">Туры ручной сборки</p>
                    <p>Отдых по Вашим правилам. Добавьте экскурсии и VIP трансфер в Вашу путевку</p>
                </div>
            </li>
        </ul>
    </div>
</div>

@push('scripts')
    {!! JsValidator::formRequest('App\Http\Requests\PodborRequest', '#form-podbor') !!}
@endpush