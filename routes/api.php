<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


/*CATEGORY POSITION*/
Route::group(['namespace' => 'App\Http\Controllers\CategoryPosition', 'prefix'=>'category_position'], function(){

    Route::post('/', 'StoreController');
    Route::get('/', 'IndexController');
});

/*CATEGORY COMFORT*/
Route::group(['namespace' => 'App\Http\Controllers\CategoryComfort', 'prefix'=>'category_comfort'], function(){

    Route::post('/', 'StoreController');
    Route::get('/', 'IndexController');
});

/*POSITION*/
Route::group(['namespace' => 'App\Http\Controllers\Position', 'prefix'=>'position'], function(){

    Route::get('/create','CreateController');
    Route::post('/', 'StoreController');
    Route::get('/', 'IndexController');
//    Route::delete('/{item}', 'DeleteController');
//    Route::get('/{item}/edit', 'EditController');
//    Route::patch('/{item}', 'UpdateController');
});

