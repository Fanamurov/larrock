@if(App::environment() === 'local')
    <script src="{{asset('_assets/_admin/_js/jquery-1.11.1.min.js')}}"></script>
@else
    <script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
@endif
<!-- Mainly scripts -->
<script src="/_assets/bower_components/matchHeight/jquery.matchHeight.js" type="text/javascript"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<script src="/_assets/bower_components/selectize/dist/js/standalone/selectize.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript">
    var root = '{{url('/')}}';
</script>
<script src="{{asset('_assets/_santa/_js/santa_core.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
@if(isset($validator)) {!! $validator !!} @endif
<script src="/_assets/bower_components/jquery-validation/dist/jquery.validate.min.js"></script>
<script src="/_assets/bower_components/jquery-validation/dist/additional-methods.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>

@if(App::environment() !== 'local')
        <!-- BEGIN JIVOSITE CODE {literal} -->
    <script type='text/javascript'>
    (function(){ var widget_id = '170189';
        var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = '//code.jivosite.com/script/widget/'+widget_id; var ss = document.getElementsByTagName('script')[0]; ss.parentNode.insertBefore(s, ss);})();</script>
    <!-- {/literal} END JIVOSITE CODE -->

        <!-- Yandex.Metrika counter -->
        <script type="text/javascript">
            (function (d, w, c) {
                (w[c] = w[c] || []).push(function() {
                    try {
                        w.yaCounter27992118 = new Ya.Metrika({
                            id:27992118,
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
        <noscript><div><img src="https://mc.yandex.ru/watch/27992118" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
        <!-- /Yandex.Metrika counter -->

    <script type="text/javascript">
        /* init Call Service */
        var CallSiteId = 'f48bce31ae6868ac9906030623b40fa4';
        var CallBaseUrl = '//uptocall.com';
        (function() {
            var lt = document.createElement('script');
            lt.type ='text/javascript';
            lt.charset = 'utf-8';
            lt.async = true;
            lt.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') + CallBaseUrl + '/widget/client.js';
            var sc = document.getElementsByTagName('script')[0];
            if (sc) sc.parentNode.insertBefore(lt, sc);
            else document.documentElement.firstChild.appendChild(lt);
        })();
    </script>
    <script type="text/javascript">(window.Image ? (new Image()) : document.createElement('img')).src = location.protocol + '//vk.com/rtrg?r=sXMlCvbczZH2HR9yylv5qbaxpIP7G4KSep35gT8Pme59Fg81A/FwozpoG3bGhq*v7KI6D/DAME2iQ7gl1wpwy0EZ0wU3eO5GKSrtDA0KNd5yAR4JVF9S6bT4rvpQ41L2H3wsGDm3NrMW4mwP*8MJr9vUgYenIyd1WpYCdr5gF7o-';</script>

    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
        ga('create', 'UA-22516151-1', 'auto');
        ga('send', 'pageview');
    </script>
@endif