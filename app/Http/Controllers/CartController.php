<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        return response()->json([
            'user' => $user,
            'cart' => $user->cart
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        $data = [
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
        ];
        $product = Product::find($request->product_id);
        $data['price'] = $product->price;
        $data['subtotal'] = $request->quantity * $data['price'];
        $cart = Cart::create([
            'user_id' => $user->id
        ] + $data);
        return response()->json([
            'user' => $user,
            'cart' => $cart
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        //
    }
}
