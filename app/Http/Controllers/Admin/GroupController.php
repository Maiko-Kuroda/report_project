<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Group;
use App\User;

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

        
    }


}


