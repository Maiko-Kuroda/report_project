@extends('layouts.account')
@section('title', 'アカウント')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <h2>プロフィール</h2>
            <form action="{{action('Admin\UserController@yourAccount')}}" method="get">
                @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif

                <div class="form-group row">
        
                    <div class="col-md-10">
                       <img src="{{ asset('storage/image/' . $your_account->photo) }}" style="width: 40%" >
                    </div>
                </div>
                <div class="py0">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="card">
                                    <div class="card-header" > name </div>
                                        <div class="card-body">
                                            <blockquote class="blockquote mb-0">
                                                <p>{{$your_account->name}}</p>
                                            </blockquote>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="py0">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="card">
                                    <div class="card-header" > mail </div>
                                        <div class="card-body">
                                            <blockquote class="blockquote mb-0">
                                                <p>{{$your_account->email}}</p>
                                            </blockquote>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="py0">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="card">
                                    <div class="card-header" > group </div>
                                        <div class="card-body">
                                            <blockquote class="blockquote mb-0">
                                                <p>{{$your_account->group_name}}</p>
                                            </blockquote>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="py0">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="card">
                                    <div class="card-header" > hobby </div>
                                        <div class="card-body">
                                            <blockquote class="blockquote mb-0">
                                                <p>{{$your_account->hobby}}</p>
                                            </blockquote>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <div class="form-group row">
                   <div class="col-md-10">
                       <input type="hidden" name="id" value="{{ $your_account->id }}">
                       {{ csrf_field() }}
                       <input type="button" class="button" onclick="location.href='./user/edit'" value="編集する">
                   </div>
               </div>
            </form>
        </div>
    </div>
</div>
@endsection