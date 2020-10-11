@extends('layouts.group')
@section('title', 'Join room')
@section('content')
<div class="container">
    <div class="page-top">
        <div class="row">
            <h2>レポートを投稿しよう</h2>
        </div>
        <div class="row">
            <div class="col-md-8">
                <form action="{{ action('Admin\GroupController@login') }}" method="get">
                    <div class="form-group row">
                        <label class="col-md-2">Welcome!</label>
                          
                        <div class="col-md-2-button2">
                            <div class="row">
                                <a href="{{ action('Admin\ReportController@showMypage') }}" input type="button" class="button-3">こちら！</a>
                            </div>   
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection