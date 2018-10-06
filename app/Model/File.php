<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    //
    protected $fillable = ['md5'];
    public $timestamps = false;
}
