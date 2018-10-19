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
    <a href="" class="tab-item">首页</a>
    <a href="" class="tab-item">2018新三板点金奖<br>
        金牌董秘颁奖大会报名</a>
</div>
<div id="app">
    <div class="detail-top">
        <div>
            <img src="/images/default.png">
        </div>
    </div>
    <ul class="clear list">
        <li class="bar-tab">
            <div class="tab-item ellipsis">
                <div class="tab-item name">最佳推荐挂牌券商奖</div>
                <div class="tab-item num">4654票</div>
            </div>
            <a class="tab-item"></a>
        </li>
        <li class="bar-tab">
            <div class="tab-item ellipsis">
                <div class="tab-item name">最佳推荐挂牌券商奖</div>
                <div class="tab-item num">4654票</div>
            </div>
            <a class="tab-item"></a>
        </li>
        <li class="bar-tab">
            <div class="tab-item ellipsis">
                <div class="tab-item name">最佳推荐挂牌券商奖</div>
                <div class="tab-item num">4654票</div>
            </div>
            <a class="tab-item"></a>
        </li>
    </ul>
    <div class="info-box">
        <ul>
            <li>2017新三板金牌董秘TOP1000榜单规则<br>
                暨点金奖新三板金牌董秘颁奖规则</li>
            <li>
                10000+董秘<br>
                是11594家公司和10000家投资机构<br>
                30万投资人的链接器<br>
                新三板市场最可爱的人</li>
            <li>
                金牌董秘<br>
                是10000＋董秘的榜样<br>
                整个新三板最应该被褒奖的人</li>
            <li>
                金牌董秘<br>
                必须是<br>
                资本市场信息披露规则坚定的捍卫者<br>
                资本运作的顶级高手<br>
                市值管理的大师级人物<br>
                挂牌公司坚实前行的杰出贡献者<br>
                并且<br>
                为全市场广泛认同  声誉卓著</li>
            <li>
                挖掘超过100万＋数据<br>
                「读懂新三板」从信息披露、<br>
                资本运作、<br>
                市值管理、<br>
                杰出贡献、<br>
                外界评价、<br>
                五个维度制作<br>
                2017新三板金牌董秘TOP1000榜单</li>
            <li>
                并将在2017首届中国新三板年度盛典暨点金奖颁奖仪式上<br>
                为其中的前十名授予<br>
                2017点金奖新三板金牌董秘</li>
            <li>
                你的这一票，将决定参选董秘的<br>
                “外界评价”得分<br>
                每个微信账号只有5票<br>
                给每一位董秘最多只能投1票<br>
                是时候<br>
                投出你的这一票了！</li>
        </ul>
    </div>
    <div class="text">
        <h3>投票须知：</h3>
        <p>1、2017新三板金牌董秘TOP1000榜单中的TOP10将获得点金奖2017新三板金牌董秘称号，并将在2017首届中国新三板年度盛典暨点金奖颁奖仪式领奖。<br>
            2、以1亿数据为基础，点金奖将客观评选新三板市场中的董秘、挂牌公司、券商机构、投资机构以及其他中介机构，具体榜单和奖项如上。<br>
            3、在法律许可范围内，本活动最终解释权归读懂新三板所有。</p>
    </div>
</div>
</body>
<script src="{{ asset('/js/fastclick.js') }}"></script>
<script>
</script>
</html>