<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Option;

class ApiController extends Controller
{
    //
    public function top()
    {
        $data = Option::whereBetween('option_vote', [1000, 3000])->get()->toArray();


        var_dump($data);
        exit;
    }
}
