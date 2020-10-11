<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
// ↓　Userモデルを使うための設定
use App\User;
use App\Follow;
use App\Group;
use App\UserGroup;
// ↓画像のサイズ変換
use \InterventionImage;
class UserController extends Controller
{
    public function yourAccount(Request $request, User $user)
    {
        // Auth::user(class名：your_account)によってyour_account.blade.phpにアカウント情報を渡す
        $your_account = Auth::user();
        $groups = $your_account->groups;
        return view('admin.user.your_account', ['your_account' => $your_account, 'groups' => $groups]);
    }
    // get
    public function edit()
    {
        // controllerファイルからbladeファイル へユーザー情報を渡す
        // Auth::user();でログイン中のユーザー情報を取得できる。
        $groups = Group::get();// グループ全部とってくる。
        $your_account = Auth::user();
        $user_groups = $your_account->groups;
        return view('admin.user.edit', ['your_account' => $your_account,'groups' => $groups, "user_groups" => $user_groups]);
    }
    // post
    public function update(Request $request)
    {
        // $this->validate($request, User::$rules); ←使うなら$rulesを定義する必要
        $user = Auth::user();
        $account_form = $request->all();
        if (isset($account_form['photo'])) {
            $file = $request->file('photo'); // 8/2 Photo→photoに修正
             $name = $file->getClientOriginalName();
            $path = $request->file('photo')->store('public/image');
            $user->photo = basename($path);
            $user->save();
            unset($account_form['photo']);
            InterventionImage::make($file)->resize(1080, null, function ($constraint) {
            $constraint->aspectRatio();
            })->save(public_path('storage/image' . $user->photo));// 8/2 「image」→「storage/image」に修正
        } elseif (0 == strcmp($request->remove, 'true')) {
            $user->photo = null;
        }
        unset($account_form['_token']);
        // ↓　fillでフォームから受け取ったデータをユーザーに埋め込む（設定）し保存
        $user->fill($account_form)->save();
        // return redirect('/user/edit')
        // ユーザとグループの関係を初期化
        $user->groups()->detach();
        //グループidを保存（中間テーブルに保存するときはattachをつかう。ユーザーidは$user=Auth::userで取れている）
        $groups = $request->input('groups');
        foreach ($groups as $group) {
            $user->groups()->attach(
                ['group_id' => $group],
                ['user_id' => Auth::id()]
            );
        }
        return redirect('user');
    }
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request, User $user)
    {
        //↓チェックは、自分がログインしているかどうかを毎回確認する処理。今回はいらない
        //web.phpにミドルウェア、、つけた。
        $all_users = User::where('id', '<>', Auth::id())->get();
        //フォローテーブル（カラムのto）を結合。
        $your_account = Auth::user();
        $follows = $your_account->following;
        return view('admin.user.user_index', ['all_users' => $all_users,'follows' => $follows]);
    }
}