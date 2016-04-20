<br/><br/><div id="mc-container"></div>
@section('scripts')
    <script type="text/javascript">
        cackle_widget = window.cackle_widget || [];
        cackle_widget.push({widget: 'Comment', id: '30688', channel: '{!! URL::current() !!}',
        });
        (function() {
            var mc = document.createElement('script');
            mc.type = 'text/javascript';
            mc.async = true;
            mc.src = ('https:' == document.location.protocol ? 'https' : 'http') + '://cackle.me/widget.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(mc, s.nextSibling);
        })();
    </script>
@endsection