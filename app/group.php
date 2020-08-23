<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    //
    protected $guarded = array('id');
    public static $rules = array(
        'group_name' => 'required',
        // 'user_id' => 'required',
        

        );
        
        //これでグループを引っ張るときにユーザーIDと一致するものを
        public function UserGroups()
        {
            return $this->hasMany('App\UserGroup');
        }
}
