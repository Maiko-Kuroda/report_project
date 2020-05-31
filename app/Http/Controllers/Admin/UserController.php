<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
// ↓　Userモデルを使うための設定
use App\User;


class UserController extends Controller
{
   
    public function yourAccount(Request $request, User $user)
    {
        $your_account = Auth::user();
        return view('admin.user.your_account',['your_account' => $your_account]);
    }

    //get 
    public function edit(Request $request)
    {
        // controllerファイルからbladeファイル へユーザー情報を渡す
        // Auth::user();でログイン中のユーザー情報を取得できる。
        $your_account = Auth::user();
        return view('admin.user.edit',['your_account' => $your_account]);
    }

    // post
    public function update(Request $request)
    {
        // $this->validate($request, User::$rules); ←使うなら$rulesを定義する必要
        $user=user::find($request->id);
        $account_form = $request->all();
        if (isset($user_form['image'])) {
            $path = $request->file('image')->store('public/image');
            $user->image_path = basename($path);
            unset($account_form['image']);
          } elseif (0 == strcmp($request->remove, 'true')) {
            $user->image_path = null;
          }
        unset($account_form['_token']);
        // ↓　fillでフォームから受け取ったデータをユーザーに埋め込む（設定）し保存
        $user->fill($account_form)->save();

        return redirect('/user/edit');
        
    }

    public function __construct(){
        $this->middleware('auth');
    }

    

}

