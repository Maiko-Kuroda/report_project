<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    //
    protected $guarded = array('id');
    public static $rules = array(
        'body' => 'required',
        'user_id' => 'required',
        );
        
        //未作成
        public function histories()
        {
            return $this->hasMany('App\History');
        }
}
