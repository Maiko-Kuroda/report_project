<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Follow;
use Auth;
class FollowController extends Controller
{
    //フォローする
    public function follow(Request $request)
    {
        //$userIDはフォローした人のID
        $form = $request->all();
        $userId = $form['user_id'];
        // フォローしているか
        $isFollowing = Self::isFollowing($userId);
        //フォローしてる人をデーターベースに入れる処理↓
        if ($isFollowing == false) {
            // $follow = Follow::find($userId);
            //フォロー テーブルを作っている
            $follow = new Follow();

            $follow->fill(['from' => Auth::id(),'to' => $userId]);
            $follow->save();
        }
        return response()->json(['isFollow' => true]);
    }
    //フォローを外す
    public function unfollow(Request $request)
    {
        $form = $request->all();
        $userId = $form['user_id'];
        // フォローしているか
        $isFollowing = Self::isFollowing($userId);
        if ($isFollowing == false) {
            Follow::where('from', Auth::id())->where('to', $userId)->delete();
        }
        return response()->json(['isFollow' => false]);
    }
    // フォローしているか
    private static function isFollowing(Int $userId)
    {
        return (bool) Follow::where('from', $userId)->where('to', Auth::id())->first(['id']);
    }
    // フォローされているか
    public function isFollowed(Int $userId)
    {
        return (bool) Follow::where('from', Auth::id())->where('to', $userId)->first(['id']);
    }
}