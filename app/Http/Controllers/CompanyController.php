<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Theme;
use App\Model\Company;
class CompanyController extends Controller
{
    protected  $vid;
    public function __construct()
    {
        $this->vid = 2;
    }

    //
    public function index(Request $request)
    {
        if($request->ajax()){
            return $this->load_data($request);
        }else{
            $keyword = $request->input('keyword') ? $request->input('keyword') :'';
            $data = Theme::find($this->vid);
            return view('company.index',compact('data','keyword'));
        }
    }
    public function show($id)
    {
        $data = '';
        return view('company.show',compact('id','data'));
    }
    public function load_data($request)
    {
        $page  = $request->input('page') ? $request->input('page') : 1;
        $limit = $request->input('limit')? $request->input('limit') : 20;
        $field = $request->input('field')? $request->input('field') :'c_vote';
        $order = $request->input('order')? $request->input('order') :'desc';
        $keyword = $request->input('keyword')? $request->input('keyword') :'';
        $start = ($page-1) * $limit;
        //判断是否有关键字
        if(strlen($keyword) >0){
            $data  = Company::where('c_name','like',$keyword.'%')
                ->offset($start)->limit($limit)->orderBy($field,$order)->get()->toArray();
            $count = Company::where('c_name','like',$keyword.'%')->count();
        }else{
            $data  = Company::offset($start)->limit($limit)->orderBy($field,$order)->get()->toArray();
            $count = Company::count();
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
    public function store(Request $request)
    {
        if($request->input('id') && $request->input('type')){
            $data = Company::where('id',$request->input('id'))->first();
        }
        if($data['vid']>0){
            $data['info'] = M('vote')->where(" id = {$data['vid']} ")->find();
            //简介
            //$info['desc'] = str_replace(array("\r\n", "\n", "\r"),"<br />", $info['desc']);
            //奖项
            if($data['awards_ids']){
                $where['id'] = array('in',$data['awards_ids']);
                $data['award'] = M('awards')->where($where)->select();
                //统计票数
                if($data['award']){
                    foreach($data['award'] as $k=>$v){
                        $vote_where['vid'] = $data['vid'];
                        $vote_where['aid'] = $v['id'];
                        $vote_where['cid'] = $id;
                        $data['award'][$k]['vote_num'] = M('company_log')->where($vote_where)->count();
                    }
                }
            }
        }
        $this->as
    }
}
