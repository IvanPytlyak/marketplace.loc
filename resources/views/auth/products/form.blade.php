@extends('layouts.app')

@isset($product)
@section('title', 'Редактировать товар') 
@else
@section('title', 'Создать товар')
@endisset


@section('content')
    <div class="col-md-12">
        @isset($product)
            <h1>Редактировать Товар</h1>
        @else
            <h1>Добавить Товар</h1>
        @endisset    

                <form method="POST" enctype="multipart/form-data" action="
                @isset($product)
                    {{route('products.update', $product)}}
                @else
                    {{route('products.store')}}
                @endisset
                ">    
                    <div>
                        @isset($product)
                           @method('PUT') 
                        @endisset
                        @csrf
                        <div class="input-group row">
                            <label for="code" class="col-sm-2 col-form-label">Код: </label>
                            <div class="col-sm-6">
                                @error('code')
                                    <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                                <input type="text" class="form-control" name="code" id="code" 
                                value="@isset($product){{$product->code}}@endisset">
                            </div>
                        </div>
                        <br>
                        <div class="input-group row">
                            <label for="name" class="col-sm-2 col-form-label">Название: </label>
                            <div class="col-sm-6">
                                @error('name')
                                    <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                                <input type="text" class="form-control" name="name" id="name" 
                                value="@isset($product) {{$product->name}} @endisset">
                            </div>
                        </div>
                        <br>
                        <div class="input-group row">
                            <label for="category_id" class="col-sm-2 col-form-label">Категория: </label>
                            <div class="col-sm-6">
                                <select name="category_id" id="category_id" class="form-control"> 
                                    @foreach ($categories as $category)
                                        <option value="{{$category->id}}"
                                            @isset($product)
                                                @if($category->id == $product->category_id)
                                                    selected
                                                @endif
                                            @endisset
                                            >{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="input-group row">
                            <label for="description" class="col-sm-2 col-form-label">Описание: </label>
                            <div class="col-sm-6">
                                @error('description')
                                    <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                                <textarea name="description" id="description" cols="72" rows="7">@isset($product){{$product->description}}@endisset</textarea>
                            </div>
                        </div>
                        <br>
                        <div class="input-group row">
                            <label for="image" class="col-sm-2 col-form-label">Картинка: </label>
                            <div class="col-sm-10">
                                <label class="btn btn-default btn-file">
                                    Загрузить <input type="file" style="display: none;" name="image" id="image">
                                </label>
                            </div>
                        </div>

                        {{-- @include('imags.create') --}}

                        <div class="input-group row">
                            <label for="price" class="col-sm-2 col-form-label">Цена: </label>
                            <div class="col-sm-2">
                                @error('price')
                                    <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                                <input type="text" class="form-control" name="price" id="price" 
                                value="@isset($product) {{$product->price}} @endisset">
                            </div>
                        </div>

                        <br>
                        @foreach (
                            [
                            'hit'=>'Хит',
                            'new' => 'Новинка',
                            'recommend' => 'Рекомендуемое',
                            'is_active' => 'Активная карточка товара'
                            ] as $field => $title)                
                          
                            <div class="form-group row">
                                <label for="check" class="col-sm-2 col-form-label">{{$title}}: </label>
                                <div class="col-sm-10">
                                    <input type="checkbox" name="{{$field}}" id="{{$field}}"
                                    @if(isset($product) && $product->$field === 1)
                                        checked="checked"
                                        @endif
                                    >
                                </div>
                            </div>  
                        @endforeach
                        <br>

                        <button class="btn btn-success">Сохранить</button>
                    </div>
                </form>
            </div>
@endsection 


{{-- @section('scripts')

<script>
    ClassicEditor
        .create( document.querySelector( '#description' ) )
        .catch( error => {
            console.error( error );
        } );
</script>

@endsection --}}

