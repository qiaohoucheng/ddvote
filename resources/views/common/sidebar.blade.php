<div class="layui-side-scroll">
    <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
    <ul class="layui-nav layui-nav-tree"  lay-filter="test">
        <li class="layui-nav-item  layui-this">
            <a href="{{ url('/home') }}">
                <i class="layui-icon layui-icon-engine"></i> <cite>概览</cite>
            </a>
        </li>
        <!-- layui-nav-itemed -->
        <li class="layui-nav-item ">
            <a class="" href="javascript:;">
                <i class="layui-icon layui-icon-template-1"></i>
                <cite>投票设置</cite>
            </a>
            <dl class="layui-nav-child">
                <dd {!! Request::is('design/type/1*') ? 'class="layui-this"' : '' !!} >
                    <a href="/design/type/1">投票列表</a>
                </dd>
                <dd {!! Request::is('design/type/3*') ? 'class="layui-this"' : '' !!}>
                    <a href="/design/type/3">新建投票</a>
                </dd>
            </dl>
        </li>
        <li class="layui-nav-item ">
            <a class="" href="javascript:;">
                <i class="layui-icon layui-icon-set"></i>
                <cite>系统设置</cite>
            </a>
            <dl class="layui-nav-child">
                <dd {!! Request::is('setting/enddate') ? 'class="layui-this"' : '' !!} >
                    <a href="/setting/enddate">时间设置</a>
                </dd>
            </dl>
        </li>
    </ul>
</div>