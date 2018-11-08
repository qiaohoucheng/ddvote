<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{  $data->theme_name }}</title>
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
            background-color: #000103;
            font-family: '微软雅黑','PingFang SC','Droidsansfallback';
        }
        h1, h2, h3, h4, h5, h6 {
            line-height: 1.4;
        }
        #app {
            background-color: #000103;
            min-height: 100%;
            background-image: url(/images/quanshang-bg.png);
            background-repeat: no-repeat;
            background-size: 100% auto;
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


        .top-box img {
            width: 100%;
            vertical-align: top;
        }

        .search-box {
            padding: 0.533rem;
            padding-top: 5.866rem;
        }
        .search {
            background-image: url(/images/ic_search@2x.png);
            background-repeat: no-repeat;
            height: 0.96rem;
            background-size: 100% 100%;
        }
        .search .search-input {
            width:100%;
            border: none;
            height: 0.96rem;
            line-height: 0.96rem;
            text-align: left;
            font-size: 0.32rem;
            padding: 0.1rem 0.533rem;
            padding-right: 0.266rem;
            color: #666;
            background-color: transparent;
        }
        .search .search-btn {
            width: 2.24rem;
            height: 100%;
            background-color: transparent;
            color: transparent;
        }


        .search .search-btn:active {
            background-color: transparent;
            color: transparent;
        }
        ::-webkit-input-placeholder {
            color: rgba(255,255,255,.5);
        }
        .list-middle {
            padding: 0.533rem;
            text-align: center;
            position: relative;
        }
        .list-middle>div {
            font-size: 0.426rem;
            color: #F0CA79;
        }
        .list-middle>div:before {
            content: '';
            position: absolute;
            height: 1px;
            background-color: #F0CA79;
            top: 49.9%;
            left: 0.533rem;
            right: 60%;
        }
        .list-middle>div:after {
            content: '';
            position: absolute;
            height: 1px;
            background-color: #F0CA79;
            top: 49.9%;
            right: 0.533rem;
            left: 60%;
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
        .list li div:first-child {
            text-align: left;
            width: 6.693rem;
            color: #F0CA79;
            font-size: 0.373rem;
            padding: 0 0.533rem;
        }
        .list li.bar-tab a {
            width: 100%;
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
<div id="app">
    <div class="search-box">
        <form action="/v2" method="get" id="search-form">
        <div class="search bar-tab">
            <input type="search" name="keyword"  value="{{ $keyword }}"  class="search-input tab-item" placeholder="请输入证券公司简称搜索">
            <a href="javascript:;" class="search-btn tab-item"></a>
        </div>
        </form>
    </div>
    <div class="list-middle">
        <div>排行榜</div>
    </div>
    <ul class="clear list" id="dd-content">
    </ul>
</div>
</body>
<script src="{{ asset('/js/fastclick.js') }}"></script>
<script>
    layui.use('layer', function(){
        var $ = layui.jquery, layer = layui.layer;
        var token ='{{ csrf_token() }}';
        FastClick.attach(document.body);
        //搜索
        $('.search-btn').click(function(){
            $('#search-form').submit();
        })
        //投票
        $('.list').on('click','.vote-btn',function(){
            var cid = $(this).data('id');
            if(cid >0){
                window.location.href='/v2/'+cid;
            }
        });
    });
    layui.use('flow', function(){
        var $ = layui.jquery;
        var flow = layui.flow;
        var keyword ='{{ $keyword }}';
        flow.lazyimg();
        flow.load({
            elem: '#dd-content'
            ,done: function(page, next){
                console.log(page);
                var lis = [];
                $.get('/v2',{'page':page,'keyword':keyword}, function(res){
                    //假设你的列表返回在data集合中
                    layui.each(res.data, function(index, item){
                        lis.push(
                        '<li class="bar-tab">'+
                            '<div class="tab-item ellipsis">'+item.c_name+'<span style="float:right;"> '+item.vote+'票</span></div>'+
                            '<a href="javascript:;" class="tab-item vote-btn" data-id="'+item.id+'"></a>'+
                            '</li>'
                        )
                    });
                    next(lis.join(''), page < res.pages);
                });

            }
        });
    });
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
            var thumb ='http://vote.dudong.com/images/share.png';
            wx.onMenuShareTimeline({
                title: '{{ $data->theme_name }}',
                link: link,
                imgUrl: thumb,
                success: function () {
                },
                cancel: function () {
                }
            });
            wx.onMenuShareAppMessage({
                title: '{{ $data->theme_name }}',
                desc: '2018年，谁是券商中的佼佼者？ 投出您的一票，为中国新三板券商业务主体加油！',
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
    <script src="https://s19.cnzz.com/z_stat.php?id=1275138459&web_id=1275138459" language="JavaScript"></script>
</div>
</html>