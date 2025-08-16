<?php

use App\Http\Controllers\Admin\DefectController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Shared\UploaderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('shared')->group(function(){
    Route::post('upload', [UploaderController::class, 'upload'])->name('shared.uploader.upload');
});

Route::prefix('line-guru')->group(function(){
    Route::get('/output', [\App\Http\Controllers\Api\LineGuru\GarmentTrackingController::class, 'index']);
});

Route::prefix('admin')->group(function(){

    Route::prefix('product')->group(function(){

        Route::get('list-all', [ProductController::class, 'listAll'])->name('admin.product.list-all');
        Route::post('save-one', [ProductController::class, 'saveOne'])->name('admin.product.save-one');
        Route::get('{id}/edit-one', [ProductController::class, 'editOne'])->name('admin.product.edit-one');
        Route::put('{id}/modify-one', [ProductController::class, 'modifyOne'])->name('admin.product.modify-one');
        Route::put('{id}/change-primary-picture', [ProductController::class, 'changePrimaryPicture'])->name('admin.product.change-primary-picture');
        Route::delete('{id}/destroy-one', [ProductController::class, 'destroyOne'])->name('admin.product.destroy-one');

    });

    Route::prefix('defects')->group(function(){
        Route::get('translations', [DefectController::class, 'listAllTranslation'])->name('admin.defects.translations');
    });


});

Route::patch('/full-qc/{page}/defect-analysis', [\App\Http\Controllers\Inspector\FullQcController::class,'defectAnalysis'])->name('full-qc.defect-analysis.report');
Route::patch('/full-qc/{page}/defect-analysis-transcaction', [\App\Http\Controllers\Inspector\FullQcController::class,'defectAnalysisTransaction'])->name('full-qc.defect-analysis-transcaction.report');

