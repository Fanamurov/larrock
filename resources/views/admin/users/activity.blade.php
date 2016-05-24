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
                                <div class="alert alert-warning">У автора нет стран/курортов/разделов</div>
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
                                <div class="alert alert-warning">У автора нет новостей</div>
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
                                <div class="alert alert-warning">У автора нет материалов в блоге</div>
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
                                    <span> Заполнено стран/курортов </span>
                                    <h2 class="font-bold">{{ $categories->total() }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="widget style1 text-center">
                            <span> место </span>
                            <h2 class="font-bold">1<i class="glyphicon glyphicon-fire"></i></h2>
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
                                <h1 class="no-margins">{{ $counter['categories']['loads']['user'] }}</h1>
                                <div class="stat-percent font-bold text-success">{{ $counter['categories']['loads']['perst'] }}%</div>
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
                                <h1 class="no-margins">{{ $counter['categories']['share']['user'] }}</h1>
                                <div class="stat-percent font-bold text-success">{{ $counter['categories']['share']['perst'] }}%</div>
                                <small>От общего</small>
                            </div>
                        </div>
                    </div>
                </div>

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
                            <h2 class="font-bold">1<i class="glyphicon glyphicon-fire"></i></h2>
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
                                <h1 class="no-margins">{{ $counter['tours']['loads']['user'] }}</h1>
                                <div class="stat-percent font-bold text-success">{{ $counter['tours']['loads']['perst'] }}%</div>
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
                                <h1 class="no-margins">{{ $counter['tours']['share']['user'] }}</h1>
                                <div class="stat-percent font-bold text-success">{{ $counter['tours']['share']['perst'] }}%</div>
                                <small>От общего</small>
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
                            <h2 class="font-bold">1<i class="glyphicon glyphicon-fire"></i></h2>
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
                                <h1 class="no-margins">{{ $counter['news']['loads']['user'] }}</h1>
                                <div class="stat-percent font-bold text-success">{{ $counter['news']['loads']['perst'] }}%</div>
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
                                <h1 class="no-margins">{{ $counter['news']['share']['user'] }}</h1>
                                <div class="stat-percent font-bold text-success">{{ $counter['news']['share']['perst'] }}%</div>
                                <small>От общего</small>
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
                                <h2 class="font-bold">1<i class="glyphicon glyphicon-fire"></i></h2>
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
                                    <h1 class="no-margins">{{ $counter['blog']['loads']['user'] }}</h1>
                                    <div class="stat-percent font-bold text-success">{{ $counter['blog']['loads']['perst'] }}%</div>
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
                                    <h1 class="no-margins">{{ $counter['blog']['share']['user'] }}</h1>
                                    <div class="stat-percent font-bold text-success">{{ $counter['blog']['share']['perst'] }}%</div>
                                    <small>От общего</small>
                                </div>
                            </div>
                        </div>
                    </div>

                <div class="ibox-content">
                    <strong>Последние действия</strong>
                    <div id="vertical-timeline" class="vertical-container dark-timeline">
                        @foreach($logger as $logger_value)
                            <div class="vertical-timeline-block">
                                @if($logger_value->type_action === 'Add')
                                    <div class="vertical-timeline-icon lazur-bg">
                                        <i class="glyphicon glyphicon-certificate"></i>
                                    </div>
                                @elseif($logger_value->type_action === 'Update')
                                    <div class="vertical-timeline-icon yellow-bg">
                                        <i class="glyphicon glyphicon-pencil"></i>
                                    </div>
                                @elseif($logger_value->type_action === 'Delete')
                                    <div class="vertical-timeline-icon red-bg">
                                        <i class="glyphicon glyphicon-trash"></i>
                                    </div>
                                @endif
                                <div class="vertical-timeline-content">
                                    <p>{{ $logger_value->action }}</p>
                                    <span class="vertical-date small text-muted"> {{ $logger_value->updated_at }} </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection