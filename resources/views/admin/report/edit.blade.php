@extends('layouts.report')
@section('title', 'レポートの編集')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <h2>今日、どうでした？</h2>
            <form action="{{action('Admin\ReportController@update')}}" method="post" enctype="multipart/form-data">
                @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
               
                <div class="from-group row">
                    <label class="col-md-2" for="hobby"></label>
                     <div class="col-md-20">
                         <input type="text" class="form-control" name="report" value="{{ $your_report->report }}">
                     </div>
                </div>
               

               <div class="form-group row">
                   <div class="col-md-10">
                       <input type="hidden" name="id" value="{{ $your_account->id }}">
                       {{ csrf_field() }}
                       <input type="submit" class="btn btn-primary" value="投稿">
                   </div>
               </div>
            </form>
        </div>
    </div>
</div>
@endsection