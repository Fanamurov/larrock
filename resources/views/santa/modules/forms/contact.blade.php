<form id="form-contact" class="form-contact" method="post" action="/forms/contact">
    <p class="h3 text-center">Задать вопрос</p>
    <div class="form-group">
        <input type="text" class="form-control" id="form-contact-name" placeholder="Как к вам обращаться" name="name">
    </div>
    <div class="form-group">
        <input type="text" class="form-control" id="form-contact-contact" placeholder="Email или телефон" name="contact">
    </div>
    <div class="form-group">
        <textarea class="form-control" name="comment" id="form-contact-comment" placeholder="Текст сообщения"></textarea>
    </div>
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <button type="submit" class="btn btn-default pull-right" name="submit_contact">Отправить</button>
    <div class="clearfix"></div>
</form>
{!! JsValidator::formRequest('App\Http\Requests\ContactRequest', '#form-contact') !!}