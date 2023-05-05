<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        if ($search) {
            return response()->json(Product::where('name', 'like', '%'.$search.'%')->get(), 200);
        }

        $category = $request->input('category');

        if ($category) {
            return response()->json(Product::with('category')->whereHas('category', function($cb) use ($category){
                $cb->where('name', 'like', '%'.$category.'%');
            })->orderBy('name', 'ASC')->get()
            , 200);
        }

        $price_min = $request->input('price_min');
        $price_max = $request->input('price_max');
        
        if ($price_min && $price_max) {
            return response()->json(Product::where('price', '>=', $price_min)->where('price', '<=', $price_max)->where('price','>=', $price_min)->orderBy('price')->get(), 200);
        }

        $review = Review::select('product_id', DB::raw('CAST(AVG(rating) AS DECIMAL(5,0)) as rating'))->groupBy('product_id')->get();

        $products = $review->load('product');

        return response()->json($products
        , 200);
        // return response()->json(Product::all(), 200);
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
