<?php

    use Modules\ProcessQCModule\Http\Controllers\AssemblySewingOnline\EndlineAudit;

    use Modules\ProcessQCModule\http\Controllers\AssemblySewingOnline\InlineDefectController;
use Modules\ProcessQCModule\Http\Controllers\AssemblySewingOnline\EndlineAudit\InlineInspectionController;
use Modules\ProcessQCModule\Http\Livewire\AssemblySewingOnline\EndlineAudit\InlineInspectionComponent;

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

Route::prefix('processqcmodule')->group(function() {

    Route::prefix('cutting')->group(function(){
        Route::prefix('inline-audit')->group(function(){
          Route::get('/', fn()=>redirect()->route('processqcmodule::cutting.inline-audit.inline-cutting'))->name('processqcmodule::cutting.inline-audit');
          Route::get('/inline-cutting','Cutting\InlineAuditController@inlineCutting')->name('processqcmodule::cutting.inline-audit.inline-cutting');
          Route::get('/fabric-audit','Cutting\InlineAuditController@fabricAudit')->name('processqcmodule::cutting.inline-audit.fabric-audit');
        });
        Route::prefix('endline-inspection')->group(function(){
          Route::get('/', fn()=>redirect()->route('processqcmodule::cutting.endline-inspection.endline-cutting'))->name('processqcmodule::cutting.endline-inspection');
          Route::get('/endline-cutting','Cutting\EndlineInspectionController@endlineCutting')->name('processqcmodule::cutting.endline-inspection.endline-cutting');
          Route::get('/fabric-inspection','Cutting\EndlineInspectionController@fabricInspection')->name('processqcmodule::cutting.endline-inspection.fabric-inspection');
        });
        Route::prefix('testing')->group(function(){
            Route::get('/',fn()=>redirect()->route('processqcmodule::cutting.testing.fabric-testing'))->name('processqcmodule::cutting.testing');
            Route::get('fabric-testing','Cutting\TestingController@fabricTesting')->name('processqcmodule::cutting.testing.fabric-testing');
        });
    });

    Route::prefix('embellishment')->group(function(){
        Route::prefix('inline-audit')->group(function(){
            Route::get('/',fn()=>redirect()->route('processqcmodule::embellishment.inline-audit.audit'))->name('processqcmodule::embellishment.inline-audit');
            Route::get('/audit','Embellishment\InlineAuditController@audit')->name('processqcmodule::embellishment.inline-audit.audit');
        });
        Route::prefix('inspection')->group(function(){
            Route::get('/',fn()=>redirect()->route('processqcmodule::embellishment.inspection.endline'))->name('processqcmodule::embellishment.inspection');
            Route::get('/endline','Embellishment\InspectionController@endline')->name('processqcmodule::embellishment.inspection.endline');
        });
    });

    Route::prefix('pre-assembly/sewing-offline')->group(function(){
        Route::prefix('inline-audit')->group(function(){
            Route::get('/',fn()=>redirect()->route('proceesqcmodule::pre-assembly-sewing-offline.inline-audit.offline'))->name('proceesqcmodule::pre-assembly-sewing-offline.inline-audit');
            Route::get('/offline','PreAssemblySewingOffline\InlineAuditController@offline')->name('proceesqcmodule::pre-assembly-sewing-offline.inline-audit.offline');
        });
        Route::prefix('sewing-inspection')->group(function(){
            Route::get('/',fn()=>redirect()->route('proceesqcmodule::pre-assembly-sewing-offline.sewing-inspection.endline'))->name('proceesqcmodule::pre-assembly-sewing-offline.sewing-inspection');
            Route::get('/endline','PreAssemblySewingOffline\SewingInspectionController@endline')->name('proceesqcmodule::pre-assembly-sewing-offline.sewing-inspection.endline');
        });
    });

    Route::prefix('assembly/sewing-online')->group(function(){


        Route::prefix('inline-defect')->group(function(){
            Route::get('/setup', [InlineDefectController::class, 'setup'])->name('processqcmodule::assembly/sewing-online.inline-defect.setup');
            Route::get('/report', [InlineDefectController::class, 'report'])->name('processqcmodule::assembly/sewing-online.inline-defect.report');
            Route::get('/inspector', [InlineDefectController::class, 'inspector'])->name('processqcmodule::assembly/sewing-online.inline-defect.inspector');
            Route::get('/', fn()=>redirect()->route('processqcmodule::assembly/sewing-online.inline-defect.setup'))->name('processqcmodule::assembly/sewing-online.inline-defect');
        });

        Route::prefix('inline-audit')->group(function(){

            Route::prefix('inline')->group(function(){
                Route::get('/',fn()=>redirect()->route('processqcmodule::assembly/sewing-online.inline-audit.inline.setup'))->name('processqcmodule::assembly/sewing-online.inline-audit.inline');
                Route::get('/setup', 'AssemblySewingOnline\InlineAudit\InlineModuleController@setup')->name('processqcmodule::assembly/sewing-online.inline-audit.inline.setup');
                Route::get('/report', 'AssemblySewingOnline\InlineAudit\InlineModuleController@report')->name('processqcmodule::assembly/sewing-online.inline-audit.inline.report');
                Route::get('/inspector', 'AssemblySewingOnline\InlineAudit\InlineModuleController@inspector')->name('processqcmodule::assembly/sewing-online.inline-audit.inline.inspector');
            });

            Route::prefix('measurement-audit')->group(function(){
                Route::get('/',fn()=>redirect()->route('processqcmodule::assembly/sewing-online.inline-audit.measurement-audit.setup'))->name('processqcmodule::assembly/sewing-online.inline-audit.measurement-audit');
                Route::get('/setup', 'AssemblySewingOnline\InlineAudit\MeasurementAuditController@setup')->name('processqcmodule::assembly/sewing-online.inline-audit.measurement-audit.setup');
                Route::get('/report', 'AssemblySewingOnline\InlineAudit\MeasurementAuditController@report')->name('processqcmodule::assembly/sewing-online.inline-audit.measurement-audit.report');
                Route::get('/inspector', 'AssemblySewingOnline\InlineAudit\MeasurementAuditController@inspector')->name('processqcmodule::assembly/sewing-online.inline-audit.measurement-audit.inspector');
            });

            Route::prefix('first-bulk')->group(function(){
                Route::get('/',fn()=>redirect()->route('processqcmodule::assembly/sewing-online.inline-audit.first-bulk.setup'))->name('processqcmodule::assembly/sewing-online.inline-audit.first-bulk');
                Route::get('/setup', 'AssemblySewingOnline\InlineAudit\FirstBulkController@setup')->name('processqcmodule::assembly/sewing-online.inline-audit.first-bulk.setup');
                Route::get('/report', 'AssemblySewingOnline\InlineAudit\FirstBulkController@report')->name('processqcmodule::assembly/sewing-online.inline-audit.first-bulk.report');
                Route::get('/inspector', 'AssemblySewingOnline\InlineAudit\FirstBulkController@inspector')->name('processqcmodule::assembly/sewing-online.inline-audit.first-bulk.inspector');
            });

        });

        Route::prefix('sewing-inspection')->group(function(){
            Route::get('/endline','AssemblySewingOnline\SewingInspection\EndlineModuleController@index')->name('processqcmodule::assembly/sewing-online.sewing-inspection.endline');
        });

        Route::prefix('endline-audit')->group(function(){
            Route::prefix('inline-inspection')->group(function(){
                Route::get('/', fn()=>redirect()->route('processqcmodule::assembly/sewing-online.endline-audit.inline-inspection.setup'))->name('processqcmodule::assembly/sewing-online.endline-audit.inline-inspection');
                Route::get('/setup', [EndlineAudit\InlineInspectionController::class,'setup'])->name('processqcmodule::assembly/sewing-online.endline-audit.inline-inspection.setup');
                Route::get('/report', [EndlineAudit\InlineInspectionController::class,'report'])->name('processqcmodule::assembly/sewing-online.endline-audit.inline-inspection.report');
                Route::get('/inspector', [EndlineAudit\InlineInspectionController::class,'inspector'])->name('processqcmodule::assembly/sewing-online.endline-audit.inline-inspection.inspector');
            });
        });

    });

    Route::prefix('finishing')->group(function(){

        Route::prefix('inline-audit')->group(function(){
            Route::get('/',fn()=>redirect()->route('processqcmodule::finishing.inline-audit.inline'))->name('processqcmodule::finishing.inline-audit');
            Route::get('/inline','Finishing\InlineAuditController@inline')->name('processqcmodule::finishing.inline-audit.inline');
            Route::get('/measurement-audit','Finishing\InlineAuditController@measurementAudit')->name('processqcmodule::finishing.inline-audit.measurement-audit');
        });

        Route::prefix('sewing-inspection')->group(function(){
            Route::get('/',fn()=>redirect()->route('processmodule::finishing.sewing-inspection.endline'))->name('processmodule::finishing.sewing-inspection');
            Route::get('/endline', 'Finishing\SewingInspectionController@endline')->name('processmodule::finishing.sewing-inspection.endline');
        });

        Route::prefix('finishing-inspection')->group(function(){
            Route::get('/',fn()=>redirect()->route('processmodule::finishing.finishing-inspection.measurment'))->name('processmodule::finishing.finishing-inspection');
            Route::get('/measurement', 'Finishing\FinishingInspectionController@measurement')->name('processmodule::finishing.finishing-inspection.measurment');
        });

    });

    Route::prefix('laundry')->group(function(){

        Route::prefix('inline-audit')->group(function(){
            Route::get('/',fn()=>redirect()->route('processqcmodule::laundry.inline-audit.inline-afterwash'))->name('processqcmodule::laundry.inline-audit');
            Route::get('/inline-afterwash', 'Laundry\InlineAuditController@inlineAfterwash')->name('processqcmodule::laundry.inline-audit.inline-afterwash');
            Route::get('/measurement-audit', 'Laundry\InlineAuditController@measurementAudit')->name('processqcmodule::laundry.inline-audit.measurement-audit');
        });

        Route::prefix('sewing-inspection')->group(function(){
            Route::get('/',fn()=>redirect()->route('processqcmodule::laundry.sewing-inspection.endline'))->name('processqcmodule::laundry.sewing-inspection');
            Route::get('/endline', 'Laundry\SewingInspectionController@endline')->name('processqcmodule::laundry.sewing-inspection.endline');
        });

        Route::prefix('finishing-inspection')->group(function(){
            Route::get('/',fn()=>redirect()->route('processqcmodule::laundry.finish-inspection.measurement'))->name('processqcmodule::laundry.finish-inspection');
            Route::get('/measurement','Laundry\FinishingInspectionController@measurement')->name('processqcmodule::laundry.finish-inspection.measurement');
        });

        Route::prefix('endline-audit')->group(function(){
            Route::get('/',fn()=>redirect()->route('processqcmodule::laundry.endline-audit.inline-inspection'))->name('processqcmodule::laundry.endline-audit');
            Route::get('/inline-inspection','Laundry\EndlineAuditController@inlineInspection')->name('processqcmodule::laundry.endline-audit.inline-inspection');
        });

    });

    Route::prefix('packaging')->group(function(){

        Route::prefix('inline-audit')->group(function(){
            Route::get('/',fn()=>redirect()->route('processqcmodule::packaging.inline-audit.inline-packing'))->name('processqcmodule::packaging.inline-audit');
            Route::get('/inline-packing','Packaging\InlineAuditController@inlinePacking')->name('processqcmodule::packaging.inline-audit.inline-packing');
        });

        Route::prefix('sewing-inspection')->group(function(){
            Route::get('/',fn()=>redirect()->route('processqcmodule::packaging.sewing-inspection.endline'))->name('processqcmodule::packaging.sewing-inspection');
            Route::get('/endline','Packaging\SewingInspectionController@endline')->name('processqcmodule::packaging.sewing-inspection.endline');
        });

        Route::prefix('endline-audit')->group(function(){
            Route::get('/',fn()=>redirect()->route('processqcmodule::packaging.endline-audit.inline-inspection'))->name('processqcmodule::packaging.endline-audit');
            Route::get('/inline-inspection','Packaging\EndlineAuditController@inlineInspection')->name('processqcmodule::packaging.endline-audit.inline-inspection');
        });

        Route::prefix('carton-audit')->group(function(){
            Route::get('/',fn()=>redirect()->route('processqcmodule::packaging.carton-audit.pick-n-pack'))->name('processqcmodule::packaging.carton-audit');
            Route::get('/pick-n-pack','Packaging\CartonAuditController@pickNpack')->name('processqcmodule::packaging.carton-audit.pick-n-pack');
        });

    });

});
