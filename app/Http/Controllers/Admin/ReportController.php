<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Report;
class ReportController extends Controller
{
    // レポート一覧表示
    public function index(Request $request)
    {
        //ユーザーモデルでユーザー
        //$requestのcond_userの値を$cond_userに代入
        $cond_user = $request->cond_user;
        $posts;
        if ($cond_user != '') {
            // 検索されたら検索結果を取得する
            $posts = Report::whereHas('user', function ($query) use ($cond_user) {
                // slugをkeywordで検索
                $query->where(‘name’, ‘like’, ‘%’.$cond_user.‘%’);
            })->get();
        } else {
            // それ以外はすべてのレポートを取得する
            $posts = Report::all();
        }
        return view('admin.report.index', ['posts' => $posts, 'cond_user' => $cond_user]);
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
    //新規レポート更新処理（post）
    public function create(Request $request)
    {
        $report = new report;
        $form = $request->all();
        unset($form['_token']);
        // データベースに保存する
        //↓ログインしているユーザーの情報を登録情報に追加している。
        $form['user_id'] = Auth::id();
        $report->fill($form);
        $report->save();
        //更新ボタンを押したらreport/mypage（自分のレポート一覧みれるページ）にリダイレクトする・mypage新規で作る必要あり
        return redirect('report/mypage');
    }
    //新規レポート投稿画面（get）
    public function add(Request $request)
    {
        return view('admin.report.create');
    }
    public function showMypage(Request $request)
    {
        //Auth::userで登録されているユーザー情報全て取ってくる（アドレスとかも）
        $your_account = Auth::user();
        //↓たくさんのユーザーIDに紐づいているレポートの中から、自分のIDのものを引っ張ってくる
        $reports = Report::where('user_id', Auth::id())->get();
        return view('admin.report.myPage', ['your_account' => $your_account, 'reports' => $reports]);
    }
    //レポート編集画面
    public function edit(Request $request)
    {
        $report = Report::find($request->id);
        dd($report);
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
        unset($report_form['report']);
        $report->fill($report_form)->save();
        return redirect('admin/report/mypage');
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
