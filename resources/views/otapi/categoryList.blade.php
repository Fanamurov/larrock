@extends('tbkhv.main')
@section('title') Category @endsection

@section('content')
    <h1 class="col-xs-24">{{ (string)$category->OtapiCategory->Name }}</h1>
    <div class="clearfix"></div><br/>
    @foreach($data->CategoryInfoList->Content->Item as $data_value)
        <div class="col-xs-12 col-xs-6">
            <p class="h4"><a href="/otapi/{{ (string)$data_value->Id }}">{{ (string)$data_value->Name }}</a></p>
        </div>
    @endforeach
@endsection