<div class="row row-zakazTura col-xs-24" id="row-zakazHotel">
    <div class="col-sm-12">
        <form id="form-zakaz" class="form-zakazHotel" method="post" action="/forms/zakazHotel">
            <p class="h1">Проверка наличия номеров</p>
            <div class="form-group">
                <label for="form-zakazHotel-name" class="control-label">Как к Вам обращаться?<sup>*</sup>:</label>
                <input type="text" class="form-control" id="form-zakazHotel-name" placeholder="Как к вам обращаться" name="name">
            </div>
            <div class="form-group">
                <label for="form-zakazHotel-tel" class="control-label">Номер телефона<sup>*</sup>:</label>
                <input type="text" class="form-control" id="form-zakazHotel-tel" placeholder="Телефон" name="tel">
            </div>
            <div class="form-group">
                <label for="form-zakazHotel-email" class="control-label">E-mail<sup>*</sup>:</label>
                <input type="email" class="form-control" id="form-zakazHotel-email" placeholder="Email" name="email">
            </div>
            <div class="form-group">
                <label for="form-zakazHotel-city" class="control-label">Вылет из города<sup>*</sup>:</label>
                <select name="city" id="form-zakazHotel-city" class="form-control">
                    <option value="Хабаровск">Хабаровск</option>
                    <option value="Москва">Москва</option>
                    <option value="Владивосток">Владивосток</option>
                    <option value="Благовещенск">Благовещенск</option>
                </select>
            </div>
            <div class="form-group">
                <label for="form-zakazHotel-date" class="control-label">Дата заезда<sup>*</sup>:</label>
                <input type="date" class="form-control" id="form-zakazHotel-date" name="date">
            </div>
            <div class="form-group">
                <label for="form-zakazHotel-date-out" class="control-label">Дата отъезда<sup>*</sup>:</label>
                <input type="date" class="form-control" id="form-zakazHotel-date-out" name="date-out">
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-xs-5">
                        <input type="text" class="form-control" id="form-zakazHotel-adult" value="2" name="adult">
                    </div>
                    <div class="col-xs-19">
                        <label for="form-zakazHotel-adult" class="control-label">Количество взрослых людей<sup>*</sup></label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-xs-5">
                        <input type="text" class="form-control" id="form-zakazHotel-kids" value="0" name="kids">
                    </div>
                    <div class="col-xs-19">
                        <label for="form-zakazHotel-kids" class="control-label">Количество детей<sup>*</sup></label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-xs-5">
                        <input type="text" class="form-control" id="form-zakazHotel-baby" value="0" name="baby">
                    </div>
                    <div class="col-xs-19">
                        <label for="form-zakazHotel-baby" class="control-label">Количество младенцев до 2 лет<sup>*</sup></label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="form-zakazHotel-comment" class="control-label">Ваши пожелания:</label>
                <textarea class="form-control" name="comment" id="form-zakazHotel-comment" placeholder="Текст сообщения"></textarea>
            </div>
            <input type="hidden" name="hotel_url" value="{{ URL::full() }}">
            <input type="hidden" name="hotel_name" value="{{ $data->title }}">
            <input type="hidden" name="hotel_id" value="{{ $data->id }}">
            <input type="hidden" name="hotel_type" value="hotel">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <button type="submit" class="btn btn-default pull-right" name="submit_zakaz">Проверить наличие номеров</button>
            <div class="clearfix"></div>
            <br/>
            <p>Так же вы можете забронировать отель
                по телефону: <a href="tel:84212454546">(4212) 45-45-46</a>
                или заказать <a href="/page/kontakty/">у нас в офисе</a></p>
        </form>
    </div>
    <div class="col-sm-11 col-sm-offset-1">
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
{!! JsValidator::formRequest('App\Http\Requests\ZakazHotelRequest', '#form-zakazHotel') !!}
@endpush