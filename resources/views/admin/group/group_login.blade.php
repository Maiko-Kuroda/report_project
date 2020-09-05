@extends('layouts.group')
@section('title', 'Join room')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <h2>room name</h2>
            <form action="{{action('Admin\GroupController@enter')}}" method="post" enctype="multipart/group_form-data"
                class="create-group-form">
                @if (count($errors) > 0)
                <ul>
                    @foreach($errors->all() as $e)
                    <li>{{ $e }}</li>
                    @endforeach
                </ul>
                @endif
                <div class="from-group row">
                    <div class="col-md-10">
                    <textarea class="form-control group-textarea" name="group"
                        rows="20">{{ old('group') }}</textarea>
                    </div>
                </div>
                
                <div class="form-group row">
                    <div class="col-md-10">
                        {{ csrf_field() }}
                        <input type="submit" class="button-2" 
                        onclick="location.href='/report'" value="Enter" class="click-form">
                    </div>
                </div>
            </form>
            
        </div>
    </div>
</div>
@endsection