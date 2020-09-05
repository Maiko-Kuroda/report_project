@extends('layouts.group')
@section('title', 'Welcome')

@section('content')

<nav class="navbar navbar-default">
  <div class="container-fluid"> 

    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#defaultNavbar1"><span class="sr-only">MENU</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
    </div>

    <div class="collapse navbar-collapse" id="defaultNavbar1" >
      <ul class="nav navbar-nav">
        <li><a href="/report"><span class="glyphicon glyphicon-picture"></span> report room</a></li>
        <li><a href="./user"><span class="glyphicon glyphicon-picture"></span> my page</a></li>
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
        <h2 class="head_test">Welcome</h2>
    </div>
    <div class="row">
        <div class="col-md-10 text-center pt-5 offset-1" >
            <a class="btn w-75 btn-outline-secondary" onclick="location.href='./login'" style="	box-shadow: 0px 0px 4px  black;	border-color: #f25042;">Join room</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-10 text-center offset-1">
            <a class="btn w-75 btn-outline-secondary" onclick="location.href='./add'" style="box-shadow: 0px 0px 4px  black;	border-color: #716040;">Add more room</a>
        </div>
    </div>
</div>
@endsection
