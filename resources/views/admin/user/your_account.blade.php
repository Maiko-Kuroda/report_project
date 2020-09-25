@extends('layouts.account')
@section('title', 'アカウント')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-pb-3 mx-auto">
            <h2 class="head_test">プロフィール</h2>
            <form action="{{action('Admin\UserController@yourAccount')}}" method="get">
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
                <div class="py0">
                    <div class="row">
                        <div class="col-md-10 offset-md-1">
                            <div class="box26">
                                <p span class="box-title"> name </p>
                                <h5>
                                    <p>{{$your_account->name}}</p>
                                </h5>
                            </div>
                        </div>
                    </div>
                    <div class="py0">
                        <div class="row">
                            <div class="col-md-10 offset-md-1">
                                <div class="box26">
                                    <p span class="box-title"> mail </p>
                                    <h5>
                                        <p>{{$your_account->email}}</p>
                                    </h5>
                                </div>
                            </div>
                        </div>
                        <div class="py0">
                            <div class="row">
                                <div class="col-md-10 offset-md-1">
                                    <div class="box26">
                                        <p span class="box-title"> group </p>
                                        @foreach($groups as $group)
                                            <p>{{$group->name}}</p>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="py0">
                                <div class="row">
                                    <div class="col-md-10 offset-md-1">
                                        <div class="box26">
                                            <p span class="box-title"> hobby </p>
                                            <p>{{$your_account->hobby}}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12 offset-md-1">
                                        <input type="hidden" name="id" value="{{ $your_account->id }}">
                                        {{ csrf_field() }}
                                        <input type="button" class="button" onclick="location.href='./user/edit'"
                                            value="編集する">
                                    </div>
                                </div>
            </form>
        </div>
    </div>
</div>
@endsection