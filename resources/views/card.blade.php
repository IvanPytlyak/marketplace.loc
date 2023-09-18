




<div class="col-sm-6 col-md-4">
    <div min-height="400px" class="thumbnail">
        <div class="labels">
           @if ($product->new === 1)
            <span class="badge badge-success">Новинка</span>
           @endif 
           @if($product->hit === 1)
            <span class="badge badge-danger">Хит</span>
            @endif
            @if ($product->recommend === 1)
            <span class="badge badge-warning">Рекомендуемое</span>
            @endif
        </div>

                <img max-width="300px" max-height="200px" src="{{Storage::url($product->image)}}" alt="{{$product->__('name')}}">
                <div class="caption">

                    {{$product->category->name}}
                    {{-- в данном случае category - это тоже таблица ( итоговая связь таблица->таблица->графа) --}}
         
                    <h3>{{$product->__('name')}}</h3>
                    <p id="price">{{$product->price}} руб.</p> 
                    <p id="currency">{{round($product->price/$usd, 2)}} USD</p> 
                    <p id="currency">{{round($product->price/$eur, 2)}} EUR</p>
                    {{-- деление на ноль к категориях, ругается на форму basket-a --}}

                        <p>
                            <form action="{{route('basket-add', $product->id)}}" method="POST">
                                @if ($product->isAvailable())
                                    <button type="submit" class="btn btn-warning" role="button">В корзину</button>
                                @else
                                    Товар не доступен
                                @endif
                                <a href="{{route('product', [$product->category->code,$product->code])}}"class="btn btn-warning" role="button">Подробнее</a>
                                @csrf
                            </form>
 
                    
                        </p>
                </div>
    </div>
</div>


{{-- <a href="{{route('basket')}}"class="btn btn-default" role="button">В корзину</a>
<a href="{{route('product', [$product->category->code,$product->code])}}"class="btn btn-default" role="button">Подробнее</a> --}}
