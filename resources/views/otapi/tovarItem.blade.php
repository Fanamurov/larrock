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
            @if(isset($item['config_current']->Price->promoPrice))
                <p class="cost priceOld" style="text-decoration: line-through">
                    <span class="strong-heavy price-item">{{ $item['config_current']->Price->ConvertedPriceWithoutSign }}</span><small>{{ $item['config_current']->Price->CurrencySign }}</small>
                </p>
                <p class="cost">
                    Цена:
                    <span class="strong-heavy pricePromo-item">{{ $item['config_current']->Price->promoPrice }}</span><small>{{ $item['config_current']->Price->CurrencySign }}</small>
                </p>
            @else
                <p class="cost">
                    Цена:
                    <span class="strong-heavy price-item">{{ $item['config_current']->Price->ConvertedPriceWithoutSign }}</span><small>{{ $item['config_current']->Price->CurrencySign }}</small>
                </p>
            @endif
            <p class="alert alert-warning text-center" data-toggle="tooltip" data-placement="bottom" title="1кг=250 руб"><sup>*</sup>без учета таможенной пошлины<p>
            <p class="text-center nalicie">В наличии: <span class="quantity-item">{{ $item['config_current']->Quantity }}</span> шт.</p>
            <?if(isset($category->ApproxWeight)){?>
                <p class="text-center">Примерный вес: <span>{{ $category->ApproxWeight }}</span> кг.</p><br/>
            <?}?>
            <div class="attributes-config">
                @if($data->IsSellAllowed === 'false' AND $data->HasInternalDelivery === 'false')
                    Нельзя купить: {{ $data->SellDisallowReason }}
                @endif

                @foreach($item['attr'] as $attr_key => $attr)
                    <div class="col-xs-24 row">
                        <div class="col-xs-6" style="padding-left: 0"><i>{{ $attr_key }}:</i></div>
                        <div class="col-xs-18">
                            @foreach($attr as $key => $attr_value)
                                @php($attributeKey = '@attributes')
                                @if(isset($attr_value->MiniImageUrl) && $attr_value->MiniImageUrl !== '')
                                    <button type="button" class="change-bigImageItem change-config-item change-config-item-{{ $attr_value->$attributeKey->Pid }} btn btn-default
                                    @if($item['config_current']->bucket->get($attr_value->$attributeKey->Pid) === $attr_value->$attributeKey->Vid) active @endif" rel="property"
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
                                    <button type="button" class="change-config-item change-config-item-{{ $attr_value->$attributeKey->Pid }} btn btn-default
                                @if($item['config_current']->bucket->get($attr_value->$attributeKey->Pid) === $attr_value->$attributeKey->Vid) active @endif"
                                            title="{{ $attr_value->PropertyName }} {{ $attr_value->Value }}"
                                            data-vid="{{ $attr_value->$attributeKey->Vid }}"
                                            data-pid="{{ $attr_value->$attributeKey->Pid }}"
                                            data-originalName="{{ $attr_value->OriginalPropertyName }}:{{ $attr_value->OriginalValue }}
                                                    ({{ $attr_value->PropertyName }} {{ $attr_value->Value }}) ">
                                        {{ mb_strimwidth($attr_value->Value, 0, 10, '...') }}
                                    </button>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <br/>
                @endforeach
                <input type="hidden" name="configs" value='{!! json_encode($item['configs']) !!}'>
                <input type="hidden" name="config_current" value='{!! json_encode($item['config_current']) !!}'>
            </div>
            <br/>
            <input type="hidden" name="configurationId" value="">
            @if($item['config_current']->Quantity > 0)
                <p class="text-center button_bg">
                    <button class="btn btn-danger btn-lg btn-add-to-cart"
                        data-id="{{ $data->Id }}"
                        data-name="{{ $data->OriginalTitle }}"
                        @if(isset($item['config_current']->Price->promoPrice))
                            data-price="{{ $item['config_current']->Price->promoPrice }}"
                        @else
                            data-price="{{ $data->Price->ConvertedPriceWithoutSign }}"
                        @endif
                        data-config=""
                        data-src="">
                    <i class="fa fa-cart-plus"></i> Добавить в корзину</button>
                    <button class="btn btn-info btn-lg btn-add-to-cart"
                            data-id="{{ $data->Id }}"
                            data-name="{{ $data->OriginalTitle }}"
                            @if(isset($data->Price->promoPrice))
                                data-price="{{ $data->Price->promoPrice }}"
                            @else
                                data-price="{{ $data->Price->ConvertedPriceWithoutSign }}"
                            @endif
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
                    {!! $data->Description !!}
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="description">
                <div class="col-xs-24">
                    @if(isset($data->Attributes->ItemAttribute))
                        @foreach($data->Attributes->ItemAttribute as $attribute)
                            @if(isset($attribute->IsConfigurator) && $attribute->IsConfigurator === 'false')
                                <p><i>{{ $attribute->PropertyName }}: {{ $attribute->Value }}</i></p>
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="opinions">
                <div class="col-xs-24">
                    @foreach($opinions as $item)
                        <div>{{ $item->Content }}</div>
                        <div>{{ $item->CreatedDate }}</div>
                        <div>{{ $item->UserNick }}</div>
                        <div>{{ $item->Result }}</div>
                        <div>{{ $item->Images }}</div>
                    @endforeach
                    <div id="mc-container"></div>
                    <script type="text/javascript">
                        cackle_widget = window.cackle_widget || [];
                        cackle_widget.push({widget: 'Comment', id: {{ $data->Id }});
                        (function() {
                            var mc = document.createElement('script');
                            mc.type = 'text/javascript';
                            mc.async = true;
                            mc.src = ('https:' == document.location.protocol ? 'https' : 'http') + '://cackle.me/widget.js';
                            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(mc, s.nextSibling);
                        })();
                    </script>
                    <a id="mc-link" href="http://cackle.me">Комментарии для сайта <b style="color:#4FA3DA">Cackl</b><b style="color:#F65077">e</b></a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-24">
            @include('tbkhv.modules.catalog.soputka', $moduleLast)
        </div>
    </div>
@endsection