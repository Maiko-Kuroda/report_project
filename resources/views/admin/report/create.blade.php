@extends('layouts.report')
@section('title', 'レポートの投稿')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <h2>今日、どうでした？</h2>
            <form action="{{action('Admin\ReportController@create')}}" method="post" enctype="multipart/form-data"
                class="create-report-form">
                @if (count($errors) > 0)
                <ul>
                    @foreach($errors->all() as $e)
                    <li>{{ $e }}</li>
                    @endforeach
                </ul>
                @endif
                <div class="from-group row">
                    <div class="col-md-10">
                    <textarea class="form-control report-textarea" name="report"
                        rows="20">{{ old('report') }}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-10">
                        {{ csrf_field() }}
                        <input type="submit" class="btn btn-primary" value="投稿" class="click-form">
                    </div>
                </div>
            </form>
            
        </div>
    </div>
</div>
@endsection