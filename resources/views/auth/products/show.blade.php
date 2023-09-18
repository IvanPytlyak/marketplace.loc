@extends('layouts.app')

@section('title', 'Товар ' . $product->name)

@section('content')

    <div class="col-md-12">
        <h1></h1>
        <table class="table">
            <tbody>
            <tr>
                <th>
                    Поле
                </th>
                <th>
                    Значение
                </th>
            </tr>
            <tr>
                <td>ID</td>
                <td>{{$product->id}}</td>
            </tr>
            <tr>
                <td>Код</td>
                <td>{{$product->code}}</td>
            </tr>
            <tr>
                <td>Название</td>
                <td>{{$product->name}}</td>
            </tr>
            <tr>
                <td>Название на английском</td>
                <td>{{$product->name_en}}</td>
            </tr>

            <tr>
                <td>Категория</td>
                <td>{{$product->category->name}}</td>
            </tr>

            <tr>
                <td>Описание</td>
                <td>{{$product->description}}</td>
            </tr>
            <tr>
                <td>Описание на английском</td>
                <td>{{$product->description_en}}</td>
            </tr>
            <tr>
                <td>Картинка</td>
                <td><img id="fix_img_roduct_category" src="{{Storage::url($product->image)}}"></td>
            </tr>
            <tr>
                <td>Цена</td>
                <td>{{$product->price}}</td>
            </tr>
            <tr>
                <td>Кол-во товаров</td>
                <td>{{$product->count}}</td>
            </tr>
            <tr>
                <td>Акционный признак</td>
                <td>
                    @if ($product->new === 1)
                        <span class="badge badge-success">Новинка</span>
                    @endif 
                    @if($product->hit === 1)
                        <span class="badge badge-danger">Хит</span>
                    @endif
                    @if ($product->recommend === 1)
                        <span class="badge badge-warning">Рекомендуемое</span>
                    @endif    
                </td>
            </tr>
            <tr>
                <td>Активная карточка</td>
                <td>
                    @if ($product->is_active === 1)
                        да
                    @else
                        нет
                    @endif
                </td>
            </tr>
            </tbody>
        </table>
    </div>

@endsection