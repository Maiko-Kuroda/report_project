@extends('layouts.report')
@section('title', 'レポートの投稿')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <h2>今日、どうでした？</h2>
            <form action="{{action('Admin\ReportController@add')}}" method="post" enctype="multipart/form-data">
                @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
               
                <div class="from-group row">
                    <label class="col-md-2" for="report">今日、どうでした？</label>
                    <div class="col-md-20">
                        <textarea class="form-control" name="report" rows="20">{{ old('report') }}</textarea>
                    </div> 
                </div>
               

               <div class="form-group row">
                   <div class="col-md-10">
                       {{ csrf_field() }}
                       <input type="submit" class="btn btn-primary" value="投稿">
                   </div>
               </div>
            </form>
        </div>
    </div>
</div>
@endsection