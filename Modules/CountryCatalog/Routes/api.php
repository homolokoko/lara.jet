<?php

use Illuminate\Http\Request;

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

use Modules\CountryCatalog\Http\Controllers\Api;
use Modules\CountryCatalog\Http\Controllers\CountryCatalogController;
Route::middleware('auth:api')->get('/countrycatalog', function (Request $request) {
    return $request->user();
});
Route::prefix('countrycatalog')->group(function() {
    Route::post('/store', [CountryCatalogController::class,'store'])->name('countrycatalog::store');
    Route::prefix('/test')->group(function(){
        Route::get('/',[Api\TestController::class,'index'])->name('countrycatalog::test.index');
    });
});

