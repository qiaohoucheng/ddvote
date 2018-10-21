<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Theme;
use App\Model\Company;
use App\Model\Prize;

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
        //奖项详情
        $data = Theme::find($this->vid)->toArray();
        $data['theme_desc'] = str_replace(array("\r\n", "\n", "\r"),"<br />", $data['theme_desc']);
        //奖项分类
        $data['prize'] = Prize::all()->toArray();
        //具体票数
        //dd($data['prize']);
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
    public function store()
    {

    }
    public function pic()
    {
       $c  = Company::all();
       foreach ($c as $k=>$v)
       {
            $file_name = public_path().'/logo/'.$v->c_name.'.png';
            if(file_exists($file_name)){
                $content = file_get_contents($file_name);
                $putname = 'dd00'.$v->id.'.png';
                file_put_contents(public_path().'/logo/'.$putname,$content);
                //var_dump($content);exit;
            }
            echo $v->c_name.'<br/>';
       }
    }
}
