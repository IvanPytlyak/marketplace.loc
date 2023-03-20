<div class="col-sm-6 col-md-4">
    <div class="thumbnail">
        <!-- <div class="labels">
        </div> -->
        <img src="http://internet-shop.tmweb.ru/storage/products/iphone_5.jpg" alt="iPhone 5SE">
        <div class="caption">
            <h3>{{$product->name}}</h3>
            <p>{{$product->price}}</p>
            <p>
            <form action="{{route('basket')}}" method="POST">
                <button type="submit" class="btn btn-primary" role="button">В корзину</button>
                <!-- {{$product->getCategory()->name}} -->
                <!-- {{$product->category->name}} -->
                <!--category отсюда  Product.php return $this->belongsTo(Category::class); -->
                <a href="{{route('product', [$product->category->code, $product->code])}}" class="btn btn-default" role="button">Подробнее</a>
            </form>
            </p>
        </div>
    </div>
</div>