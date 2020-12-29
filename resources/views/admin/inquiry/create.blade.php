@extends('layouts.report')
@section('title', 'contact')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <h2>問合せ</h2>
            <form action="{{action('Admin\InquiryController@create')}}" method="post" enctype="multipart/form-data"
                class="create-inquiry-form">
                
                @if (count($errors) > 0)
                <ul>
                    @foreach($errors->all() as $e)
                    <li>{{ $e }}</li>
                    @endforeach
                </ul>
                @endif
                <div class="from-group row">
                    <div class="col-md-3">
                        <p class="h6">件名</p>
                        <input type ="text" name="title"
                        rows="20">{{ old('title') }}
                    </div>
                </div>

                <div class="from-group row">
                    <div class="col-md-10">
                        <p class="h6">内容</p>
                        <textarea rows="10" cols="60" class="form-control inquiry-textarea" name="inquiry"
                        rows="20">{{ old('inquiry') }}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-10">
                        {{ csrf_field() }}
                        <input type="hidden" name="name" value="{{ Auth::user()->name}}">
                        <input type="hidden" name="email" value="{{ Auth::user()->email}}">
                        <input type="submit" class="button-2" value="投稿" class="click-form">
                    
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection