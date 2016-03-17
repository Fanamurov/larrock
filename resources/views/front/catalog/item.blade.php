@extends('front.main')
@section('title') {{ $data->title }} @endsection

@section('content')
    {!! Breadcrumbs::render('catalog.item', $data) !!}

    <div class="catalogPageItem row">
        <h1>{{ $data->title }}</h1>
        <div class="row">
            <div class="col-xs-12">
                <div class="catalogImage">
                    @if(count($data->images) > 0)
                        <img src="{{ $data->images->first()->getUrl() }}" alt="{{ $data->title }}" class="TovarImage">
                    @endif
                    <div class="cost">
                        @if($data->cost == 0)
                            <span class="empty-cost">цена договорная</span>
                        @else
                            <span class="default-cost">&nbsp;&nbsp;&nbsp;&nbsp;{{ $data->cost }} <span class="what">{{ $data->what }}</span></span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-xs-12">
                <form class="form-addToCart" method="post" action="/forms/contact">
                    <div class="input-group">
                        <span class="input-group-addon addon-x">X</span>
                        <input type="text" class="form-control kolvo" value="20000">
                        <span class="input-group-addon addon-what">кг</span>
                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-info pull-right" name="submit_contact">
                                <img src="/_assets/_front/_images/icons/icon_cart_white.png"
                                     alt="Добавить в корзину" class="add_to_cart pointer"
                                     data-id="{{ $data->id }}" width="32" height="32">
                            </button>
                        </div>
                    </div>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                </form>
            </div>
        </div>
        <div class="row row-description">
            <div class="col-xs-12">
                <div class="catalogFull">
                    <div>{!! $data->description !!}</div>
                </div>
            </div>
            <div class="col-xs-12 other-photos">
                @if(count($data->images) > 1)
                    @foreach($data->images as $key => $image)
                        @if($key > 0)
                            <div class="other-photos-bg" style="background-image: url('{!! $image->getUrl() !!}')"></div>
                        @endif
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endsection

@section('front.modules.list.catalog')
    @include('front.modules.list.catalog')
@endsection