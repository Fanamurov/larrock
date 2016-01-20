@extends('admin.main')
@section('title') {{ $app['name'] }} admin @endsection

@section('content')
    <div class="ibox float-e-margins">
        <div class="ibox-title background-transparent">
            <div>
                {!! Breadcrumbs::render('admin.wizard.check') !!}
                <div class="add-panel">
                    <a class="btn btn-info pull-right" href="/admin/{{ $app['name'] }}/import">Далее</a>
                </div>
            </div>
        </div>
    </div>

    <div class="ibox float-e-margins">
        <div class="ibox-content">
            @foreach($data as $data_value)
                <h3>{{ $data_value->getTitle() }}</h3>
                <table class="table">
                    <tbody>
                    <tr>
                        @foreach($data_value->first() as $colomn_name => $colomn_value)
                            <td>{{ $colomn_name }}</td>
                        @endforeach
                    </tr>
                    @foreach($data_value as $colomn)
                        <tr>
                            @foreach($colomn as $colomn_name => $colomn_value)
                                <td>{{ $colomn_value }}</td>
                            @endforeach
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endforeach
        </div>
    </div>
@endsection