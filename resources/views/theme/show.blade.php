@extends('home')
@section('css')
@endsection
@section('content')
<div class="layui-card layadmin-header">
    <div class="layui-breadcrumb" lay-filter="breadcrumb" style="visibility: visible;">
        <a href=" {{url('/home') }} ">概览</a>
    </div>
</div>
@endsection