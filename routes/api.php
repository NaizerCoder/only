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
/*API CARS*/
Route::group(['namespace' => 'App\Http\Controllers\API', 'prefix'=>'cars'], function(){

    Route::get('/', 'GetCars');
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

/*CARS*/
Route::group(['namespace' => 'App\Http\Controllers\Car', 'prefix'=>'car'], function(){

    Route::get('/create','CreateController');
    Route::post('/', 'StoreController');
    Route::get('/', 'IndexController');
//    Route::delete('/{item}', 'DeleteController');
//    Route::get('/{item}/edit', 'EditController');

    Route::group(['namespace' => 'Driver', 'prefix' => 'driver'], function () {
        Route::patch('/{car}', 'UpdateDriverController');
    });
});

/*EMPLOYEES*/
Route::group(['namespace' => 'App\Http\Controllers\Employee', 'prefix'=>'employee'], function(){

    Route::get('/create','CreateController');
    Route::post('/', 'StoreController');
    Route::get('/', 'IndexController');
    Route::get('/drivers', 'GetDriverController');
    Route::post('/car', 'GetCarsEmployeeController');
//    Route::delete('/{item}', 'DeleteController');
//    Route::get('/{item}/edit', 'EditController');
//    Route::patch('/{item}', 'UpdateController');
});

/*TRIPS*/
Route::group(['namespace' => 'App\Http\Controllers\Trip', 'prefix'=>'trip'], function(){

    Route::get('/create','CreateController');
    Route::post('/', 'StoreController');
    Route::get('/', 'IndexController');
//    Route::delete('/{item}', 'DeleteController');
//    Route::get('/{item}/edit', 'EditController');
    Route::patch('/{trip}', 'UpdateController');
});



