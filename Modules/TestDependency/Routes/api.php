<?php

use Illuminate\Http\Request;
use Modules\TestDependency\Http\Controllers\PhotoUploadController;
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

    Route::prefix('upload')->group(function(){
        Route::post('/64', [PhotoUploadController::class,'upload64'])->name('testdependency::api.upload.64');
        Route::post('/file', [PhotoUploadController::class,'uploadFile'])->name('testdependency::api.upload.file');
    });

});
