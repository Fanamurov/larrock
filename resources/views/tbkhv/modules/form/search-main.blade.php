<form action="/otapi/search" method="get">
    <div class="input-group block-search">
        <input name="search" type="text" class="form-control" placeholder="Поиск товаров по названию или коду..." value="{{ Request::get('search') }}">
        <span class="input-group-btn">
                        <button class="btn btn-default" type="submit"><i class="fa fa-search"></i> Искать!</button>
                    </span>
    </div>
</form>