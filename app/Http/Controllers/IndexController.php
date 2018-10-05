<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;

use App\Model\Theme;
use App\Model\Option;
use App\Model\Votelog;
use Illuminate\Support\Facades\DB;

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
    //详情
    public function show($id)
    {
        $data = Option::find($id);
        $info = Theme::find($this->vid);
        $info['theme_desc'] = str_replace(array("\r\n", "\n", "\r"),"<br />", $info['theme_desc']);
        return view('index.detail',compact('id','data','info'));
    }
    //投票
    public function store(Request $request)
    {
        $mid = 1;
        $option_id = $request->input('option_id');
        $vid = $request->input('vid');
        if($vid ==1 && $option_id >0){
            //strtotime(Carbon::now());
            $today = strtotime(Carbon::today());
            $tomorrow = strtotime(Carbon::tomorrow());
            $logid = Votelog::where('member_id',$mid)->where('theme_id',$vid)
                ->where('option_id',$option_id)->where('created_at','>',$today)->value('id');
            if(isset($logid) && $logid >0){
                $return['code'] = 0;
                $return['msg'] = '您今天已经投过票了';
            }else{

            }
            exit();
        }else{
            $return['code'] = 0;
            $return['msg'] = '网错错误';
        }
        return $return;
    }
    //提交审核
    public function update(Request $request)
    {
        $rules = [
            'submit_name'=>'required',
            'mobile' => 'required',
            'url' => 'required',
        ];
        $message = [
            'submit_name.required' => '请添加姓名',
            'mobile.required' => '请添加手机号',
            'url.required' => '请添加图片',
        ];
        $validator = Validator::make($request->input(), $rules, $message);
        if ($validator->fails()){
            return $this->qhc(0,'缺少参数');
        }else{
            $data['name'] = $request->input('submit_name');
            $data['mobile'] = $request->input('mobile');
            $data['url'] = $request->input('url');
            $data['created_at'] = strtotime(Carbon::now());
            $data['member_id'] = $this->uid ? $this->uid :0;
            $id = DB::table('audit')->insertGetId($data);
            if($id >0){
                return $this->qhc(1,'提交成功！请等待审核');
            }else{
                return $this->qhc(0,'提交失败！');
            }
        }
    }
}
