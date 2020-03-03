<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    
    protected $guarded = array('id');
    protected $table = 'todos';
    //
    public static $rules = array(
        'body' => 'required',
    );
}
