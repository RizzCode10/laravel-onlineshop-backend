<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AddressController;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// register
Route::post('/register', [App\Http\Controllers\Api\AuthController::class, 'register']);
//logout
Route::post('/logout', [App\Http\Controllers\Api\AuthController::class, 'logout'])->middleware('auth:sanctum');

//login
Route::post('/login', [App\Http\Controllers\Api\AuthController::class, 'login']);

//category
Route::get('/categories', [App\Http\Controllers\Api\CategoryController::class, 'index']);

//product
Route::get('/products', [App\Http\Controllers\Api\ProductController::class, 'index']);



// Order
// Route::post('/orders', [App\Http\Controllers\Api\OrderController::class, 'order']);
// Route::post('/orders', [App\Http\Controllers\Api\OrderController::class, 'order'])->middleware('auth:sanctum');
Route::post('/order', [App\Http\Controllers\Api\OrderController::class, 'order'])->middleware('auth:sanctum');

//callback
Route::post('/callback', [App\Http\Controllers\Api\CallbackController::class, 'callback']);

// Address Api Resource
// Route::apiResource('addresses', App\Http\Controllers\Api\AddressController::class);
// Route::get('/addresses', [App\Http\Controllers\Api\AddressController::class, 'index']);
// Route::post('/addresses', [App\Http\Controllers\Api\AddressController::class, 'store']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/addresses', [AddressController::class, 'index']);
    Route::post('/addresses', [AddressController::class, 'store']);

    // Order
    Route::post('/orders', [App\Http\Controllers\Api\OrderController::class, 'order']);
});
Route::post('/callback', [App\Http\Controllers\Api\CallbackController::class, 'callback']);

