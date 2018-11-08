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
            <a href="{{ url('theme') }}">投票管理</a><span lay-separator="">/</span>
            <a><cite>选项列表</cite></a>
        </div>
        <div class="layui-fluid">
            <input type="hidden" value="" name="optionid" id="optionid">
            <div class="layui-row layui-col-space15">
                <div class="layui-col-md12">
                    <div class="layui-card">
                        <div class="layui-card-header">
                            <div class="pull-left">
                                投票主题名称:<b>{{ $data->theme_name }}</b>
                            </div>
                            <div class="pull-right">
                                <button type="button" class="layui-btn layui-btn-sm" id="test1">
                                    <i class="layui-icon">&#xe67c;</i>导入Excel
                                </button>
                                <a href="option/create" class="layui-btn layui-btn-sm" >新建选项</a>
                            </div>
                        </div>
                        <div class="layui-card-body">
                            <!-- 搜索 -->
                            <form class="layui-form" action="">
                                <div class="demoTable">
                                    {{--（姓名/手机号/身份证号）--}}
                                    <div class="layui-inline">
                                        <input class="layui-input" placeholder="选项名称" name="keyword" id="keyword" autocomplete="off" value="{{  $keyword }}">
                                    </div>
                                    <button class="layui-btn" type="button" data-type="reload" id="search-btn">搜索</button>
                                    <a class="layui-btn layui-btn-primary" type="button" href="/theme/{{$id}}/option">清空搜索条件</a>
                                </div>
                            </form>
                            <!-- 表格 -->
                            <table class="layui-table" id="DDTABLE" lay-filter="optiontable">
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
                                <span class="layui-badge layui-bg-green">正常</span>
                                @{{#  }else{ }}
                                <span class="layui-badge layui-bg-orange">已锁定</span>
                                @{{#  } }}
                            </script>
                            <script type="text/html" id="barDemo">
                                <a class="layui-btn layui-btn-sm"  lay-event="pass">审核</a>
                                <a class="layui-btn layui-btn-danger layui-btn-sm" lay-event="del">删除</a>
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
                var $ = layui.jquery;
                var token = '{{ csrf_token() }}';
                var keyword = '{{ urlencode($keyword) }}';
                var id ='{{ $id }}';

                //文件上传
                var uploadInst = upload.render({
                    elem: '#test1' //绑定元素
                    ,url: '/excel/import'
                    ,accept: 'file' //普通文件
                    ,exts: 'xls|xlsx' //上传接口
                    ,data:{'_token':token}
                    ,done: function(res){
                        console.log(res)
                        //上传完毕回调
                    }
                    ,error: function(e){
                        console.log(e);
                        //请求异常回调
                    }
                });
                //拖拽上传
                upload.render({
                    elem: '#test10'
                    ,url: '/file/adminUpload'
                    ,before: function(obj){
                        //layer.load(); //上传loading
                        var optionid = $('#optionid').val();
                        this.data={'_token':token,'option_id':optionid};
                    }
                    ,done: function(res){
                        var inhtml='';
                        console.log(res)
                        if(res.code == 1){
                            inhtml+='<li class="li-item">';
                            inhtml+='<div class="dd-item " data-aid="'+res.data.id+'" data-optionid="'+res.data.option_id+'">';
                            inhtml+='<img src="/images/select.png" class="select">'+
                                '<div class="cover">'+
                                '<img src="'+res.data.url+'" onerror="javascript:this.src=\'/images/default.png\';">'+
                                '</div>'+
                                '<div class="info">'+
                                '<h3 class="ellipsis">'+res.data.name+'</h3>'+
                                '<p class="ellipsis">'+res.data.mobile+'</p>'+
                                '</div>'+
                                '</div>'+
                                '</li>';
                            document.getElementById('dd-idlist').insertAdjacentHTML("afterBegin",inhtml);
                        }
                    }
                });
                //获取数据
                table.render({
                    elem: '#DDTABLE',
                    page:{curr: location.hash.replace('#!page=', ''),hash:'page'},
                    url:'/option/load?keyword='+keyword,
                    limit: 20,
                    cols: [[
                        {field:'id', width:100, fixed: true,title:'ID',sort:true}
                        ,{field:'option_name', width:200,title:'姓名'}
                        ,{field:'option_code', width:200,title:'公司代码'}
                        ,{field:'option_company', width:200,title:'公司名称'}
                        ,{field:'option_vote', width:200,title:'投票数',sort:true}
                        ,{field:'status', width:150,title:'状态', templet:'#sbox'}
                        ,{fixed: 'right',  align:'center', toolbar: '#barDemo',title:'操作'}
                    ]],
                    done: function(res){

                    }
                });
                table.on('sort(optiontable)',function(obj){
                   console.log(obj.field);
                   console.log(obj.type);
                   console.log(this);
                   table.reload('DDTABLE',{
                       initSort:obj,
                       where:{
                           field:obj.field,
                           order:obj.type
                       }
                   })
                });
                //监听select
                form.on('select(status)', function(data){
                    window.location.href='/application/index?status='+data.value;
                });
                //监听表格复选框选择
                table.on('checkbox(qrcode)', function(obj){
                    //console.log(obj)
                });
                //监听工具条
                table.on('tool(optiontable)', function(obj){
                    var data = obj.data;
                    if(obj.event === 'detail'){
                        window.location.href='/theme/'+data.id;
                    }
                    if(obj.event ==='option'){
                        window.location.href='/theme/'+data.id+'/option'
                    }
                    if(obj.event === 'del'){
                        layer.confirm('真的删除行么', function(index){
                            obj.del();
                            layer.close(index);
                        });
                    }
                    if(obj.event === 'edit'){
                        if(data.zyaid >0){
                            var token = '{{ csrf_token() }}';
                            layer.confirm('是否通过审核？', {
                                btn: ['通过','拒绝'] //按钮
                            }, function(){
                                $.post('/application/review',{'id':data.zyaid,'_token':token,'status':2},function(obj){
                                    layer.msg(obj.message);
                                    if(obj.code ==1){
                                        setTimeout(function(){//两秒后跳转
                                            $(".layui-laypage-btn").click()
                                        },2500);
                                    }
                                })
                            }, function(){
                                $.post('/application/review',{'id':data.zyaid,'_token':token,'status':3},function(obj){
                                    layer.msg(obj.message);
                                    if(obj.code ==1){
                                        setTimeout(function(){//两秒后跳转
                                            $(".layui-laypage-btn").click()
                                        },2500);
                                    }
                                })
                            });
                        }
                        //layer.alert('编辑行：<br>'+ JSON.stringify(data))
                    }
                    if(obj.event === 'pass'){
                        if(data.id >0){
                            $('#optionid').val(data.id);
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
                                                layer.close(index);
                                                setTimeout(function(){
                                                    window.location.reload();
                                                },1000);
                                            }
                                        });
                                    }else{
                                        layer.msg('请选择图片');
                                    }
                                },
                            });
                            $.get('/audit/'+data.id,function(data){
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
                                            '<img src="'+v.imgurl.url+'" onerror="javascript:this.src=\'/images/default.png\';">'+
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
                //搜索
                $('#search-btn').click(function(){
                    var keyword = $('#keyword').val();
                    if(keyword.length>0){
                        window.location.href='/theme/'+id+'/option?keyword='+keyword;
                    }
                })
                //回车绑定
                $(document).keydown(function(event){
                    if(event.keyCode==13){
                        var keyword = $('#keyword').val();
                        if(keyword.length>0){
                            window.location.href='/theme/'+id+'/option?keyword='+keyword;
                        }
                    }
                });
            });
        </script>
    </div>
@endsection