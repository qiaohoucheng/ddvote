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
            background-image: url(/images/dongmi-bg.png);
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
        .list {
            padding: 0.533rem;
            padding-top: 0;
            padding-bottom: 1px;
        }
        .list li {
            display: block;
            width: 4.266rem;
            border-radius: 0.16rem;
            background-color: #141E3C;
            overflow: hidden;
            margin-bottom: 0.4rem;
        }
        .list li:nth-child(2n) {
            float: right;
        }
        .list li:nth-child(2n+1) {
            float: left;
        }
        .list-top {
            height: 2.4rem;
            background-image: url(/images/default2.png);
            background-repeat: no-repeat;
            background-size: 100%;
            overflow: hidden;
            position: relative;
        }
        .list-top img {
            width: 100%;
            vertical-align: top;
        }
        .list-num {
            position: absolute;
            left: 0.266rem;
            right: 0.266rem;
            bottom: 0.16rem;
            text-align: right;
            font-size: 0.32rem;
            color: #F0CA79;
            -webkit-text-shadow: 0 0 4px rgba(0,0,0,0.50);
            text-shadow: 0 0 4px rgba(0,0,0,0.50);
        }
        .list-bot {
            height: 1.6rem;
            background-color: #141E3C;
        }
        .list-bot .vote-btn {
            padding-right: 0.266rem;
            width: 1.706rem;
        }
        .vote-btn span{
            display: block;
            margin-left: auto;
            width: 1.44rem;
            height: 0.8rem;
            background-image: url(/images/ic_vote@2x.png);
            background-repeat: no-repeat;
            background-size: 100% 100%;
        }
        .list-bot .list-tit {
            color: #fff;
            font-size: 0.426rem;
            width: 100%;
            padding-left: 0.32rem;
            text-align: left;
        }
        .list-tit span {
            font-size: 0.32rem;
            color: #fff;
            opacity: 0.5;
            display: block;
            vertical-align: middle;
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
{{--<div class="nav bar-tab">--}}
    {{--<a href="" class="tab-item"></a>--}}
    {{--<a href="" class="tab-item"></a>--}}
{{--</div>--}}
<div id="app">
    <div class="search-box">
        <form action="/" method="get" id="search-form">
        <div class="search bar-tab">
            <input type="search" value="{{ $keyword }}" class="search-input tab-item" name="keyword" placeholder="请输入姓名或公司代码搜索参投董秘嘉宾">
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
        var token ='{{ csrf_token() }}';
        FastClick.attach(document.body);
        //搜索
        $('.search-btn').click(function(){
            $('#search-form').submit();
        })
        //投票
            $('.list').on('click','.vote-btn',function(){
            var option_id = $(this).data('optionid');
            $.post('/v1',{'option_id':option_id,'_token':token},function(data){
                if(data.code ==1){
                    var text = $('.li_'+option_id).find('.dd-num').text();
                    $('.li_'+option_id).find('.dd-num').text(Number(text)+Number(1));
                }
                layer.msg(data.message);
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
                        lis.push(
                        '<li class="li_'+item.id+'">'+
                            '<a href=/v1/'+item.id+'>'+
                            '<div class="list-top">'+
                            '<img lay-src="'+item.path+'">'+
                            '<div class="list-num"><span class="dd-num">'+item.option_vote+'</span>票</div>'+
                            '</div>'+
                            '</a>'+
                        '<div class="list-bot bar-tab">'+
                            '<a href=/v1/'+item.id+' class="list-tit tab-item">'+
                            '<label>'+item.option_name+'<span class="ellipsis">'+item.option_company+'</span></label>'+
                            '</a>'+
                        '<a href="javascript:;" data-optionid="'+item.id+'" class="tab-item vote-btn">'+
                            '<span></span>'+
                            '</a>'+
                            '</div>'+
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
                desc: '让努力，被看见！投出你的一票，为10000+新三板董秘加油！',
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