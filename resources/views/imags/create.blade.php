{{-- @extends('layouts.app') --}}

{{-- @section('content') --}}

{{-- <form method="POST" enctype="multipart/form-data" action="{{route('imags_store')}}">
    @csrf
    <div class="input-group row">
        <label for="imags" class="col-sm-2 col-form-label">Дополнительные картинки: </label>
        <div class="col-sm-10">
            <label class="btn btn-default btn-file">
                Загрузить <input type="file" style="display: none;" name="imags" id="imags">
            </label>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-6" >
            <label for="product_id" class="sr-only">product_id</label>
        <input class="fix_input" type="text" name="product_id" id="product_id" placeholder="product_id">
        </div>
    </div>
    <button class="btn btn-success">Сохранить</button>
</form> --}}


<form method="POST" enctype="multipart/form-data" action="{{route('imags_store', ['product' => $product->id])}}">
    @csrf
    <div class="input-group row">
        <label for="imags" class="col-sm-2 col-form-label">Дополнительные картинки: </label>
        <div class="col-sm-10">
            <label class="btn btn-default btn-file">
                Загрузить <input type="file" style="display: none;" name="imags" id="imags">
            </label>
        </div>
    </div>
   
    <input type="hidden"  type="text" name="product_id_img" value="{{$product->id}}">
        
    
    <button class="btn btn-success">Сохранить</button>
</form>


{{-- @endsection --}}