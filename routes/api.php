<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::resource('sellers', SellerController::class)->middleware('seller');
// ->except('show')
Route::post('login', [AuthController::class, 'login']); 
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    // return $request->user();
Route::post('register', [AuthController::class, 'register']);
// Route::put('update/{user}', [UserController::class, 'update'])->middleware('auth:sanctum');
Route::post('update/{user}', [UserController::class, 'update'])->middleware('auth:sanctum');
Route::post('openStore', [UserController::class, 'openStore'])->middleware('auth:sanctum');
Route::group(['prefix' => 'auth', 'middleware' => 'auth:sanctum'], function(){
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('user', [UserController::class, 'show']);
});
Route::get('product',[ProductController::class, 'index']);

// Route::get('/user', function (Request $request) {
//     return response()->json(
//         auth()->user()->role
//         // \App\Models\User::with('role')->where('email', 'seller@gmail.com')->first()
//         // \App\Models\RoleUser::with('user')->first()
//         , 200);
// })->middleware(['auth:sanctum', 'seller']);