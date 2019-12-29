<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/css/app.css"/>
    <script src="/js/app.js"></script>

    <title>后台管理登入页面</title>
</head>
<body>

<div class="container">
    @if(session()->has('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
            @endif
    <hr/>
    <form action="{{ route('login.list') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="exampleInputEmail1">用户名(username)</label>
            <input type="text" class="form-control" name="username">
            @if($errors->has('username'))
            <small id="emailHelp" class="form-text text-danger">{{ $errors->first('username') }}</small>
                @endif
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">密码(password)</label>
            <input type="password" name="password" class="form-control" id="exampleInputPassword1">
            @if($errors->has('username'))
                <small id="emailHelp" class="form-text text-danger">{{ $errors->first('password') }}</small>
            @endif
        </div>
        <label for="exampleInputPassword1">验证码(code)</label>
        <div class="form-group">
            <input type="text" name="code">
            <img src="{{ captcha_src() }}" onclick="this.src='{{ captcha_src() }}'+'?'+Math.random()">
            @if($errors->has('username'))
                <small id="emailHelp" class="form-text text-danger">{{ $errors->first('code') }}</small>
            @endif
        </div>
        <button type="submit" class="btn btn-primary">登入</button>
    </form>
</div>


</body>
</html>
