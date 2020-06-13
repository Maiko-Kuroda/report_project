@extends('layouts.report')
@section('title', 'レポート')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <h2>レポート</h2>
            <form action="{{action('Admin\ReportController@yourReport')}}" method="post">
                @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                <div class="form-group row">
                    <label class="col-md-2" for="report">レポート</label>
                     <div class="col-md-10">
                        <p>{{$report->name}}</p>
                     </div>
                </div>
               
                <div class="form-group row">
                   <div class="col-md-10">
                       <input type="hidden" name="id" value="{{ $report->id }}">
                       {{ csrf_field() }}
                       <input type="button" onclick="location.href='./report/edit'" value="＋">
                   </div>
               </div>



            </form>
        </div>
    </div>
</div>
@endsection
