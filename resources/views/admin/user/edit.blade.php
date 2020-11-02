@extends('layouts.account')
@section('title', 'プロフィールの編集')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <h2>プロフィール</h2>
            <form action="{{action('Admin\UserController@update')}}" method="post" enctype="multipart/form-data">
                @if (count($errors) > 0)
                    <ul>
                        @foreach($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                @endif
                <div class="form-group row">
                    <label class="col-md-2" for="name">名前</label>
                     <div class="col-md-10">
                         <input type="text" class="form-control" name="name" value="{{ $your_account->name }}">
                     </div>
                </div>
                <div class="form-group row">
                     <label class="col-md-2" for="email">メール</label>
                     <div class="col-md-10">
                         <input type="text" class="form-control" name="email" value="{{ $your_account->email }}">
                     </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2" for="group_name">所属グループ</label>
                     <div class="col-md-10">
                        <select multiple name="groups[]" size="5">
                            @foreach($groups as $group)
                                @php
                                    $isSelect = false;
                                    foreach ($user_groups as $user_group) {
                                        if($user_group->id === $group->id){
                                            $isSelect = true;
                                            break;
                                        }
                                    }
                                @endphp
                                <option value="{{ $group->id }}" @if($isSelect === true) selected @endif>{{$group->name}}</option>
                            @endforeach
                        </select>
                         <!-- <input type="text" class="form-control" name="group_name" value="{{ $your_account->group_name }}"> -->
                     </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2" for="hobby">趣味</label>
                     <div class="col-md-10">
                         <input type="text" class="form-control" name="hobby" value="{{ $your_account->hobby }}">
                     </div>
                </div>
                <div class="form-group2 row">
                        <label class="col-md-2" for="photo">画像</label>
                        <div class="col-md-10">
                            <input type="file" class="form-control-file" name="photo">
                        </div>
                        
                </div>
               <div class="form-group row">
                   <div class="col-md-10">
                       <input type="hidden" name="id" value="{{ $your_account->id }}">
                       {{ csrf_field() }}
                       <input type="submit" class="btn btn-primary" value="更新">
                   </div>
               </div>
            </form>
        </div>
    </div>
</div>
@endsection