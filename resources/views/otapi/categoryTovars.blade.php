@extends('tbkhv.main')
@section('title') {{ (string)$category->OtapiCategory->Name }} @endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('otapi.category', (string)$category->OtapiCategory->Id) !!}
@endsection

@section('filters')
    <p class="h2">Фильтры для поиска:</p>
    <form action="" method="get">
        @foreach($GetCategorySearchProperties->SearchPropertyInfoList->Content->Item as $filter)
            <div class="filter-item form-group col-xs-4">
                <select id="filter{{ (string)$filter->Id }}" class="form-control" name="{{ (string)$filter->Id }}">
                    <option value="">{{ (string)$filter->Name }}</option>
                    @foreach($filter->Values->PropertyValue as $filter_value)
                        <option @if(array_search((string)$filter_value->Id, $selected_filters)) selected @endif
                                value="{{ (string)$filter_value->Id }}">{{ (string)$filter_value->Name }}</option>
                    @endforeach
                </select>
            </div>
        @endforeach
        <div class="clearfix"></div>
        <div class="form-group">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <button type="submit" class="btn btn-success hidden" name="filter"><i class="fa fa-sort"></i> Применить фильтры</button>
        </div>
    </form>

    <div>
        <form action="" method="get">
            <div class="col-xs-6 form-group">
                <a href="#">Сортировать по цене <i class="glyphicon glyphicon-sort-by-alphabet-alt"></i></a>
            </div>
            <div class="col-xs-6 form-group">
                <a href="#">Сортировать по популярности <i class="glyphicon glyphicon-sort-by-alphabet-alt"></i></a>
            </div>
        </form>
    </div>
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
                        <img class="all-width" src="{{ $data_value->Pictures->ItemPicture->Medium }}" alt="{{ (string)$data_value->Title }}">
                    </div>
                    <p class="cost">{{ (string)$data_value->Price->ConvertedPriceWithoutSign }} {{ (string)$data_value->Price->CurrencySign }}</p>
                    <p>{{ (string)$data_value->Title }}</p>
                    <p><a href="/otapi/{{ (string)$data_value->CategoryId }}/tovar/{{ (string)$data_value->Id }}">{{ (string)$data_value->OriginalTitle }}</a></p>
                    <p class="vendor">{{ (string)$data_value->VendorName }}
                        <br/>@for($i=0; $i < ceil((string)$data_value->VendorScore/5); $i++)
                            <i class="fa fa-star"></i>
                        @endfor
                        </p>
                </div>
            @endforeach
        </div>
    </div>

    <nav class="pagination">
        <ul class="pagination pagination-lg">
            <li>
                <a href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            @if($paginator['current'] - 4 > 0)
                <li><a href="?page=1">1</a></li>
                <li><a href="#">...</a></li>
            @endif
            @if($paginator['current'] - 3 > 0)
                <li><a href="?page={{ $paginator['current']-3 }}">{{ $paginator['current']-3 }}</a></li>
            @endif
            @if($paginator['current'] - 2 > 0)
                <li><a href="?page={{ $paginator['current']-2 }}">{{ $paginator['current']-2 }}</a></li>
            @endif
            @if($paginator['current'] - 1 > 0)
                <li><a href="?page={{ $paginator['current']-1 }}">{{ $paginator['current']-1 }}</a></li>
            @endif
            <li class="active"><a href="#">{{ $paginator['current'] }} <span class="sr-only">(current)</span></a></li>
            @if($paginator['current'] + 1 < $paginator['pages'])
                <li><a href="?page={{ $paginator['current']+1 }}">{{ $paginator['current']+1 }}</a></li>
            @endif
            @if($paginator['current'] + 2 < $paginator['pages'])
                <li><a href="?page={{ $paginator['current']+2 }}">{{ $paginator['current']+2 }}</a></li>
            @endif
            @if($paginator['current'] + 3 < $paginator['pages'])
                <li><a href="?page={{ $paginator['current']+3 }}">{{ $paginator['current']+3 }}</a></li>
            @endif
            @if($paginator['pages'] > $paginator['current']+3)
                <li><a href="#">...</a></li>
                <li><a href="?page={{ $paginator['pages'] }}">{{ $paginator['pages'] }}</a></li>
            @endif
            <li>
                <a href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
@endsection