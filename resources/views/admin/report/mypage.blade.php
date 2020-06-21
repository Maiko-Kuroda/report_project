@extends('layouts.report')
@section('title', 'レポート一覧')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <h2>レポート一覧</h2>
            <form action="{{action('Admin\ReportController@add')}}" method="get">
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

                @foreach($reports as $report)
                <div class="form-group row">
                    <label class="col-md-2" for="report">今日のレポート</label>
                     <div class="col-md-10">
                        <p>{{$report->name}}</p>
                     </div>
                </div>
                @endforeach

<!--                
                <div class="form-group row">
                   <div class="col-md-10">
                       <input type="hidden" name="id" value="{{ $report->id }}">
                       {{ csrf_field() }}
                       <input type="button" onclick="location.href='./report/edit'" value="＋">
                   </div>
               </div> -->
                


            </form>
        </div>
    </div>
</div>
@endsection
