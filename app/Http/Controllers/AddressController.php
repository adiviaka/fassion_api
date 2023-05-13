<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $address = auth()->user()->userdetail->address;
        return response()->json($address, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request = $request->all();
        $address = auth()->user()->userdetail->address()->create($request);
        return response()->json($address, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Address $address)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Address $address)
    {
        $request = $request->all();
        $address->update($request);
        return response()->json($address, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Address $address)
    {
        $address = auth()->user()->userdetail->address()->find($address->id);
        $address->delete();
        return response()->json(['message' => 'Address deleted successfully']);
    }
}
