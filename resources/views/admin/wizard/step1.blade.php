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
            <form action="" method="post">
                <table class="table table-clean">
                    <thead>
                    <tr>
                        <th>Поле в прайсе</th>
                        <th>Поле в БД</th>
                        <th>Поле для людей</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($colomns as $colomn)
                        <tr>
                            <td>
                                <div class="form-group">
                                    <input type="text" value="{{ $colomn }}" class="form-control" disabled>
                                    <input type="hidden" value="{{ $colomn }}" name="xls[]">
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <select name="db[]" class="form-control">
                                        <option value="">Не назначено</option>
                                        @foreach($catalog['rows'] as $catalog_row => $catalog_option)
                                            <option value="{{ $catalog_row }}"
                                                    @if(array_key_exists($colomn, $wizard))
                                                        @if($wizard[$colomn]['db'] === $catalog_row) selected @endif
                                                    @endif
                                            >{{ $catalog_row }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <select name="slug[]" class="form-control">
                                        <option value="">Не назначено</option>
                                        @foreach($catalog['rows'] as $catalog_row => $catalog_option)
                                            <option value="{{ $catalog_row }}"
                                                    @if(array_key_exists($colomn, $wizard))
                                                        @if($wizard[$colomn]['slug'] === $catalog_row) selected @endif
                                                    @endif
                                            >{{ $catalog_option['title'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="form-group text-right">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <button type="submit" class="btn btn-info">Сохранить</button>
                </div>
            </form>
        </div>
    </div>
@endsection