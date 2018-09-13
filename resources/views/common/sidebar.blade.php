<div class="layui-side-scroll">
    <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
    <ul class="layui-nav layui-nav-tree"  lay-filter="test">
        <li class="layui-nav-item layui-nav-itemed">
            <a class="" href="javascript:;">作品列表</a>
            <dl class="layui-nav-child">
                <dd {!! Request::is('design/type/1*') ? 'class="layui-this"' : '' !!} >
                    <a href="/design/type/1">幼儿组</a>
                </dd>
                <dd {!! Request::is('design/type/2*') ? 'class="layui-this"' : '' !!}>
                    <a href="/design/type/2">儿童组</a>
                </dd>
                <dd {!! Request::is('design/type/3*') ? 'class="layui-this"' : '' !!}>
                    <a href="/design/type/3">少年组</a>
                </dd>
            </dl>
        </li>
        <li class="layui-nav-item layui-nav-itemed">
            <a class="" href="javascript:;">统计</a>
            <dl class="layui-nav-child">
                <dd {!! Request::is('statistics/index') ? 'class="layui-this"' : '' !!} >
                    <a href="/statistics/index">数据统计</a>
                </dd>
            </dl>
        </li>
        <li class="layui-nav-item layui-nav-itemed">
            <a class="" href="javascript:;">设置</a>
            <dl class="layui-nav-child">
                <dd {!! Request::is('setting/enddate') ? 'class="layui-this"' : '' !!} >
                    <a href="/setting/enddate">时间设置</a>
                </dd>
            </dl>
        </li>
    </ul>
</div>