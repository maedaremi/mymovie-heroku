<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $guarded = array('id');
    protected $table = 'movie';
    //
    public static $rules = array(
        'title' => 'required',
        'body' => 'required',
        //'image_path' => 'required'
    );
}
