<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Group;
use App\User;
use App\Report;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller   
{
    // レポート一覧表示
    public function index(Request $request)
    {
        // dd($cond_group);
        $your_account = Auth::user();
        $query = Group::all();
        //ユーザーモデルでユーザー情報をすべて取ってくる
        //$requestのcond_userの値を$cond_userに代入
        $cond_user = $request->cond_user;
        $cond_group = $request->input('group');
        $groups = $your_account->groups;
       
        if (isset($cond_group) && $cond_group != -1) {
            $report = Report::where('group_id', $cond_group);
            
        } else {
            //今自分が属しているグループと一致してるもの（どれでもwhereIn）を引っ張ってくる。
            $group_ids = [];
            foreach ($groups as $g) {
                $group_ids[] = $g->id;
            }
            // dd($group_ids);
            
            $report = Report::whereIn('group_id', $group_ids);
            // dd($report);
            // $report = $report[0];
            // dd($report[1]);
        }
        
        if ($cond_user != '') {
            // 検索されたら検索結果を取得する
            $report = $report->whereHas('user', function ($query) use ($cond_user) {
                // slugをkeywordで検索
                $query->where('name', 'like', '%' . $cond_user . '%');
            });
        }
        // dd($report);
        $posts = $report->orderBy('updated_at', 'desc')->get();
        // dd($posts[0]);
        return view('admin.report.index', ['posts' => $posts, 'cond_user' => $cond_user,'groups' =>$groups,'group'=>$cond_group]);
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
    //新規レポート投稿画面（get）
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