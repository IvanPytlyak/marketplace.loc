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
                    <a class="navbar-brand" href="{{route('index')}}">@lang('main.fish_place')</a>
                </div>
                <div id="navbar" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        {{-- <li @if (Route::currentRouteNamed('index')) class="active" @endif><a href="{{route('index')}}">Все товары</a></li> --}}
                        {{-- <li @if (Route::currentRouteNamed('categor*')) class="active" @endif><a href="{{route('categories')}}">Категории</a></li>
                        <li @if (Route::currentRouteNamed('basket')) class="active" @endif><a href="{{route('basket')}}">В корзину</a></li> --}}
                        {{-- AppServiceProvider @routeactive --}}
                        <li @routeactive('index')><a href="{{route('index')}}">@lang('main.all_goods')</a></li>
                        <li @routeactive('categor*')><a href="{{route('categories')}}">@lang('main.categories')</a></li>
                        <li @routeactive('basket')><a href="{{route('basket')}}">@lang('main.add_to_cart')</a></li>
                        <li> <a href="{{route('locale', __('main.set_lang'))}}">@lang('main.set_lang')</a></li>
                    



                        <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
                            Валюта: {{ session('currency', 'BYN') }} <span class="caret"></span> 
                            </a> <ul class="dropdown-menu"> 
                                @foreach (App\Models\Currency::where('date', \Carbon\Carbon::now()->toDateString())->get() as $currency) 
                                {{-- @foreach (App\Classes\CurrencyConversion::getCurrencies() as $currency)  --}}
                                    <li> <a href="{{ route('currency', $currency->code) }}"> {{ $currency->symbol }}              
                            </a></li> 
                                    @endforeach 
                                </ul> 
                                {{-- @dd( session('currencyRate')) --}}
                        </li>
                        
                                          

                        <li><a href="{{route('reset')}}">Сбросить проект</a></li>
                        {{-- <li><a href="{{route('reviews_create')}}">Отзывы</a></li> --}}
                        {{-- <li><a href="{{route('reviews_create')}}">TG</a></li> --}}
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        @guest
                            <li><a href="{{route('login')}}">@lang('main.entry')</a></li>
                            <li><a href="{{route('register')}}">@lang('main.register')</a></li>
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
            
        
        
        
           
</body>
</html>
