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
         return view('admin.group.group_create');
     }

    //グループの新規作成更新処理（post）
    public function create(Request $request)
    {
        $group = new group;
        $group_form = $request->all(); //blade
        unset($group_form['_token']);// テーブルにない項目を削除されるのを防ぐ
        unset($group_form['group']);
        $group->fill($group_form);//15行めを全てを配列にしてもらっているモデルのインスタンスに要素を詰め込む
        // $group->user_id = Auth::id();
        $group->save();
        Auth::user()->groups()->attach($group->id);//新規グループ作成時に中間テーブルに保存
        $toUrl = $request->session()->get("fromUrl");
        $request->session()->forget("formUrl");
        // return redirect($toUrl);
        // return view ('admin.report',['report' => $reports]);
        return view ('admin.group.new_group');
    }
   
    //グループ編集画面
    public function edit(Request $request)
    {
        // dd($request->id);
        $group = Group::find($request->id);
        return view('admin.group.group_edit', ['group' => $group]);
    }
    //グループ編集画面(更新処理)
    public function update(Request $request)
    {
        $group = Group::find($request->id);
        $group_form = $request->all();
        // dd($group_form);
        unset($group_form['_token']);
        $group->fill($group_form)->save();
        return redirect('group/index');
    }

    //グループのエントランス(get)
    public function welcome(Request $request)
    {
        $request->session()->put("fromUrl", url()->previous());
        return view('admin.group.welcome');
    }

    //既存グループへのログインページ(get)
    public function enter(Request $request)
    {
        $request->session()->put("fromUrl", url()->previous());
        return view('admin.group.group_login');
    }

    //既存グループへのログイン処理(post)
    public function login(Request $request)
    {
        $your_group = $request->your_group; 
        //存在したら処理進む、存在してなかったらエラーを出す
        //エラーの場合はアドルームに戻して、エラ-メッセージを表示
        //存在したら、ユーザーグループにグループが存在するかを検索
        //存在したら、次の処理
        //存在しなかったら、グループの登録処理に進む
        //入ったグループのレポート一覧を返す
        //レポートテーブルに対してグループ50行めのグループIdを元にレポートを検索
    
        $group= Gruop::where('name',$your_group)->get();//グループテーブル内に入力した値がグループテーブルの中に存在するかを検索する必要あり
       if (is_null($group)) {
           redirect('admin.group.welcome');
       }
       $reports= Report::where('group_id',$group->id)->get();//where('左がカラム名','右一致してほしいグループの中のID')
       return view ('admin.report',['report' => $reports]);

    }

    //グループ一覧表示(get)
   public function index(Request $request)
   {
    $all_groups = Group::all();
    return view('admin.group.group_index',['all_groups' =>$all_groups]);
   }

   public function delete(Request $request)
   {
       // 該当するGroup Modelを取得して削除
       Group::find($request->id)->delete();
       // 該当するGroup に紐づくレポートを削除
       Report::where('group_id',$request->id)->delete();
       
       return redirect('group/index');
   }  




}
