<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;

use App\Model\Theme;
use App\Model\Option;
use App\Model\Votelog;
use Illuminate\Support\Facades\DB;
use Validator;

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
        $this->uid = 1;
        $mid = $this->uid?$this->uid:0;
        $option_id = $request->input('option_id');
        $vid = $this->vid;
        $theme = Theme::find($vid);
        $now_time = strtotime(Carbon::now());
        if( $now_time - $theme->end_time > 0 ){
            $this->qhc('40001','投票已截止');
        }
        $today  = strtotime(Carbon::today());
        $tomorrow = strtotime(Carbon::tomorrow());
        //判断是否投过票
        $has_arr = Votelog::where('theme_id',$vid)
            ->where('member_id',$mid)
            ->where('created_at','>=',$today)
            ->where('created_at','<=',$tomorrow)
            ->select('option_id')->get();
        if(!$has_arr){
            $msg = '投票成功 剩余可投票次数4次';
        }else{
            $vote_arr = array();
            foreach ($has_arr as $key=>$item){
                $vote_arr[] = $item->option_id;
            }
            if(in_array($option_id,$vote_arr)){
                return $this->qhc('40003','Sorry 一个人只能投一票哦');
            }else{
                $num = count($vote_arr);
                switch($num){
                    case 1:
                        $msg ='投票成功 剩余可投票次数3次';
                        break;
                    case 2:
                        $msg ='投票成功 剩余可投票次数2次';
                        break;
                    case 3:
                        $msg ='投票成功 剩余可投票次数1次';
                        break;
                    case 4:
                        $msg ='投票成功! 投票次数已用完';
                        break;
                    case 5:
                    default:
                        return  $this->qhc('40001','Sorry 您今日投票次数已用完');
                        break;

                }

            }
        }
        $votelog = new Votelog();
        $votelog->member_id = $mid;
        $votelog->theme_id = $this->vid;
        $votelog->option_id = $option_id;
        $votelog->created_at = time();
        $res = $votelog->save();
        //投票
        if($res !== false ){
            Option::where('id',$option_id)->increment('option_vote');
            return $this->qhc('1',$msg);
        }
        return $this->qhc('0','网络异常');
    }
    //提交审核
    public function update(Request $request)
    {
        $this->uid = 1;
        $rules = [
            'submit_name'=>'required',
            'mobile' => 'required',
            'pic_id' => 'required',
        ];
        $message = [
            'submit_name.required' => '请添加姓名',
            'mobile.required' => '请添加手机号',
            'pic_id.required' => '请添加图片',
        ];
        $validator = Validator::make($request->input(), $rules, $message);
        if ($validator->fails()){
            return $this->qhc(0,'缺少参数');
        }else{
            $data['name'] = $request->input('submit_name');
            $data['mobile'] = $request->input('mobile');
            $data['photo'] = $request->input('pic_id');
            $data['created_at'] = strtotime(Carbon::now());
            $data['member_id'] = $this->uid ? $this->uid :0;
            $data['option_id'] = $request->input('option_id');
            $id = DB::table('audit')->insertGetId($data);
            if($id >0){
                return $this->qhc(1,'提交成功！请等待审核');
            }else{
                return $this->qhc(0,'提交失败！');
            }
        }
    }
}
