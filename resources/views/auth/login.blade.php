@extends('admin.main')

@section('content')
    <form method="POST" action="/auth/login" style="width: 300px; margin: 0 auto">
        <h1 class="text-center">Авторизация</h1>
        <div class="form-group">
            <label for="email" class="control-label">Email:</label>
            <input type="email" name="email" id="email" class="form-control">
        </div>
        <div class="form-group">
            <label for="password" class="control-label">Password:</label>
            <input type="password" name="password" id="password" class="form-control">
        </div>
        <div class="form-group">
            <input type="hidden" name="_token" value="{{csrf_token()}}"><br>
            <input type="submit" value="Enter" class="btn btn-default btn-block">
        </div>
    </form>
@endsection