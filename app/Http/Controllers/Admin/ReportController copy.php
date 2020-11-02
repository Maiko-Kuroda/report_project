<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Group;
use App\User;
use App\Report;

class ReportController extends Controller   
{
    // レポート一覧表示
    public function index(Request $request)
    {
        // dd($request);
        $your_account = Auth::user();
        $query = Group::all();
        //ユーザーモデルでユーザー情報をすべて取ってくる
        //$requestのcond_userの値を$cond_userに代入
        $cond_user = $request->cond_user;
        $group = $request->input('group');
        $posts = [];
        $groups = $your_account->groups;
        $serch_ids = [];

        // dd($cond_user);
        if($cond_user != ''){

            $serch_ids = User::where('name','like',"%$cond_user%")->get()->toArray();
            $serch_ids = array_column( $serch_ids, 'id' );
        }
        // dd($request->name);
        \Log::info("----");
        \Log::info($request->all());
        
        //検索条件なし、全件取得
        if ($cond_user =='' && $group == "-1") {
            \Log::info("検索条件なし");
          } 
          //名前だけ入力あり
        else if ($cond_user != "" && $group == "-1") {
            \Log::info("名前だけ検索");
            // $serch_ids=[1,2];
            $posts = Report::whereIn('user_id', $serch_ids)->get();
            // dd($serch_ids);
          } 
          //グループだけ入力ありhbjhm
        else if ($cond_user =='' && $group != "-1") {
            \Log::info("グループだけ検索");
            $posts = Report::where('group_id', $request->group_id)->get();
            // dd($serch_ids);
        }
        else {
            // 両方の入力があった
            \Log::info("両方検索");
            $posts = Report::where('group_id', $request->group_id)->whereIn('user_id', $serch_ids)->get();
            // dd($serch_ids);
          }
        // dd($groups);
        // dd($query->where('group_id', $group));

        return view('admin.report.index', ['posts' => $posts, 'cond_user' => $cond_user,'groups' =>$groups,'group'=>$group]);
        // return view('admin.report.index', ['posts' => $posts]);
     }
        //myPageでは自分のidで検索する→$reports = Report::where('user_id', Auth::id())->get();
    /*
     public function yourReport(Request $request, report $report)
     {
        // Auth::report(class名：report)によってreport.blade.phpにレポート内容を渡す
        $report = Auth::report();
        return view('admin.report.report',['report' => $report]);
    }
*/
    //新規レポート投稿画面（get
    public function add(Request $request)
    {
        $your_account = Auth::user();
        $request->session()->put("fromUrl", url()->previous());
        $groups = $your_account->groups;
        return view('admin.report.create',['groups' =>$groups]);
    }
    public function showMypage(Request $request)
    {
        //Auth::userで登録されているユーザー情報全て取ってくる（アドレスとかも）
        $your_account = Auth::user();
        //日付けを取ってくる
        // $date = date_create($request->date);
        // $date = date_format($date , 'Y-m-d');
        // $obj = Report::where('created_at' , 'like' , $date . '%')->get();
        // //↓たくさんのユーザーIDに紐づいているレポートの中から、自分のIDのものを引っ張ってくる
        // $reports = Report::where('user_id', Auth::id())->get();
        // //↓Y-m-d表記にViewで表示させたい
        // foreach($reports as &$report){
        //     $date = date_create($report->date);
        //     $date = date_format($date , 'Y-m-d');
        //     $report->date = $date; //取得したレポートのデータを、Y-m-dに変換
        // }
        $reports = Report::where('user_id', Auth::id())->orderBy('updated_at', 'desc')->get();
        return view('admin.report.myPage', ['your_account' => $your_account, 'reports' => $reports]);
    }

    //新規レポート更新処理（post）
    public function create(Request $request)
    {
        $report = new report;
        $form = $request->all();//レポート内容、グループ名などviewからすべて受け取っている
        unset($form['_token']);
        // データベースに保存する
        //↓ログインしているユーザーの情報を登録情報に追加している。
        $form['user_id'] = Auth::id();
        $report->fill($form);
        $report->save();
        //更新ボタンを押したらreport/mypage（自分のレポート一覧みれるページ）にリダイレクトする・mypage新規で作る必要あり
        //↓　フォームに入力された内容にDBに保存するアクション
        $toUrl = $request->session()->get("fromUrl");
        $request->session()->forget("formUrl");
        return redirect($toUrl);
        // リクエストのもと（グループ新規作成）
    }

    //レポート編集画面
    public function edit(Request $request)
    {
        $report = Report::find($request->id);
        return view('admin.report.edit', ['report' => $report]);
    }
    //レポート更新処理
    //$requestには、postで受け取った情報（ユーザーが編集したレポート）が入る
    public function update(Request $request)
    {
       //①findメソッドで、指定されたid（$requestのidプロパティ）に該当するレコードを取得
       //して$reportに代入（編集前のもの）
        $report = Report::find($request->id);
        //②編集前の$report＝編集前のもの。これを編集後の内容が代入されている$requestの内容に更新
        //③$requestから各プロパティを呼び出し、$articleの各プロパティとして代入する。
        //（上書き保存のイメージ。）
        //④モデルのsaveメソッドを実行し、内容をデータベースに書き込む。
        $report_form =$request->all();
        unset($report_form['_token']);
        // unset($report_form['report']);
        $report->fill($report_form)->save();
        return redirect('report/mypage');
    }
    //レポート削除処理
    public function delete(Request $request)
    {
        $report = Report::find($request->id);
        //削除
        $report->delete();
        return redirect('admin/report/');
    }
}