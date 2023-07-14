@extends('master')
@section('title', 'Товар')


@section('content')
   
    <h1>{{$category->name}}</h1>
    <h2>{{$product->name}}</h2>
    <p id="price">Цена: <b>{{$product->price}} руб.</b></p>
        <p id="currency">{{round($product->price/$usd, 2)}} USD</p> 
        <p id="currency">{{round($product->price/$eur, 2)}} EUR</p>
    <img src="{{Storage::url($product->image)}}">
    <br>
    <br>
    <div class="row" id="row_images">
        @foreach ($images as $imag)
            <div class="col-md-3" id="col_images">
                <img id="images_fix" src="{{Storage::url($imag->name)}}" alt="">
            </div>
        @endforeach
    </div>

    <br>
   
    <p>{{$product->description}}</p>


    <br>
    <h2>Отзывы</h2>
    <div class="comments-wrapper">
        @foreach($comments as $comment) 
            <div class="comment">
                <div class="comment-header"> 
                    <h4 class="comment-author">{{ $comment->name }}</h4> 
                    <span class="comment-date">{{ $comment->created_at }}</span> 
                </div> 
                <div class="comment-content"> 
                    <div class="comment-description">
                        <p>{{ $comment->description }}</p> 
                    </div> 
                </div> 
            </div> 
        @endforeach 
        @include('reviews.create')
    </div>

@endsection



    {{-- <div class="comments">
        @foreach ($commends as $commend)
         <div class="comment">
            <div class="comment-content">
                <p>Комментарии: {{$commend->description}}</p> 
            </div> 
        </div> 
        @endforeach
    </div> --}}


    
    {{-- <div>
        @foreach ($commends as $commend)
        <p>Комментарии: {{$commend->description}}</p> 
        @endforeach
    </div> --}}















    {{-- @yield('content') --}}

    {{-- <div class="warning"></div>
    <form method="POST" action="#">           
        <input type="text" name="email"></input>
        <button type="submit">Отправить</button>
    </form> --}}

    {{-- <section class="comment-section">
        <h2 class="section-title mb-5" data-aos="fade-up">Отправить комментарий</h2>
        <form action="/" method="POST">
            <div class="row">
                <div class="form-group col-12" data-aos="fade-up">
                    <label for="comment" class="sr-only">Комментарий</label>
                    <textarea name="comment" id="comment" class="form-control" placeholder="aaaa"></textarea>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-12" data-aos="fade-up">
                    <label for="name" class="sr-only">Имя</label>
                   <input type="text" name="name" id="name" placeholder="Имя">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-12" data-aos="fade-up">
                    <label for="email" class="sr-only">E-mail</label>
                   <input type="email" name="email" id="email" placeholder="email">
                </div>
            </div>
            <div class="row">
                <div class="col-12" data-aos="fade-up">
                   <input type="submit" value="Отправить" class="btn btn-warning">
                </div>
            </div>
        </form>
        </section>
    --}}
