<?php

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

//Route::prefix('schoolmanagement')->group(function() {
//    Route::get('/', 'SchoolManagementController@index');
//});

use Modules\SchoolManagement\Http\Controllers\StudentController;
Route::group(['prefix'=>'school-management'],function(){

    Route::group(['prefix'=>'student'],function(){

        Route::get('/index',[StudentController::class,'index'])->name('');

    });


});


