<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    
    protected $guarded = array('id');
    public static $rules = array(
        'from' => 'required',
        'to' => 'required',
        
        );

}
