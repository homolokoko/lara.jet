<?php

use Illuminate\Http\Request;
use Modules\TestDependency\Http\Controllers\QRCodeController;

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

Route::middleware('auth:api')->get('/testdependency', function (Request $request) {
    return $request->user();
});

Route::prefix('testdependency')->group(function() {

    Route::prefix('qr-code')->group(function(){
        Route::get('/', [QRCodeController::class,'index'])->name('testdependency::api.qr-code.index');
    });

});
