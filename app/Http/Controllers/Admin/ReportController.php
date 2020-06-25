<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Report;
class ReportController extends Controller
{
    // 一覧表示
    public function index()
    {
        //
    }

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
        return view('admin.report.mypage', ['your_account' => $your_account, 'reports' => $reports]);
    }
    
    public function update(Request $request)
    {
        $this->validate($request, Reports::$request);
        $report = Report::find($request->id);

        unset($report_form['_token']);
        unset($report_form['remove']);
        $report->fill($report_form)->save();

        $history = new History;
        $history->new_id = $report->id;


    }
    
    //レポート編集画面
    public function edit(Request $request)
    {
        $report = Report::find($request->id);
        return view('admin.report.edit', ['report' => $report]);
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
