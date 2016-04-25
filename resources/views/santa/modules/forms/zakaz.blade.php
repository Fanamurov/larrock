<div class="row row-zakazTura" id="row-zakazTura">
    <div class="col-sm-12">
        <form id="form-zakaz" class="form-zakaz" method="post" action="/forms/zakazTura">
            <p class="h1">Заказ тура</p>
            <div class="form-group">
                <label for="form-contact-email" class="control-label">Как к Вам обращаться?<sup>*</sup>:</label>
                <input type="text" class="form-control" id="form-contact-name" placeholder="Как к вам обращаться" name="name">
            </div>
            <div class="form-group">
                <label for="form-contact-tel" class="control-label">Номер телефона<sup>*</sup>:</label>
                <input type="text" class="form-control" id="form-contact-tel" placeholder="Телефон" name="tel">
            </div>
            <div class="form-group">
                <label for="form-contact-email" class="control-label">E-mail<sup>*</sup>:</label>
                <input type="email" class="form-control" id="form-contact-email" placeholder="Email" name="email">
            </div>
            <div class="form-group">
                <label for="form-contact-date" class="control-label">Примерная дата вылета<sup>*</sup>:</label>
                <input type="date" class="form-control" id="form-contact-date" name="date">
            </div>
            <div class="form-group">
                <label for="form-contact-comment" class="control-label">Ваши пожелания:</label>
                <textarea class="form-control" name="comment" id="form-contact-comment" placeholder="Текст сообщения"></textarea>
            </div>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <button type="submit" class="btn btn-default pull-right" name="submit_zakaz">Заказать тур</button>
            <div class="clearfix"></div>
            <br/>
            <p>Так же вы можете заказать тур
                по телефону: (4212) 45-45-46
                или заказать <a href="/page/kontakty/">у нас в офисе</a></p>
        </form>
    </div>
    <div class="col-sm-11 col-sm-offset-1">
        <ul class="list-unstyled list-profits">
            <li class="row">
                <div class="col-sm-6">
                    <img src="/_assets/_santa/_images/labels/1450095405_Discount.png" alt="discount" class="all-width">
                </div>
                <div class="col-sm-18">
                    <p class="h3">Гарантия лучшей цены</p>
                    <p>Если вы найдете готовый тур дешевле, чем у нас, при одинаковых условиях бронирования, мы предложим его вам по той же или более выгодной цене</p>
                </div>
            </li>
            <li class="row">
                <div class="col-sm-6">
                    <img src="/_assets/_santa/_images/labels/1450095924_Lock.png" alt="discount" class="all-width">
                </div>
                <div class="col-sm-18">
                    <p class="h3">100% гарантия отдыха</p>
                    <p>Чтобы вы чувствовали себя спокойно и уверенно на отдыхе — предлагаем уникальные страховые программы</p>
                </div>
            </li>
            <li class="row">
                <div class="col-sm-6">
                    <img src="/_assets/_santa/_images/labels/1450095369_Like.png" alt="discount" class="all-width">
                </div>
                <div class="col-sm-18">
                    <p class="h3">Только хорошие отзывы</p>
                    <p>98% наших клиентов оставили положительный отзыв</p>
                </div>
            </li>
            <li class="row">
                <div class="col-sm-6">
                    <img src="/_assets/_santa/_images/labels/1450095428_Heart.png" alt="discount" class="all-width">
                </div>
                <div class="col-sm-18">
                    <p class="h3">Проверенные туроператоры</p>
                    <p>Мы предлагаем туры только от проверенных партнеров</p>
                </div>
            </li>
            <li class="row">
                <div class="col-sm-6">
                    <img src="/_assets/_santa/_images/labels/1450095462_Gift.png" alt="discount" class="all-width">
                </div>
                <div class="col-sm-18">
                    <p class="h3">Туры ручной сборки</p>
                    <p>Отдых по Вашим правилам. Добавьте экскурсии и VIP трансфер в Вашу путевку</p>
                </div>
            </li>
        </ul>
    </div>
</div>
{!! JsValidator::formRequest('App\Http\Requests\ZakazRequest', '#form-zakaz') !!}