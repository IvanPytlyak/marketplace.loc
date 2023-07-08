<!doctype html>
<html lang="ru">
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
    <link href="/css/background.css" rel="stylesheet"> 
</head>
<body>
    <img src="../storage/background/fone.jpg" alt="" id="window_background">
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="{{route('index')}}">Рыбное место</a>
                </div>
                <div id="navbar" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        {{-- <li @if (Route::currentRouteNamed('index')) class="active" @endif><a href="{{route('index')}}">Все товары</a></li> --}}
                        {{-- <li @if (Route::currentRouteNamed('categor*')) class="active" @endif><a href="{{route('categories')}}">Категории</a></li>
                        <li @if (Route::currentRouteNamed('basket')) class="active" @endif><a href="{{route('basket')}}">В корзину</a></li> --}}
                        {{-- AppServiceProvider @routeactive --}}
                        <li @routeactive('index')><a href="{{route('index')}}">Все товары</a></li>
                        <li @routeactive('categor*')><a href="{{route('categories')}}">Категории</a></li>
                        <li @routeactive('basket')><a href="{{route('basket')}}">В корзину</a></li>
                    
                        <li><a href="{{route('reset')}}">Сбросить проект в начальное состояние</a></li>
                        <li><a href="{{route('reviews_create')}}">Отзывы</a></li>
                        {{-- <li><a href="{{route('reviews_create')}}">TG</a></li> --}}
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        @guest
                            <li><a href="{{route('login')}}">Войти</a></li>
                            <li><a href="{{route('register')}}">Зарегестрироваться</a></li>
                        @endguest
                        @auth
                        @admin
                            <li><a href="{{route('home')}}">Панель администратора</a></li>
                        @else
                            <li><a href="{{route('person.orders.index')}}">Мои заказы</a></li> 
                            {{-- as => person. web.php--}}
                        @endadmin
                            
                            <li><a href="{{route('get-logout')}}">Выйти</a></li>
                        @endauth         
                    </ul>
                </div>
            </div>
        </nav>

            <div class="container">
                <div class="starter-template">
                    @if (session()->has('success'))
                    <p class="alert alert-success">{{session()->get('success')}}</p>
                    @endif
                    @if (session()->has('warning'))
                    <p class="alert alert-warning">{{session()->get('warning')}}</p>
                    @endif
            
                    @yield('content')
            </div>
          @include('telegram')
        </div>
</body>
</html>
