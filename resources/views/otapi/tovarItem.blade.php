@extends('tbkhv.main')
@section('title') Купить {{ $data->Title }} в Хабаровске. Товары из Китая @endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('otapi.tovar', $data->RootPath) !!}
@endsection

@section('content')
    <div class="page-catalog-item">
        <div class="col-xs-24 col-sm-12 col-md-7 block-gallery">
        @if(isset($data->Pictures))
            <?$count_picture = 0?>
            @if(count($data->Pictures->ItemPicture) > 0)
                @foreach($data->Pictures->ItemPicture as $picture)
                    <?++$count_picture?>
                    <a class="fancybox @if($count_picture === 1) bigImageItem @endif" href="{{ $picture->Large }}" rel="fancybox-thumb">
                        @if($count_picture === 1)
                            <img src="{{ $picture->Large }}" class="all-width fancybox LargeImg" alt="{{ $data->Title }}">
                        @else
                            <img src="{{ $picture->Small }}" class="fancybox SmallImg" alt="{{ $data->Title }}">
                        @endif
                    </a>
                @endforeach
            @else
                <a class="fancybox" href="{{ $data->Pictures->ItemPicture->Large }}" rel="fancybox-thumb">
                    <img src="{{ $data->Pictures->ItemPicture->Large }}" class="all-width fancybox LargeImg" alt="{{ $data->Title }}">
                </a>
            @endif
        @endif
        </div>
        <div class="col-xs-24 @if( !isset($vendor->Credit->Level)) col-sm-12 col-md-16 col-md-offset-1 @else col-sm-12 col-md-10 col-md-offset-1 @endif">
            <div>
                <h1>{{ mb_strimwidth($data->Title, 0, 130, '...') }}</h1>
                <p><a target="_blank" href="{{ $data->TaobaoItemUrl }}">[этот товар на таобао]</a></p>
                <br/>
            </div>
            <div class="clearfix"></div>
            @if($data->MasterQuantity > 0)
                @if(isset($data->Promotions[0]->Price->Quantity))
                    <p class="cost priceOld" style="text-decoration: line-through">
                        <span class="strong-heavy price-item">{{ $data->Price->ConvertedPriceWithoutSign }}</span>
                        <small>{{ $data->Price->CurrencySign }}</small>
                    </p>
                    <p class="cost">
                        Цена:
                        <span class="strong-heavy pricePromo-item">{{ $data->Promotions[0]->Price->ConvertedPriceWithoutSign }}</span>
                        <small>{{ $data->Promotions[0]->Price->CurrencySign }}</small>
                    </p>
                    <p class="alert alert-warning text-center" data-toggle="tooltip" data-placement="bottom" title="1кг=250 руб"><sup>*</sup>без учета таможенной пошлины<p>
                    <p class="text-center nalicie">В наличии: <span class="quantity-item">{{ $data->MasterQuantity }}</span> шт.</p>
                @elseif(isset($data->Promotions->Price->Quantity))
                    <p class="cost priceOld" style="text-decoration: line-through">
                        <span class="strong-heavy price-item">{{ $data->Price->ConvertedPriceWithoutSign }}</span>
                        <small>{{ $data->Price->CurrencySign }}</small>
                    </p>
                    <p class="cost">
                        Цена:
                        <span class="strong-heavy pricePromo-item">{{ $data->Promotions->Price->ConvertedPriceWithoutSign }}</span>
                        <small>{{ $data->Promotions->Price->CurrencySign }}</small>
                    </p>
                    <p class="alert alert-warning text-center" data-toggle="tooltip" data-placement="bottom" title="1кг=250 руб"><sup>*</sup>без учета таможенной пошлины<p>
                    <p class="text-center nalicie">В наличии: <span class="quantity-item">{{ $data->MasterQuantity }}</span> шт.</p>
                @else
                    <p class="cost">
                        Цена:
                        <span class="strong-heavy pricePromo-item">{{ $data->Price->ConvertedPriceWithoutSign }}</span>
                        <small>{{ $data->Price->CurrencySign }}</small>
                    </p>
                    <p class="alert alert-warning text-center" data-toggle="tooltip" data-placement="bottom" title="1кг=250 руб"><sup>*</sup>без учета таможенной пошлины<p>
                    <p class="text-center nalicie">В наличии: <span class="quantity-item">{{ $data->MasterQuantity }}</span> шт.</p>
                @endif
            @else
                <p class="alert alert-warning text-center">Товара нет в наличии</p>
            @endif

            @if(isset($category->ApproxWeight))
                <p class="text-center">Примерный вес: <span>{{ $category->ApproxWeight }}</span> кг.</p><br/>
            @endif
            <form id="ItemConfig">
            <div class="attributes-config">
                @if($data->IsSellAllowed === 'false' AND $data->HasInternalDelivery === 'false')
                    Нельзя купить: {{ $data->SellDisallowReason }}
                @endif

                @php($attributeKey = '@attributes')
                @php($current_line_attribute = '')
                @foreach($data->Attributes->ItemAttribute as $attr_key => $attr_value)
                    @if($attr_value->IsConfigurator === 'true')
                        @if($current_line_attribute !== $attr_value->PropertyName)
                            @php($current_line_attribute = $attr_value->PropertyName)
                            <p>{{ $attr_value->PropertyName }}:</p>
                        @endif
                        @if(isset($attr_value->MiniImageUrl) && $attr_value->MiniImageUrl !== '')
                            <button type="button" class="change-bigImageItem change-config-item change-config-item-{{ $attr_value->$attributeKey->Pid }} btn btn-default" rel="property"
                                    title="{{ $attr_value->PropertyName }} {{ $attr_value->Value }}"
                                    data-vid="{{ $attr_value->$attributeKey->Vid }}"
                                    data-pid="{{ $attr_value->$attributeKey->Pid }}"
                                    data-originalName="{{ $attr_value->OriginalPropertyName }}:{{ $attr_value->OriginalValue }}
                                            ({{ $attr_value->PropertyName }} {{ $attr_value->Value }})
                                    {{ mb_strimwidth($attr_value->Value, 0, 10, '...') }}"
                                    data-scr="{{ $attr_value->ImageUrl }}">
                                <img src="{{ $attr_value->MiniImageUrl }}" alt="{{ $attr_value->PropertyName }} {{ $attr_value->Value }}">
                            </button>
                        @else
                            <button type="button" class="change-config-item change-config-item-{{ $attr_value->$attributeKey->Pid }} btn btn-default"
                                    title="{{ $attr_value->PropertyName }} {{ $attr_value->Value }}"
                                    data-vid="{{ $attr_value->$attributeKey->Vid }}"
                                    data-pid="{{ $attr_value->$attributeKey->Pid }}"
                                    data-originalName="{{ $attr_value->OriginalPropertyName }}:{{ $attr_value->OriginalValue }}
                                            ({{ $attr_value->PropertyName }} {{ $attr_value->Value }}) ">
                                {{ mb_strimwidth($attr_value->Value, 0, 10, '...') }}
                            </button>
                        @endif
                        @if($current_line_attribute !== $data->Attributes->ItemAttribute[$attr_key+1]->PropertyName)
                                <input type="hidden" class="current_config" id="config-{{ $attr_value->$attributeKey->Pid }}" name="{{ $attr_value->$attributeKey->Pid }}" value="">
                            <div class="clearfix"></div><br/>
                        @endif
                    @endif
                @endforeach
                <input type="hidden" name="configs" value='{!! json_encode($data->ConfiguredItems) !!}'>
                <input type="hidden" name="configs_promo" value='{!! json_encode($data->Promotions) !!}'>
            </div>
            </form>
            <br/>
            <input type="hidden" name="configurationId" value="">
            @if($data->MasterQuantity > 0)
                <p class="text-center button_bg">
                    <button class="btn btn-danger btn-lg btn-add-to-cart" disabled
                        data-id="{{ $data->Id }}"
                        data-name="{{ $data->OriginalTitle }}"
                        data-price=""
                        data-config=""
                        data-src="">
                    <i class="fa fa-cart-plus"></i> Добавить в корзину</button>
                    <button class="btn btn-info btn-lg btn-add-to-cart" disabled
                            data-id="{{ $data->Id }}"
                            data-name="{{ $data->OriginalTitle }}"
                            data-price=""
                            data-config=""
                            data-src=""
                            data-action="to_cart">
                        <i class="fa fa-shopping-cart"></i> Купить в один клик</button>
                    <a href="/cart" class="btn btn-success btn-lg hidden btn-to-cart-link"><i class="fa fa-shopping-cart"></i> К корзине</a>
                </p>
            @else
                <p class="text-center button_bg"><span class="h2">Товара нет в наличии</span></p>
            @endif
            <div class="clearfix"></div>
        </div>
        @if(isset($vendor->Credit->Level))
            <div class="col-xs-24 col-md-5 col-md-offset-1">
                <div class="vendor">
                    <p class="h4 row">Продавец:</p>
                    <ul class="list-unstyled row list-vendor">
                        <li class="row">
                            <p class="col-xs-24">
                                <a href="/otapi/vendor/{{ $data->VendorId }}">{{ $data->VendorName }}</a>
                                <br/>
                                @php($count_it = ceil($vendor->Credit->Level/5))
                                @for($i=0; $i < $count_it; $i++)
                                    <i class="fa fa-star"></i>
                                @endfor
                            </p>
                        </li>
                        <li class="row">
                            <p class="col-xs-24">{{ $data->Location->City }}
                                ({{ $data->Location->State }})</p>
                        </li>
                        <li class="row">
                            <p class="col-xs-24">{{ $vendor->VendorInfo->Credit->TotalFeedbacks }} отзывов
                                <i class="glyphicon glyphicon-heart"></i>
                                @if($vendor->VendorInfo->Credit->TotalFeedbacks > 0)
                                    {{ mb_strimwidth(($vendor->VendorInfo->Credit->PositiveFeedbacks * 100) / $vendor->VendorInfo->Credit->TotalFeedbacks, 0, 5, '') }}%
                                @endif
                            </p>
                        </li>
                    </ul>
                </div>

                @if($vendorTovars->TotalCount > 0)
                    <p class="h4 text-center row">Так же продает:</p>
                    <div class="row row-vendorTovars">
                        @foreach($vendorTovars->Content->Item as $tovar)
                            @if(isset($tovar->Pictures->ItemPicture[0]->Small))
                            <a href="/otapi/{{ $tovar->CategoryId }}/tovar/{{ $tovar->Id }}">
                                <img src="{{ $tovar->Pictures->ItemPicture[0]->Small }}" class="col-xs-12" alt="Фото товара">
                            </a>
                            @endif
                        @endforeach
                        @if($vendorTovars->TotalCount - 6 > 0)
                            <p class="text-right"><i>
                                    И еще <a href="/otapi/vendor/{{ $data->VendorId }}">
                                        {{ $vendorTovars->TotalCount-6 }} товаров...</a></i>
                            </p>
                        @endif
                    </div>
                @endif
            </div>
        @endif
    </div>
    <div class="clearfix"></div><br/><br/><br/>

    <div class="tabs">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs nav-tabs-description" role="tablist">
            <li role="presentation" class="active"><a href="#photo-description" aria-controls="photo-description" role="tab" data-toggle="tab">Фото и описание</a></li>
            <li role="presentation"><a href="#description" aria-controls="description" role="tab" data-toggle="tab">Характеристики товара</a></li>
            <li role="presentation"><a href="#opinions" aria-controls="opinions" role="tab" data-toggle="tab">Отзывы</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="photo-description">
                <div class="col-xs-24">
                    <!--{!! $data->Description !!}-->
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="description">
                <div class="col-xs-24">
                    @include('otapi.item.attribute-list')
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="opinions">
                <div class="col-xs-24">
                    @include('otapi.item.opinions')
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-24">
            @include('tbkhv.modules.catalog.soputka', ['data' => $moduleLast->Items->Content->Item, 'totalCount' => $moduleLast->Items->TotalCount])
        </div>
    </div>
@endsection