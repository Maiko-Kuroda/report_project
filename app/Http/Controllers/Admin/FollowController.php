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
        $your_account = Auth::user();
        $userId = $form['user_id'];
        // フォローしているか
        $isFollowing = $your_account->isFollowing($userId);
        //フォローしてる人をデーターベースに入れる処理↓
        if ($isFollowing == false) {
            $your_account->following()->attach(
                ['from' => $your_account->id ],
                ['to' => $userId]
            );
        }
        return response()->json(['isFollow' => 1]);
    }
    //フォローを外す
    public function unfollow(Request $request)
    {
        $form = $request->all();
        $your_account = Auth::user();
        $userId = $form['user_id'];
        // フォローしているか
        $isFollowing = $your_account->isFollowing($userId);
        //フォローしてる人をデーターベースに入れる処理↓
        if ($isFollowing == true) {
            $your_account->following()->detach(['to' => $userId]);
        }
        return response()->json(['isFollow' => 0]);
    }
}