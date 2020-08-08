@extends('layouts.admin')
@section('title', 'レポート一覧')

@section('content')
    <div class="container">
        <div class="page-top">
            <div class="row">
                <h2>レポート一覧</h2>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <form action="{{ action('Admin\ReportController@index') }}" method="get">
                        <div class="form-group row">
                            <label class="col-md-2">ユーザー</label>
                            
                            <div class="col-md-5">
                                <div class="input-group">
                                    {{ csrf_field() }}
                                    <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="User Search">
                                     <div class="input-group-append">
                                        <input type="submit" class="btn btn-primary" value="検索">                                     </div>
                                </div>
                                <!-- <input type="text" class="form-control" name="cond_user" value={{ $cond_user }}> -->
                            </div>  
                            <div class="col-md-2-button2">
                                <!-- <div class="row">
                                    {{ csrf_field() }}
                                    <input type="submit" class="button-2" value="検索">
                                </div> -->
                                <div class="row">
                                    <a href="{{ action('Admin\ReportController@add') }}" input type="button" class="button-3">新規投稿</a>
                                </div>   
                            </div>
                        </div>
                    </form>
                </div>
                <!-- <div class="col-md-4">

                </div> -->
            </div>
        </div>

        <div class="row">
            <div class="admin-report col-md-12 mx-auto">
                <div class="row">
                <table class="table">
                        <thead>
                            <tr class="table-warning">
                                
                                <th width="10%"></th>
                                <th width="20%">更新日時</th>
                                <th width="40%">メンバー</th>
                                <th width="40%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($posts as $report)
                                <tr>
                                    <!-- <th>{{ $report->id }}</th> -->
                                    <th></th>
                                    <th>{{ date_format(date_create($report->update_at), 'Y-m-d') }}</th>
                                    <td>{{ $report->user->name }}</td>
                                    <td>{{ $report->report }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection