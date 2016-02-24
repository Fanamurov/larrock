@extends('tbkhv.main')
@section('title') Купить {{ (string)$data->OtapiItemFullInfo->Title }} в Хабаровске. Товары из Китая @endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('otapi.tovar', (string)$category->OtapiCategory->Id) !!}
@endsection

@section('content')
    <div class="page-catalog-item">
        <div class="col-xs-7 block-gallery">
            <?$count_picture = 0?>
            @foreach($data->OtapiItemFullInfo->Pictures->ItemPicture as $picture)
                <?++$count_picture?>
                <a class="fancybox" href="{{ (string)$picture->Large }}" rel="fancybox-thumb">
                    @if($count_picture === 1)
                        <img src="{{ (string)$picture->Large }}" class="all-width fancybox LargeImg" alt="{{ (string)$data->OtapiItemFullInfo->Title }}">
                    @else
                        <img src="{{ (string)$picture->Small }}" class="fancybox SmallImg" alt="{{ (string)$data->OtapiItemFullInfo->Title }}">
                    @endif
                </a>
            @endforeach
        </div>
        <div class="col-xs-10 col-xs-offset-1">
            <h1>{{ (string)$data->OtapiItemFullInfo->Title }}</h1>
            <p class="h4">{{ (string)$data->OtapiItemFullInfo->OriginalTitle }}</p>
            <p><a href="{{ (string)$data->OtapiItemFullInfo->TaobaoItemUrl }}">[этот товар на таобао]</a></p>
            <p class="cost">
                <span class="strong-heavy">{{ (string)$data->OtapiItemFullInfo->Price->ConvertedPriceWithoutSign }}</span>
                {{ (string)$data->OtapiItemFullInfo->Price->CurrencySign }}
            </p>
            <div class="attributes-config">
                @foreach($data->OtapiItemFullInfo->Attributes->ItemAttribute as $attribute)
                    @if((string)$attribute->IsConfigurator === 'true')
                        <p>
                            <span>{{ (string)$attribute->PropertyName }}:</span>
                            @if((string)$attribute->MiniImageUrl !== '')
                                <a class="fancybox" rel="property" href="{{ (string)$attribute->ImageUrl }}">
                                    <img src="{{ (string)$attribute->MiniImageUrl }}" alt="{{ (string)$attribute->PropertyName }} {{ (string)$attribute->Value }}">
                                    {{ (string)$attribute->Value }}
                                </a>
                            @else
                                {{ (string)$attribute->Value }}
                            @endif
                        </p>
                    @endif
                @endforeach
            </div>
            <p>В наличии: {{ (string)$data->OtapiItemFullInfo->MasterQuantity }} шт.</p>
            <button class="btn btn-danger btn-lg btn-add-to-cart"
                    data-id="{{ (string)$data->OtapiItemFullInfo->Id }}"
                    data-name="{{ (string)$data->OtapiItemFullInfo->OriginalTitle }}"
                    data-price="{{ (string)$data->OtapiItemFullInfo->Price->ConvertedPriceWithoutSign }}">
                <i class="fa fa-cart-plus"></i> Добавить в корзину
            </button>
            <a href="/cart" class="btn btn-success btn-lg hidden btn-to-cart-link">Товар добавлен в корзину. Перейти к оформлению покупки</a>
            <div class="clearfix"></div>
        </div>
        <div class="col-xs-5 col-xs-offset-1">
            <p class="h4 row text-center">Продавец:</p>
            <ul class="list-unstyled row list-vendor">
                <li class="row">
                    <p class="col-xs-12">Имя:</p>
                    <p class="col-xs-12"><a href="/otapi/vendor/{{ (string)$data->OtapiItemFullInfo->VendorId }}">{{ (string)$data->OtapiItemFullInfo->VendorName }}</a></p>
                </li>
                <li class="row">
                    <p class="col-xs-12">Находится в:</p>
                    <p class="col-xs-12">{{ (string)$data->OtapiItemFullInfo->Location->City }}
                        ({{ (string)$data->OtapiItemFullInfo->Location->State }})</p>
                </li>
                <li class="row">
                    <p class="col-xs-12">Отзывов:</p>
                    <p class="col-xs-12">{{ (string)$vendor->VendorInfo->Credit->TotalFeedbacks }}</p>
                </li>
                <li class="row">
                    <p class="col-xs-12">Положительных:</p>
                    <p class="col-xs-12">{{ (string)$vendor->VendorInfo->Credit->PositiveFeedbacks }}</p>
                </li>
                <li class="row">
                    <p class="col-xs-12">Рейтинг:</p>
                    <p class="col-xs-12">{{ (string)$vendor->VendorInfo->Credit->Level }}</p>
                </li>
            </ul>

            <hr/>
            <p class="h4 text-center row">Так же продает:</p>
            <div class="row">
                @foreach($vendorTovars->OtapiItemInfoSubList->Content->Item as $tovar)
                    <a href="/otapi/{{ (string)$tovar->CategoryId }}/tovar/{{ (string)$tovar->Id }}">
                        <img src="{{ (string)$tovar->Pictures->ItemPicture->Small }}" class="col-xs-8" alt="Фото товара">
                    </a>
                @endforeach
                <p class="text-right"><i>
                    И еще <a href="/otapi/vendor/{{ (string)$data->OtapiItemFullInfo->VendorId }}">
                        {{ (string)$vendorTovars->OtapiItemInfoSubList->TotalCount }} товаров...</a></i>
                </p>
            </div>
        </div>
    </div>
    <div class="clearfix"></div><br/><br/><br/>

    <div class="tabs">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs nav-tabs-description" role="tablist">
            <li role="presentation"><a href="#description" aria-controls="description" role="tab" data-toggle="tab">Характеристики товара</a></li>
            <li role="presentation" class="active"><a href="#photo-description" aria-controls="photo-description" role="tab" data-toggle="tab">Фото и описание</a></li>
            <li role="presentation"><a href="#opinions" aria-controls="opinions" role="tab" data-toggle="tab">Отзывы</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane" id="description">
                <div class="col-xs-24">
                    @foreach($data->OtapiItemFullInfo->Attributes->ItemAttribute as $attribute)
                        @if((string)$attribute->IsConfigurator === 'false')
                            <p><i>{{ (string)$attribute->PropertyName }}: {{ (string)$attribute->Value }}</i></p>
                        @endif
                    @endforeach
                </div>
            </div>
            <div role="tabpanel" class="tab-pane active" id="photo-description">
                <div class="col-xs-24">
                    {!! (string)$GetItemDescription->OtapiItemDescription->ItemDescription !!}
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="opinions">
                <div class="col-xs-24">

                </div>
            </div>
        </div>
    </div>
@endsection