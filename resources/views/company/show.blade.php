<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{ $data['theme_name'] }}</title>
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
    <meta http-equiv="Cache-Control" content="no-transform">
    <meta http-equiv="Cache-Control" content="no-siteapp">
    <meta name="format-detection" content="telephone=no">
    <!-- 引入样式 -->
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('/layui/css/layui.css') }}">
    <script src="{{ asset('/layui/layui.js') }}"></script>
    <script src="{{ asset('/js/jquery-2.2.3.min.js') }}"></script>
    <style type="text/css">
        html, body {
            height: 100%;
        }
        body {
            line-height: 1.4;
            background-color: #000;
            font-family: '微软雅黑','PingFang SC','Droidsansfallback';
        }
        h1, h2, h3, h4, h5, h6 {
            line-height: 1.4;
        }
        #app {
            background-color: #000103;
            background-image: linear-gradient(0deg, #010103 0%, #0B1232 100%);
            min-height: 100%;
        }
        .ellipsis {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        .ellipsis-2 {
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 2;
            overflow: hidden;
        }
        .bar-tab {
            display: table;
            width: 100%;
            table-layout: fixed;
            -webkit-touch-callout: none;
        }
        .bar-tab .tab-item {
            display: table-cell;
            overflow: hidden;
            width: 1%;
            text-align: center;
            vertical-align: middle;
            white-space: nowrap;
            text-overflow: ellipsis;
        }
        .x-line {
            height: 1px;
            background-color: #eee;
            -webkit-transform: scaleY(0.5);
            transform: scaleY(0.5);
        }
        .text-center {
            text-align: center;
        }
        .text-right {
            text-align: right;
        }
        .clear:after {
            content: "";
            display: block;
            width: 0;
            height: 0;
            clear: both;
        }

        .info-box {
            padding: 0.533rem;
            background-color: rgba(255,255,255,.1);
            border-radius: 0.213rem;
            text-align: center;
            color: #fff;
            font-size: 0.346rem;
            margin: 0 0.533rem;
            height: 10.64rem;
            overflow-y: auto;
        }
        .info-box li {
            display: block;
            margin-bottom: 0.48rem;
        }
        .info-box li:last-child {
            margin-bottom: 0;
        }
        .text {
            color: #fff;
            width: 7.866rem;
            margin: 0 auto;
            padding: 0.533rem 0;
        }
        .text h3 {
            font-size: 0.346rem;
            margin-bottom: 0.266rem;
        }
        .text p {
            font-size: 0.346rem;
        }
        .nav {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            z-index: 998;
            height: 1.333rem;
            background-repeat: no-repeat;
            background-size: 100%;
            overflow: hidden;
            background-color: #141E3C;
        }
        .nav a {
            color: #F0CA79;
        }
        .nav>a:first-child {
            font-size: 0.426rem;
            width: 4.133rem;
        }
        .nav>a:first-child:after {
            content: '';
            position: absolute;
            left: 4.133rem;
            top: 0.266rem;
            bottom: 0.266rem;
            width: 1px;
            background-color: #F0CA79;
        }
        .nav>a:last-child {
            font-size: 0.373rem;
            width: 100%;
        }
        .nav~#app {
            padding-bottom: 1.333rem;
        }
        .list {
            padding: 0.533rem;
            padding-top: 0;
            padding-bottom: 1px;
        }
        .list li {
            /*display: block;*/
            margin-bottom: 0.4rem;
            background-image: url(/images/ic_vote2@2x.png);
            background-repeat: no-repeat;
            height: 0.96rem;
            line-height: 0.96rem;
            background-size: 100% 100%;
        }
        .list li>div:first-child {
            text-align: left;
            width: 6.693rem;
            color: #F0CA79;
            font-size: 0.373rem;
            padding-left: 0.533rem;
            padding-right: 0.266rem;
        }
        .list li.bar-tab a {
            width: 100%;
        }
        .list li.bar-tab .name {
            text-align: left;
            max-width: 3.8rem;
        }
        .list li.bar-tab .num {
            text-align: right;
            color: #fff;
            font-size: 0.32rem;
            max-width: 1.76rem;
        }
        .detail-top {
            padding: 0.533rem;
        }
        .detail-top>div {
            border-radius: 0.16rem;
            overflow: hidden;
        }
        .detail-top img {
            width: 100%;
            vertical-align: top;
        }
    </style>
    <script>
        var mql = window.matchMedia("(orientation: portrait)");
        function onMatchMeidaChange(mql){
            var w = document.documentElement.clientWidth / 10;
            document.getElementsByTagName('html')[0].style['font-size'] = w + 'px';
        }
        onMatchMeidaChange(mql);
        mql.addListener(onMatchMeidaChange);
    </script>
</head>
<body>
<div class="nav bar-tab">
    <a href="/v2" class="tab-item">首页</a>
    <a href="" class="tab-item">中国新三板年度盛典暨<br/>第二届点金奖颁奖典礼报名</a>
</div>
<div id="app">
    <div style="padding-top: 2.666rem;background-image: url(/images/top-bg.png);background-repeat: no-repeat;background-size: 89.4% auto;background-position: center 0.533rem;"></div>
    <div class="detail-top" style="padding-top: 0;">
        <div style="height: 2.133rem;background-color: #fff;position: relative;">
            <img src="{{ $data['company']['c_logo'] }}" style="width: 100%;height: auto;top: 50%;-webkit-transform: translateY(-50%);transform: translateY(-50%);position: absolute;left: 0">
        </div>
    </div>
    <ul class="clear list">
        @foreach( $data['prize'] as $k =>$v)
        <li class="bar-tab">
            <div class="tab-item ellipsis">
                <div class="tab-item name">{{ $v['prize_name'] }}</div>
                <div class="tab-item num"><span id="{{ $v['id'] }}box">{{ $data['company']['v'.$v['id']] }}</span> 票</div>
            </div>
            <a class="tab-item vote-btn" href="javascript:;" data-pid="{{ $v['id'] }}"></a>
        </li>
        @endforeach
    </ul>
    <div class="info-box">
        <ul>
            <li>2018点金奖·券商综合实力TOP20榜单评选规则<br>
                暨点金奖新三板券商奖项颁奖规则
            </li>
            <li>
                「读懂新三板」从多维度对券商业务进行梳理<br>
                旨在发现新三板综合实力最强<br>
                在推荐挂牌、持续督导、做市各业务领域处于领先地位的券商<br>
                我们希望<br>
                能够以榜单排名的形式，为挂牌公司提供选择依据<br>
                降低挂牌公司选择中介服务机构的抉择成本<br>
                提高市场的运行效率<br>
                推动多层次资本市场的健康发展<br>
            </li>
            <li>
                本次活动采取线下线上共同评选的方式<br>
                将对新三板市场券商的多项业务进行逐一评选，产生：<br>
                “最佳推荐挂牌券商TOP20”榜单</li>
                “最佳督导券商TOP20”榜单</li>
                “最佳做市商TOP20”榜单</li>
                并在此三项榜单评选的基础上综合其他因素</li>
                最终产生“新三板券商综合实力TOP20”榜单</li>
            <li>
                本次线上投票共分三类<br>
                最佳做市券商、最佳督导券商、最佳挂牌券商<br>
                最具综合实力券商线上投票结果将由该三部分的投票结果综合产生<br>
                投票综合数据将计入券商综合实力TOP20榜单最终评选结果<br>
                占评选比重20%<br>
                每个微信ID每天只能投10票<br>
                每天给每个券商奖项可投1票，不能重复投票<br>
            <li>
                在榜单评选基础上，将产生<br>
                “最佳推荐挂牌券商奖”、“最佳督导券商奖”、“最佳做市商奖”<br>
                以及“最佳券商奖”各十名<br>
                于11月30日「2018中国新三板年度盛典暨第二届点金奖颁奖典礼」<br>
                现场颁奖<br>
            <li>
        </ul>
        <img src="/images/text.png" width="100%">
    </div>
    <div class="text">
        <h3>投票须知：</h3>
        <p>
            {!! htmlspecialchars_decode($data['theme_desc']) !!}
        </p>
    </div>
</div>
</body>
<script src="{{ asset('/js/fastclick.js') }}"></script>
<script>
    layui.use('layer', function(){
        var $ = layui.jquery;
        var layer = layui.layer;
        var token ='{{ csrf_token() }}';
        //FastClick.attach(document.body);
        //投票
        $('.list').on('click','.vote-btn',function(){
            var cid = '{{ $id }}';
            var pid = $(this).data('pid');
            $.post('/v2',{'pid':pid,'cid':cid,'_token':token},function(data){
                if(data.code ==1){
                    var text = $('#'+cid+'box').text();
                    $('#'+pid+'box').text(Number(text)+Number(1));
                }
                layer.msg(data.message);
            });

        });
    })
</script>
<script src="http://res.wx.qq.com/open/js/jweixin-1.4.0.js"></script>
<script type="text/javascript">
    $(function(){
        var url = location.href.split('#').toString();
        $.ajax({
            type : "get",
            url : "/getconfig",
            dataType : "json",
            data:{url:url},
            async : false,
            success : function(data) {
                wx.config({
                    debug: false,
                    appId: data.appId,
                    timestamp: data.timestamp,
                    nonceStr: data.nonceStr,
                    signature: data.signature,
                    jsApiList: [
                        'checkJsApi',
                        'onMenuShareTimeline',
                        'onMenuShareAppMessage'
                    ]
                });
            },
            error: function(xhr, status, error) {
                //alert(status);
                //alert(xhr.responseText);
            }
        });
        wx.ready(function () {
            var link = window.location.href;
            var protocol = window.location.protocol;
            var host = window.location.host;
            var thumb ="http://vote.dudong.com/images/share.png";
            wx.onMenuShareTimeline({
                title: '{{ $data['company']['c_name'] }}正在参加2018点金奖·券商综合实力TOP20线上评选',
                link: link,
                imgUrl: thumb,
                success: function () {
                },
                cancel: function () {
                }
            });
            wx.onMenuShareAppMessage({
                title: '{{ $data['company']['c_name'] }}正在参加2018点金奖·券商综合实力TOP20线上评选',
                desc: '请为我们投票！',
                link: link,
                imgUrl: thumb,
                type: 'link',
                dataUrl: '',
                success: function () {
                },
                cancel: function () {
                }
            });
        });

    });
</script>
<div style="display: none;">
    <script src="https://s13.cnzz.com/z_stat.php?id=1274993675&web_id=1274993675" language="JavaScript"></script>
</div>
</html>