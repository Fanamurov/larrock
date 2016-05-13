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
                    <option value="">{{ (string)$filter->Name }}: любой</option>
                    @foreach($filter->Values->PropertyValue as $filter_value)
                        <option @if(array_search((string)$filter_value->Id, $selected_filters)) selected @endif
                                value="{{ (string)$filter_value->Id }}">{{ (string)$filter_value->Name }}</option>
                    @endforeach
                </select>
            </div>
        @endforeach
        <div class="clearfix"></div>

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
@endsection

@section('content')
    <div class="page-catalog-category">
        <div class="col-xs-24">
            <h1>{{ (string)$category->OtapiCategory->Name }}</h1>
            <p>Всего товаров в разделе: {{ (string)$data->OtapiItemInfoSubList->TotalCount }}</p>
        </div>
        <div class="row">
            @foreach($data->OtapiItemInfoSubList->Content->Item as $data_value)
                <div class="col-xs-12 col-sm-6 col-md-4 item-catalog link_block_this" data-href='/otapi/{{ (string)$data_value->CategoryId }}/tovar/{{ (string)$data_value->Id }}'>
                    <div class="div-img">
                        @if(is_array($data_value->Pictures->ItemPicture))
                            <img class="all-width" src="{{ $data_value->Pictures->ItemPicture[0]->Medium }}" alt="{{ (string)$data_value->Title }}">
                        @else
                            <img class="all-width" src="{{ $data_value->Pictures->ItemPicture->Medium }}" alt="{{ (string)$data_value->Title }}">
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
        </div>
    </div>

    <div class="Pagination catalogPagination">{!! $paginator->render() !!}</div>
@endsection