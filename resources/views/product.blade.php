<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Интернет Магазин: Товар</title>

    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <script src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/starter-template.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="https://internet-shop.tmweb.ru">Интернет Магазин</a>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li><a href="https://internet-shop.tmweb.ru">Все товары</a></li>
                    <li><a href="https://internet-shop.tmweb.ru/categories">Категории</a>
                    </li>
                    <li><a href="https://internet-shop.tmweb.ru/basket">В корзину</a></li>
                    <li><a href="https://internet-shop.tmweb.ru/reset">Сбросить проект в начальное состояние</a></li>
                    <li><a href="https://internet-shop.tmweb.ru/locale/en">en</a></li>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">₽<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="https://internet-shop.tmweb.ru/currency/RUB">₽</a></li>
                            <li><a href="https://internet-shop.tmweb.ru/currency/USD">$</a></li>
                            <li><a href="https://internet-shop.tmweb.ru/currency/EUR">€</a></li>
                        </ul>
                    </li>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    <li><a href="https://internet-shop.tmweb.ru/login">Войти</a></li>

                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="starter-template">
            <h1>iPhone X 64GB</h1>
            <h2>{{ $product }}</h2>
            <!-- return view('product', ['product' => $product]); Maincontroller -->
            <h2>Мобильные телефоны</h2>
            <p>Цена: <b>71990 ₽</b></p>
            <img src="http://internet-shop.tmweb.ru/storage/products/iphone_x.jpg">
            <p>Отличный продвинутый телефон с памятью на 64 gb</p>

            <form action="https://internet-shop.tmweb.ru/basket/add/1" method="POST">
                <button type="submit" class="btn btn-success" role="button">Добавить в корзину</button>

                <input type="hidden" name="_token" value="0KxwZ7HpPxw3G7PiTxs34sxOEa3Yscv2l2EvcDYM">
            </form>
        </div>
    </div>
</body>

</html>