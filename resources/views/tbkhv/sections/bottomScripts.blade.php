<!-- Mainly scripts -->
<script src="{{asset('_assets/_front/_js/bootstrap.min.js')}}"></script>
<script src="/_assets/bower_components/selectize/dist/js/standalone/selectize.min.js"></script>
<script type="text/javascript">
    var root = '{{url('/')}}';
</script>
<script src="/_assets/bower_components/matchHeight/jquery.matchHeight.js" type="text/javascript"></script>
<script src="{{asset('_assets/_front/_js/front_core.min.js')}}"></script>
<script type="text/javascript" src="/_assets/bower_components/fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>
<script type="text/javascript" src="/_assets/bower_components/fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>
<script type="text/javascript" src="/_assets/bower_components/fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
<script type="text/javascript" src="/_assets/bower_components/fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>
<script type="text/javascript" src="/_assets/bower_components/fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>

<!-- Laravel Javascript Validation -->
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
@if(isset($validator)) {!! $validator !!} @endif
@yield('scripts')