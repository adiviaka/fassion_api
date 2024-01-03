<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

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
        // $request = $request->all();
        // $address = auth()->user()->userdetail->address()->create($request);
        // return response()->json($address, 201);
        $validate = Validator::make($request->all(),
            [
                'address' => 'required|string|max:255',
                'village' => 'required|string|max:255',
                'district' => 'required|string|max:255',
                'city' => 'required|string|max:255',
                'province' => 'required|string|max:255',
                'postalcode' => 'required|string|max:255'
            ]
        );

        if ($validate->fails()) {
            $respon = [
                'status' => 'error',
                'message' => 'Validation Error',
                'errors' => $validate->errors(),
                'content' => null
            ];
            return response()->json ($respon, 400);
        }

        // return $request->user();
        $address = $request->user()->userDetail->Address()->create([
            'address' => $request->address,
            'village' => $request->village,
            'district' => $request->district,
            'city' => $request->city,
            'province' => $request->province,
            'postal_code' => $request->postalcode
        ]);

        $respon = [
            'status' => 'success',
            'message' => 'Address created successfully',
            'errors' => null,
            'content' => $address
        ];
        return response()->json($respon, 201);
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
        $input = $request->all();
        $validate = Validator::make($input, [
            'address' => 'required|string|max:255',
            'village' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'postalcode' => 'required|string|max:255'
        ]);

        if ($validate->fails()) {
            $respon = [
                'status' => 'error',
                'message' => 'Validation Error',
                'errors' => $validate->errors(),
                'content' => null
            ];
            return response()->json ($respon, 400);
        }

        $address->address = $input['address'];
        $address->village = $input['village'];
        $address->district = $input['district'];
        $address->city = $input['city'];
        $address->province = $input['province'];
        $address->postal_code = $input['postalcode'];
        $address->save();

        $respon = [
            'status' => 'success',
            'message' => 'Address edited successfully',
            'errors' => null,
            'content' => $address
        ];
        return response()->json($respon, 201);
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
