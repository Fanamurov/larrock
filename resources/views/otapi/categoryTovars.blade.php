@extends('tbkhv.main')
@section('title') {{ (string)$category->OtapiCategory->Name }} @endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('otapi.category', (string)$category->OtapiCategory->Id) !!}
@endsection

@section('filters')
    <p class="h2">Фильтры для поиска:</p>
    <form action="" method="post">
        @foreach($GetCategorySearchProperties->SearchPropertyInfoList->Content->Item as $filter)
            <div class="filter-item form-group col-xs-4">
                <label for="filter{{ (string)$filter->Id }}" class="control-label">{{ (string)$filter->Name }}:</label>
                <select id="filter{{ (string)$filter->Id }}" class="form-control">
                    @foreach($filter->Values->PropertyValue as $filter_value)
                        <option value="{{ (string)$filter_value->Id }}">{{ (string)$filter_value->Name }}</option>
                    @endforeach
                </select>
            </div>
        @endforeach
        <div class="clearfix"></div>
        <div class="form-group">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <button type="submit" class="btn btn-success" name="filter"><i class="fa fa-sort"></i> Применить фильтры</button>
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
                        <img class="all-width" src="{{ $data_value->Pictures->ItemPicture->Medium }}" alt="{{ (string)$data_value->Title }}">
                    </div>
                    <p class="cost">{{ (string)$data_value->Price->ConvertedPriceWithoutSign }} {{ (string)$data_value->Price->CurrencySign }}</p>
                    <p>{{ (string)$data_value->Title }}</p>
                    <p><a href="/otapi/{{ (string)$data_value->CategoryId }}/tovar/{{ (string)$data_value->Id }}">{{ (string)$data_value->OriginalTitle }}</a></p>
                    <p class="vendor">Продавец: {{ (string)$data_value->VendorName }} (Рейтинг: {{ (string)$data_value->VendorScore }})</p>
                </div>
            @endforeach
        </div>
    </div>

    <nav class="pagination">
        <ul class="pagination pagination-lg">
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
        </ul>
    </nav>
@endsection