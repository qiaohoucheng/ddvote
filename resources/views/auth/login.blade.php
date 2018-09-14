<html>
<head>
    <meta charset="utf-8">
    <title>投票系统后台</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="stylesheet" href="{{ asset('/layui/css/layui.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/all.css') }}">
    <link rel="stylesheet" href="{{asset('/css/login.css')}}" >
</head>
<body layadmin-themealias="default" class="layui-layout-body" >
<div id="LAY_app" class="layadmin-tabspage-none">
    <link rel="stylesheet" href="./dist/style/login.css?v=1.0.0 pro-1" media="all">
    <div class="layadmin-user-login layadmin-user-display-show" id="LAY-user-login">
        <div class="layadmin-user-login-main" style="background-color: #fff;">
            <div class="layadmin-user-login-box layadmin-user-login-header">
                <h2>读懂新三板</h2>
                <p>读懂新三板投票后台管理系统</p>
            </div>
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                {{ csrf_field() }}
                <div class="layadmin-user-login-box layadmin-user-login-body layui-form">
                    <div class="layui-form-item">
                        <label class="layadmin-user-login-icon layui-icon layui-icon-username" for="LAY-user-login-username"></label>
                        <input type="email"  name="email" id="LAY-user-login-username" lay-verify="required" placeholder="用户名" class="layui-input" value="{{ old('email') }}">
                    </div>
                    <div class="layui-form-item">
                        <label class="layadmin-user-login-icon layui-icon layui-icon-password" for="LAY-user-login-password"></label>
                        <input type="password" name="password" id="LAY-user-login-password" lay-verify="required" placeholder="密码" class="layui-input">
                    </div>
                    {{--<div class="layui-form-item">--}}
                    {{--<div class="layui-row">--}}
                    {{--<div class="layui-col-xs7">--}}
                    {{--<label class="layadmin-user-login-icon layui-icon layui-icon-vercode" for="LAY-user-login-vercode"></label>--}}
                    {{--<input type="text" name="vercode" id="LAY-user-login-vercode" lay-verify="required" placeholder="图形验证码" class="layui-input">--}}
                    {{--</div>--}}
                    {{--<div class="layui-col-xs5">--}}
                    {{--<div style="margin-left: 10px;">--}}
                    {{--<img src="https://www.oschina.net/action/user/captcha" class="layadmin-user-login-codeimg" id="LAY-user-get-vercode">--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    <div class="layui-form-item">
                        <button class="layui-btn layui-btn-fluid" type="submit" lay-filter="LAY-user-login-submit">登 入</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>