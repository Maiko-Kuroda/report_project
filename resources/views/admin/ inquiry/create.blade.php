@extends('layouts.report')
@section('title', '問合せ内容の投稿')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <h2>お問合わせ内容</h2>
            <form action="{{action('Admin\InquiryController@create')}}" method="post" enctype="multipart/form-data"
                class="create-report-form">
                
                @if (count($errors) > 0)
                <ul>
                    @foreach($errors->all() as $e)
                    <li>{{ $e }}</li>
                    @endforeach
                </ul>
                @endif
                <div class="from-group row">
                    <div class="col-md-5">
                    <textarea class="form-control inquiry-titlearea" name="title"
                        rows="20">{{ old('title') }}</textarea>
                    </div>
                </div>

                <div class="from-group row">
                    <div class="col-md-10">
                    <textarea class="form-control inquiry-textarea" name="inquiry"
                        rows="20">{{ old('inquiry') }}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-10">
                        {{ csrf_field() }}
                        <input type="submit" class="button-2" value="投稿" class="click-form">
                    
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection