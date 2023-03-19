<div class="col-sm-6 col-md-4">
    <div class="thumbnail">
        <div class="labels">
        </div>
        <img src="http://internet-shop.tmweb.ru/storage/products/iphone_5.jpg" alt="iPhone 5SE">
        <div class="caption">
            <h3>iPhone 5SE</h3>
            <p>17221 ₽</p>
            <p>
            <form action="{{route('basket')}}" method="POST">
                <button type="submit" class="btn btn-primary" role="button">В корзину</button>
                @isset($category)
                {{$category->name}}
                @endisset
                <a href=" https://internet-shop.tmweb.ru/mobiles/iphone_5se" class="btn btn-default" role="button">Подробнее</a>
                <input type="hidden" name="_token" value="0KxwZ7HpPxw3G7PiTxs34sxOEa3Yscv2l2EvcDYM">
            </form>
            </p>
        </div>
    </div>
</div>