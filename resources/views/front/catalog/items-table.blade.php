@extends('front.main')
@section('title') {{ $seo['title'] }} @endsection

@section('content')
    {!! Breadcrumbs::render('catalog.items', $data) !!}

    <div class="catalog-filters">
        @include('front.modules.filters.sortCost')
        @include('front.modules.filters.vid')
        @include('front.modules.filters.itemsOnPage')
    </div>

    <div class="catalogPageCategoryItems row">
        <table class="table">
            <thead>
            <tr>
                <th>Наименование</th>
                <th>Описание</th>
                <th>Цена</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($data->get_tovars as $item)
                <tr>
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->description }}</td>
                    <td>{{ $item->cost }} {{ $item->what }}</td>
                    <td>В корзину</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="Pagination catalogPagination">{!! $paginator->render() !!}</div>
@endsection