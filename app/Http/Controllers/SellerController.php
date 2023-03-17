<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SellerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // if(auth()->guest() || auth()->user()->username !== 'admin'){
        //     return response()->json(['message' => 'Unauthorized'], 401);
        // }

        // if(!auth()->check() || auth()->user()->username !== 'admin'){
        //     return response()->json(['message' => 'Unauthorized'], 401);
        // }

        // if(auth()->user()->username !== 'admin'){
        //     return response()->json(['message' => 'Unauthorized'], 401);
        // }
        $this->authorize('seller');
        return response()->json(Seller::all(), 200);
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
    public function show(Seller $seller)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Seller $seller)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Seller $seller)
    {
        //
    }
}
