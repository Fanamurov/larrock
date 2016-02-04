@extends('front.main')
@section('title') TEST @endsection

@section('content')
    {!! Breadcrumbs::render('catalog.item', $data) !!}

    <div class="catalogPageItem row">
        @if(count($data->get_images) > 0)
            <img src="/images/catalog/140-140/{{ $data->get_images->first()->name }}" alt="{{$data->title}}" class="TovarImage">
        @else
            Not photo
        @endif

        <h1>{{ $data->title }}</h1>
        <div>{!! $data->description !!}</div>
        <p>{{ $data->cost }} {{ $data->what }}</p>
    </div>
@endsection