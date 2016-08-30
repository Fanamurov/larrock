<header class="row">
    <div class="col-xs-24 col-sm-12 col-md-5">
        <div class="col-xs-24 col-md-22 col-md-offset-0">
            <a href="/" class="logo">
                <img src="/_assets/tbkhv/_images/logo.png" width="225" height="49" alt="tbkhv.ru">
                <span class="logo-description">Товары из Китая в Хабаровске</span>
            </a>
        </div>
    </div>
    <div class="col-xs-24 col-sm-12 hidden-xs hidden-md hidden-lg">
        @include('tbkhv.modules.form.search-main')
    </div>
    <div class="col-xs-24 col-md-offset-1 col-md-18 hidden-xs">
        @include('tbkhv.sections.headBenefits')
    </div>
</header>

<div class="header-top_menu">
    <div class="col-xs-24 col-md-6 block-categories pointer show_menu">
        <span class="text-uppercase"><i class="fa fa-reorder"></i> Категории товаров</span>
        <span class="close_menu hidden"><i class="fa fa-times" title="Закрыть меню"></i></span>
    </div>
    <div class="col-xs-24 col-md-18 form-search-block hidden-sm">
        @include('tbkhv.modules.form.search-main')
    </div>
</div>
<div class="clearfix"></div>