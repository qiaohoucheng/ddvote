<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Model\Theme;
use App\Model\Company;
use App\Model\Prize;
use App\Model\Cvote;

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
        //券商详情
        $data['company'] = Company::find($id)->toArray();
        $data['theme_desc'] = str_replace(array("\r\n", "\n", "\r"),"<br />", $data['theme_desc']);
        //奖项分类
        $data['prize'] = Prize::all()->toArray();
        //$votelog = Cvote::where('c_id',$id)->get()->toArray();

        //foreach ($data['prize'] as &$v){
        //    $count = Cvote::where('c_id',$id)->where('prize_id',$v['id'])->count();
        //    $v['vote'] = $count > 0 ? $count :0;
        //}
        //具体票数
        //dd($data['prize']);
        return view('company.show',compact('id','data'));
    }
    public function load_data($request)
    {
        $page  = $request->input('page') ? $request->input('page') : 1;
        $limit = $request->input('limit')? $request->input('limit') : 20;
        $field = $request->input('field')? $request->input('field') :'vote';
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
        $mid = $request->session()->get('d2_uid')?$request->session()->get('d2_uid'):0;
        if($request->input('pid') && $request->input('cid')){
            $now_time = strtotime(Carbon::now());
            $end_time = Theme::where('id',$this->vid)->value('end_time');
            if( $now_time - $end_time > 0 ){
                return    $this->qhc('40001','投票已截止');
            }
            $today  = strtotime(Carbon::today());
            $tomorrow = strtotime(Carbon::tomorrow());
            $count = Cvote::where('member_id',$mid)
                ->where('c_id',$request->input('cid'))
                ->where('prize_id',$request->input('pid'))
                ->where('created_at','>=',$today)
                ->where('created_at','<=',$tomorrow)
                ->count();
            $daycount = Cvote::where('member_id',$mid)
                ->where('created_at','>=',$today)
                ->where('created_at','<=',$tomorrow)
                ->count();
            if($count >0 ){
                return $this->qhc('40003','Sorry,不能重复投票哦');
            }
            if($daycount >= 10){
                return $this->qhc('40004','感谢参与，您今日的投票次数已用完');
            }else{
                $num = intval(9 - $daycount);
                $msg = '投票成功！今日您还可以投'.$num.'票！';
            }
            $model = new Cvote();
            $model->theme_id = 2;
            $model->member_id = $mid;
            $model->prize_id = $request->input('pid');
            $model->c_id = $request->input('cid');
            $model->created_at = $now_time;
            $res = $model->save();
            //投票
            if($res !== false ){
                Company::where('id',$request->input('cid'))->increment('v'.$request->input('pid'),'1',['vote'=>DB::raw('vote + 1')]);
                return $this->qhc('1',$msg);
            }
        }else{
            return $this->qhc('0','网络异常');
        }
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
