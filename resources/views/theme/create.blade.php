@extends('home')
@section('css')
@endsection
@section('content')
<div class="layui-card layadmin-header">
    <div class="layui-breadcrumb" lay-filter="breadcrumb" style="visibility: visible;">
        <a href="{{ url('theme') }}">投票管理</a><span lay-separator="">/</span>
        <a><cite>新建投票</cite></a>
    </div>

    <div class="layui-fluid">
        <div class="layui-row layui-col-space15">
            <div class="layui-col-md12">
                <div class="layui-card">
                    <div class="layui-card-header">
                        <h3>基本信息</h3>
                        <div class="pull-right">
                        </div>
                    </div>
                    <div class="layui-card-body">
                    <form class="layui-form layui-form-pane" action="{{ url('/theme') }}" method="POST" id="vote_create">
                        <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                        <div class="layui-form-item">
                            <label class="layui-form-label">活动名称</label>
                            <div class="layui-input-block">
                                <input type="text" name="theme_name" autocomplete="off"  lay-verify="required" placeholder="请输入活动名称" class="layui-input">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <div class="layui-inline">
                                <label class="layui-form-label">开始时间</label>
                                <div class="layui-input-block">
                                    <input type="text" name="start_time" id="date1"  lay-verify="required" autocomplete="off" class="layui-input">
                                </div>
                            </div>
                            <div class="layui-inline">
                                <label class="layui-form-label">结束时间</label>
                                <div class="layui-input-inline">
                                    <input type="text" name="end_time" id="date2"  lay-verify="required" autocomplete="off" class="layui-input">
                                </div>
                            </div>
                        </div>
                        <div class="layui-form-item layui-form-text">
                            <label class="layui-form-label">活动规则</label>
                            <div class="layui-input-block">
                                <textarea placeholder="请输入内容" name="desc"  lay-verify="required" class="layui-textarea" rows="10"></textarea>
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <button class="layui-btn" lay-submit="" lay-filter="demo1">保存</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        layui.use(['form', 'layedit', 'laydate'], function(){
            var form = layui.form
                ,layer = layui.layer
                ,layedit = layui.layedit
                ,laydate = layui.laydate;

            //日期
            laydate.render({
                elem: '#date1'
            });
            laydate.render({
                elem: '#date2'
            });

            //创建一个编辑器
            //var editIndex = layedit.build('LAY_demo_editor');

            //自定义验证规则
//            form.verify({
//                theme_name: function(value){
//                    if(value.length < 5){
//                        return '标题至少得5个字符啊';
//                    }
//                }
//                ,start_time:function(value){
//
//                }
//                ,desc: function(value){
//
//                }
//            });

            //监听指定开关
            form.on('switch(switchTest)', function(data){
                layer.msg('开关checked：'+ (this.checked ? 'true' : 'false'), {
                    offset: '6px'
                });
                layer.tips('温馨提示：请注意开关状态的文字可以随意定义，而不仅仅是ON|OFF', data.othis)
            });

            //监听提交
            form.on('submit(demo1)', function(data){
                var thisform = $('#vote_create');
                console.log(JSON.stringify(data.field));
                $.post(thisform.attr('action'),data.field,function(dd){
                    console.log(dd);

                })
                return false;
            });
        });
    </script>
</div>
@endsection