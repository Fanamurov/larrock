@extends('tbkhv.main')
@section('title') {{ (string)$category->OtapiCategory->Name }}. Товары раздела @endsection

@section('content')
    <div class="CategoryInfoList">
        <h1 class="col-xs-24">{{ (string)$category->OtapiCategory->Name }}</h1>
        <div class="clearfix"></div><br/>
        @foreach($data->CategoryInfoList->Content->Item as $data_value)
            <div class="col-xs-12 col-xs-6 CategoryInfoList-item">
                <p class="h4 link_block">
                    <img src="/_assets/tbkhv/_images/empty_big.png" class="all-width">
                    <a href="/otapi/{{ (string)$data_value->Id }}">{{ (string)$data_value->Name }}</a>
                </p>
            </div>
        @endforeach
    </div>
@endsection