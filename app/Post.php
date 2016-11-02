<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    function category() {
    	return $this->belongsTo('App\Category');
    }
}
