<!DOCTYPE html>
<html lang="ru" prefix="og: http://ogp.me/ns/article#">
@include('santa.sections.head')
<body class="mainpage {{ $app_name or '' }} {{ $app_param or '' }}">
<div class="container container-body">
    @include('santa.sections.header')
    <section class="row" id="content">
        @include('santa.sections.tabsWhiteLabel')
        <section id="right_colomn" class="col-xs-24 col-sm-8 col-md-7">
            <div class="col-xs-24 content-padding">
                @include('santa.modules.forms.subscribe')
                @yield('rightColomn')
                @if(isset($banner))
                    @include('front.modules.list.banner')
                @endif
                @include('santa.modules.list.vidy')
            </div>
        </section>
        <div class="col-xs-24 col-sm-16 col-md-17">
            <div class="col-xs-24">
                @include('santa.errors')
                @include('santa.modules.slideshow.mainpage', $slideshow)

                <div class="sletatResult" data-country-id="{{ $country_id_sletat }}">
                    @if($GetTours['iTotalRecords'] > 0)
                        @include('santa.sletat.searchResultShort')
                    @else
                        <div class="toursPageCountry-bestcost row">
                            <div class="col-xs-24"><h5 class="title-header">Лучшие цены</h5></div>
                            <div class="col-xs-24" id="loadState">
                                <div class="progress">
                                    <div class="progress-bar progress-bar-danger progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 10%;">
                                        <span class="progress-current">0%</span>
                                    </div>
                                </div>
                            </div>
                            <div class="alert alert-warning col-xs-24 alert-progress">Обработка запроса продолжается</div>
                        </div>
                        @push('scripts')
                        <script>
                            $(document).ready(function(){
                                GetLoadStateShort({{ $GetTours['requestId'] }}, 20, 8);
                            });
                        </script>
                        @endpush
                    @endif
                </div>
                @include('santa.modules.list.news')
                @include('santa.modules.list.blog')
                @include('santa.modules.list.tours')
                @yield('content')
                @include('santa.modules.html.socialGroups')
                <div class="col-xs-24 content_bottom-sharing">
                    <span>Поделитесь с друзьями:</span> @include('santa.modules.share.sharing')
                </div>
            </div>
        </div>
    </section>
</div>
<footer>
    @include('santa.sections.footer')
    @yield('footer')
</footer>
@include('santa.sections.bottomScripts')
@stack('scripts')
</body>
</html>