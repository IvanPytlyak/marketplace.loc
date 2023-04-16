<div class="col-sm-6 col-md-4">
    <div class="thumbnail">
        <div class="labels">
            @if ($product->isNew())
                <span class="badge badge-success">Новинка</span>
            @endif
            @if ($product->isRecommend())
                <span class="badge badge-warning">Рекомендуемые</span>
            @endif
            @if ($product->isHit())
                <span class="badge badge-danger">Хит продаж</span>
            @endif
        </div>
        <img src="{{Storage::url($product->image)}}" alt="iPhone 5SE">
        {{-- http://internet-shop.tmweb.ru/storage/products/iphone_5.jpg --}}
        <div class="caption">
            <h3>{{$product->name}}</h3>
            <p>{{$product->price}}</p>
            <p>
            <form action="{{route('basket-add', $product->id)}}" method="POST">
                <button type="submit" class="btn btn-primary" role="button">В корзину</button>
                <!-- {{$product->getCategory()->name}} -->
                <!-- {{$product->category->name}} -->
                <!--category отсюда  Product.php return $this->belongsTo(Category::class); -->
                <a href="{{route('product', [$product->category->code, $product->code])}}" class="btn btn-default" role="button">Подробнее</a>
                @csrf
            </form>
            </p>
        </div>
    </div>
</div>