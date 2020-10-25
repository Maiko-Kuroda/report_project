<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Group extends Model
{
    //
    protected $guarded = array('id');
    public static $rules = array(
        'name' => 'required',
        // 'user_id' => 'required',
    );
    //ユーザーとグループがN:Nの関係のため
    //User.phpには　fumction groups
    public function users()
    {
        return $this->belongsToMany('App\User', 'user_group', 'group_id', 'user_id');
    }
}
