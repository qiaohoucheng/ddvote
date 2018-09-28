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
            background-color: #000;
            font-family: '微软雅黑','PingFang SC','Droidsansfallback';
        }
        h1, h2, h3, h4, h5, h6 {
            line-height: 1.4;
        }
        #app {
            background-color: #000;
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

        .top-box {
            display: block;
            position: relative;
        }
        .top-box img {
            width: 100%;
            vertical-align: top;
        }
        .top-box .top-logo {
            position: absolute;
            width: 2.24rem;
            left: 0.8rem;
            top: 0.746rem;
        }
        .search-box {
            padding: 0.32rem;
        }
        .search {
            background-image: url(/images/input-img.png);
            background-repeat: no-repeat;
            height: 0.774rem;
            background-size: 100%;
        }
        .search .search-input {
            width: 7.013rem;
            border: none;
            height: 100%;
            text-align: left;
            font-size: 0.346rem;
            padding: 0.1rem 0.4rem;
            color: #666;
            background-color: transparent;

        }
        .search .search-btn {
            width: 2.386rem;
            height: 100%;
            background-color: transparent;
            color: transparent;
        }
        .search .search-btn:active {
            background-color: transparent;
            color: transparent;
        }
        ::-webkit-input-placeholder {
            color: #bbb;
        }
        .list {
            padding: 0.32rem;
            padding-top: 0;
            padding-bottom: 1px;
        }
        .list li {
            display: block;
            width: 4.52rem;
            border-radius: 0.16rem;
            overflow: hidden;
            margin-bottom: 0.32rem;
        }
        .list li:nth-child(2n) {
            float: right;
        }
        .list li:nth-child(2n+1) {
            float: left;
        }
        .list-top {
            height: 2.533rem;
            background-image: url(/images/default.png);
            background-repeat: no-repeat;
            background-size: 100%;
            overflow: hidden;
            display: block;
        }
        .list-top img {
            width: 100%;
            vertical-align: top;
        }
        .list-bot {
            height: 1.266rem;
            background-color: #fff;
        }
        .list-bot .vote-btn {
            padding-right: 0.32rem;
            width: 1.573rem;
        }
        .vote-btn span{
            display: block;
            margin-left: auto;
            width: 1.253rem;
            height: 0.48rem;
            background-image: url('/images/votebtn.png');
            background-repeat: no-repeat;
            background-size: 100%;
        }
        .list-bot .list-tit {
            color: #000;
            font-size: 0.4rem;
            width: 100%;
            padding-left: 0.32rem;
            text-align: left;
        }
        .list-tit span {
            font-size: 0.266rem;
            color: #bbb;
            margin-left: 0.064rem;

            display: inline-block;
            -webkit-transform: scale(0.83);
            transform: scale(0.83);
            vertical-align: middle;
        }
        .nav {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            z-index: 998;
            height: 1.2rem;
            background-image: url('/images/navbtn.jpg');
            background-repeat: no-repeat;
            background-size: 100%;
            overflow: hidden;
            background-color: #ffc969;
        }
        .nav~#app {
            padding-bottom: 1.2rem;
        }
    </style>
    <script>
        var w = document.documentElement.clientWidth / 10;
        document.getElementsByTagName('html')[0].style['font-size'] = w + 'px';
    </script>
</head>
<body>
{{--<div class="nav bar-tab">--}}
    {{--<a href="" class="tab-item"></a>--}}
    {{--<a href="" class="tab-item"></a>--}}
{{--</div>--}}
<div id="app">
    <div class="top-box">
        <a href="#">
            <img src="/images/topbg.jpg" data ="/topbg.jpg">
        </a>
    </div>
    <div class="search-box">
        <form action="/" method="get" id="search-form">
            <div class="search bar-tab">
                <input type="search" value="{{ $keyword }}" autocomplete="off" name="keyword" class="search-input tab-item" placeholder="请输入姓名或公司代码搜索参投董秘">
                <a href="javascript:;" class="search-btn tab-item"></a>
            </div>
        </form>
    </div>
    <ul class="clear list" id="dd-content">
    </ul>
</div>
<script src="{{ asset('/js/fastclick.js') }}"></script>
<script>
    layui.use('layer', function(){
        var $ = layui.jquery, layer = layui.layer;
        FastClick.attach(document.body);
        //搜索
        $('.search-btn').click(function(){
            $('#search-form').submit();
        })
        //投票
        $('.list').on('click','.vote-btn',function(){
            var vid = $(this).data('vid');
            $.post('/v1',{'vid':vid},function(data){
                layer.msg(data.msg);
            });
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
                $.get('/v1',{'page':page,'keyword':keyword}, function(res){
                    //假设你的列表返回在data集合中
                    layui.each(res.data, function(index, item){
                        lis.push('<li>'+
                            '<a  href="/v1/'+item.id+'"class="list-top">'+
                            '<img lay-src="'+item.path+'">'+
                            '</a>'+
                            '<div class="list-bot bar-tab">'+
                            '<div class="list-tit tab-item">'+
                            '<label>'+item.option_name+'<span class="ellipsis">'+item.option_company+'</span></label>'+
                            '</div>'+
                            '<a href="javascript:;" data-pid="'+item.id+'" data-vid="'+item.theme_id+'"  class="tab-item vote-btn">'+
                            '<span></span>'+
                            '</a>'+
                            '</div>'+
                            '</li>')
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
            var thumb ='http://vote.dudong.com/images/default.png';
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
                desc: '',
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
</body>
</html>