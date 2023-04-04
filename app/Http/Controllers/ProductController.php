<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $req)
    {
        $search = $req->input('search');

        if ($search) {
            return response()->json(Product::where('name', 'like', '%'.$search.'%')->get(), 200);
        }

        $category = $req->input('category');

        if ($category) {
            return response()->json(Product::with('category')->whereHas('category', function($cb) use ($category){
                $cb->where('name', 'like', '%'.$category.'%');
            })->get()
            , 200);
        }
        return response()->json(Product::all(), 200);

        // $review;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }

    public function categoryFilter(Request $request, Product $product){
        $input = $request->all();
        if ($input['category'] == 'all') {
            return response()->json(Product::all(), 200);
        }
    }
}
