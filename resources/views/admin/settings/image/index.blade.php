@extends('admin.main')

@section('title') Image presets admin @endsection

@section('content')
    <div class="ibox float-e-margins">
        <div class="ibox-title background-transparent">
            <div>
                <h1 class="inline">Пресеты картинок</h1>
            </div>
        </div>
    </div>

    <div class="ibox float-e-margins">
        <div class="ibox-content">
            <table class="table">
                <thead>
                <tr>
                    <th>Название компонента</th>
                    <th>Большие фото</th>
                    <th>Миниатюры</th>
                    <th>Admin preset</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($apps as $app)
                    <form method="post" action="">
                    <tr>
                        <td>{{ $app->title }} <small class="text-muted">[{{ $app->name }}]</small></td>
                        <td>
                            <div class="form-group">
                                <input type="text" class="form-control" name="image_original" placeholder="без ограничений"
                                value="{{ Input::old('image_original', \Funct\Collection\get($app->settings, 'image_original')) }}">
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <input type="text" class="form-control" name="image_generate" placeholder="нет"
                                value="{{ Input::old('image_generate', \Funct\Collection\get($app->settings, 'image_generate')) }}">
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <input type="text" class="form-control" value="110x110" disabled>
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <input type="hidden" name="id" value="{{ $app->id }}">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <button type="submit" class="btn btn-success" name="save_preset">Сохранить</button>
                            </div>
                        </td>
                    </tr>
                    </form>
                @endforeach
                <tr>
                    <td></td>
                    <td colspan="3">
                        <p>Указываются размеры картинок в формате [ширина-высота], каждый пресет через запятую</p>
                        <p>Например: 150-210, 300-500</p>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection