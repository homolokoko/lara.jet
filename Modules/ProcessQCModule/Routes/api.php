<?php

use Illuminate\Http\Request;
use Modules\ProcessQCModule\Http\Controllers\AssemblySewingOnline\EndlineAudit;

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

Route::middleware('auth:api')->get('/processqcmodule', function (Request $request) {
    return $request->user();
});

Route::prefix('processqcmodule')->group(function() {
    Route::prefix('assembly/sewing-online')->group(function(){
        Route::prefix('endline-audit')->group(function(){
            Route::prefix('inline-inspection')->group(function(){
                Route::get('/origin', [EndlineAudit\InlineInspectionController::class,'index'])->name('api/processqcmodule::assembly/sewing-online.endline-audit.inline-inspection.origin');
                Route::get('/mapped', [EndlineAudit\InlineInspectionController::class,'create'])->name('api/processqcmodule::assembly/sewing-online.endline-audit.inline-inspection.mapped');
            });
        });
    });
});
