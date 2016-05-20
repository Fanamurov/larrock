@extends('admin.main')
@section('title') {{ $app['name'] }} admin @endsection

@section('content')
    <div class="ibox float-e-margins">
        <div class="ibox-title background-transparent">
            <div>
                {!! Breadcrumbs::render('admin.author', $user) !!}
            </div>
        </div>
    </div>

    <div class="ibox float-e-margins">
        <div class="col-xs-12">
            @foreach($users as $user_value)
                <a class="label" href="/admin/users/author/{{ $user_value->id }}">{{ $user_value->first_name }} {{ $user_value->last_name }}</a>
            @endforeach
        </div>
    </div>
    <div class="clearfix"></div><br/><br/>

    <div class="row">
        <div class="col-sm-8">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Туры</a></li>
                <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Разделы</a></li>
                <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Блог</a></li>
                <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Новости</a></li>
            </ul>
            <div class="clearfix"></div>
            <div class="ibox float-e-margins">
                <div class="ibox-content">

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="home">
                            @if(count($tours) === 0)
                                <div class="alert alert-warning">Туров еще нет</div>
                            @else
                            <!-- Есть вложенные разделы. Выводим из список -->
                                <table class="table table-striped table-hover">
                                    <tbody>
                                    @include('admin.users.activityBlocks.tours', array('data' => $tours, 'app' => $app))
                                    </tbody>
                                </table>
                                {!! $tours->render() !!}
                            @endif
                        </div>
                        <div role="tabpanel" class="tab-pane" id="profile">
                            @if(count($categories) === 0)
                                <div class="alert alert-warning">У автора нет материалов</div>
                            @else
                                <table class="table table-striped table-hover">
                                    <tbody>
                                    @include('admin.users.activityBlocks.categories', array('data' => $categories, 'app' => $app))
                                    </tbody>
                                </table>
                                {!! $categories->render() !!}
                            @endif
                        </div>
                        <div role="tabpanel" class="tab-pane" id="messages">
                            @if(count($news) === 0)
                                <div class="alert alert-warning">У автора нет материалов</div>
                            @else
                                <table class="table table-striped table-hover">
                                    <tbody>
                                    @include('admin.users.activityBlocks.news', array('data' => $news, 'app' => $app))
                                    </tbody>
                                </table>
                                {!! $news->render() !!}
                            @endif
                        </div>
                        <div role="tabpanel" class="tab-pane" id="settings">
                            @if(count($blog) === 0)
                                <div class="alert alert-warning">У автора нет материалов</div>
                            @else
                                <table class="table table-striped table-hover">
                                    <tbody>
                                    @include('admin.users.activityBlocks.blog', array('data' => $blog, 'app' => $app))
                                    </tbody>
                                </table>
                                {!! $blog->render() !!}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="ibox float-e-margins">
                <div class="row">
                    <div class="col-xs-8">
                        <div class="widget style1">
                            <div class="row">
                                <div class="col-xs-12 text-right">
                                    <span> Заполнено туров </span>
                                    <h2 class="font-bold">{{ $tours->total() }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="widget style1 text-center">
                            <span> место </span>
                            <h2 class="font-bold">1</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <span class="label label-success pull-right">views</span>
                                <h5>Туры</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins">86,200</h1>
                                <div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div>
                                <small>От общего</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <span class="label label-success pull-right">sharing</span>
                                <h5>Туры</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins">2,200</h1>
                                <div class="stat-percent font-bold text-success">4% <i class="fa fa-bolt"></i></div>
                                <small>От просмотров</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-8">
                        <div class="widget style1">
                            <div class="row">
                                <div class="col-xs-12 text-right">
                                    <span> Заполнено новостей </span>
                                    <h2 class="font-bold">{{ $news->total() }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="widget style1 text-center">
                            <span> место </span>
                            <h2 class="font-bold">1</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <span class="label label-success pull-right">views</span>
                                <h5>Новости</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins">86,200</h1>
                                <div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div>
                                <small>От общего</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <span class="label label-success pull-right">sharing</span>
                                <h5>Новости</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins">2,200</h1>
                                <div class="stat-percent font-bold text-success">4% <i class="fa fa-bolt"></i></div>
                                <small>От просмотров</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="ibox float-e-margins">
                    <div class="row">
                        <div class="col-xs-8">
                            <div class="widget style1">
                                <div class="row">
                                    <div class="col-xs-12 text-right">
                                        <span> Заполнено блога </span>
                                        <h2 class="font-bold">{{ $blog->total() }}</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <div class="widget style1 text-center">
                                <span> место </span>
                                <h2 class="font-bold">1</h2>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <span class="label label-success pull-right">views</span>
                                    <h5>Блог</h5>
                                </div>
                                <div class="ibox-content">
                                    <h1 class="no-margins">26,241</h1>
                                    <div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div>
                                    <small>От общего</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <span class="label label-success pull-right">sharing</span>
                                    <h5>Блог</h5>
                                </div>
                                <div class="ibox-content">
                                    <h1 class="no-margins">8,299</h1>
                                    <div class="stat-percent font-bold text-success">11% <i class="fa fa-bolt"></i></div>
                                    <small>От просмотров</small>
                                </div>
                            </div>
                        </div>
                    </div>

                <div class="ibox-content">
                    <strong>Последние действия</strong>
                    <div id="vertical-timeline" class="vertical-container dark-timeline">
                        <div class="vertical-timeline-block">
                            <div class="vertical-timeline-icon gray-bg">
                                <i class="glyphicon glyphicon-text-size"></i>
                            </div>
                            <div class="vertical-timeline-content">
                                <p>Conference on the sales results for the previous year.
                                </p>
                                <span class="vertical-date small text-muted"> 2:10 pm - 12.06.2014 </span>
                            </div>
                        </div>
                        <div class="vertical-timeline-block">
                            <div class="vertical-timeline-icon gray-bg">
                                <i class="glyphicon glyphicon-text-size"></i>
                            </div>
                            <div class="vertical-timeline-content">
                                <p>Many desktop publishing packages and web page editors now use Lorem.
                                </p>
                                <span class="vertical-date small text-muted"> 4:20 pm - 10.05.2014 </span>
                            </div>
                        </div>
                        <div class="vertical-timeline-block">
                            <div class="vertical-timeline-icon gray-bg">
                                <i class="glyphicon glyphicon-text-size"></i>
                            </div>
                            <div class="vertical-timeline-content">
                                <p>There are many variations of passages of Lorem Ipsum available.
                                </p>
                                <span class="vertical-date small text-muted"> 06:10 pm - 11.03.2014 </span>
                            </div>
                        </div>
                        <div class="vertical-timeline-block">
                            <div class="vertical-timeline-icon navy-bg">
                                <i class="glyphicon glyphicon-text-size"></i>
                            </div>
                            <div class="vertical-timeline-content">
                                <p>The generated Lorem Ipsum is therefore.
                                </p>
                                <span class="vertical-date small text-muted"> 02:50 pm - 03.10.2014 </span>
                            </div>
                        </div>
                        <div class="vertical-timeline-block">
                            <div class="vertical-timeline-icon gray-bg">
                                <i class="glyphicon glyphicon-text-size"></i>
                            </div>
                            <div class="vertical-timeline-content">
                                <p>Conference on the sales results for the previous year.
                                </p>
                                <span class="vertical-date small text-muted"> 2:10 pm - 12.06.2014 </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection