<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',fn()=>redirect('/dashboard'));
Route::get('/test/query',[\App\Http\Controllers\TestController::class,'query'])->name('test.query');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
//    Route::get('/dashboard', function () {
//        return view('dashboard');
//    })->name('dashboard');

    Route::get('/dashboard', fn ()=>view('dashboard'))->name('dashboard');

    Route::prefix('admin')->group(function(){
        Route::get('product', fn()=>view('admin.product'))->name('admin.product');
        Route::get('/symmetric', fn()=>view('admin.symmetric.page'))->name('admin.symmetric.page');
        Route::get('defects-translated', fn()=>view('admin.defect.translations'))->name('admin.defect.translations');
    });


    Route::prefix('/management')->group(function(){
        Route::get('/buyer',fn()=>view('management.buyer'))->name('management.buyer');
        Route::get('/style',fn()=>view('management.style'))->name('management.style');
        Route::get('/purchase-order',fn()=>view('management.purchase-order'))->name('management.purchase-order');

        Route::get('/staff',fn()=>view('management.staff'))->name('management.staff');
        Route::get('/course',fn()=>view('management.course'))->name('management.course');
        Route::get('/attendent',fn()=>view('management.attendent'))->name('management.attendent');
        Route::get('/score',fn()=>view('management.score'))->name('management.score');
    });

    Route::get('/full-qc/{mode}/{report_view}/form',[\App\Http\Controllers\Inspector\FullQcController::class,'form'])->name('full-qc.form');
    Route::get('/full-qc/{mode}/{report_view}/report',[\App\Http\Controllers\Inspector\FullQcController::class,'report'])->name('full-qc.report');

    Route::prefix('/materials')->group(function(){

        Route::prefix('/audit')->group(function(){
            Route::get('/',fn()=>view('materials.audit.trim'))->name('url.materials.audit.trim');
            Route::get('/{type}',[\App\Http\Controllers\Material\AuditController::class,'audit'])->name('url.materials.audit');
        });

    });


});

Route::get('/defect',fn()=>view('client.defect'))->name('client.defect');
Route::get('/photograph-upload',fn()=>view('client.photograph-upload'))->name('client.photograph-upload');
Route::prefix('blade-ui')->group(function(){
    Route::get('/hero-icon', fn()=>view('blade-ui.hero-icon'))->name('blade-ui.hero-icon');
});


Route::get('/full-qc/packing/{page}', [\App\Http\Controllers\Inspector\FullQcController::class,'packing'])->name('full-qc.packing.form');
Route::get('/full-qc/afterwash/{page}', [\App\Http\Controllers\Inspector\FullQcController::class,'afterwash'])->name('full-qc.afterwash.form');
Route::get('/full-qc/finishing/{page}', [\App\Http\Controllers\Inspector\FullQcController::class,'finishing'])->name('full-qc.finishing.form');


