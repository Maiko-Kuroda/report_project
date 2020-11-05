@extends('layouts.group')
@section('title', 'グループ名の編集')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <h2>グループ名の変更</h2>
            <form action="{{action('Admin\GroupController@update')}}" method="post" enctype="multipart/form-data">
                @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                <div class="from-group row">
                    <label class="col-md-2" for="report">グループ</label>
                     <div class="col-md-10">
                     <input type="text" class="form-control" name="name" value="{{ $group->name }}">
                     </div>
                </div>
               <div class="form-group row">
                   <div class="col-md-10">
                       <input type="hidden" name="id" value="{{ $group->id }}">
                       {{ csrf_field() }}
                       <input type="submit" class="button-2" value="更新">
                   </div>
               </div>
            </form>
        </div>
    </div>
</div>
@endsection