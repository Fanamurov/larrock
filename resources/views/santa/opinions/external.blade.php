@extends('santa.main')
@section('title') Отзывы @endsection

@section('content')
    <div class="pageOpinions">
    <h1>Отзывы путешественников о "Санта Авиа"</h1>
    <div id="mc-review"></div>
@endsection

@push('scripts')
    <script type="text/javascript">
        cackle_widget = window.cackle_widget || [];
        cackle_widget.push({widget: 'Review', id: '30688', channel: '/otzyvy/',
        });
        (function() {
            var mc = document.createElement('script');
            mc.type = 'text/javascript';
            mc.async = true;
            mc.src = ('https:' == document.location.protocol ? 'https' : 'http') + '://cackle.me/widget.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(mc, s.nextSibling);
        })();
    </script>
@endpush