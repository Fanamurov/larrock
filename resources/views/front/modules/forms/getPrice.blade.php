<form id="form-getPrice" class="form-contact" method="post" action="/forms/getPrice">
    <p class="h3 text-center">Запросить прайс</p>
    <div class="form-group">
        <input type="email" class="form-control" id="form-getPrice-email" placeholder="Введите ваш email" name="email">
    </div>
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <button type="submit" class="btn btn-default pull-right" name="submit_contact">Запросить прайс</button>
    <div class="clearfix"></div>
</form>