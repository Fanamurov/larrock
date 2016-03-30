@extends('santa.main')
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
            @foreach($data->get_toursActive as $item)
                <tr>
                    <td>{{ $item->title }}</td>
                    <td>{{ $data->short }}</td>
                    <td>{{ $item->cost }} {{ $item->what }}</td>
                    <td><img src="/_assets/_front/_images/icons/icon_cart.png" alt="Добавить в корзину" class="add_to_cart pointer"
                             data-id="{{ $item->id }}" width="40" height="25"></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="Pagination catalogPagination">{!! $paginator->render() !!}</div>
@endsection

@section('front.modules.list.catalog')
    @include('front.modules.list.catalog')
@endsection