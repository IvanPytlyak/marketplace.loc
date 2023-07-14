<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/background.css">
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    
    <img src="../storage/background/fone.jpg" alt="" id="window_background">
        <a href="{{route('index')}}">На главную</a>
            {{-- <section class="comment-section">
                    <h2 class="section-title mb-5">Отправить комментарий</h2>
                    <form action="{{route('reviews_store')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="description" class="sr-only">Комментарий</label>
                                <textarea  name="description" id="description" class="form-control" placeholder="Добавьте ваш комментарий"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-6" >
                                <label for="product_id" class="sr-only">product_id</label>
                            <input class="fix_input" type="text" name="product_id" id="product_id" placeholder="product_id">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-6" >
                                <label for="name" class="sr-only">Имя</label>
                            <input class="fix_input" type="text" name="name" id="name" placeholder="Имя">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                            <input class="fix_submit" type="submit" value="Отправить" class="btn btn-warning">
                            </div>
                        </div>
                    </form>
            </section> --}}




            <section class="comment-section">
                <h2 class="section-title mb-5">Отправить комментарий</h2>
                <form action="{{route('reviews_store', ['product' => $product])}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="description_review" class="sr-only">Комментарий</label>
                            <textarea  name="description_review" id="description" class="form-control" placeholder="Добавьте ваш комментарий"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-6" >
                            <label for="name_review" class="sr-only">Имя</label>
                        <input class="fix_input" type="text" name="name_review" id="name" placeholder="Имя">
                        </div>
                    </div>

                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                    <div class="row">
                        <div class="col-6">
                        <input class="fix_submit" type="submit" value="Отправить" class="btn btn-warning">
                        </div>
                    </div>
                </form>
        </section>
    
</body>
</html>