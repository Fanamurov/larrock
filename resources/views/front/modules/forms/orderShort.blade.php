<form id="form-orderShort" class="form-orderShort" method="post" action="/cart/short">
    <p class="h3 text-center">Форма заявки</p>
    <div class="form-group">
        <input type="text" class="form-control" id="form-orderShort-name" placeholder="Как к вам обращаться" name="name">
    </div>
    <div class="form-group">
        <input type="text" class="form-control" id="form-orderShort-contact" placeholder="Email или телефон" name="contact">
    </div>
    <div class="form-group">
        <textarea class="form-control" name="comment" id="form-orderShort-comment" placeholder="Комментарий"></textarea>
    </div>
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <button type="submit" class="btn btn-default pull-right" name="submit_orderShort">Отправить заявку</button>
    <div class="clearfix"></div>
</form>