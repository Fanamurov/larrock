@extends('santa.main')
@section('title') {{ $data->get_seo->seo_title or $data->title }} @endsection

@section('content')
    <div class="page-{{ $data->url }} pagePage">
        <h1>{{ $data->title }}</h1>
        <div class="page_description">{!! $data->description !!}</div>

        <script charset="utf-8" src="//www.travelpayouts.com/widgets/f099c6c9e3ea04e03b82d2df6290a130.js?v=559" async></script>
        <p></p><br/>

        <script async src="//www.travelpayouts.com/ducklett/scripts.js?widget_type=brickwork&currency=rub&host=hydra.aviasales.ru&marker=88136.%D0%A0%D0%B0%D0%B7%D0%B4%D0%B5%D0%BB%20%D0%B0%D0%BA%D1%86%D0%B8%D0%B8&additional_marker=%D0%A0%D0%B0%D0%B7%D0%B4%D0%B5%D0%BB%20%D0%B0%D0%BA%D1%86%D0%B8%D0%B8&limit=10&origin_iatas=KHV" charset="UTF-8"></script>

        <script type="text/javascript">(window.Image ? (new Image()) : document.createElement('img')).src = location.protocol + '//vk.com/rtrg?r=ex3ijYcYNse3BwjQXSFo6FglIgQQ2Ld/eZ3v85Bolunp5rFhLH5*gnKlCYOctp4sxc50VDFQAlHC/jP7Ss7wr9u1kA4v68tXR3AniB/4jWzZBlnK5Vi1/jvwGxblvjpPnAxavVcQKuBXubzAUa0hZnkssJt6T9H44fnaCSD8obY-';</script>
    </div>
@endsection