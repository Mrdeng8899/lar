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
    <title>回收站</title>
</head>
<body>
@if(session()->has('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success')  }}
    </div>

@endif

<hr>
<div class="container">
    <a href="{{ route('user.index') }}" class="btn btn-primary btn-lg">返回首页</a>
    <hr/>
    <table class="table table-striped table-dark">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">用户名</th>
            <th scope="col">性别</th>
            <th scope="col">邮箱</th>
            <th scope="col">操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($res as $v)
            <tr>
                <th scope="row">{{ $v['id'] }}</th>
                <td>{{ $v['username'] }}</td>
                <td>{{ $v['sex'] }}</td>
                <td>{{ $v['email'] }}</td>
                <td><a href="{{ route('admin.os',['id'=>$v['id']]) }}"  class="btn btn-danger" style="padding-left: 20px;">点击恢复</a>&nbsp;&nbsp;&nbsp;<a href="{{ route('admin.de',['id'=>$v['id']]) }}"  class="btn btn-danger" style="padding-left: 20px;" onclick="alert('您确定要删除此条数据吗')">永久删除</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
<nav aria-label="...">
    <ul class="pagination pagination-lg">
        <li class="page-item active" aria-current="page">
        </li>
        {{ $res->links() }}
    </ul>
</nav>

</div>

</body>
</html>
