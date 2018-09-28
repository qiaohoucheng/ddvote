<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title></title>
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
            background-color:  #000;
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

        .head {
            padding: 0.32rem;
            padding-bottom: 0;
        }
        .top {
            background-color: #fff;
            border-radius: 0.16rem;
            overflow: hidden;
        }
        .top-default {
            height: 5.613rem;
            background-image: url(/images/default.png);
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
            width: 4.373rem;
            padding-left: 0.586rem;
            text-align: left;
            color: #010101;
            font-size: 0.533rem;
        }
        .top-info .co {
            font-size: 0.426rem;
            color: #bbb;
            text-align: left;
            width: 100%;
        }
        .top-info .co span {
            margin-left: 0.32rem;
        }
        .btn-wrap {
            padding: 0.32rem;
        }
        .btn-group {
            height: 1.254rem;
            background-image: url(/images/vote-group.png);
            background-repeat: no-repeat;
            background-size: 100%;
        }
        .btn-group .tab-item:first-child,.btn-group .tab-item:last-child {
            width: 2.72rem;
        }
        .btn-group .tab-item:nth-child(2) {
            width: 100%;
        }
        .info-box {
            padding: 0 0.32rem;
        }
        .info-box img {
            width: 100%;
            vertical-align: top;
        }
        .text {
            color: #fff;
            width: 8.08rem;
            margin: 0 auto;
            padding: 0.266rem 0;
        }
        .text h3 {
            font-size: 0.426rem;
            margin-bottom: 0.16rem;
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
            height: 1.2rem;
            background-image: url(/images/navbtn.jpg);
            background-repeat: no-repeat;
            background-size: 100%;
            overflow: hidden;
            background-color: #ffc969;
        }
        .nav~#app {
            padding-bottom: 1.2rem;
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
            width: 7.68rem;
            height: 10.654rem;
            background-image: url(/images/pop.png);
            background-repeat: no-repeat;
            background-size: 100%;
            overflow: hidden;
            padding: 0 0.533rem;
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
            background-color: transparent;
            font-size: 0.32rem;
            color: #666;
            text-align: center;
            height: 0.854rem;
            line-height: 0.854rem;
            position: absolute;
            left: 0.533rem;
            width: 6.614rem;
            border: none;
        }
        .pop-input:nth-child(1) {
            top: 1.733rem;
        }
        .pop-input:nth-child(2) {
            top: 2.92rem;
        }
        .pop-input::-webkit-input-placeholder {
            color: #ffc969;
        }
        .pop-btn {
            display: block;
            height: 0.854rem;
            color: transparent;
            background-color: transparent;
            position: absolute;
            left: 0.533rem;
            right: 0.533rem;
            top: 9.24rem;
        }
        .u-btn {
            position: absolute;
            top: 4.186rem;
            left: 0.533rem;
            width: 6.614rem;
            height: 2.506rem;
            background-color: transparent;
            border: none;
            color: transparent;
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
        var w = document.documentElement.clientWidth / 10;
        document.getElementsByTagName('html')[0].style['font-size'] = w + 'px';
    </script>
</head>
<body>
<div class="nav bar-tab">
    <a href="/v1" class="tab-item"></a>
    <a href="http://t.cn/R08SVTo" class="tab-item"></a>
</div>
<div id="app" v-cloak>
    <div class="head">
        <div class="top">
            <div class="top-default">
                <img src="#">
            </div>
            <div class="top-info bar-tab">
                <div class="tab-item name">姓名：<span>{{  $data->option_name }}</span></div>
                <div class="tab-item co">{{  $data->option_company }}<span>{{  $data->option_code }}</span></div>
            </div>
        </div>
    </div>
    <div class="btn-wrap">
        <div class="btn-group bar-tab">
            <a href="javascript:showpop()" class="tab-item"></a>
            <a href="javascript:;" data-pid="{$data.id}" data-vid="{$info['id']}" class="tab-item vote-btn"></a>
            <a href="javascript:showshare()" class="tab-item"></a>
        </div>
    </div>
    <div class="info-box">
        <img src="/images/info.jpg">
    </div>
    <div class="text">
        <h3>投票须知：</h3>
        <p>{{ $info->theme_desc }}</p>
    </div>
</div>
<form id="pic-form" action="{:U('index/submit_audit')}" method="post" >
    <input type="hidden" name="pid" id="pid" value="{$data.id}" />
    <input type="hidden" name="submit_photo" id="submit-photo">
    <a href="javascript:hidepop(),hideshare()" class="mask" id="mask" style="display: none"></a>
    <div class="pop-box" id="pop" style="display: none">
        <input type="text"  name="submit_name" class="pop-input" autocomplete="off" placeholder="姓名（必填）">
        <input type="text"  name="submit_mobile" class="pop-input" autocomplete="off" placeholder="联系方式（必填）">
        <button type="button" class="layui-btn u-btn" id="up"></button>
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

        upload.render({
            elem: '#up'
            ,url: '/file/uploadPicture/'
            ,size: 4000 //限制文件大小，单位 KB
            ,before: function(obj){
                //预读本地文件示例，不支持ie8
                // obj.preview(function(index, file, result){
                //   $('#demo2').attr('src', result); //图片链接（base64）
                // });
            }
            ,done: function(res){
                if(res.status > 0){
                    $('#submit-photo').val(res.file.id);
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
        FastClick.attach(document.body);
        //投票
        $('.btn-group').on('click','.vote-btn',function(){
            var pid = $(this).data('pid');
            var vid = $(this).data('vid');
            $.post('/index/toupiao',{'pid':pid,'vid':vid},function(data){
                layer.msg(data.msg);
            })

        });
        $('.pop-btn').click(function(){
            $.post('/index/submit_audit',$('#pic-form').serialize(),function(data){
                if(data.code =='200'){
                    hidepop();
                }
                layer.msg(data.msg);
            })
        })
        //提交上传图片
    })
</script>
<script src="http://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>
<script type="text/javascript">
    $(function(){
        var url = location.href.split('#').toString();
        $.ajax({
            type : "get",
            url : "http://app.dudong.com/?app=wechat&controller=search&action=jssdk",
            dataType : "jsonp",
            jsonp : 'callback',
            data:{url:url},
            async : false,
            success : function(data) {
                wx.config({
                    debug: true,
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
                alert(status);
                alert(xhr.responseText);
            }
        });
        wx.ready(function () {
            var link = window.location.href;
            var protocol = window.location.protocol;
            var host = window.location.host;
            var thumb ="http://vote.dudong.com/images/default.png";
            wx.onMenuShareTimeline({
                title: '我是秦始皇,打钱',
                link: link,
                imgUrl: thumb,
                success: function () {
                },
                cancel: function () {
                }
            });
            wx.onMenuShareAppMessage({
                title: '我是秦始皇,打钱',
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
</html>