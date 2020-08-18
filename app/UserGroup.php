<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserGroup extends Model
{
    //
    protected $guarded = array('id');
    public static $rules = array(
        'group_id' => 'required',
        'user_id' => 'required',
        

        );
        
        //これでレポートを引っ張るときにユーザーIDと一致するものを
        public function user()
        {
            return $this->belongsTo('App\User');
        }

        //これでグループを引っ張るときにユーザーIDと一致するものを
        public function group()
        {
            return $this->belongsTo('App\Group');
        }

}
