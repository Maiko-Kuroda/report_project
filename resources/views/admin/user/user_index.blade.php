@extends('layouts.user_index')
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
    <div class="row justify-content-center">
    <h2 class="head_test">ユーザー一覧</h2>
    <form action="{{action('Admin\UserController@index')}}" method="get">
        <div class="col-md-8">
          @foreach ($all_users as $user)
          <div class="card" style="color: black">
            <div class="card-haeder p-3 w-100 d-flex">
              <img src="{{ asset('storage/image/' . $user->photo) }}" class="rounded-circle" width="50" height="50">
              <div class="ml-5 d-flex flex-column">
                  <p class="mb-0">{{ $user->name }}</p>
                  <a href="{{ url('users/' .$user->id) }}" class="text-secondary">{{ $user->id }}</a>
              </div>
              <div class="d-flex flex-column follow-btn">
                  <span class="userId" data-userid={{ $user->id }}></span>
                  <span class="isFollow" data-isFollow='false'>フォローする</span>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </form>
    </div>
</div>
@endsection