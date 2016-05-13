@extends('tbkhv.main')
@section('title') Купить {{ $data['Result']['Item']['Title'] }} в Хабаровске. Товары из Китая @endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('otapi.tovar', $category['OtapiCategory']['Id']) !!}
@endsection

@section('content')
    <div class="page-catalog-item">
        <div class="col-xs-7 block-gallery">
            <?$count_picture = 0?>
            @if( !array_key_exists('Large', $data['Result']['Item']['Pictures']['ItemPicture']))
                @foreach($data['Result']['Item']['Pictures']['ItemPicture'] as $picture)
                    <?++$count_picture?>
                    <a class="fancybox @if($count_picture === 1) bigImageItem @endif" href="{{ $picture['Large'] }}" rel="fancybox-thumb">
                        @if($count_picture === 1)
                            <img src="{{ $picture['Large'] }}" class="all-width fancybox LargeImg" alt="{{ $data['Result']['Item']['Title'] }}">
                        @else
                            <img src="{{ $picture['Small'] }}" class="fancybox SmallImg" alt="{{ $data['Result']['Item']['Title'] }}">
                        @endif
                    </a>
                @endforeach
            @else
                <a class="fancybox" href="{{ $data['Result']['Item']['Pictures']['ItemPicture']['Large'] }}" rel="fancybox-thumb">
                    <img src="{{ $data['Result']['Item']['Pictures']['ItemPicture']['Large'] }}" class="all-width fancybox LargeImg" alt="{{ $data['Result']['Item']['Title'] }}">
                </a>
            @endif
        </div>
        <div class="col-xs-10 col-xs-offset-1">
            <div>
                <h1>{{ mb_strimwidth($data['Result']['Item']['Title'], 0, 130, '...') }}</h1>
                <p><a target="_blank" href="{{ $data['Result']['Item']['TaobaoItemUrl'] }}">[этот товар на таобао]</a></p>
                <br/>
            </div>
            <div class="clearfix"></div>
            @if(isset($item['config_current']['Price']['promoPrice']))
                <p class="cost priceOld" style="text-decoration: line-through">
                    <span class="strong-heavy price-item">{{ $item['config_current']['Price']['ConvertedPriceWithoutSign'] }}</span><small>{{ $item['config_current']['Price']['CurrencySign'] }}</small>
                </p>
                <p class="cost">
                    Цена:
                    <span class="strong-heavy pricePromo-item">{{ $item['config_current']['Price']['promoPrice'] }}</span><small>{{ $item['config_current']['Price']['CurrencySign'] }}</small>
                </p>
            @else
                <p class="cost">
                    Цена:
                    <span class="strong-heavy price-item">{{ $item['config_current']['Price']['ConvertedPriceWithoutSign'] }}</span><small>{{ $item['config_current']['Price']['CurrencySign'] }}</small>
                </p>
            @endif
            <p class="text-center nalicie">В наличии: <span class="quantity-item">{{ $item['config_current']['Quantity'] }}</span> шт.</p>
            <div class="attributes-config">
                @if($data['Result']['Item']['IsSellAllowed'] === 'false' AND $data['Result']['Item']['HasInternalDelivery'] === 'false')
                    Нельзя купить: {{ $data['Result']['Item']['SellDisallowReason'] }}
                @endif

                @foreach($item['attr'] as $attr_key => $attr)
                    <div class="col-xs-24 row">
                        <div class="col-xs-6" style="padding-left: 0"><i>{{ $attr_key }}:</i></div>
                        <div class="col-xs-18">
                            @foreach($attr as $key => $attr_value)
                                @if(array_key_exists('MiniImageUrl', $attr_value) && $attr_value['MiniImageUrl'] !== '')
                                    <button type="button" class="change-bigImageItem change-config-item change-config-item-{{ $attr_value['@attributes']['Pid'] }} btn btn-default
                                    @if($item['config_current']['bucket'][$attr_value['@attributes']['Pid']] === $attr_value['@attributes']['Vid']) active @endif" rel="property"
                                            title="{{ $attr_value['PropertyName'] }} {{ $attr_value['Value'] }}"
                                            data-vid="{{ $attr_value['@attributes']['Vid'] }}"
                                            data-pid="{{ $attr_value['@attributes']['Pid'] }}"
                                            data-originalName="{{ $attr_value['OriginalPropertyName'] }}:{{ $attr_value['OriginalValue'] }}
                                                    ({{ $attr_value['PropertyName'] }} {{ $attr_value['Value'] }})
                                        {{ mb_strimwidth($attr_value['Value'], 0, 10, '...') }}"
                                            data-scr="{{ $attr_value['ImageUrl'] }}">
                                        <img src="{{ $attr_value['MiniImageUrl'] }}" alt="{{ $attr_value['PropertyName'] }} {{ $attr_value['Value'] }}">
                                    </button>
                                @else
                                    <button type="button" class="change-config-item change-config-item-{{ $attr_value['@attributes']['Pid'] }} btn btn-default
                                @if($item['config_current']['bucket'][$attr_value['@attributes']['Pid']] === $attr_value['@attributes']['Vid']) active @endif"
                                            title="{{ $attr_value['PropertyName'] }} {{ $attr_value['Value'] }}"
                                            data-vid="{{ $attr_value['@attributes']['Vid'] }}"
                                            data-pid="{{ $attr_value['@attributes']['Pid'] }}"
                                            data-originalName="{{ $attr_value['OriginalPropertyName'] }}:{{ $attr_value['OriginalValue'] }}
                                                    ({{ $attr_value['PropertyName'] }} {{ $attr_value['Value'] }}) ">
                                        {{ mb_strimwidth($attr_value['Value'], 0, 10, '...') }}
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
            <p class="text-center button_bg">
                <button class="btn btn-danger btn-lg btn-add-to-cart"
                    data-id="{{ $data['Result']['Item']['Id'] }}"
                    data-name="{{ $data['Result']['Item']['OriginalTitle'] }}"
                    @if(isset($data['Result']['Item']['Price']['promoPrice']))
                        data-price="{{ $data['Result']['Item']['Price']['promoPrice'] }}"
                    @else
                        data-price="{{ $data['Result']['Item']['Price']['ConvertedPriceWithoutSign'] }}"
                    @endif
                    data-config=""
                    data-src="">
                <i class="fa fa-cart-plus"></i> Добавить в корзину</button>
                <button class="btn btn-info btn-lg btn-add-to-cart"
                        data-id="{{ $data['Result']['Item']['Id'] }}"
                        data-name="{{ $data['Result']['Item']['OriginalTitle'] }}"
                        @if(isset($data['Result']['Item']['Price']['promoPrice']))
                            data-price="{{ $data['Result']['Item']['Price']['promoPrice'] }}"
                        @else
                            data-price="{{ $data['Result']['Item']['Price']['ConvertedPriceWithoutSign'] }}"
                        @endif
                        data-config=""
                        data-src=""
                        data-action="to_cart">
                    <i class="fa fa-shopping-cart"></i> Купить в один клик</button>
            <a href="/cart" class="btn btn-success btn-lg hidden btn-to-cart-link"><i class="fa fa-shopping-cart"></i> К корзине</a>
            </p>
            <div class="clearfix"></div>
        </div>
        <div class="col-xs-5 col-xs-offset-1">
            <div class="vendor">
                <p class="h4 row">Продавец:</p>
                <ul class="list-unstyled row list-vendor">
                    <li class="row">
                        <p class="col-xs-24">
                            <a href="/otapi/vendor/{{ $data['Result']['Item']['VendorId'] }}">{{ $data['Result']['Item']['VendorName'] }}</a>
                            <br/>
                            @for($i=0; $i < ceil($vendor['VendorInfo']['Credit']['Level']/5); $i++)
                                <i class="fa fa-star"></i>
                            @endfor
                        </p>
                    </li>
                    <li class="row">
                        <p class="col-xs-24">{{ $data['Result']['Item']['Location']['City'] }}
                            ({{ $data['Result']['Item']['Location']['State'] }})</p>
                    </li>
                    <li class="row">
                        <p class="col-xs-24">{{ $vendor['VendorInfo']['Credit']['TotalFeedbacks'] }} отзывов
                            <i class="glyphicon glyphicon-heart"></i>
                        {{ mb_strimwidth(($vendor['VendorInfo']['Credit']['PositiveFeedbacks'] * 100) / $vendor['VendorInfo']['Credit']['TotalFeedbacks'], 0, 5, '') }}%
                        </p>
                    </li>
                </ul>
            </div>

            @if($vendorTovars['OtapiItemInfoSubList']['TotalCount'] > 0)
                <p class="h4 text-center row">Так же продает:</p>
                <div class="row row-vendorTovars">
                    @foreach($vendorTovars['OtapiItemInfoSubList']['Content']['Item'] as $tovar)
                        @if(isset($tovar['Pictures']['ItemPicture'][0]['Small']))
                        <a href="/otapi/{{ $tovar['CategoryId'] }}/tovar/{{ $tovar['Id'] }}">
                            <img src="{{ $tovar['Pictures']['ItemPicture'][0]['Small'] }}" class="col-xs-12" alt="Фото товара">
                        </a>
                        @endif
                    @endforeach
                    @if($vendorTovars['OtapiItemInfoSubList']['TotalCount'] - 6 > 0)
                        <p class="text-right"><i>
                                И еще <a href="/otapi/vendor/{{ $data['Result']['Item']['VendorId'] }}">
                                    {{ $vendorTovars['OtapiItemInfoSubList']['TotalCount']-6 }} товаров...</a></i>
                        </p>
                    @endif
                </div>
            @endif
        </div>
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
                    {!! $GetItemDescription['OtapiItemDescription']['ItemDescription'] !!}
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="description">
                <div class="col-xs-24">
                    @if(isset($data['Result']['Item']['Attributes']['ItemAttribute']))
                        @foreach($data['Result']['Item']['Attributes']['ItemAttribute'] as $attribute)
                            @if($attribute['IsConfigurator'] === 'false')
                                <p><i>{{ $attribute['PropertyName'] }}: {{ $attribute['Value'] }}</i></p>
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="opinions">
                <div class="col-xs-24">
                    <div id="mc-container"></div>
                    <script type="text/javascript">
                        cackle_widget = window.cackle_widget || [];
                        cackle_widget.push({widget: 'Comment', id: 43706});
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