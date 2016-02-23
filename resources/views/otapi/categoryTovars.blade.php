@extends('tbkhv.main')
@section('title') {{ (string)$category->OtapiCategory->Name }} @endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('otapi.category', (string)$category->OtapiCategory->Id) !!}
@endsection

@section('filters')
    <p class="h2">Фильтры для поиска:</p>
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
    <div class="form-group">
        <button type="submit" class="btn btn-default">Применить фильтры</button>
    </div>
@endsection

@section('content')
    <div class="page-catalog-category">
        <h1>{{ (string)$category->OtapiCategory->Name }}</h1>
        <p>Всего товаров в разделе: {{ (string)$data->OtapiItemInfoSubList->TotalCount }}</p>
        <div class="row">
            @foreach($data->OtapiItemInfoSubList->Content->Item as $data_value)
                <div class="col-xs-12 col-sm-6 col-md-4 item-catalog">
                    <div class="div-img">
                        <img class="all-width" src="{{ $data_value->Pictures->ItemPicture->Medium }}" alt="{{ (string)$data_value->Title }}">
                    </div>
                    <p>{{ (string)$data_value->Title }}</p>
                    <p><a href="/otapi/{{ (string)$data_value->CategoryId }}/tovar/{{ (string)$data_value->Id }}">{{ (string)$data_value->OriginalTitle }}</a></p>
                    <p>Продавец: {{ (string)$data_value->VendorName }} (Рейтинг: {{ (string)$data_value->VendorScore }})</p>
                    <p>Price: {{ (string)$data_value->Price->ConvertedPriceWithoutSign }} {{ (string)$data_value->Price->CurrencySign }}</p>
                </div>
            @endforeach
        </div>
    </div>

    <div class="pagination">
        $data->OtapiItemInfoSubList->TotalCount
    </div>
@endsection