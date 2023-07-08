@extends('master')

@section('title', 'Категория ' . $category->name)

@section('content')

    <h1>{{$category->name}}</h1> 
    <p>{{$category->description}}</p>
    <p>товаров этой группе: {{$category->products->count()}}</p> 
    <div class="row">
           
        @foreach ($category->products->where('is_active', 1) as $product)
        @include('card', compact('product'))
        @endforeach
        {{-- @include('card', ['category' => $category]) --}}
        {{--   ['category' => $category]  = compact('category') - передаем значения для возможности его переиспользования в других связанных через include blade-файлах--}}
        
@endsection