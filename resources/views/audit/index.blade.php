@extends('home')
@section('css')
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
                            <span class="layui-badge layui-bg-green">已发布</span>
                            @{{#  }else{ }}
                            <span class="layui-badge layui-bg-orange">未发布</span>
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
    <div id="look-box" style="display: none">
        <h6 class="look-tit">查看照片</h6>
        <div class="look-main">
            <input type="hidden" value="" id="choose-pid">
            <input type="hidden" value="" id="choose-aid">
            <input type="hidden" value="" id="choose-type">
            <ul class="look-list inner-box">

            </ul>
            <ul class="clear look-list">
                <li class="upload-box">
                    <div class="look-item" style="position: relative;">
                        <input type="file" name="file" class="layui-btn u-btn" id="up" style="width: 100%;height: 100%;">
                        <img src="/Public/Home/images/upload.png" style="width: 100%;height: 100%;"></div>
                </li>
            </ul>
            <div class="look-btnbox clear">
                <button type="button" class="layui-btn t-btn" id="close">取消</button>
                <button type="button" class="layui-btn t-btn" id="new">使用照片</button>
            </div>
        </div>
    </div>
    <script>
        layui.use(['table','form','layer'], function(){
            var table = layui.table;
            var form  = layui.form;
            var layer = layui.layer;
            var token = '{{ csrf_token() }}';

            //获取数据
            table.render({
                elem: '#DDTABLE',
                page:{curr: location.hash.replace('#!page=', ''),hash:'page'},
                url:'/audit',
                cols: [[
                     {field:'id', width:60, fixed: true,title:'ID'}
                    ,{field:'option_name', width:200,title:'董秘名称'}
                    ,{field:'option_company',width:200,align:'center',title:'公司名称'}
                    ,{field:'option_code',width:200,align:'center',title:'公司代码'}
                    ,{field:'status', width:150,title:'状态', templet:'#sbox'}
                    ,{fixed:'right',  align:'center', toolbar: '#barDemo',title:'操作'}
                ]],
                done: function(res){

                }
            });
            //监听工具条
            table.on('tool(qrcode)', function(obj){
                var data = obj.data;
                if(obj.event === 'pass'){
                    if(data.option_id >0){
                        var token = '{{ csrf_token() }}';
                        $.post('/aduit/'+data.option_id,{'_token':token},function(data){
                            if(data.code ==1){

                            }
                        })
                        layer.open({
                            type: 1,
                            title: '查看照片',
                            closeBtn: 0,
                            shadeClose: true,
                            area: ['838px', '630px'],
                            skin: 'lookbox',
                            content: '',
                            btn:['使用照片','取消']
                        }, function(){

                        }, function(){

                        });
                    }
                }
            });
        });
    </script>
</div>
@endsection