<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends Controller
{
    public function  uploadPicture(Request $request)
    {
        var_dump($request->file());
        exit;
    }
}
