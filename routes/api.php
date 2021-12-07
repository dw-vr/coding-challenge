<?php
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('/v1')->group(function(){
    //there are two possible aproaches to limiting what methods are exposed in the api
    //one is except, and the other is only
    //['except'=>['edit','create'] ]
    //['only'=>['edit','create'] ]
    //for security reasons, we use only
    Route::resource('categories',CategoryController::class,['only'=>['index','show'] ]);
    Route::resource('products',ProductController::class,['only'=>['index','show','create','update','destroy'] ]);
});