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
                        <input type="hidden" name="search" value="{{ Request::get('search') }}">
                        <button type="submit" class="btn btn-success hidden" name="filter"><i class="fa fa-sort"></i> Применить фильтры</button>
                    </div>
                </form>
            @endif
        </div>

        <div class="row">
            @if($data->Result->Items->Items->TotalCount > 0)
                <div class="col-xs-24"><h2 class="col-xs-24">Товары:</h2></div>
                @foreach($data->Result->Items->Items->Content->Item as $data_value)
                    <div class="col-xs-12 col-sm-6 item-catalog link_block_this" data-href='/otapi/{{ (string)$data_value->CategoryId }}/tovar/{{ (string)$data_value->Id }}'>
                        <div class="div-img">
                            <img class="all-width" src="{{ (string)$data_value->Pictures->ItemPicture->Medium }}" alt="{{ (string)$data_value->Title }}">
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
            @endif
        </div>

        <div class="Pagination catalogPagination">{!! $paginator->render() !!}</div>
    </div>
@endsection