<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Store;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
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
            'profile' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'password' => 'min:6|max:12',
            'n_password' => 'required_with:password|min:6|max:12',
        ]);

        if ($validator->fails()) {
            $respon = [
                'status' => 'error',
                'message' => 'Update Error',
                'errors' => null,
                'content' => $validator->errors()
            ];
            return response()->json($respon, 401);
        }

        if ($request->has('password') && $request->has('n_password')) {
            if (!Hash::check($input['password'], $user->password)) {
                $respon = [
                    'status' => 'error',
                    'message' => 'Update Error',
                    'errors' => null,
                    'content' => 'Password not match'
                ];
                return response()->json($respon, 401);
            }
            $user->password = $input['n_password'];
            $user->save();
        }

        if ($request->hasFile('profile') && $request->file('profile')->isValid()) {
            if ($user->userdetail->profile) {
                $path = substr($user->userdetail->profile, strpos($user->userdetail->profile, 'images'));
                // Storage::disk('public')->exists($path) ? Storage::disk('public')->delete($path) : "";
                Storage::disk('public')->delete($path);
            }

            $filename = "profile_" . Str::random(16) . "-" . Carbon::now()->toDateString() . "." . $request->file('profile')->getClientOriginalExtension();
            // $request->file('profile')->store('images/user/profile', 'public');
            $uploadFile = $request->file('profile')->storePubliclyAs('images/profile', $filename, 'public');
            $profilepicture = asset('storage/' . $uploadFile);

            $user->userdetail->profile = $profilepicture;
        }

        $user->userdetail->first_name = $input['first_name'];
        $user->userdetail->last_name = $input['last_name'];
        $user->userdetail->birthdate = $input['birthdate'];
        $user->userdetail->gender = $input['gender'];
        $user->userdetail->contact = $input['contact'];
        // $user->userdetail->profile = $profilepicture;
        
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

    public function openStore(Request $request)
    {
        try {
            $validate = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'address' => 'required|string',
                'contact' => 'required|string|min:10|max:13',
                'description' => 'nullable|string',
                'VA' => 'required|string|max:255',
            ]);


            if ($validate->fails()) {
                $respon = [
                    'status' => 'error',
                    'message' => 'Validation Error',
                    'errors' => $validate->errors(),
                    'content' => null
                ];
                return response()->json($respon, 422);
            }

            $user = User::find(auth()->user()->id);
            Store::create([
                'user_id' => $user->id,
                'name' => $request->name,
                'address' => $request->address,
                'contact' => $request->contact,
                'description' => $request->description,
                'VA' => $request->VA,
            ]);

            $user->role()->sync([1, 2]);
            $user = User::with(['store', 'role'])->where('id', $user->id)->first();

            $respon = [
                'status' => 'success',
                'message' => 'Store Created',
                'errors' => null,
                'content' => $user
            ];

            return response()->json($respon, 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Server Error',
                'errors' => $e->getMessage(),
                'content' => null
            ], 500);
        }
    }
}
