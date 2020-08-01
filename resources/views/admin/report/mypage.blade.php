@extends('layouts.report')
@section('title', 'レポート一覧')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <h2>my page</h2>
            <form action="{{action('Admin\ReportController@add')}}" method="get">
                @if (count($errors) > 0)
                <ul>
                    @foreach($errors->all() as $e)
                    <li>{{ $e }}</li>
                    @endforeach
                </ul>
                @endif
                <div class="form-group row">
                    <div class="col-md-10">
                    <img src="{{ asset('storage/image/' . $your_account->photo) }}" style="width: 40%">
                    </div>
                </div>
                


                @foreach($reports as $report)
                <div class="form-group row">
                    <label class="col-md-2" for="report">●</label>
                    <div class="col-md-10">
                        <p>{{date_format(date_create($report->update_at), 'Y-m-d')}}</p>
                        <p>{{$report->report}}</p>
                        <!-- ↓編集画面に移動 -->
                        <a href="/report/edit?id={{$report->id}}" class="btn btn-secondary">編集</a>
                    </div>
                </div>
                
                @endforeach

                {{-- 新規登録 --}}
                <div class="form-group row">
                    <div class="col-md-10">
                        <input type="hidden" name="id" value="{{ $report->id }}">
                        <a href="/report/add" class="btn btn-secondary">＋</a>
                    </div>
                </div>
               
            </form>
        </div>
    </div>
</div>
@endsection
