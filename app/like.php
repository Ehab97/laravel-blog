<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class like extends Model
{
    //
    public function post(){
    	return $this->belongsTo('App\Post','post_id');
    }
}
