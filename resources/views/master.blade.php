<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Интернет Магазин: @yield('title')</title>

    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <script src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/starter-template.css" rel="stylesheet">
    <link href="/css/mycss.css" rel="stylesheet">
</head>

<body>
    {{-- <div id="window_background"> --}}
        <img src="/public/storage/background/vivid-blurred-colorful-background.jpg" alt="" id="window_background">
        <nav id="color_switch" class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                    <div class="navbar-header">
                        <a id="color_switch" class="navbar-brand" href="{{route('index')}}">Интернет Магазин</a>
                    </div>
                    <div id="navbar" class="collapse navbar-collapse">
                        <ul class="nav navbar-nav">
                            <li @routeactive('index')><a href="{{route('index')}}">Все товары</a></li>
                            {{-- <li @if (Route::currentRouteNamed('categor*')) class="active" @endif ><a href="{{route('categories')}}">Категории</a> --}}
                                {{-- AppserverProvaider-  --}}
                                <li @routeactive('categor*') ><a href="{{route('categories')}}">Категории</a>
                                    {{-- @routeactive определен в app/providers/AppserviceProvider  str 29 --}}
                            </li>
                            <li @routeactive('basket*')><a href="{{route('basket')}}">В корзину</a></li>
                            <li><a href="{{route('reset')}}">Сбросить проект в начальное состояние</a></li>


                            {{-- <li><a href="http://marketplace.loc/locale/en">en</a></li> --}}

                            {{-- <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">BYN<span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">BYN</a></li>
                                    <li><a href="#">$</a></li>
                                    <li><a href="#">€</a></li>
                                </ul>
                            </li> --}}
                        </ul>

                        <ul class="nav navbar-nav navbar-right">
                            @guest    
                                <li><a href="{{route('login')}}">Войти</a></li>
                            @endguest

                            @auth   
                            @admin
                                <li><a href="{{route('home')}}">Панель администратора</a></li>
                            @else
                                <li><a href="{{route('person.orders.index')}}">Мои заказы</a></li>
                                {{-- person prefix в роутах, из-за дубля имени роута --}}
                            @endadmin
                                <li><a href="{{route('get-logout')}}">Выйти</a></li>
                            @endauth
                        </ul>
                    </div>
                </div>
        </nav>

            <div class="container">
                <div class="starter-template">
                        @if(session()->has('success')) 
                            <p class="alert alert-success">{{session()->get('success')}}</p>
                        @endif
                        @if (session()->has('warning'))
                        <p class="alert alert-warning">{{session()->get('warning')}}</p>         
                        @endif
                    @yield('content')
                </div>
            </div>
    
</body>

</html>