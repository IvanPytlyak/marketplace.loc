<?php

namespace App\Http\Controllers;

use App\Models\Imag;
use App\Models\Product;
use Illuminate\Http\Request;

class ImagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('imags.create');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('imags.create'); // или index
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Product $product)
    {
        // $params = $request->all();
        // if ($request->hasFile('imags')) {
        //     $file = $request->file('imags');
        //     $path = $file->store('imags');
        //     $params['imags.name'] = $path;
        // };
        // Imag::create($params);
        // return redirect()->route('products.index');


        $params = $request->all();
        if ($request->has('imags')) {
            // $file = $request->file('imags');
            // $path = $file->store('imags');
            $path = $request->file('imags')->store('imags');
            $params['imags.name'] = $path;
        };

        $img = new Imag(['product_id' => $params['product_id_img']]);
        $img->name = $params['imags.name'];
        $img->save();

        return redirect()->route('products.index', ['product' => $product->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
