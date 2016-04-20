@extends('santa.main')
@section('title') {{ $seo['title'] }} @endsection

@section('content')
    {!! Breadcrumbs::render('tours.all') !!}

    <div class="tours-filters row">
        <div class="col-sm-8">
            <select class="form-control" name="vid">
                <option value="">Все виды отдыха</option>
            </select>
        </div>
        <div class="col-sm-8">
            <select class="form-control" name="country">
                <option value="">Все страны</option>
            </select>
        </div>
        <div class="col-sm-8">
            <select class="form-control" name="resort">
                <option value="">Все курорты</option>
            </select>
        </div>
    </div>

    <div class="toursPageCategoryItems row">
        @each('santa.tours.blockTour', $data, 'data')
    </div>

    <div class="Pagination catalogPagination">{!! $paginator->render() !!}</div>
@endsection
