<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;


Route::get('/products', [ProductController::class, 'index']);

Route::post('/products', [ProductController::class, 'store']);

Route::get('/products/{id}', [ProductController::class, 'show']);

Route::put('/products/{id}', [ProductController::class, 'update']);

Route::delete('/products/{id}', [ProductController::class, 'destroy']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login',[AuthController::class,'login']);

Route::group(['middleware' => ['auth:sanctum',]],
        function(){
            Route::resource('product',ProductController::class);
            
            Route::post('logout',[AuthController::class,'logout']);
        }
);