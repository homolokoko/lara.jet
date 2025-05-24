<?php

use Modules\TestDependency\Http\Controllers\QRCodeController;

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

Route::prefix('testdependency')->group(function() {

    Route::prefix('qr-code')->group(function(){
        Route::get('/', fn()=>redirect()->route('testdependency::qr-code.scanner'))->name('testdependency::qr-code');
        Route::get('/scanner', [QRCodeController::class,'scanner'])->name('testdependency::qr-code.scanner');
        Route::get('/grid-list', [QRCodeController::class,'gridList'])->name('testdependency::qr-code.grid-list');
        Route::get('/table-list', [QRCodeController::class,'tableList'])->name('testdependency::qr-code.table-list');
    });


});
