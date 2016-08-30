@extends('tbkhv.two-colomn')
@section('title') {{ $category->Name }} @endsection

@section('breadcrumbs')
    <section class="block-breadcrumbs">
        <div class="hidden-xs">
            {!! Breadcrumbs::render('otapi.category', $category->Id) !!}
        </div>
    </section>
@endsection

@section('sub-categories')
    <ul class="list-group">
        @foreach($sub_categories as $sub_category_count => $sub_category)
            @if($sub_category_count < 3)
                <li class="list-group-item @if($sub_category->Id === $category->Id) list-group-item-success @endif">
                    <a href="/otapi/{{ $sub_category->Id }}">{{ $sub_category->Name }}</a>
                </li>
            @endif
        @endforeach
        <li class="list-group-item">
            <button class="btn btn-primary btn-block" type="button" data-toggle="collapse" data-target="#collapse-sub-categories" aria-expanded="false" aria-controls="collapse-sub-categories">
                <i class="glyphicon glyphicon-th-list"></i> Загрузить подразделы
            </button>
        </li>
    </ul>
    <div class="collapse" id="collapse-sub-categories">
        <ul class="list-group">
            @foreach($sub_categories as $sub_category_count => $sub_category)
                @if($sub_category_count >  3)
                    <li class="list-group-item @if($sub_category->Id === $category->Id) list-group-item-success @endif">
                        <a href="/otapi/{{ $sub_category->Id }}">{{ $sub_category->Name }}</a>
                    </li>
                @endif
            @endforeach
        </ul>
    </div>
@endsection

@section('filters')
    <div class="panel panel-default">
        Найдено товаров: <br/>{{ $data->TotalCount }} шт.
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

        <div class="btn-show-filters">
            <button class="btn btn-primary btn-block" type="button" data-toggle="collapse" data-target="#collapse-other-fiters" aria-expanded="false" aria-controls="collapse-other-fiters">
                <i class="glyphicon glyphicon-th-list"></i> другие фильтры
            </button>
        </div>
        <div class="collapse" id="collapse-other-fiters">
            @foreach($GetCategorySearchProperties as $filter)
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
        </div>
        <div class="clearfix"></div>

        <div class="col-xs-24">
            <div class="form-group">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <input type="hidden" name="sort" value="{{ $sort_active }}">
                <button type="submit" class="btn btn-lg btn-success btn-block" name="filter"><i class="fa fa-sort"></i> Применить фильтры</button>
            </div>
            <div class="clearfix"></div>
        </div>
    </form>
@endsection

@section('content')
    <div class="page-catalog-category">
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
            <h1 class="col-xs-24">{{ $category->Name }}</h1>
        </div>
        <div class="row">
            @foreach($data->Content->Item as $data_value)
                <div class="col-xs-12 col-sm-8 col-md-6 item-catalog link_block_this" data-href='/otapi/{{ $data_value->CategoryId }}/tovar/{{ $data_value->Id }}'>
                    <div class="div-img">
                    @if(isset($data_value->Pictures))
                        @if(is_array($data_value->Pictures->ItemPicture))
                            <img class="all-width" src="{{ $data_value->Pictures->ItemPicture[0]->Medium }}" alt="{{ $data_value->Title }}">
                        @else
                            <img class="all-width" src="{{ $data_value->Pictures->ItemPicture->Medium }}" alt="{{ $data_value->Title }}">
                        @endif
                        @endif
                    </div>
                    @if(isset($data_value->PromotionPrice->ConvertedPriceList->Internal) && $data_value->PromotionPrice->Quantity > 0)
                        <p class="cost">{{ $data_value->PromotionPrice->ConvertedPriceList->Internal }}</p>
                    @else
                        <p class="cost">{{ $data_value->Price->ConvertedPrice }}</p>
                    @endif
                    <p><a class="title-tovar" href="/otapi/{{ $data_value->CategoryId }}/tovar/{{ $data_value->Id }}">
                            {{ mb_strimwidth($data_value->Title, 0, 70, '...') }}
                        </a></p>
                    <p class="vendor">{{ $data_value->VendorName }}
                        @php($score_delim = ceil($data_value->VendorScore/5))
                        <br/>@for($i=0; $i < $score_delim; $i++)
                            <i class="fa fa-star"></i>
                        @endfor
                        </p>
                </div>
            @endforeach
        </div>
    </div>

    <div class="Pagination catalogPagination">{!! $paginator->render() !!}</div>
@endsection