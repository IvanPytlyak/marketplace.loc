<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $reviews = Review::get();
        // return view('reviews.index', compact('reviews')); //'reviews', 'product' // 
        return view('reviews.create');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('reviews.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $params = $request->all();
        Review::create($params);
        // return redirect()->route('reviews.index');
        return redirect()->route('index');
        // дописать redirect ку да нужно ?
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        //
    }
}
