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
    //新規レポート入力画面
    public function create(Request $request)
    {
      unset($form['_token']);
    // データベースに保存する
        //↓ログインしているユーザーの情報を登録情報に追加している。
      $form['user_id'] = Auth::id();
      $report->fill($form);
      $report->save();
        //更新ボタンを押したらreport/mypage（自分のレポート一覧みれるページ）にリダイレクトする・mypage新規で作る必要あり
      return redirect('admin/report/create');
    }

    //新規レポート投稿画面
    public function add(Request $request)
    {
        return view('admin.report.create');
    }

    //レポート編集画面
    public function edit(Request $request)
    {
        $user = Auth::user();
        $report = Report::find($request->id);
        return view('admin.report.edit',['report' => $report]);

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
