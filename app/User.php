<?php
namespace App;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
class User extends Authenticatable
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'hobby', 'photo', 'email', 'password',
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    //ユーザー1人に対して、レポートは複数紐づいているので、「reports」(複数形)
    public function reports()
    {
        return $this->hasMany('App\Report');
    }
    //ユーザーとグループがN:Nの関係のため
    //Groups.phpには　function users
    public function groups()
    {
        return $this->belongsToMany('App\Group','user_group','user_id','group_id');
    }
    //フォローしているユーザー一覧取得
    public function following()
    {
        return $this->belongsToMany(User::class, 'follows', 'from', 'to')->withTimestamps();
    }
    //フォローされているユーザー一覧取得
    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows', 'to', 'from')->withTimestamps();
    }
    public function getAllUsers(Int $user_id)
    {
        return $this->Where('id', '!=', $user_id)->get();
    }
    //フォローされているユーザー一覧取得
    public function isFollowing($user_id)
    {
        return $this->following()->where('to', $user_id)->exists();
    }
}