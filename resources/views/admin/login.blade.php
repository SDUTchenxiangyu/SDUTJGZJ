<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('static/css/ch-ui.admin.css')}}">
    <link rel="stylesheet" href="{{ asset('static/font/css/font-awesome.min.css')}}">
    <title>后台管理系统</title>
</head>
<body style="background:#F3F3F4;">
    <div class="login_box">
        <h1>建工之家</h1>
        <h2>欢迎使用网站管理平台</h2>
        <div class="form">
            @if(session('msg'))
            <p style="color:red">{{ session('msg') }}</p>
            @endif
            <form action="" method="post">
                {{ csrf_field() }}
                <ul>
                    <li>
                        <input type="text" name="user_name" class="text">
                        <span><i class="fa fa-user"></i></span>
                    </li>
                    <li>
                        <input type="password" name="user_pass" class="text">
                        <span><i class="fa fa-lock"></i></span>
                    </li>
                    <li>
                        <input type="text" name="code" class="code">
                        <span><i class="fa fa-check-square-o"></i></span>
                        <img src="{{ url('admin/code') }}" alt="" onclick="this.src='{{ url('admin/code') }}?'+Math.random()">
                    </li>
                    <li>
                        <input type="submit" value="立即登陆">
                    </li>
                </ul>
            </form>
            <p><a href="#">返回首页</a>&copy 2017 Powered by<a href="http://www.sdut-jgzj.cn" target="_blank"><br>www.sdut-jgzj.cn</a></p>
        </div>
    </div>
</body>
</html>