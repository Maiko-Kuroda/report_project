<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    //
    protected $guarded = array('id');
    public static $rules = array(
        'report' => 'required',
        'user_id' => 'required',
        'group_id' => 'required',
        );
        
    //これでレポートを引っ張るときにユーザーIDと一致するものを
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function group()
    {
        return $this->belongsTo('App\Group');
    }
}
