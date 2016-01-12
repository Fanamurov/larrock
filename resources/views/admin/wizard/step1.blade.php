@extends('admin.main')
@section('title') {{ $app['name'] }} admin @endsection

@section('content')
    <div class="ibox float-e-margins">
        <div class="ibox-title background-transparent">
            <div>
                {!! Breadcrumbs::render('admin.wizard.step1') !!}
                <div class="add-panel">
                    <a class="btn btn-info pull-right" href="/admin/{{ $app['name'] }}/step2">Далее</a>
                </div>
            </div>
        </div>
    </div>

    <div class="ibox float-e-margins">
        <div class="ibox-content">

        </div>
    </div>
@endsection