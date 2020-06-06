@extends('layouts.report')
@section('title', 'レポート')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <h2>レポート</h2>
            <form action="{{action('Admin\ProfileController@yourReport')}}" method="get">
                @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                <div class="form-group row">
                    <label class="col-md-2" for="name">レポート</label>
                     <div class="col-md-10">
                        <p>{{$your_report->name}}</p>
                     </div>
                </div>
                <div class="form-group row">
                     <label class="col-md-2" for="email">メール</label>
                     <div class="col-md-10">
                         <p>{{$your_account->email}}</p>
                     </div>
                </div>
                <div class="from-group row">
                    <label class="col-md-2" for="group_name">所属グループ</label>
                     <div class="col-md-10">
                     <p>{{$your_account->hobby}}</p>
                     </div>
                </div>
                <div class="from-group row">
                    <label class="col-md-2" for="hobby">趣味</label>
                     <div class="col-md-10">
                     <p>{{$your_account->hobby}}</p>
                     </div>
                </div>
                <div class="form-group row">
                   <div class="col-md-10">
                       <input type="hidden" name="id" value="{{ $your_account->id }}">
                       {{ csrf_field() }}
                       <input type="button" onclick="location.href='./user/edit'" value="編集する">
                   </div>
               </div>



            </form>
        </div>
    </div>
</div>
@endsection
