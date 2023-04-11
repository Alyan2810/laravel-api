<?php

use App\Http\Controllers\Frontend\AboutController;
use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ServiceController;;
use App\Http\Controllers\indexController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\LoginCheck;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//protected by Guard middleware
route::post('/upload', [ContactController::class, 'upload'])->middleware('login_check');
route::get('/data1to1' , [indexController::class, 'oneToone'])->middleware('login_check');
route::get('/data1tom' , [indexController::class, 'oneTomany'])->middleware('login_check');
route::get('/upload', function(){
    return view('upload');
    })->middleware('login_check');

//.........................    
    
route::get('/' , [HomeController::class, 'index']);
route::get('/contact' , [ContactController::class, 'index']);
route::get('/about' , [AboutController::class, 'index']);
route::get('/blog' , [BlogController::class, 'index']);
route::get('/service' , [ServiceController::class, 'index']);


route::get('/login' , function()
{
    session()->put('user_id' , 1);
    return redirect('/');
});
route::get('/logout' , function()
{
    session()->forget('user_id');
    return redirect()->back();
});
route::get('/no-access', function(){
    echo "No Access";
    die;
    });