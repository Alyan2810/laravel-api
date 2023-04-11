<?php

use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;

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

Route::apiResource('posts', PostController::class);

// Route::get('posts', [PostController::class, 'index']);
// Route::post('posts', [PostController::class, 'store']);
// Route::get('posts/{post}', [PostController::class, 'show']);
// Route::put('posts/{post}', [PostController::class, 'update']);
// Route::delete('posts/{post}', [PostController::class, 'destroy']);

//passport Token 
route::post('/register',[UserController::class, 'register']  );
route::post('/login',[UserController::class, 'login']  );

//Passport authenticaion
Route::middleware('auth:api')->group(function(){
    route::get('/user/{id}',[UserController::class, 'getUser']  );
});


//Route::apiResource('/user/{id}', 'UserController')->middleware('auth:api');