@extends('tbkhv.main')
@section('title') Купить в Китае {{ (string)$data->OtapiItemFullInfo->Title }} @endsection

@section('content')
    <div class="page-catalog-item">
        <div class="col-xs-7 block-gallery">
            @foreach($data->OtapiItemFullInfo->Pictures->ItemPicture as $picture)
                <p>Картинка: {{ (string)$picture->Large }}</p>
            @endforeach
            <img src="ves_16.jpg" class="all-width">
        </div>
        <div class="col-xs-10 col-xs-offset-1">
            <h1>{{ (string)$data->OtapiItemFullInfo->Title }}</h1>
            <p class="h4">{{ (string)$data->OtapiItemFullInfo->OriginalTitle }}</p>
            <p>{{ (string)$data->OtapiItemFullInfo->TaobaoItemUrl }}</p>
            <p class="cost">
                <span class="strong-heavy">{{ (string)$data->OtapiItemFullInfo->Price->ConvertedPriceWithoutSign }}</span>
                {{ (string)$data->OtapiItemFullInfo->Price->CurrencySign }}
            </p>
            <p>Есть доставка: {{ (string)$data->OtapiItemFullInfo->Price->IsDeliverable }}</p>
            <button class="btn btn-warning btn-lg"><i class="fa fa-cart-plus"></i> Добавить в корзину</button>
            <div class="clearfix"></div>
            <br/>
            <div class="description">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                    labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                    laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                    voluptate velit esse cillum dolore eu fugiat nulla pariatur</p>
            </div>
        </div>
        <div class="col-xs-5 col-xs-offset-1">
            <p class="h4">Продавец:</p>
            <ul class="list-unstyled row">
                <li>
                    <p class="col-xs-12">Имя:</p>
                    <p class="col-xs-12">{{ (string)$data->OtapiItemFullInfo->VendorName }}</p>
                </li>
                <li>
                    <p class="col-xs-12">Находится в:</p>
                    <p class="col-xs-12">{{ (string)$data->OtapiItemFullInfo->Location->City }}
                    ({{ (string)$data->OtapiItemFullInfo->Location->State }})</p>
                </li>
                <li>
                    <p class="col-xs-12">Количество товара:</p>
                    <p class="col-xs-12">{{ (string)$data->OtapiItemFullInfo->MasterQuantity }}</p>
                </li>
                <li>
                    <p class="col-xs-12">Отзывов:</p>
                    <p class="col-xs-12">38582</p>
                </li>
                <li>
                    <p class="col-xs-12">Положительных:</p>
                    <p class="col-xs-12">100.00%</p>
                </li>
                <li>
                    <p class="col-xs-12">Рейтинг:</p>
                    <p class="col-xs-12"><i class="fa fa-star"></i><i class="fa fa-star"></i> {{ (string)$data->OtapiItemFullInfo->VendorScore }}</p>
                </li>
            </ul>

            <hr/>
            <p class="h4 text-center">Так же продает:</p>
            <div class="row">
                <img src="ves_16.jpg" class="col-xs-8">
                <img src="ves_16.jpg" class="col-xs-8">
                <img src="ves_16.jpg" class="col-xs-8">
                <img src="ves_16.jpg" class="col-xs-8">
                <img src="ves_16.jpg" class="col-xs-8">
                <img src="ves_16.jpg" class="col-xs-8">
            </div>
        </div>
    </div>
    <div class="clearfix"></div><br/><br/>

    <div class="tabs">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#description" aria-controls="description" role="tab" data-toggle="tab">Характеристики товара</a></li>
            <li role="presentation"><a href="#photo-description" aria-controls="photo-description" role="tab" data-toggle="tab">Фото и описание</a></li>
            <li role="presentation"><a href="#opinions" aria-controls="opinions" role="tab" data-toggle="tab">Отзывы</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="description">
                Раздел:
                <p>Id Category: {{ (string)$category->OtapiCategory->Id }}</p>
                <p>Category name: {{ (string)$category->OtapiCategory->Name }}</p>
                <p>Id parent category: {{ (string)$category->OtapiCategory->ParentId }}</p>
            </div>
            <div role="tabpanel" class="tab-pane" id="photo-description">

            </div>
            <div role="tabpanel" class="tab-pane" id="opinions">

            </div>
        </div>
    </div>
@endsection