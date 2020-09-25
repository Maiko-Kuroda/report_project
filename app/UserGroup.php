<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class UserGroup extends Model
{
    protected $table = 'user_group';
    //登録者とグループを紐付けるため。usegroupテーブルでかけば、複数人が同じグループ所属できる
    protected $guarded = array('id');
    public static $rules = array(
        'group_id' => 'required',
        'user_id' => 'required',
    );
    //これでレポートを引っ張るときにユーザーIDと一致するものを
    public function user()
    {
        return $this->belongsTo('App\User');  //belongsToは1対n、
    }
    //これでグループを引っ張るときにユーザーIDと一致するものを
    public function group()
    {
        return $this->belongsTo('App\Group');
    }
}