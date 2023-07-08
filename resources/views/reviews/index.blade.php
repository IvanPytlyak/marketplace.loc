{{-- @extends('product')

@section('content')

<h1>Коментарии для товара</h1>
@foreach ($reviews as $review)
    <div>
        <p>Текст коментария: {{$review->description}}</p>
    </div>
@endforeach
<a href="{{ route('reviews.create', $product->id) }}">Добавить комментарий</a>
@endsection --}}

<section class="comment-section">
    @foreach ($reviews as $review)
    <br>
    <p>Комментарий: {{$review->description}}</p> 
    @endforeach

</section>