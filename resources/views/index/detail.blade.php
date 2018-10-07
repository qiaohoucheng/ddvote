<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>我是{{ $data->option_name }}，我正在参与2018点金奖·新三板金牌董秘评选</title>
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

        .head {
            padding: 0.533rem;
            padding-bottom: 0;
        }
        .top {
            background-color: #141E3C;
            border-radius: 0.16rem;
            overflow: hidden;
        }
        .top-default {
            height: 5.013rem;
            background-image: url(/images/default2.png);
            background-repeat: no-repeat;
            background-size: cover;
            overflow: hidden;
        }
        .top-default img {
            width: 100%;
            vertical-align: top;
        }
        .top-info {
            height: 2.026rem;
        }
        .top-info .name {
            width: 100%;
            padding-left: 0.4rem;
            text-align: left;
            color: #fff;
            font-size: 0.426rem;
            display: block;
            margin-bottom: 0.1rem;
        }
        .top-info .co {
            font-size: 0.32rem;
            color: #fff;
            text-align: left;
            width: 100%;
            opacity: 0.5;
            display: block;
            padding-left: 0.4rem;
        }
        .top-info>div:last-child {
            position: relative;
            text-align: right;
            padding-right: 0.4rem;
        }
        .top-num {
            display: inline-block;
            color: #F0CA79;
            font-size: 0.32rem;
            line-height: 2;
        }
        .btn-wrap {
            padding: 0.533rem;
        }
        .btn-group {
            height: 0.96rem;
            background-image: url(/images/ic_detail_vote@2x.png);
            background-repeat: no-repeat;
            background-size: 100% 100%;
        }
        .btn-group .tab-item:first-child,.btn-group .tab-item:last-child {
            width: 2.88rem;
        }
        .btn-group .tab-item:nth-child(2) {
            width: 100%;
        }
        .info-box {
            padding: 0.533rem;
            background-color: rgba(255,255,255,.1);
            border-radius: 0.213rem;
            text-align: center;
            color: #fff;
            font-size: 0.346rem;
            margin: 0 0.533rem;
            overflow-y: auto;
        }
        .info-box ul {
            margin-bottom: 0.6rem;
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
        .mask {
            position: fixed;
            z-index: 999;
            left: 0;
            top: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0,0,0,.7)
        }
        /*.pop {
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            right: 0;
            bottom: 0;
            overflow-y: auto;
        }*/
        .pop-box {
            position: fixed;
            top: 50%;
            left: 50%;
            background-color: #fff;
            border-radius: 0.16rem;
            -webkit-transform: translate(-50%,-50%);
            transform: translate(-50%,-50%);
            width: 8.4rem;
            height: 11.2rem;
            /*background-image: url(images/pop.png);*/
            /*background-repeat: no-repeat;*/
            /*background-size: 100%;*/
            overflow: hidden;
            padding: 0.533rem;
            z-index: 1001;
        }
        /*        .pop-box h3 {
                    color: #000;
                    font-size: 0.426rem;
                    margin-top: 0.666rem;
                    margin-bottom: 0.56rem;
                    text-align: center;
                }
                .pop-tip {
                    font-size: 0.32rem;
                    color: #bbb;
                }*/
        .pop-input {
            background-color: #F5F5F5;
            font-size: 0.373rem;
            color: #666;
            text-align: center;
            height: 0.96rem;
            line-height: 0.96rem;
            border-radius: 0.96rem;
            border: none;
            margin-bottom: 0.266rem;
            text-align: left;
            padding: 0.213rem 0.533rem;
            width: 100%;
        }
        .pop-input:nth-child(1) {
            top: 1.733rem;
        }
        .pop-input:nth-child(2) {
            top: 2.92rem;
        }
        .pop-input::-webkit-input-placeholder {
            color: rgba(0,0,0,.3);
        }
        .pop-btn {
            display: block;
            height: 0.96rem;
            background-image: url(/images/ic_submit@2x.png);
            color: transparent;
            background-color: transparent;
            position: absolute;
            left: 0.533rem;
            right: 0.533rem;
            bottom: 0.533rem;
            background-size: 100% 100%;
            background-repeat: no-repeat;
        }
        .u-btn {
            width: 100%;
            height: 2.666rem;
            background-color: #F5F5F5;
            border-radius: 0.213rem;
            border: none;
            color: rgba(0,0,0,.3);
            font-size: 0.373rem;
            line-height: 10;
            overflow: hidden;
            background-image: url(/images/ic_pic@2x.png);
            background-repeat: no-repeat;
            background-position: center 0.533rem;
            background-size: 1.173rem auto;
            margin-bottom: 0.32rem;
        }
        .u-btn:active,.u-btn:focus,.u-btn:hover {
            color: rgba(0,0,0,.3);
        }
        .pop-tit {
            text-align: center;
            color: #F0CA79;
            font-size: 0.48rem;
            padding-top: 0.266rem;
            padding-bottom: 0.533rem;
        }
        .pop-text {
            font-size: 0.32rem;
            color: rgba(0,0,0,.5);
        }
        .img-box {
            width: 100%;
            height: 2.666rem;
            background-color: #F5F5F5;
            border-radius: 0.213rem;
            overflow: hidden;
        }
        .img-box img {
            width: 100%;
            vertical-align: top;
        }
        .info-box p {
            font-size: 0.426rem;
            color: #F0CA79;
            margin-bottom: 0.533rem;
        }
        .share-icon {
            position: fixed;
            top: 0.746rem;
            right: 0.533rem;
            width: 3.813rem;
            z-index: 1000;
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
    <div class="nav bar-tab">
        <a href="/v1" class="tab-item">首页</a>
        <a href="http://t.cn/EvK14Nt" class="tab-item">中国新三板年度盛典暨<br>第二届点金奖颁奖典礼报名</a>
    </div>
</div>
<div id="app" v-cloak>
    <div class="head">
        <div class="top">
            <div class="top-default">
                @if(isset( $data->option_img ))
                <img src="{{ $data->option_img }}">
                @endif
            </div>
            <div class="top-info bar-tab">
                <div class="tab-item">
                    <span class="name">{{ $data->option_name }}</span>
                    <span class="co ellipsis">{{ $data->option_company }}；{{ $data->option_code }}</span>
                </div>
                <div class="tab-item">
                    <div class="top-num">
                        投票数：<span id="dd_num">{{ $data->option_vote }}</span><br>
                        总排名：<span id="dd_rank">{{ $data->rank }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="btn-wrap">
        <div class="btn-group bar-tab">
            <a href="javascript:showpop()" class="tab-item"></a>
            <a href="javascript:;"  data-optionid="{{ $data->id }}" class="tab-item vote-btn"></a>
            <a href="javascript:showshare()" class="tab-item"></a>
        </div>
    </div>
    <div class="info-box">
        <p>“让努力，被看见” —— 2018<br>点金奖金牌董秘TOP100 榜单评选规则</p>
        <ul>
            <li>10000+董秘<br>
                是 10000+公司和 10000+家投资机构<br>
                30 万投资人的链接器<br>新三板市场最可爱的人</li>
            <li>金牌董秘<br>
                必须是<br>
                资本市场信息披露规则坚定的捍卫者<br>资本运作的顶级高手<br>
                市值管理的大师级人物<br>
                挂牌公司监事坚实前行的杰出贡献者<br>并且<br>
                为全市场广泛认同 声誉卓著</li>
            <li>挖掘 100 万+数据<br>
                「读懂新三板」从信息披露、<br>资本运作、<br>
                市值管理、<br>杰出贡献、<br>外界评价、<br>五个维度制作<br>
                2018 新三板金牌董秘 TOP100 榜单</li>
            <li>并将在 2018 年中国新三板年度盛典<br>暨第二届点金奖颁奖典礼上<br>为其中的前十名授予<br>“2018 点金奖·新三板金牌董秘”称号</li>
            <li>您的这一票，将决定参选董秘的<br>“外界评价”得分<br>每个微信账号每天可投 5 票<br>每天给每一位董秘最多可投 1 票<br>是时候，投出您的这一票<br>让 10000+新三板董秘的努力，被看见！</li>
        </ul>
        <img src="/images/text.png" width="100%">
    </div>
    <div class="text">
        <h3>投票须知：</h3>
        <p>{!! htmlspecialchars_decode($info->theme_desc) !!} </p>
    </div>
</div>
<a href="javascript:hidepop()" class="mask" id="mask" style="display: none"></a>
<form id="pic-form" action="" method="post" >
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="option_id" value="{{ $data->id }}">
    <input type="hidden" name="pic_id" id="submit-photo" >
    <input type="hidden" name="_method" value="put">
    <div class="pop-box" id="pop" style="display: none">
        <div class="pop-tit">图片上传</div>
        <input type="text" name="submit_name"  class="pop-input" placeholder="姓名（必填）">
        <input type="text" name="mobile" class="pop-input" placeholder="联系方式（必填）">
        <button type="button" class="layui-btn u-btn" id="up">点击上传图片</button>
        <div class="img-box" style="display: none;">
        </div>
        <p class="pop-text">照片上传注意事项：<br>
            ·为确保上传照片真实性，请预留联系方式<br>
            ·经会务人员确认并审核后、方可显示在投票页面</p>
        <a href="javascript:;" class="pop-btn"></a>
    </div>
</form>
</body>
<div id="share" style="display:none;">
    <img src="/images/share-icon.png" class="share-icon">
</div>
<script src="{{ asset('/js/fastclick.js') }}"></script>
<!-- <script src="lay/modules/mobile/upload-mobile.js"></script> -->
<script>
    function showpop() {
        document.getElementById('mask').style.display="block";
        document.getElementById('pop').style.display="block";
    }
    function hidepop() {
        document.getElementById('mask').style.display="none";
        document.getElementById('pop').style.display="none";
        document.getElementById('share').style.display="none";
    }
    function showshare() {
        document.getElementById('mask').style.display="block";
        document.getElementById('share').style.display="block";
    }
    function hideshare() {
        document.getElementById('mask').style.display="none";
        document.getElementById('share').style.display="none";
    }
    layui.use('upload', function(){
        var $ = layui.jquery
            ,upload = layui.upload;
        var token = '{{ csrf_token() }}';
        upload.render({
            elem: '#up'
            ,url: '/file/uploadPicture/'
            ,size: 4000 //限制文件大小，单位 KB
            ,data:{'_token':token}
            ,before: function(obj){
                //预读本地文件示例，不支持ie8
                 obj.preview(function(index, file, result){
                     $('#up').hide();
                     $('.img-box').show();
                     $('.img-box').html('<img src="'+result+'">');
                 });
            }
            ,done: function(res){
                if(res.code == 1){
                    $('#submit-photo').val(res.data.pic_id);
                    return layer.msg('上传成功');
                }else{
                    return layer.msg('上传失败');

                }
            }
            ,error: function(){
                //演示失败状态，并实现重传

            }
        });

    });
    layui.use('layer', function(){
        var $ = layui.jquery;
        var layer = layui.layer;
        var token ='{{ csrf_token() }}';
        //FastClick.attach(document.body);
        //投票
        $('.btn-group').on('click','.vote-btn',function(){
            var option_id = $(this).data('optionid');
            $.post('/v1',{'option_id':option_id,'_token':token},function(data){
                if(data.code ==1){
                    var text = $('#dd_num').text();
                    $('#dd_num').text(Number(text)+Number(1));
                }
                layer.msg(data.message);
            });

        });
        $('.pop-btn').click(function(){
            $.post('/v1/update',$('#pic-form').serialize(),function(data){
                if(data.code =='1'){
                    hidepop();
                }
                layer.msg(data.message);
            })
        })
        //提交上传图片
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
                title: '我是{{ $data->option_name }}，我正在参与2018点金奖·新三板金牌董秘评选',
                link: link,
                imgUrl: thumb,
                success: function () {
                },
                cancel: function () {
                }
            });
            wx.onMenuShareAppMessage({
                title: '我是{{ $data->option_name }}，我正在参与2018点金奖·新三板金牌董秘评选',
                desc: '请为我助力！让努力，被看见！',
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
</html>