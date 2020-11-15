@extends('layouts.admin')
@section('title', 'Welcome')
@section('content')

<div class="container">
    <div class="row">
    <div class="col-md-8 col-pb-3 mx-auto">
        <h2 class="head_test">Welcome</h2>
    </div>
    <!-- <div class="row">
        <div class="col-md-10 text-center pt-5 offset-1" >
            <a class="btn w-75 btn-outline-secondary" onclick="location.href='./login'" style="	box-shadow: 0px 0px 4px  black;	border-color: #f25042;">Join room</a>
        </div>
    </div> -->
    <div class="row">
        <div class="col-md-10 text-center offset-1">
            <a class="btn w-75 btn-outline-secondary" onclick="location.href='./add'" style="box-shadow: 0px 0px 4px  black;	border-color: #716040;">グループ新規作成</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-10 text-center offset-1">
            <a class="btn w-75 btn-outline-secondary" onclick="location.href='./index'" style="box-shadow: 0px 0px 4px  black;	border-color: #716040;">グループ編集</a>
        </div>
    </div>

    
</div>
@endsection
