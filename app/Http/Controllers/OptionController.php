<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Option;
use App\Model\Theme;

class OptionController extends Controller
{
    //主题信息加载
    public function index(Request $request,$id){
        $keyword = $request->input('keyword')?$request->input('keyword'):'';
        $data = Theme::where('id',$id)->first();
        return view('option.index',compact('id','data','keyword'));
    }
    //选项列表
    public function load_data(Request $request){
        return $this->dataFormat(new Option(),$request);
    }
    public function create($tid)
    {
        return view('option.create',compact('tid'));
    }
}
