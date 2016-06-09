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
                <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Туры {{ $tours->total() }}</a></li>
                <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Страны, курорты {{ $categories->total() }}</a></li>
                <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Блог {{ $blog->total() }}</a></li>
                <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Новости {{ $news->total() }}</a></li>
                <li role="presentation"><a href="#hotels" aria-controls="hotels" role="tab" data-toggle="tab">Отели {{ $hotels->total() }}</a></li>
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
                        <div role="tabpanel" class="tab-pane" id="hotels">
                            @if(count($blog) === 0)
                                <div class="alert alert-warning">У автора нет отелей</div>
                            @else
                                <table class="table table-striped table-hover">
                                    <tbody>
                                    @include('admin.users.activityBlocks.hotels', array('data' => $hotels, 'app' => $app))
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
                    <div class="col-xs-24">
                        <h1 class="text-center">Заказы туров: {{ $forms['zakazTura']['count']['new'] }}</h1>
                        <div class="col-xs-12">
                            @foreach($forms['zakazTura']['data'] as $key => $form_value)
                                <button class="btn btn-danger btn-block" data-toggle="modal" data-target="#myModal{{$key}}">
                                    <i class="glyphicon glyphicon-envelope"></i> {{ $form_value->params['tour_name'] }}
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="myModal{{$key}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h1 class="modal-title text-center" id="myModalLabel">Заказ тура</h1>
                                            </div>
                                            <div class="modal-body">
                                                <p>Имя: {{ $form_value->params['name'] }}</p>
                                                <p>Телефон: {{ $form_value->params['tel'] }}</p>
                                                <p>Email: <a href="mailto:{{ $form_value->params['email'] }}">{{ $form_value->params['email'] }}</a></p>
                                                <p>Примерная дата вылета: {{ $form_value->params['date'] }}</p>
                                                <p>Комментарий: {{ $form_value->params['comment'] }}</p>
                                                <p><a href="{{ $form_value->params['tour_url'] }}">Ссылка на тур</a></p>
                                                <select name="status" class="form-control">
                                                    <option value="Новый">Статус заявки: Новый</option>
                                                    <option value="Просмотрено">Статус заявки: Просмотрено</option>
                                                    <option value="Заказ сделан">Статус заявки: Заказ сделан</option>
                                                    <option value="Заказ отменен">Статус заявки: Заказ отменен</option>
                                                    <option value="Удалено">Статус заявки: Удалено</option>
                                                </select>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="ibox float-e-margins">
                <div class="row">
                    <div class="col-xs-6">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <span class="label label-success pull-right">views</span>
                                <h5>Курорты</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins">{{ $counter['categories']['loads']['user'] }}</h1>
                                <span class="stat-percent font-bold text-success">{{ $counter['categories']['loads']['perst'] }}%</span>
                                <small>От общего</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <span class="label label-success pull-right">sharing</span>
                                <h5>Курорты</h5>
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

                <div class="row">
                    <div class="col-xs-6">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <span class="label label-success pull-right">views</span>
                                <h5>Отели</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins">{{ $counter['hotels']['loads']['user'] }}</h1>
                                <div class="stat-percent font-bold text-success">{{ $counter['hotels']['loads']['perst'] }}%</div>
                                <small>От общего</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <span class="label label-success pull-right">sharing</span>
                                <h5>Отели</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins">{{ $counter['hotels']['share']['user'] }}</h1>
                                <div class="stat-percent font-bold text-success">{{ $counter['hotels']['share']['perst'] }}%</div>
                                <small>От общего</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="ibox float-e-margins">
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
    </div>
@endsection