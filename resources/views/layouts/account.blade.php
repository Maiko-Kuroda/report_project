<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
         {{-- 後の章で説明します --}}
        <meta name="csrf-token" content="{{ csrf_token() }}">

        {{-- 各ページごとにtitleタグを入れるために@yieldで空けておきます。 --}}
        <title>@yield('title')</title>

        <!-- Scripts -->
         {{-- Laravel標準で用意されているJavascriptを読み込みます --}}
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Lato:400,700|Noto+Sans+JP:400,700" rel="stylesheet">

        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <!-- Styles -->
        {{-- Laravel標準で用意されているCSSを読み込みます --}}
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        {{-- この章の後半で作成するCSSを読み込みます --}}
        <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    </head>
    <body>
        <div id="app">
            {{-- 画面上部に表示するナビゲーションバーです。 --}}
            <header class="navbar-laravel">
            <!-- <div class="container d-flex justify-content-between">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a> -->
                <!-- <nav class="navbar navbar-default">
                    <a type="button" class="navbar-toggle" data-toggle="collapse" data-target="#defaultNavbar">
                        <span class="material-icons h1">child_care</span>
                    </a>
                    <div class="collapse navbar-collapse" id="defaultNavbar" >
                        <ul class="navbar-nav">
                            <li><a href="/report"><span class="glyphicon glyphicon-picture"></span> report room</a></li>
                            <li><a href="/user"><span class="glyphicon glyphicon-picture"></span> my page</a></li>
                            <li><a href="/user/index"><span class="glyphicon glyphicon-credit-card"></span> user index</a></li>
                            <li><a href="#" class="dropdown-toggle" data-toggle="dropdown">chenge room<b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">グループ１</a></li>
                                    <li><a href="#">グループ2</a></li>
                                    <li><a href="#">グループ3</a></li>
                                </ul>
                            </li>      
                            <li><a href="/group/welcome"><span class="glyphicon glyphicon-credit-card"></span> group top</a></li>
                            <li><a href="artist_logout.php"><span class="glyphicon glyphicon-off"></span> log out</a></li>
                        </ul>          
                    </div> 
                </nav>  -->
                <div class="fixed-top">
                    <nav class="navbar navbar-dark bg-dark">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                    </nav>
                    <div class="collapse" id="navbarToggleExternalContent">
                        <div class="bg-dark p-4">
                            <ul class="navbar-nav">
                                <li><a href="/report"><span class="glyphicon glyphicon-picture"></span> report room</a></li>
                                <li><a href="/user"><span class="glyphicon glyphicon-picture"></span> my page</a></li>
                                <li><a href="/user/index"><span class="glyphicon glyphicon-credit-card"></span> user index</a></li>
                                <!-- <li><a href="#" class="dropdown-toggle" data-toggle="dropdown">chenge room<b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">グループ１</a></li>
                                        <li><a href="#">グループ2</a></li>
                                        <li><a href="#">グループ3</a></li>
                                    </ul>
                                </li>       -->
                                <li><a href="artist_logout.php"><span class="glyphicon glyphicon-off"></span> log out</a></li>
                            </ul>          
                        </div>
                    </div>
                </div>
            </div>
        </header>
            @section('content') 
            {{-- ここまでナビゲーションバー --}}

            <main class="py-4">
                {{-- コンテンツをここに入れるため、@yieldで空けておきます。 --}}
                @yield('content')
            </main>
        </div>
    </body>
</html>