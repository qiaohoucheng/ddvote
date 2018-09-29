<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\URL;

use Socialite;
use SocialiteProviders\Weixin\Provider;
use App\Model\Member;
use Carbon\Carbon;

class WechatController extends Controller
{
    protected $appid;
    protected $secret;
    public function __construct()
    {
        $this->appid   = 'wx2ae1cda2b7d4bd3b';
        $this->secret  = '69fb4a819956275b9b404d3342cfb4f3';
    }

    public function getconfig(Request $request)
    {
        $url = $request->input('url');
        $appid =  $this->appid;
        $secret = $this->secret;
        //获取token  7200
        $accessToken = Cache::remember('accessTokenv', 120, function () use ($appid, $secret) {
            $accessTokenUrl = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$secret";
            $accessTokenJson = file_get_contents($accessTokenUrl);
            $accessTokenObj = json_decode($accessTokenJson);
            $accessToken = $accessTokenObj->access_token;
            return $accessToken;
        });
        //获取ticket
        $jsapiTicket =  Cache::remember('jsapiTicket', 120, function () use ($accessToken) {
            $ticketUrl = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token=$accessToken&type=jsapi";
            $jsapiTicketJson = file_get_contents($ticketUrl);
            $jsapiTicketObj = json_decode($jsapiTicketJson);
            $jsapiTicket = $jsapiTicketObj->ticket;
            return $jsapiTicket;
        });

        $noncestr = str_random(16);
        $time = time();
        $jsapiTicketNew = "jsapi_ticket=$jsapiTicket&noncestr=$noncestr&timestamp=$time&url=$url";
        $signature = sha1($jsapiTicketNew);
        $signPackage = array(
            "appId"     => $appid,
            "nonceStr"  => $noncestr,
            "timestamp" => $time,
            "url"       => $url,
            "signature" => $signature
        );
        return $signPackage;
    }

    public function redirectToProvider(Request $request)
    {
        return Socialite::with('weixin')->redirect();
    }

    public function handleProviderCallback(Request $request)
    {
        $uid = session('dduid');
        if($uid>0){
            return redirect('/v1');
        }
        $user_data = Socialite::with('weixin')->user();
        $member = Member::firstorNew(['openid'=>$user_data->openid]);
        $member->nickname = $user_data->nickname;
        $member->photo = $user_data->avatar;
        $member->created_at = strtotime(Carbon::now());
        $res = $member->save();
        if($res){
            session('dduid',$member->id);
        }
    }
}
