<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Theme;
use Illuminate\Support\Facades\Validator;

class ThemeController extends Controller
{
    //列表
    public function index(Request $request)
    {
        if($request->ajax('get')){
            return $this->adminFormat(new Theme(),$request);
        }
        return view('theme.index');
    }
    //详情
    public function show($id)
    {
        $data ='';
        return view('theme.show',compact('id','data'));
    }
    //新建
    public function create()
    {
        return view('theme.create');
    }
    //保存
    public function store(Request $request)
    {
        $rules = [
            'theme_name'=>'required',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'desc' => 'required',
        ];
        $message = [
            'theme_name.required' => '请输出投票名称',
            'desc.required' => '请输入投票简介',
            'start_time.required' => '请选择开始日期',
            'end_time.required' => '请选择结束日期',
            'end_time.after' => '结束日期必须在开始日期之后',
        ];
        $validator = Validator::make($request->input(), $rules, $message);
        if ($validator->fails()){
            return $this->qhc(0,$validator->errors());
        }else{
            $theme = new Theme();
            $theme->theme_name  = $request->input('theme_name');
            $theme->start_time  = strtotime($request->input('start_time'));
            $theme->end_time  = strtotime($request->input('end_time'));
            $theme->theme_desc  = $request->input('desc');
            $res = $theme->save();
            if($res){
                return $this->qhc(1,'新增成功');
            }else{
                return $this->qhc(0,'新增失败');
            }
        }

    }
    //编辑
    public function edit($id)
    {
        return view('theme.edit');
    }
    //更新
    public function update(Request $request)
    {

    }
    //删除
    public function destroy($id)
    {

    }
}
