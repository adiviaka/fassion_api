<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UserDetail;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // return response()->json($request->all(), 200);
        $validate = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required'
        ]);

        if ($validate->fails()) {
            $respon = [
                'status' => 'error',
                'message' => 'Login Failed',
                'errors' => $validate->errors(),
                'content' => null
            ];
            return response()->json($respon, 401);
            // return response()->json($respon, 200);
        } else {
            $credentials = request(['email', 'password']);
            $credentials = Arr::add($credentials, 'status', 'active');
            if (!Auth::attempt($credentials)) {
                $respon = [
                    'status' => 'error',
                    'message' => 'Unauthorized',
                    'errors' => null,
                    'content' => null
                ];
                return response()->json($respon, 401);
            }
            $user = User::where('email', $request->email)->first();
            if (!Hash::check($request->password, $user->password, [])){
                throw new Exception('Error in Login');
            }
            $tokenResult = $user->createToken('token-auth')->plainTextToken;
            $respon = [
                'status' => 'success',
                'message' => 'Login Success',
                'errors' => null,
                'content' => [
                    'status_code' => 200,
                    'access_token' => $tokenResult,
                    'token_type' => 'Bearer',
                    'user' => $user,
                    'role' => $user->role,
                ]
            ];
            return response()->json($respon, 200);
        }
    }

    public function logout(Request $request){
        $user = $request -> user();
        $user -> currentAccessToken() -> delete();
        $respon = [
            'status' => 'success',
            'message' => 'Logout Successfully',
            'errors' => null,
            'content' => null
        ];
        return response()->json($respon, 200);
    }

    public function register(Request $request){
        $validate = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email:dns|unique:users',
            'birthdate' => 'required|date_format:Y-m-d',
            'gender' => 'required|in:1,2',
            'contact' => 'required|string|min:10|max:13',
            'password' => 'required|min:6|max:12',
            'c_password' => 'required|same:password',
        ]);

        if ($validate->fails()){
            $respon = [
                'status' => 'error',
                'message' => 'Validation Error',
                'errors' => $validate->errors(),
                'content' => null
            ];
            return response()->json($respon, 422);
        }
        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole(2);

        $detail = $validate->validated();
        $detail['user_id'] = $user->id;
        UserDetail::create($detail);



        $user = User::with(['userdetail', 'role'])->where('email', $request->email)->first();

        $respon = [
            'status' => 'success',
            'message' => 'Register Success',
            'errors' => null,
            'content' => $user
        ];

        return response()->json($respon, 200);
        
    }
}