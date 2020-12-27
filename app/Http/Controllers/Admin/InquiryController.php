<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Auth;
use App\Mail\InquiryMail;
use Mail;
class InquiryController extends Controller
{
    //問合せ画面を表示(get)
    public function add(Request $request){
        $your_account = Auth::user();
        $request->session()->put("fromUrl", url()->previous());
        return view('admin.inquiry.create');
    }
    //問合せ内容を保存 → メール送る(post)
    public function create(Request $request){
        // メールの宛先取得
        $user = User::where('isAdmin', 1)->first();
        $to = $user->email;
        Mail::to($to)->send(new InquiryMail(Auth::user()));
        //↑今はユーザー情報しか入らない。本文を入れるならば(Auth::user(),○○)という感じで情報を入れる
        
        // $inquiry = new inquiry;
        // $form = $request->all();//問合せ内容などをviewからすべて受け取っている
        // unset($form['_token']);
        // // データベースに保存する
        // //↓ログインしているユーザーの情報を登録情報に追加している。
        // $form['user_id'] = Auth::id();
        // $inquiry->fill($form);
        // $inquiry->save();
        // //↓フォームに入力された内容にDBに保存するアクション
        $toUrl = $request->session()->get("fromUrl");
        $request->session()->forget("formUrl");
        return redirect($toUrl);
    }
}