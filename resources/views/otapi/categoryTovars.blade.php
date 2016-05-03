@extends('tbkhv.main')
@section('title') {{ (string)$category->OtapiCategory->Name }} @endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('otapi.category', (string)$category->OtapiCategory->Id) !!}
@endsection

@section('filters')
    <p class="h2 col-xs-24">Фильтры для поиска:</p>
    <form action="" method="get" id="form-filter-category">
        @foreach($GetCategorySearchProperties->SearchPropertyInfoList->Content->Item as $filter)
            <div class="filter-item form-group col-xs-6" title="{{ (string)$filter->Name }}">
                <select id="filter{{ (string)$filter->Id }}" class="form-control filter-category" name="TTT{{ (string)$filter->Id }}">
                    <option value="">{{ (string)$filter->Name }}</option>
                    @foreach($filter->Values->PropertyValue as $filter_value)
                        <option @if(array_search((string)$filter_value->Id, $selected_filters)) selected @endif
                                value="{{ (string)$filter_value->Id }}">{{ (string)$filter_value->Name }}</option>
                    @endforeach
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

        <div class="clearfix"></div>
        <div class="form-group">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <button type="submit" class="btn btn-success hidden" name="filter"><i class="fa fa-sort"></i> Применить фильтры</button>
        </div>
    </form>
@endsection

@section('content')
    <div class="page-catalog-category">
        <div class="col-xs-24">
            <h1>{{ (string)$category->OtapiCategory->Name }}</h1>
            <p>Всего товаров в разделе: {{ (string)$data->OtapiItemInfoSubList->TotalCount }}</p>
        </div>
        <div class="row">
            @foreach($data->OtapiItemInfoSubList->Content->Item as $data_value)
                <div class="col-xs-12 col-sm-6 item-catalog link_block_this" data-href='/otapi/{{ (string)$data_value->CategoryId }}/tovar/{{ (string)$data_value->Id }}'>
                    <div class="div-img">
                        <img class="all-width" src="{{ $data_value->Pictures->ItemPicture->Medium }}" alt="{{ (string)$data_value->Title }}">
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
        </div>
    </div>

    <div class="Pagination catalogPagination">{!! $paginator->render() !!}</div>
@endsection