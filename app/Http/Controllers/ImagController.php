<?php

namespace App\Http\Controllers;

use App\Models\Imag;
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
    public function store(Request $request)
    {
        $params = $request->all();

        if ($request->hasFile('imags')) {
            $file = $request->file('imags');
            $path = $file->store('imags');
            $params['imags.name'] = $path;
        };

        Imag::create($params);
        return redirect()->route('products.index');
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
