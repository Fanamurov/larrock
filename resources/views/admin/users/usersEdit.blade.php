@extends('admin.layouts.main')
@section('title', 'Users admin')
@section('page_h1', 'User edit')
@section('page_h1_new', 'нового пользователя')

@section('content')
    @foreach($data as $data_value)
        <form action="/admin/users/{{{$data_value->id}}}/update" method="post">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" value="{{{$data_value->email}}}" class="form-control" id="email">
            </div>
            <div class="form-group">
                <label for="first_name">first_name</label>
                <input type="text" value="{{{$data_value->first_name}}}" class="form-control" id="first_name">
            </div>
            <div class="form-group">
                <label for="last_name">last_name</label>
                <input type="text" value="{{{$data_value->last_name}}}" class="form-control" id="last_name">
            </div>
            <div class="form-group">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </div>
        </form>
    @endforeach
@endsection