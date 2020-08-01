@extends('layouts.admin')
@section('title', 'レポート一覧')

@section('content')
    <div class="container">
        <div class="row">
            <h2>レポート一覧</h2>
        </div>
        <div class="row">
            <div class="col-md-4">
                <a href="{{ action('Admin\ReportController@add') }}" role="button" class="btn btn-primary">＋</a>
            </div>
            <div class="col-md-8">
                <form action="{{ action('Admin\ReportController@index') }}" method="get">
                    <div class="form-group row">
                        <label class="col-md-2">ユーザー</label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" name="cond_user" value={{ $cond_user }}>
                        </div>
                        <div class="col-md-2">
                            {{ csrf_field() }}
                            <input type="submit" class="btn btn-primary" value="検索">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="admin-report col-md-12 mx-auto">
                <div class="row">
                <table class="table">
                        <thead>
                            <tr class="table-warning">
                                
                                <th width="10%">ID</th>
                                <th width="10%">更新日時</th>
                                <th width="50%">メンバー</th>
                                <th width="30%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($posts as $report)
                                <tr>
                                    <!-- <th>{{ $report->id }}</th> -->
                                    <th>{{ date_format(date_create($report->update_at), 'Y-m-d') }}</th>
                                    <td>{{ $report->user->name }}</td>
                                    <td>{{ $report->report }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
<!-- <table class="table">
  <thead>
    <tr>
      <th>#</th>
      <th>First Name</th>
      <th>Last Name</th>
    </tr>
  </thead>
  <tbody>
    <tr class="table-warning">
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
    </tr>
  </tbody>
</table> -->



                </div>
            </div>
        </div>
    </div>
@endsection