@extends('layouts.admin')
@section('title', 'レポート一覧')
@section('content')

    <div class="container">
        <div class="page-top">
            <div class="row">
                <h2>レポート一覧</h2>
            </div>
        </div>
            <div class="row">
                <div class="col-md-8">
                    <form action="{{ action('Admin\ReportController@index') }}" method="get">
                        @csrf
                        <div class="form-group row">
                            <div class="col-sm-10">
                                <div class="text-center my-5">
                                    
                                </div>                       
                                <label class="col-md-2">グループ,ユーザー検索</label>
                                <div class="col-md-5">
                                    <select class="" name="group">
                                    <option value="-1">指定なし</option>
                                        @foreach($groups as $group)
                                        <option value="{{$group->id}}">{{$group->name}}</option>
                                        @endforeach
                                    </select>
                                    <div class="input-group">
                                        {{ csrf_field() }}
                                        <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="User Search" name="cond_user">
                                        <div class="input-group-append">
                                            <input type="submit" class="btn btn-primary" value="検索">                                     
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>        
                    <div class="col-md-2-button2">
                        <div class="row">
                            <a href="{{ action('Admin\ReportController@add') }}" input type="button" class="button-3">新規投稿</a>
                        </div>   
                    </div> 
                </div>
            </div>
        </div>

        <div class="row">
            <div class="admin-report col-md-12 mx-auto">
                <div class="row">
                <table class="table member-table">
                        <thead>
                            <tr class="table-warning">
                                <th width="10%"></th>
                                <th width="15%">更新日時</th>
                                <th width="10%">メンバー</th>
                                <th width="10%">グループ</th>
                                <th width="40%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($posts as $report)
                                <tr>
                                    <th></th>
                                    <th>{{ date_format(date_create($report->update_at), 'Y-m-d') }}</th>
                                    <td>{{ $report->user->name }}</td>
                                    <td>{{ $report->group->name }}</td>
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