<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    // 一覧表示
    public function index()
    {
        //
    }

    //新規レポート入力画面
    public function create()
    {
        //
    }

    //新規レポート投稿画面
    public function add(Request $request)
    {
        return view('admin.report.create');
    }

    //レポート編集画面
    public function edit(Request $request)
    {
        return view('admin.report.edit');
    }

    //レポート削除処理
    public function delete(Request $request)
    {
        $report = Reports::find($request->id);
        //削除
        $report->delete();
        return redirect('admin/report/');
    }
    
}
