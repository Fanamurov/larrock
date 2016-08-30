<!-- Mainly scripts -->
<script src="{{asset('_assets/tbkhv/_js/bootstrap.min.js')}}"></script>
<script type="text/javascript">
    var root = '{{url('/')}}';
</script>
<script src="/_assets/bower_components/matchHeight/jquery.matchHeight.js" type="text/javascript"></script>
<script src="{{asset('_assets/tbkhv/_js/front_core.min.js')}}"></script>
<script type="text/javascript" src="/_assets/bower_components/fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>
<script type="text/javascript" src="/_assets/bower_components/fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>
<script type="text/javascript" src="/_assets/bower_components/fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
<script type="text/javascript" src="/_assets/bower_components/fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>
<script type="text/javascript" src="/_assets/bower_components/fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>

<!-- Laravel Javascript Validation -->
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
@if(isset($validator)) {!! $validator !!} @endif
@yield('scripts')

@if(App::environment() !== 'local')
    <!-- Yandex.Metrika counter -->
    <script type="text/javascript">
        (function (d, w, c) {
            (w[c] = w[c] || []).push(function() {
                try {
                    w.yaCounter39261310 = new Ya.Metrika({
                        id:39261310,
                        clickmap:true,
                        trackLinks:true,
                        accurateTrackBounce:true,
                        webvisor:true
                    });
                } catch(e) { }
            });

            var n = d.getElementsByTagName("script")[0],
                    s = d.createElement("script"),
                    f = function () { n.parentNode.insertBefore(s, n); };
            s.type = "text/javascript";
            s.async = true;
            s.src = "https://mc.yandex.ru/metrika/watch.js";

            if (w.opera == "[object Opera]") {
                d.addEventListener("DOMContentLoaded", f, false);
            } else { f(); }
        })(document, window, "yandex_metrika_callbacks");
    </script>
    <noscript><div><img src="https://mc.yandex.ru/watch/39261310" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
    <!-- /Yandex.Metrika counter -->
@endif