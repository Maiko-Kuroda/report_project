<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Inquiry;
use Auth;
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
    public function create(){

    	$data = [];
    	Mail::send('emails.test', $data, function($message){
            $message->to('maik0.k@hotmail.co.jp', 'Test')
                    ->subject('This is a test mail');
        });
        
        // $inquiry = new inquiry;
        // $form = $request->all();//問合せ内容などをviewからすべて受け取っている
        // unset($form['_token']);
        // // データベースに保存する
        // //↓ログインしているユーザーの情報を登録情報に追加している。
        // $form['user_id'] = Auth::id();
        // $inquiry->fill($form);
        // $inquiry->save();
        // //↓フォームに入力された内容にDBに保存するアクション
        // $toUrl = $request->session()->get("fromUrl");
        // $request->session()->forget("formUrl");
        return redirect($toUrl);


    }

    




}
