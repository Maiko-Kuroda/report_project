<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
// ↓　Userモデルを使うための設定
use App\User;

// ↓画像のサイズ変換
use \InterventionImage;
class UserController extends Controller
{
    public function yourAccount(Request $request, User $user)
    {
        // Auth::user(class名：your_account)によってyour_account.blade.phpにアカウント情報を渡す
        $your_account = Auth::user();
        return view('admin.user.your_account', ['your_account' => $your_account]);
    }
    // get
    public function edit(Request $request)
    {
        // controllerファイルからbladeファイル へユーザー情報を渡す
        // Auth::user();でログイン中のユーザー情報を取得できる。
        $your_account = Auth::user();
        return view('admin.user.edit', ['your_account' => $your_account]);
    }
    // post
    public function update(Request $request)
    {
        // $this->validate($request, User::$rules); ←使うなら$rulesを定義する必要
        $user = user::find($request->id);
        $account_form = $request->all();
        $file = $request->file('Photo');
        $name = $file->getClientOriginalName();
        if (isset($account_form['photo'])) {
            $path = $request->file('photo')->store('public/image');
            $user->photo = basename($path);
            unset($account_form['photo']);
        } elseif (0 == strcmp($request->remove, 'true')) {
            $user->photo = null;
        }
        InterventionImage::make($file)->resize(1080, null, function ($constraint) {
            $constraint->aspectRatio();
        })->save(public_path('/images/' . $filename));;
        unset($account_form['_token']);
        // ↓　fillでフォームから受け取ったデータをユーザーに埋め込む（設定）し保存
        $user->fill($account_form)->save();
        return redirect('/user/edit');
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
        $followList = Follow::where('to',Auth::id())->get();
        return view('admin.user.user_index', ['all_users' => $all_users]);


    }
}
