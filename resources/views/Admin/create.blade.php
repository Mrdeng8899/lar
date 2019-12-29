<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/app.css"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="/js/app.js"></script>
    <title>后台管理系统添加用户</title>
</head>
<body>


<hr/>
<div class="container">
    <form action="{{ route('user.save') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="exampleInputEmail1">用户名</label>
            <input type="text" name="username" value="" class="form-control">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">真实姓名</label>
            <input type="text" name="truename" value="" class="form-control">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">密码</label>
            <input type="text" name="password" value="" class="form-control">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">性别</label>
            <input type="text" class="form-control" value="" name="sex" id="exampleInputPassword1">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">邮箱</label>
            <input type="text" class="form-control" value="" name="email" id="exampleInputPassword1">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">phone</label>
            <input type="text" class="form-control" value="" name="phone" id="exampleInputPassword1">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">个人简介</label>
            <textarea cols=”30” name="resume"></textarea>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">头像</label>
            <input type="file" name="header">
        </div>
        <button type="submit" class="btn btn-primary">添加</button>
    </form>


</div>




</body>
</html>
