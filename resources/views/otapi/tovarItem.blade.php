@extends('tbkhv.main')
@section('title') Купить {{ $data['OtapiItemFullInfo']['Title'] }} в Хабаровске. Товары из Китая @endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('otapi.tovar', $category['OtapiCategory']['Id']) !!}
@endsection

@section('content')
    <div class="page-catalog-item">
        <div class="col-xs-24">
            <h1>{{ $data['OtapiItemFullInfo']['Title'] }}</h1>
        </div>
        <div class="col-xs-7 block-gallery">
            <?$count_picture = 0?>
            @if( !array_key_exists('Large', $data['OtapiItemFullInfo']['Pictures']['ItemPicture']))
                @foreach($data['OtapiItemFullInfo']['Pictures']['ItemPicture'] as $picture)
                    <?++$count_picture?>
                    <a class="fancybox" href="{{ $picture['Large'] }}" rel="fancybox-thumb">
                        @if($count_picture === 1)
                            <img src="{{ $picture['Large'] }}" class="all-width fancybox LargeImg" alt="{{ $data['OtapiItemFullInfo']['Title'] }}">
                        @else
                            <img src="{{ $picture['Small'] }}" class="fancybox SmallImg" alt="{{ $data['OtapiItemFullInfo']['Title'] }}">
                        @endif
                    </a>
                @endforeach
            @else
                <a class="fancybox" href="{{ $data['OtapiItemFullInfo']['Pictures']['ItemPicture']['Large'] }}" rel="fancybox-thumb">
                    <img src="{{ $data['OtapiItemFullInfo']['Pictures']['ItemPicture']['Large'] }}" class="all-width fancybox LargeImg" alt="{{ $data['OtapiItemFullInfo']['Title'] }}">
                </a>
            @endif
        </div>
        <div class="col-xs-10 col-xs-offset-1">
            <p class="h4">{{ $data['OtapiItemFullInfo']['OriginalTitle'] }}</p>
            <p><a href="{{ $data['OtapiItemFullInfo']['TaobaoItemUrl'] }}">[этот товар на таобао]</a></p>
            <p class="cost">
                <span class="strong-heavy price-item">{{ $data['OtapiItemFullInfo']['Price']['ConvertedPriceWithoutSign'] }}</span>
                {{ $data['OtapiItemFullInfo']['Price']['CurrencySign'] }}
            </p>
            <div class="attributes-config">
                @if($data['OtapiItemFullInfo']['IsSellAllowed'] === 'false' AND $data['OtapiItemFullInfo']['HasInternalDelivery'] === 'false')
                    Нельзя купить: {{ $data['OtapiItemFullInfo']['SellDisallowReason'] }}
                @endif
                @if(isset($configured))
                    <span class="attributes-config-item">
                    <?$current_conf = ''; $change = NULL;?>
                        @foreach($data['OtapiItemFullInfo']['Attributes']['ItemAttribute'] as $key => $attribute)
                            @if($attribute['IsConfigurator'] === 'true')
                                <?if($current_conf !== $attribute['PropertyName']){
                                    $current_conf = $attribute['PropertyName'];
                                    $change = TRUE;
                                }else{
                                    $change = NULL;
                                }?>
                                @if($change)
                                </span>
                    <div class="clearfix"></div><br/>
                    <span class="attributes-config-item">
                                <label>{{ $attribute['PropertyName'] }}:</label>
                        @endif
                        @if(array_key_exists('MiniImageUrl', $attribute) && $attribute['MiniImageUrl'] !== '')
                            <button type="button" class="btn btn-default @if($change) active @endif" rel="property"
                                    title="{{ $attribute['PropertyName'] }} {{ $attribute['Value'] }}"
                                    data-price="{{ $configured[$attribute['@attributes']['Vid']]['Price'] }}"
                                    data-quantity="{{ $configured[$attribute['@attributes']['Vid']]['Quantity'] }}"
                                    data-vid="{{ $configured[$attribute['@attributes']['Vid']]['Vid'] }}"
                                    data-pid="{{ $configured[$attribute['@attributes']['Vid']]['Pid'] }}">
                                <img src="{{ $attribute['MiniImageUrl'] }}" alt="{{ $attribute['PropertyName'] }} {{ $attribute['Value'] }}">
                            </button>
                        @else
                            @if(isset($configured[$attribute['@attributes']['Vid']]))
                                <button type="button" class="btn btn-default @if($change) active @endif" data-price="{{ $configured[$attribute['@attributes']['Vid']]['Price'] }}"
                                        data-quantity="{{ $configured[$attribute['@attributes']['Vid']]['Quantity'] }}"
                                        data-vid="{{ $attribute['@attributes']['Vid'] }}"
                                        data-pid="{{ $attribute['@attributes']['Pid'] }}">
                                    {{ $attribute['Value'] }}
                                </button>
                @endif
                @endif
                @endif
                @endforeach
                @endif
            </div>
            <br/>
            <p>В наличии: <span class="quantity-item">{{ $data['OtapiItemFullInfo']['MasterQuantity'] }}</span> шт.</p>
            <input type="hidden" name="configurationId" value="">
            <button class="btn btn-danger btn-lg btn-add-to-cart"
                    data-id="{{ $data['OtapiItemFullInfo']['Id'] }}"
                    data-name="{{ $data['OtapiItemFullInfo']['OriginalTitle'] }}"
                    data-price="{{ $data['OtapiItemFullInfo']['Price']['ConvertedPriceWithoutSign'] }}">
                <i class="fa fa-cart-plus"></i> Добавить в корзину
            </button>
            <a href="/cart" class="btn btn-success btn-lg hidden btn-to-cart-link"><i class="fa fa-shopping-cart"></i> К корзине</a>
            <div class="clearfix"></div>
        </div>
        <div class="col-xs-5 col-xs-offset-1">
            <p class="h4 row text-center">Продавец:</p>
            <ul class="list-unstyled row list-vendor">
                <li class="row">
                    <p class="col-xs-12">Имя:</p>
                    <p class="col-xs-12"><a href="/otapi/vendor/{{ $data['OtapiItemFullInfo']['VendorId'] }}">{{ $data['OtapiItemFullInfo']['VendorName'] }}</a></p>
                </li>
                <li class="row">
                    <p class="col-xs-12">Находится в:</p>
                    <p class="col-xs-12">{{ $data['OtapiItemFullInfo']['Location']['City'] }}
                        ({{ $data['OtapiItemFullInfo']['Location']['State'] }})</p>
                </li>
                <li class="row">
                    <p class="col-xs-12">Отзывов:</p>
                    <p class="col-xs-12">{{ $vendor['VendorInfo']['Credit']['TotalFeedbacks'] }}</p>
                </li>
                <li class="row">
                    <p class="col-xs-12">Положительных:</p>
                    <p class="col-xs-12">{{ $vendor['VendorInfo']['Credit']['PositiveFeedbacks'] }}</p>
                </li>
                <li class="row">
                    <p class="col-xs-12">Рейтинг:</p>
                    <p class="col-xs-12">
                        @for($i=0; $i < ceil($vendor['VendorInfo']['Credit']['Level']/5); $i++)
                            <i class="fa fa-star"></i>
                        @endfor
                    </p>
                </li>
            </ul>

            @if($vendorTovars['OtapiItemInfoSubList']['TotalCount'] > 0)
                <hr/>
                <p class="h4 text-center row">Так же продает:</p>
                <div class="row">
                    @foreach($vendorTovars['OtapiItemInfoSubList']['Content']['Item'] as $tovar)
                        <a href="/otapi/{{ $tovar['CategoryId'] }}/tovar/{{ $tovar['Id'] }}">
                            <img src="{{ $tovar['Pictures']['ItemPicture'][0]['Small'] }}" class="col-xs-8" alt="Фото товара">
                        </a>
                    @endforeach
                    <p class="text-right"><i>
                            И еще <a href="/otapi/vendor/{{ $data['OtapiItemFullInfo']['VendorId'] }}">
                                {{ $vendorTovars['OtapiItemInfoSubList']['TotalCount'] }} товаров...</a></i>
                    </p>
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
                    @foreach($data['OtapiItemFullInfo']['Attributes']['ItemAttribute'] as $attribute)
                        @if($attribute['IsConfigurator'] === 'false')
                            <p><i>{{ $attribute['PropertyName'] }}: {{ $attribute['Value'] }}</i></p>
                        @endif
                    @endforeach
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