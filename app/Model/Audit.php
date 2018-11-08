<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Audit extends Model
{
    protected $table = 'audit';
    public $timestamps = false;

    public function options()
    {
        return $this->belongsTo('App\Model\Option', 'option_id');
    }

    public function imgurl()
    {
        return $this->belongsTo('App\Model\File', 'photo');
    }
}
