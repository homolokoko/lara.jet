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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');



    Route::prefix('admin')->group(function(){
        Route::get('product', fn()=>view('admin.product'))->name('admin.product');
        Route::get('/symmetric', fn()=>view('admin.symmetric.page'))->name('admin.symmetric.page');
        Route::get('defects-translated', fn()=>view('admin.defect.translations'))->name('admin.defect.translations');
    });




});

Route::get('/defect',fn()=>view('client.defect'))->name('client.defect');
Route::get('/photograph-upload',fn()=>view('client.photograph-upload'))->name('client.photograph-upload');
Route::prefix('blade-ui')->group(function(){
    Route::get('/hero-icon', fn()=>view('blade-ui.hero-icon'))->name('blade-ui.hero-icon');
});
