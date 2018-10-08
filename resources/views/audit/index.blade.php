@extends('home')
@section('css')
    <style>
        ul,li{
            list-style:none;
        }
        .dd-body .layui-layer-content{
            background-color: #eef0f5 !important;
        }
        .dd-list {
            padding-top: 20px;
            padding-bottom: 1px;
            padding-left: 10px;
            padding-right: 10px;
        }
        .dd-list>li {
            display: block;
            color: #666;
            float: left;
            padding: 0 10px;
            margin-bottom: 20px;
            width: 30%;
            height: 176px;
            overflow: hidden;
        }
        .dd-list>li h3 {
            display: block;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            color: #323d41;
            font-size: 14px;
            font-weight: 600;
            height: 18px;
            line-height: 18px;
            margin-bottom: 3px;
            padding: 0 10px;
        }
        .dd-list>li p {
            position: relative;
            float: left;
            margin-right: 10px;
            line-height: 20px;
            font-size: 12px;
            color: #404040;
            padding: 0 10px;
        }
        .dd-item {
            height: 176px;
            border: 1px solid transparent;
            cursor: pointer;
            position: relative;
        }
        .cover {
            height: 120px;
            overflow: hidden;
            transition: all .3s;
        }
        .dd-item:hover .cover {
            box-shadow: 0 8px 16px 0 rgba(7,17,27,.1);
        }
        .dd-item:hover h3 {
            color: green;
        }
        .dd-item:hover p {
            color: green;
        }
        .cover img {
            width: 100%;
            height: 100%;
            vertical-align: top;
            border-top-left-radius: 3px;
            border-top-right-radius: 3px;
        }
        .dd-upload>div {
            height: 114px;
            text-align: center;
            cursor: pointer;
        }
        .select {
            position: absolute;
            top: 0;
            right: 0;
            display: none;
        }
        .dd-item.active .select {
            display: block;
            border-radius: 3px;
            transition: all 0.5s;
            padding: 10px;
        }
        .info {
            font-size: 14px;
            height: 66px;
            padding: 10px 0;
            text-align: left;
            border-bottom-left-radius: 3px;
            border-bottom-right-radius: 3px;
            background-color: #fff;
        }
    </style>
@endsection
@section('content')
<div class="layui-card layadmin-header">
    <div class="layui-breadcrumb" lay-filter="breadcrumb" style="visibility: visible;">
        <a href="{{ url('audit') }}">投票管理</a><span lay-separator="">/</span>
        <a><cite>投票列表</cite></a>
    </div>
    <div class="layui-fluid">
        <div class="layui-row layui-col-space15">
            <div class="layui-col-md12">
                <div class="layui-card">
                    <div class="layui-card-header">
                        <div class="pull-right">
                            <a href="{{ url('/audit/create') }}" class="layui-btn layui-btn-sm" >上传照片</a>
                        </div>
                    </div>
                    <div class="layui-card-body">
                        <!-- 表格 -->
                        <table class="layui-table" id="DDTABLE" lay-filter="qrcode">
                        </table>
                        <script type="text/html" id="hidebox">
                            @{{#  if(d.is_hide == 1){ }}
                            隐藏
                            @{{#  }else{ }}
                            显示
                            @{{#  } }}
                        </script>
                        <script type="text/html" id="onebox">
                             @{{#
                                var date = new Date();
                                date.setTime(d.start_time*1000);
                                return date.Format("yyyy-MM-dd hh:mm:ss");
                             }}
                        </script>
                        <script type="text/html" id="twobox">
                            @{{#
                                var date = new Date();
                                date.setTime(d.end_time*1000);
                                return date.Format("yyyy-MM-dd hh:mm:ss");
                             }}
                        </script>
                        <script type="text/html" id="sbox">
                            @{{#  if(d.status == 1){ }}
                            <span class="layui-badge layui-bg-green">已审核</span>
                            @{{#  }else{ }}
                            <span class="layui-badge layui-bg-orange">未审核</span>
                            @{{#  } }}
                        </script>
                        <script type="text/html" id="barDemo">
                            <a class="layui-btn layui-btn-sm"  lay-event="pass">审核</a>
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        layui.use(['table','form','layer','upload','jquery'], function(){
            var table = layui.table;
            var form  = layui.form;
            var layer = layui.layer;
            var upload = layui.upload;
            var token = '{{ csrf_token() }}';
            var $ = layui.jquery

            //拖拽上传
            upload.render({
                elem: '#test10'
                ,url: '/upload/'
                ,done: function(res){
                    console.log(res)
                }
            });
            //获取数据
            table.render({
                elem: '#DDTABLE',
                page:{curr: location.hash.replace('#!page=', ''),hash:'page'},
                url:'/audit',
                cols: [[
                     {field:'id', width:100, fixed: true,title:'ID',align:'center'}
                    ,{field:'option_name', width:200,title:'董秘名称'}
                    ,{field:'option_company',width:200,align:'center',title:'公司名称'}
                    ,{field:'option_code',width:200,align:'center',title:'公司代码'}
                    ,{field:'status', width:150,title:'状态', templet:'#sbox',align:'center'}
                    ,{fixed:'right', toolbar: '#barDemo',title:'操作'}
                ]],
                done: function(res){

                }
            });
            //监听工具条
            table.on('tool(qrcode)', function(obj){
                var data = obj.data;
                if(obj.event === 'pass'){
                    if(data.option_id >0){
                        //清除数据
                        $("#dd-idlist li.li-item").remove();
                        layer.open({
                            type: 1,
                            title: '查看照片',
                            closeBtn: 0,
                            shadeClose: true,
                            area: ['838px', '630px'],
                            content: $('#new-look'),
                            skin:'dd-body',
                            btn:['使用照片','取消'],
                            yes:function(index,layero){
                                var aid = $('#dd-idlist div.active').data('aid');
                                var optionid = $('#dd-idlist div.active').data('optionid');
                                var token = '{{ csrf_token() }}';
                                if(aid && optionid){
                                    $.post('/audit',{'aid':aid,'option_id':optionid,'_token':token},function(data){
                                        layer.msg(data.message);
                                        if(data.code ==1){

                                        }
                                    });
                                }else{
                                    layer.msg('请选择图片');
                                }
                            },
                        });
                        $.get('/audit/'+data.option_id,function(data){
                            if(data.code ==1){
                                var inhtml=''
                                $.each(data.data,function(i,v){
                                    inhtml+='<li class="li-item">';
                                    if(v.status ==1){
                                        inhtml+='<div class="dd-item active" data-aid="'+v.id+'" data-optionid="'+v.option_id+'">';
                                    }else{
                                        inhtml+='<div class="dd-item " data-aid="'+v.id+'" data-optionid="'+v.option_id+'">';
                                    }

                                    inhtml+='<img src="/images/select.png" class="select">'+
                                    '<div class="cover">'+
                                    '<img src="'+v.photo+'" onerror="javascript:this.src=\'/images/default.png\';">'+
                                    '</div>'+
                                    '<div class="info">'+
                                    '<h3 class="ellipsis">'+v.name+'</h3>'+
                                    '<p class="ellipsis">'+v.mobile+'</p>'+
                                    '</div>'+
                                    '</div>'+
                                    '</li>';
                                })
                                document.getElementById('dd-idlist').insertAdjacentHTML("afterBegin",inhtml);
                            }
                        })
                    }
                }
            });
        });
    </script>
</div>
@endsection