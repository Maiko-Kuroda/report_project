@extends('layouts.account')
@section('title', 'アカウント')
@section('content')

<nav class="navbar navbar-default">
  <div class="container-fluid"> 

    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#defaultNavbar1"><span class="sr-only">MENU</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
    </div>

    <div class="collapse navbar-collapse" id="defaultNavbar1" >
      <ul class="nav navbar-nav">
        <li><a href="/report"><span class="glyphicon glyphicon-picture"></span> report room</a></li>
        <li><a href="./user/index"><span class="glyphicon glyphicon-credit-card"></span> user index</a></li>
        <li><a href="#" class="dropdown-toggle" data-toggle="dropdown">chenge room<b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li><a href="#">グループ１</a></li>
                <li><a href="#">グループ2</a></li>
                <li><a href="#">グループ3</a></li>
            </ul>
        </li>      
        <li><a href="./group/welcome"><span class="glyphicon glyphicon-credit-card"></span> group top</a></li>
        <li><a href="artist_logout.php"><span class="glyphicon glyphicon-off"></span> log out</a></li>
      </ul>          
    </div>
    <!-- /.navbar-collapse --> 
  </div>
  <!-- /.container-fluid --> 
</nav>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-pb-3 mx-auto">


        
            <h2 class="head_test">プロフィール</h2>
            <form action="{{action('Admin\UserController@yourAccount')}}" method="get">
                @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif

                <div class="form-group row">
        

                    <div class="col-md-12 text-center">
                       <img src="{{ asset('storage/image/' . $your_account->photo) }}" style="width: 50%" >
                    </div>
                </div>
                <div class="py0">
                    <div class="row">
                        <div class="col-md-10 offset-md-1">
                            <div class="box26">
                                <p span class="box-title"> name </p>
                                <h5><p>{{$your_account->name}}</p></h5>                                
                            </div>
                        </div>
                    </div>
                    <div class="py0">
                    <div class="row">
                        <div class="col-md-10 offset-md-1">
                            <div class="box26">
                                <p span class="box-title"> mail </p>
                                <h5><p>{{$your_account->email}}</p></h5>
                            </div>
                        </div>
                    </div>
                    <div class="py0">
                    <div class="row">
                        <div class="col-md-10 offset-md-1">
                            <div class="box26">
                                <p span class="box-title"> group </p>
                                  
                                <p>{{$your_account->group_name}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="py0">
                    <div class="row">
                        <div class="col-md-10 offset-md-1">
                            <div class="box26">
                                <p span class="box-title"> hobby </p>        
                                <p>{{$your_account->hobby}}</p>
                            </div>
                        </div>
                    </div>
                <div class="form-group row">
                   <div class="col-md-12 offset-md-1">
                       <input type="hidden" name="id" value="{{ $your_account->id }}">
                       {{ csrf_field() }}
                       <input type="button" class="button" onclick="location.href='./user/edit'" value="編集する">
                   </div>
               </div>
            </form>
        </div>
    </div>
</div>
@endsection