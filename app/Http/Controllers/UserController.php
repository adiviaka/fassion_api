<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function show(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'birthdate' => 'required|date_format:Y-m-d',
            'gender' => 'required|in:1,2',
            'contact' => 'required|string|min:10|max:13',
            'password' => 'min:6|max:12',
            'n_password' => 'required_with:password|min:6|max:12',
        ]);
        
        if($validator->fails()){
            $respon = [
                'status' => 'error',
                'message' => 'Update Error',
                'errors' => null,
                'content' => $validator->errors()
            ];
            return response()->json($respon, 401);
        }

        Hash::check($input['password'], $user->userdetail->password);

        $user->userdetail->first_name = $input['first_name'];
        $user->userdetail->last_name = $input['last_name'];
        $user->userdetail->birthdate = $input['birthdate'];
        $user->userdetail->gender = $input['gender'];
        $user->userdetail->contact = $input['contact'];
        $user->password = $input['password'];
        $user->n_password = $input['n_password'];
        $user->userdetail->save();
        $respon = [
            'status' => 'success',
            'message' => 'Update Success',
            'errors' => null,
            'content' => $user
        ];
        return response()->json($respon, 200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }

    public function openStore(Request $request, User $user){

    }
}
