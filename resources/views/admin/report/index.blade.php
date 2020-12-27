@extends('layouts.admin')
@section('title', 'レポート一覧')
@section('content')
    <div class="container">
        <div class="page-top">
            <div class="row" style="margin-top:50px; margin-bottom:50px;">
                <h2>レポート一覧</h2>
            </div>
        </div>
            <div class="row">
                <div class="col-md-12">
                    <form action="{{ action('Admin\ReportController@index') }}" method="get">
                        <div class="form-group row">
                        <label class="col-md-2">グループ & ユーザー検索</label>
                            <div class = "ml-3">
                                <select class="" name="group">
                                    <option value="-1">すべて</option>
                                        @foreach($groups as $group)
                                    <option value="{{$group->id}}">{{$group->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <div class="input-group">
                                    {{ csrf_field() }}
                                    <input type="text" class="form-control" name='cond_user' id="inlineFormInputGroup" placeholder="User Search">
                                     <div class="input-group-append">
                                        <input type="submit" class="btn btn-primary" value="検索">
                                     </div>
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
                                <th width="30%"></th>
                                <th width="5%">💬</th>
                                <th width="5%">❤️</th>
                                <th width="5%"></th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($posts as $report)
                                <tr>
                                    <th></th>
                                    <th>{{ date_format(date_create($report->updated_at), 'Y-m-d') }}</th>
                                    <td>{{ $report->user->name }}</td>
                                    <td>{{ optional($report->group)->name }}</td>
                                    <td>{{ $report->report }}</td>
                                    <td>
                                        <p class="mb-0 text-secondary">{{ count($report->comments) }}</p>
                                    </td>
                                    <td>
                                        <p class="mb-0 text-secondary">{{ count($report->likes) }}</p>
                                    </td>
                                    <td>
                                        <div>
                                            <a href="{{ action('Admin\ReportController@showReport', ['id' => $report->id]) }}">詳細</a>
                                        </div>
                                    </td>
                                    
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection