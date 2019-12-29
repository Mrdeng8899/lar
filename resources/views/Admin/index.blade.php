<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/app.css"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="/js/app.js"></script>
    <title>后台管理系统首页</title>
</head>
<body>

<hr/>
<div class="container">
    <a href="{{ route('user.create') }}" class="btn btn-primary btn-lg" >添加用户</a>
    <hr/>
    <form id="FormData" action="{{ route('admin.search') }}" method="post">
        @csrf
    <label>选择日期：</label><input id="meeting" type="date" name="created_at" value="{{ date('Y-m-d') }}"/>
        <input type="text" name="username" value="" id="va">
    <button type="submit" class="btn btn-primary" id="FormShou">搜索一下</button>
    </form>
        <table class="table table-bordered table-dark">
        <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">用户名</th>
            <th scope="col">真实姓名</th>
            <th scope="col">性别</th>
            <th scope="col">邮箱</th>
            <th scope="col">电话</th>
            <th scope="col">操作</th>
        </tr>
        </thead>
        <tbody>
        @csrf
        @foreach($data as $v)
            <tr>
                <th scope="row">{{ $v->id }}</th>
                <td>{{ $v->username }}</td>
                <td>{{ $v->truename }}</td>
                <td>{{ $v->sex }}</td>
                <td>{{ $v->email }}</td>
                <td>{{ $v->phone }}</td>
                <td><a href="{{ route('user.del',['id'=>$v->id]) }}"  class="btn btn-danger" style="padding-left: 20px;">删除</a>&nbsp;&nbsp;&nbsp;<a href="{{ route('admin.show') }}"  class="btn btn-danger">回收站</a>&nbsp;&nbsp;&nbsp;<a href="{{ route('admin.edit',['id'=>$v->id]) }}" class="btn btn-warning">修改</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <nav aria-label="...">
        <ul class="pagination pagination-lg">
            <li class="page-item active" aria-current="page">
            </li>
            {{ $data->appends([])->links() }}
        </ul>
    </nav>

</div>
</body>
<script>
    {{--$('#FormShou').click(function () {--}}
    {{--    // 获取value的值--}}
    {{--    // var res=$('#meeting').val();--}}
    {{--    // var des=$('#va').val();--}}
    {{--    // 发送ajax--}}
    {{--    $.ajax({--}}
    {{--        'url':'{{ route('admin.search') }}',--}}
    {{--        'type':'get',--}}
    {{--         'data':$('#FormData').serialize(),--}}
    {{--        'dataType':'json',--}}
    {{--        'success':function (data) {--}}
    {{--            var data=data.data;--}}
    {{--            var html='';--}}
    {{--            // console.log(data);--}}
    {{--        }--}}
    {{--    })--}}
    {{--})--}}

</script>
</html>
