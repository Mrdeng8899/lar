<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/app.css"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="/js/app.js"></script>
    <title>后台管理系统修改页面</title>
</head>
<body>

<hr/>
<div class="container">
    <form action="{{ route('admin.update',['id'=>$data->id]) }}" method="post">
        @csrf
        <div class="form-group">
            <label for="exampleInputEmail1">用户名</label>
            <input type="text" name="username" value="{{ $data->username }}" class="form-control">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">邮箱</label>
            <input type="text" class="form-control" value="{{ $data->email }}" name="email" id="exampleInputPassword1">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">性别</label>
            <input type="text" class="form-control" value="{{ $data->sex }}" name="sex" id="exampleInputPassword1">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">爱好</label>
            <input type="text" class="form-control" value="{{ $data->happy }}" name="happy" id="exampleInputPassword1">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">电话</label>
            <input type="text" class="form-control" value="{{ $data->phone }}" name="phone" id="exampleInputPassword1">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">个人简介</label>
            <input type="text" class="form-control" value="{{ $data->resume }}" name="resume" id="exampleInputPassword1">
        </div>
        <button type="submit" class="btn btn-primary">修改</button>
    </form>



</div>


</body>
</html>
