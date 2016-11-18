<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    function category() {
    	return $this->belongsTo('App\Category');
    }

    function tags() {
    	return $this->belongsToMany('App\Tag');
    }

    function comments () {
    	return $this->hasMany('App\Comment');
    }
}
