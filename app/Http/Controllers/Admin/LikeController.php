<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Like;
use App\Report;
use Auth;
class LikeController extends Controller
{
    public function like(Request $request)
    {
        $user_id = Auth::user()->id; //1.ログインユーザーのid取得
        $report_id = $request->report_id; //2.投稿idの取得
        $already_liked = Like::where('user_id', $user_id)->where('report_id', $report_id)->count(); //3.
    
        if (!$already_liked) { //もしこのユーザーがこの投稿にまだいいねしてなかったら
            $like = new Like; //4.Likeクラスのインスタンスを作成
            $like->report_id = $report_id; //Likeインスタンスにlike_id,user_idをセット
            $like->user_id = $user_id;
            $like->save();
        } else { //もしこのユーザーがこの投稿に既にいいねしてたらdelete
            $like  = Like::where('report_id', $report_id)->where('user_id', $user_id)->first();
            $like->delete();
        }
        //5.この投稿の最新の総いいね数を取得
        // $review_likes_count = Review::withCount('likes')->findOrFail($like_id)->likes_count;
        $report = Report::find($report_id);
        $review_likes_count = $report->likes->count();
        
        $param = [
            'isLike' => !$already_liked,
            'review_likes_count' => $review_likes_count,
        ];
        return response()->json($param); //6.JSONデータをjQueryに返す
    }
}