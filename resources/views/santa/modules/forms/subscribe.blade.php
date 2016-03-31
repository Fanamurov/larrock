<form id="form-subscribe" class="form-subscribe" method="post" action="/forms/contact">
    <div class="help">
        <p class="h4">Подпишитесь на рассылку и получите подарок</p>
        <ul>
            <li>Актуальные горящие туры</li>
            <li>Новинки, акции и конкурсы</li>
            <li>Идеи путешествий и ценные советы</li>
        </ul>
    </div>
    <div class="form_div">
        <div class="form-group">
            <input type="text" class="form-control" id="form-contact-name" placeholder="Ваше имя" name="name">
        </div>
        <div class="form-group">
            <input type="email" class="form-control" id="form-contact-contact" placeholder="Email" name="contact">
        </div>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <button type="submit" class="btn btn-default btn-block" name="submit_subscribe">Подписаться</button>
    </div>
    <div class="clearfix"></div>
</form>