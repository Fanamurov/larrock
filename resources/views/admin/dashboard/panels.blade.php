@extends('admin.main')
@section('title') CRM @endsection

@section('content')
    <div class="ibox float-e-margins">
        <div class="ibox-title background-transparent">
            <div>
                {!! Breadcrumbs::render('admin.dashboard.index') !!}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-4 panel-dashboard">
            @foreach($count['new'] as $key_panel => $panel)
                <div class="ibox float-e-margins">
                    <div class="ibox-content ibox-heading">
                        <h3><i class="fa fa-envelope-o"></i> {{ $key_panel }} <small class="pull-right text-muted">всего {{ $count['all'][$key_panel] }}</small></h3>
                        @if($count['new'][$key_panel] > 0)
                            <small><i class="fa fa-tim"></i> У вас {{ $count['new'][$key_panel] }} необработанных сообщения.</small>
                        @endif
                    </div>
                    <div class="ibox-content panel-dashboard-content">
                        <div class="feed-activity-list">
                            @include('admin.dashboard.panel'.$key_panel)
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="col-xs-8">
            <div class="ibox float-e-margins ItemInfo">
                <div class="ibox-content">Загрузка данных...</div>
            </div>
        </div>
    </div>
@endsection