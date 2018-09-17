@extends('home')
@section('css')
@endsection
@section('content')
    <div class="layui-card layadmin-header">
        <div class="layui-breadcrumb" lay-filter="breadcrumb" style="visibility: visible;">
            <a href="{{ url('theme') }}">投票管理</a><span lay-separator="">/</span>
            <a><cite>选项列表</cite></a>
        </div>
        <div class="layui-fluid">
            <div class="layui-row layui-col-space15">
                <div class="layui-col-md12">
                    <div class="layui-card">
                        <div class="layui-card-header">
                            <h3>投票主题名称:<b>{{ $data->theme_name }}</b></h3>
                            <div class="pull-right">
                                <a href="{{ url('/theme/create') }}" class="layui-btn layui-btn-sm" >导入Excel</a>
                                <a href="{{ url('/theme/create') }}" class="layui-btn layui-btn-sm" >新建选项</a>
                            </div>
                        </div>
                        <div class="layui-card-body">
                            <!-- 搜索 -->
                            <form class="layui-form" action="">
                                <div class="demoTable">
                                    {{--（姓名/手机号/身份证号）--}}
                                    <div class="layui-inline">
                                        <input class="layui-input" placeholder="选项名称" name="keyword" id="keyword" autocomplete="off" value="">
                                    </div>
                                    <button class="layui-btn" type="button" data-type="reload" id="search-btn">搜索</button>
                                </div>
                            </form>
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
                                <a class="layui-btn layui-btn-sm"  lay-event="edit">编辑</a>
                                <a class="layui-btn layui-btn-danger layui-btn-sm" lay-event="del">删除</a>
                            </script>
                        </div>
                    </div>
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
                    url:'/option/load',
                    cols: [[
                        {field:'id', width:60, fixed: true,title:'ID'}
                        ,{field:'theme_name', width:200,title:'投票主题名称'}
                        ,{field:'start_time',width:200,align:'center',title:'开始时间', templet:'#onebox'}
                        ,{field:'end_time',width:200,align:'center',title:'结束时间', templet:'#twobox'}
                        ,{field:'theme_vote', width:200,title:'总票数'}
                        ,{field:'status', width:150,title:'状态', templet:'#sbox'}
                        ,{fixed: 'right',  align:'center', toolbar: '#barDemo',title:'操作'}
                    ]],
                    done: function(res){

                    }
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
                table.on('tool(qrcode)', function(obj){
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
                });
            });
        </script>
    </div>
@endsection