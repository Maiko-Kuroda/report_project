@extends('layouts.report')
@section('title', 'レポート一覧')
@section('content')
<div class="row">
    <div class="col-md-3 text-center " >
        <a class="btn w-75 btn-outline-secondary" onclick="location.href='/home'" style="	box-shadow: 0px 0px 4px  black;	border-color: #f25042;">レポート一覧</a>
    </div>
</div>
<!-- <div class="row">
    <div class="col-md-3 text-center pt-2">
        <a class="btn w-75 btn-outline-secondary" onclick="location.href='/group/add'" style="box-shadow: 0px 0px 4px  black;	border-color: #716040;">Add more room</a>
    </div>
</div> -->

<div class="container">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <h2 class="head_test">my page</h2>
            <form action="{{action('Admin\ReportController@add')}}" method="get">
            {{-- 新規登録 --}}
                @if (count($errors) > 0)
                <ul>
                    @foreach($errors->all() as $e)
                    <li>{{ $e }}</li>
                    @endforeach
                </ul>
                @endif
                <div class="form-group row">
                    <div class="col-md-12 text-center">
                    <img src="{{ asset('storage/image/' . $your_account->photo) }}" style="width: 50%">
                    </div>
                </div>
                {{-- 新規登録 --}}
                <div class="form-group row">
                    <div class="col-md-10 offset-md-1">
                        <!-- <input type="hidden" name="id" value="{{-- $report->id --}}"> -->
                        <!-- ↑いらない。新規投稿だったらidに紐付ける必要なし -->
                        <a href="/report/add" input type="button" class="button-3">新規投稿</a>
                    </div>
                </div>
                @foreach($reports as $report)

                <div class="form-group row">
                    <!-- <label class="col-md-2" for="report">●</label> -->
                    <div class="col-md-10 offset-md-1">
                        <div class="box26">
                            <!-- <div class="card body"> -->
                                <p span class="box-title">{{date_format(date_create($report->update_at), 'Y-m-d')}}</p>
                                <h5><p>{{$report->report}}</p></h5>
                                <!-- ↓編集画面に移動 -->
                                <a href="/report/edit?id={{$report->id}}" class="card-link">編集</a>                            
                            <!-- </div> -->
                        </div>

                    
                    </div>
                </div>
                
                @endforeach
                
            </form>
        </div>
    </div>
</div>
@endsection
