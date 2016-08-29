@extends('tbkhv.main')
@section('title') {{ $category->Name }}. Товары раздела @endsection

@section('content')
    <div class="CategoryInfoList">
        <h1 class="col-xs-24">{{ $category->Name }}</h1>
        <div class="clearfix"></div><br/>
        @foreach($data as $data_value)
            <div class="col-xs-12 col-sm-8 col-md-6 CategoryInfoList-item">
                <p class="h4 link_block">
                    <img src="/_assets/tbkhv/_images/empty_big.png" class="all-width">
                    <a href="/otapi/{{ $data_value->Id }}">{{ $data_value->Name }}</a>
                </p>
            </div>
        @endforeach
    </div>
@endsection