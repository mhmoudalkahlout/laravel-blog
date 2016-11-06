<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    function posts() {
    	return $this->belongsToMany('App\Post');
    }
}
