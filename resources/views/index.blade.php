@extends('master')

@section('title', 'Главная')

@section('content')
    
    
        <h1 id="all_products">Все товары</h1>
        
        {{-- <div class="input-group input-group-sm mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-sm">Small</span>
            </div>
            <input type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
          </div> --}}

            <div class="colorfix">
                <form method="GET" action="{{route('index')}}">
                    <div class="filters row">
        
                        <div class="col-sm-2 col-md-3">
                            <label for="hit">Поиск
                                <input type="text" name="text_search" id="text_search"> 
                            </label>
                        </div>

                        <div class="col-sm-6 col-md-3">
                            <label for="price_from">Цена от
                                <input type="text" name="price_from" id="price_from" size="6" value="{{request()->price_from}}">
                            </label>
                            <label for="price_to">до
                                <input type="text" name="price_to" id="price_to" size="6"  value="{{request()->price_to}}">
                            </label>
                        </div>

                        <div class="col-sm-2 col-md-1">
                            <label for="hit">
                                <input type="checkbox" name="hit" id="hit" @if (request()->has('hit')) checked @endif>Хит
                            </label>
                        </div>
                        <div class="col-sm-2 col-md-1">
                            <label for="new">
                                <input type="checkbox" name="new" id="new" @if (request()->has('new')) checked @endif> Новинка
                            </label>
                        </div>
                        <div class="col-sm-2 col-md-1">
                            <label for="recommend">
                                <input type="checkbox" name="recommend" id="recommend" @if (request()->has('recommend')) checked @endif> Рекомендуем
                            </label>
                        </div>

                        <div class="col-sm-6 col-md-3">
                            <button type="submit" class="btn btn-primary">Фильтр</button>
                            <a href="{{route('index')}}" class="btn btn-warning">Сброс</a>
                        </div>
                    </div>
                </form>
            </div>
            <br>

        <div class="row">
            @foreach ($products as $product)    
            @include('card', compact('product'))
            @endforeach
        </div>
    
        {{$products->links('pagination::bootstrap-4')}}



@endsection
