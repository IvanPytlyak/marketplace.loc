@extends('master')
@section('title', 'Каталог')
@section('content')



<div class="starter-template">
    @foreach ($categories as $category)
    <div class="panel">
        <!-- <a href="/{{route('category', $category->code) }}"> -->
        <!-- эта строка нужна для определения группы category.blade стр 14 при отображении группы карточек для части каталога (к примеру телефоны) -->
        <a href="/{{$category->code}}">
            <img src="http://internet-shop.tmweb.ru/storage/categories/mobile.jpg">
            <h2>{{$category->name}}</h2>
        </a>
        <p>
            {{$category->description}}
        </p>
    </div>
    @endforeach

    @endsection('content')