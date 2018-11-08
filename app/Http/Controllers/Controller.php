<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected  $f;
    public function adminFormat($model,$request)
    {
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
            $data  = $model::offset($start)->limit($limit)->orderBy($field,$order)->get()->toArray();
            $count = $model::count();
        }
        $pages = ceil($count/$limit);


        $return = array(
            'code'=>0,
            'count'=>$count,
            'msg'=>'查询成功',
            'data'=>$data,
            'pages'=>$pages,
        );
        return $return;
    }
    public function dataFormat($model,$request)
    {
        //初始化
        $page  = $request->input('page') ? $request->input('page') : 1;
        $limit = $request->input('limit')? $request->input('limit') : 20;
        $field = $request->input('field')? $request->input('field') :'use_photo';
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
            $data  = $model::whereBetween('option_vote', [1000, 3000])
                ->offset($start)->limit($limit)
                ->orderBy($field,$order)->get()->toArray();
            if(count($data) < 10 ){
                $wcount = $model::whereBetween('option_vote', [1000, 3000])->count();
                $stop = ceil($wcount/20);
                if($stop == $page){
                    $this->f = count($data);
                    $start =  ($page-$stop) * $limit;
                    $limit = ceil($limit-$this->f);
                }else{
                    $start = ($page-$stop ) * $limit - $this->f;
                }
                $start <= 0 ? 0 : $start;
                $data2 = $model::whereNotBetween('option_vote', [1000, 3000])
                ->offset($start)->limit($limit)
                ->orderBy($field,$order)->get()->toArray();
                $data = array_merge($data,$data2);
            }
            $count = $model::count();
        }
        $pages = ceil($count/$limit);


        $return = array(
            'code'=>0,
            'count'=>$count,
            'msg'=>'查询成功',
            'data'=>$data,
            'pages'=>$pages
        );
        return $return;
    }

    public function qhc($code,$message,$data='')
    {
        $return  = array(
            'code' => $code,
            'message'=>$message,
            'data'=>$data
        );
        return  $return;
    }
}
