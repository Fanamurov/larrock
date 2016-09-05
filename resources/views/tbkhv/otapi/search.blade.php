@extends('tbkhv.two-colomn')
@section('title') Поиск по товарам: {{ Request::get('search') }} @endsection

@section('filters')
    <div class="panel panel-default">
        Найдено товаров: <br/>{{ $data->Items->Items->TotalCount }} шт.
    </div>
    <form action="" method="get" id="form-filter-category">
        <div class="row">
            <div class="col-xs-24">
                <div class="col-xs-12">
                    <div class="form-group">
                        <input type="text" class="form-control" value="{{ Input::get('MinPrice', '') }}" name="MinPrice" placeholder="цена от">
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="form-group">
                        <input type="text" class="form-control" value="{{ Input::get('MaxPrice', '') }}" name="MaxPrice" placeholder="цена до">
                    </div>
                </div>
            </div>
        </div>

        @if(isset($data->SearchProperties->Content->Item))
            @foreach($data->SearchProperties->Content->Item as $filter)
                @if(isset($filter->Name))
                    <div class="filter-item form-group col-xs-24" title="{{ $filter->Name }}">
                        <label for="filter{{ $filter->Id }}">{{ $filter->Name }}:</label>
                        <select id="filter{{ $filter->Id }}" class="form-control filter-category" name="TTT{{ $filter->Id }}">
                            <option value="">любой</option>
                            @foreach($filter->Values->PropertyValue as $filter_value)
                                @if(isset($filter_value->Id))
                                    <option @if(in_array($filter_value->Id, $selected_filters)) selected @endif
                                    value="{{ $filter_value->Id }}">{{ $filter_value->Name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                @endif
            @endforeach
            <div class="clearfix"></div>

            <div class="col-xs-24">
                <div class="form-group">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <input type="hidden" name="sort" value="{{ $sort_active }}">
                    <input type="hidden" name="search" value="{{ Request::get('search') }}">
                    <button type="submit" class="btn btn-lg btn-success btn-block" name="filter"><i class="fa fa-sort"></i> Применить фильтры</button>
                </div>
                <div class="clearfix"></div>
            </div>
        @endif
    </form>
@endsection

@section('content')
    <div class="page-catalog-category search-catalog-page">
        <h1 class="col-xs-24">Поиск по сайту: {{ Request::get('search') }}</h1>
        <div class="col-xs-24">
            <div class="sorters">
                <div class="btn-group btn-group-sorters" role="group">
                    <button type="button" class="btn btn-default @if($sort_active === 'Default') active @endif" data-sort="Default">Лучший выбор</button>
                    <button type="button" class="btn btn-default @if($sort_active === 'Popularity:Desc') active @endif" data-sort="Popularity:Desc">Популярные товары</button>
                    <button type="button" class="btn btn-default @if($sort_active === 'VendorRating:Desc') active @endif" data-sort="VendorRating:Desc">Лучшие продавцы</button>
                    <button type="button" class="btn btn-default @if($sort_active === 'Price:Desc' OR $sort_active === 'Price:Asc') active @endif"
                            @if($sort_active !== 'Price:Desc' AND $sort_active !== 'Price:Asc')
                            data-sort="Price:Desc"
                            @elseif($sort_active === 'Price:Desc')
                            data-sort="Price:Asc"
                            @elseif($sort_active === 'Price:Asc')
                            data-sort="Default"
                            @endif>
                        Цена
                        @if($sort_active === 'Price:Desc')
                            <i class="glyphicon glyphicon-chevron-down"></i>
                        @elseif($sort_active === 'Price:Asc')
                            <i class="glyphicon glyphicon-chevron-up"></i>
                        @else
                            <i class="glyphicon glyphicon-resize-vertical"></i>
                        @endif
                    </button>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>

        <div class="row">
            @if($data->Items->Items->TotalCount > 0)
                @if( !isset($data->Items->Items->Content->Item->Id))
                    @foreach($data->Items->Items->Content->Item as $data_value)
                        @include('tbkhv.otapi.item.block-tovar', ['data_value' => $data_value])
                    @endforeach
                @else
                    @include('tbkhv.otapi.item.block-tovar', ['data_value' => $data->Items->Items->Content->Item])
                @endif
            @else
                <div class="alert alert-danger">К сожалению, по данному поисковому запросу ничего не нашлось, попробуйте изменить данные для поиска</div>
            @endif
        </div>
    </div>

    @if(isset($paginator))
        <div class="Pagination catalogPagination">{!! $paginator->render() !!}</div>
    @endif
@endsection