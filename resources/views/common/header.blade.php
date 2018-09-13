<div class="layui-logo">童画 奥利匹克</div>
<!-- 头部区域（可配合layui已有的水平导航） -->
<ul class="layui-nav layui-layout-left">
    {{--<li class="layui-nav-item"><a href="">控制台</a></li>--}}
    {{--<li class="layui-nav-item"><a href="">作品管理</a></li>--}}
    {{--<li class="layui-nav-item"><a href="">用户</a></li>--}}
    {{--<li class="layui-nav-item">--}}
        {{--<a href="javascript:;">其它系统</a>--}}
        {{--<dl class="layui-nav-child">--}}
            {{--<dd><a href="">邮件管理</a></dd>--}}
            {{--<dd><a href="">消息管理</a></dd>--}}
            {{--<dd><a href="">授权管理</a></dd>--}}
        {{--</dl>--}}
    {{--</li>--}}
</ul>
<ul class="layui-nav layui-layout-right">
    <li class="layui-nav-item">
        <a href="javascript:;">
            <img src="http://t.cn/RCzsdCq" class="layui-nav-img">
            {{ Auth::user()->name }}
        </a>
        {{--<dl class="layui-nav-child">--}}
            {{--<dd><a href="">基本资料</a></dd>--}}
            {{--<dd><a href="">安全设置</a></dd>--}}
        {{--</dl>--}}
    </li>
    <li class="layui-nav-item">
        <a href="{{ url('/logout') }}" onclick="event.preventDefault();
        document.getElementById('logout-form').submit();">退出</a>
        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
    </li>
</ul>