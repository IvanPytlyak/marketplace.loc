@extends('master')
@section('title', 'Все категории')
@section('content')
    

    @foreach ($categories as $category)
    <img src="../storage/background/fone.jpg" alt="" id="window_background">
            <div class="panel">
                <a href="{{route('category', $category->code)}}">
                    <img height='240px' src="{{Storage::url($category->image)}}">
                    <h2>{{$category->name}}</h2></a>
                <p>{{$category->description}}</p>
            </div>        
    @endforeach

@endsection
