<form method="POST" action="/auth/login">
    <h2>Введите ваш логин и пароль</h2>
    Email <br><input type="email" name="email"><br>
    Пароль:<br> <input type="password" name="password"><br>
    <input type="hidden" name="_token" value="{{csrf_token()}}"><br>
    <input type="submit" value="Enter">
</form>