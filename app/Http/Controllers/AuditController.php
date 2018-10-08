<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Audit;

class AuditController extends Controller
{
    //列表
    public function index(Request $request)
    {
        if($request->ajax('get')){
            return $this->load_data($request);
        }
        return view('audit.index');
    }
    public function load_data($request)
    {
        $model = new Audit();
        //初始化
        $page  = $request->input('page') ? $request->input('page') : 1;
        $limit = $request->input('limit')? $request->input('limit') : 20;
        $field = $request->input('field')? $request->input('field') :'id';
        $order = $request->input('order')? $request->input('order') :'desc';
        $keyword = $request->input('keyword')? $request->input('keyword') :'';
        $start = ($page-1) * $limit;
        //判断是否有关键字
        if(strlen($keyword) >0){
            $data  = $model::where('option_code','like',$keyword.'%')
                ->orwhere('option_company','like','%'.$keyword.'%')
                ->orwhere('option_name','like','%'.$keyword.'%')
                ->offset($start)->limit($limit)->orderBy($field,$order)->get()->toArray();
            $count = $model::where('option_code','like',$keyword.'%')
                ->orwhere('option_company','like','%'.$keyword.'%')
                ->orwhere('option_name','like','%'.$keyword.'%')
                ->count();
        }else{
            $data  = $model::with(['options'=>function($query){
                $query->select('id','option_name','option_company','option_code');
            }])->offset($start)->limit($limit)->orderBy($field,$order)->get()->toArray();
            $count = $model::with(['options'=>function($query){
                $query->select('option_name','option_company','option_code');
            }])->count();
        }
        $pages = ceil($count/$limit);
        foreach ($data as $k=>&$item)
        {
            $item = array_merge($item,$item['options']);
        }

        $return = array(
            'code'=>0,
            'count'=>$count,
            'msg'=>'查询成功',
            'data'=>$data,
            'pages'=>$pages,
        );
        return $return;
    }
}
