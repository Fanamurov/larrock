@extends('tbkhv.main')
@section('title') Поиск по товарам @endsection

@section('content')
    <div class="page-catalog-category">
        <div class="col-xs-24">
            <h1>Поиск по товарам: {{ Request::get('search') }}</h1>
        </div><br/>

        <div>
            @if(isset($data->Result->SearchProperties))
                <form action="" method="get" id="form-filter-category">
                @foreach($data->Result->SearchProperties->Content->Item as $filter)
                        <div class="filter-item form-group col-xs-6" title="{{ (string)$filter->Name }}">
                        <select id="filter{{ (string)$filter->Id }}" class="form-control filter-category" name="{{ (string)$filter->Id }}">
                            <option value="">{{ (string)$filter->Name }}</option>
                            @if(is_array($filter->Values->PropertyValue))
                                @foreach($filter->Values->PropertyValue as $filter_value)
                                    <option @if(array_search((string)$filter_value->Id, $selected_filters)) selected @endif
                                    value="{{ (string)$filter_value->Id }}">{{ (string)$filter_value->Name }}</option>
                                @endforeach
                            @else
                                <option @if(array_search((string)$filter->Values->PropertyValue->Id, $selected_filters)) selected @endif
                                value="{{ (string)$filter->Values->PropertyValue->Id }}">{{ (string)$filter->Values->PropertyValue->Name }}</option>
                            @endif
                        </select>
                    </div>
                @endforeach
                    <div class="clearfix"></div>

                    <div class="filter-item form-group col-xs-6" title="Сортировки">
                        <label for="sortCost">Сортировка результатов:</label>
                        <select id="sortCost" class="form-control filter-category" name="sort">
                            <option @if(Request::get('sort', 'Price:Asc') === 'Default') selected @endif value="Default">Порядок по умолчанию</option>
                            <option @if(Request::get('sort', 'Price:Asc') === 'Price:Asc') selected @endif value="Price:Asc">Цена: по возрастанию</option>
                            <option @if(Request::get('sort', 'Price:Asc') === 'Price:Desc') selected @endif value="Price:Desc">Цена: по убываю</option>
                            <option @if(Request::get('sort', 'Price:Asc') === 'VendorRating:Desc') selected @endif value="VendorRating:Desc">Продавцы с наибольшим рейтингом</option>
                            <option @if(Request::get('sort', 'Price:Asc') === 'Volume:Desc') selected @endif value="Volume:Desc">Самые продаваемые</option>
                            <option @if(Request::get('sort', 'Price:Asc') === 'Popularity:Desc') selected @endif value="Popularity:Desc">Самые популярные</option>
                        </select>
                    </div>

                    <div class="col-xs-24">
                        <div class="sorters">
                            <span>Сортировки:</span>
                            @foreach($sorters as $sort_key => $sort_value)
                                <a href="#" class="change-sort-vid btn btn-primary @if(isset($sort_value['active'])) active @endif" data-sort="{{ $sort_key }}">{{ $sort_value['name'] }}</a>
                            @endforeach
                            <input type="hidden" name="sort" value="{{ $sort_active }}">
                        </div>

                        <div class="clearfix"></div><br/>
                        <div class="form-group">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <button type="submit" class="btn btn-lg btn-success" name="filter"><i class="fa fa-sort"></i> Применить фильтры</button>
                        </div>
                    </div>
                </form>
            @endif
        </div>

        <div class="row">
            @if($data->Result->Items->Items->TotalCount > 0)
                <div class="col-xs-24"><h2 class="col-xs-24">Товары:</h2></div>
                @foreach($data->Result->Items->Items->Content->Item as $data_value)
                    <div class="col-xs-12 col-sm-6 col-md-4 item-catalog link_block_this" data-href='/otapi/{{ (string)$data_value->CategoryId }}/tovar/{{ (string)$data_value->Id }}'>
                        <div class="div-img">
                            @if(is_array($data_value->Pictures->ItemPicture))
                                <img class="all-width" src="{{ $data_value->Pictures->ItemPicture[0]->Medium }}" alt="{{ (string)$data_value->OriginalTitle }}">
                            @else
                                <img class="all-width" src="{{ $data_value->Pictures->ItemPicture->Medium }}" alt="{{ (string)$data_value->OriginalTitle }}">
                            @endif
                        </div>
                        <p class="cost">{{ (string)$data_value->Price->ConvertedPriceWithoutSign }} {{ (string)$data_value->Price->CurrencySign }}</p>
                        <p><a href="/otapi/{{ (string)$data_value->CategoryId }}/tovar/{{ (string)$data_value->Id }}">
                                {{ mb_strimwidth($data_value->Title, 0, 70, '...') }}
                            </a></p>
                        <p class="vendor">{{ (string)$data_value->VendorName }}
                            <br/>@for($i=0; $i < ceil((string)$data_value->VendorScore/5); $i++)
                                <i class="fa fa-star"></i>
                            @endfor
                        </p>
                    </div>
                @endforeach
            @endif
        </div>

        @if(isset($paginator))
            <div class="Pagination catalogPagination">{!! $paginator->render() !!}</div>
        @endif
    </div>
@endsection