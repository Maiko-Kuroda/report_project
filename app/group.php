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
        
        //ユーザーとグループがN:Nの関係のため
        //User.phpには　fumction groups
        public function users()
        {
            return $this->hasMany('App\UserGroup');
        }
}
