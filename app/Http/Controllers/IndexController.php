<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Model\Theme;
use App\Model\Option;

class IndexController extends Controller
{
    protected  $vid;
    public function __construct()
    {
        $this->vid = 1;
    }
    //首页
    public function index(Request $request)
    {
        if($request->ajax()){
            return $this->load_data($request);
        }else{
            $keyword = $request->input('keyword') ? $request->input('keyword') :'';
            $data = Theme::find($this->vid);
            return view('index.index',compact('data','keyword'));
        }

    }
    //加载数据
    public function load_data($request)
    {
        return $this->dataFormat(new Option(),$request);
    }
    //搜索 有可能会合并到index
    public function search()
    {

    }
    //详情
    public function show($id)
    {
        $data = Option::find($id);
        $info = Theme::find($this->vid);
        return view('index.detail',compact('id','data','info'));
    }
    //投票
    public function store()
    {

    }
    //提交审核
    public function update()
    {

    }
}
