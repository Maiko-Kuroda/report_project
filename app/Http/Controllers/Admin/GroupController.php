<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Group;
use App\User;
use App\Report;

class GroupController extends Controller
{   
     //新規グループ作成画面（get）
     public function add(Request $request)
     {
         $request->session()->put("fromUrl", url()->previous());
         return view('admin.user.group_create');

     }

    //グループの新規作成更新処理（post）
    public function create(Request $request)
    {
        $group = new group;
        $group_form = $request->all();
        unset($group_form['_token']);// データベースがパンクするので、消す処理
        $group->fill($group_form);//15行めを全てを配列にしてもらっているモデルのインスタンスに要素を詰め込む
        $group->user_id = Auth::id();
        $group->save();
        $toUrl = $request->session()->get("fromUrl");
        $request->session()->forget("formUrl");
        return redirect($toUrl);
        
    }
   
    //グループのエントランス(get)
    public function welcome(Request $request)
    {
        $request->session()->put("fromUrl", url()->previous());
        return view('admin.user.welcome');
    }

    //既存グループへのログインページ(get)
    public function enter(Request $request)
    {
        $request->session()->put("fromUrl", url()->previous());
        return view('admin.user.group_login');
    }

    public function login(Request $request)
    {
        $your_group = $request->your_group; 
        $posts = Report::
        $group;
    //     //存在したら処理進む、存在してなかったらエラーを出す
    //     //エラーの場合はアドルームに戻して、エラ-メッセージを表示
    //     //存在したら、ユーザーグループにグループが存在するかを検索
    //     //存在したら、次の処理
    //     //存在しなかったら、グループの登録処理に進む
    //     //入ったグループのレポート一覧を返す
    //     //レポートテーブルに対してグループ50行めのグループIdを元にレポートを検索
    // $query->where('status',1); // status が 1 のものだけを取得する
        Gruop::where('name',$request)->get()//グループテーブル内に入力した値がグループテーブルの中に存在するかを検索する必要あり
        $this->middleware('group')->except('admin.user.welcome');
        Gruop::where('group_id',$posts)->get()
        $group_report = Report::where('group_id',Auth::id())->get();

        

// ユーザに紐づいたグループだけを表示させる
// selectで選択できる
    // }


}


