<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;

class IndexController extends Controller
{
    //
    public function index(Request $request)
    {
        //if($request->input('id')){

        //}
        Redis::set('name', 'Taylor');
    }
    public function set(Request $request)
    {
        $name = $request->input('name','sui');
        Redis::set('name', $name);
    }
    public function get()
    {
        return  Redis::get('name');
    }
}
