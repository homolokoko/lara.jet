<?php

namespace App\Http\Controllers\Material;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuditController extends Controller
{
    PRIVATE CONST PU_DATA_EXPORT = '';
    PRIVATE CONST TRIM_DATA_EXPORT = '';
    PRIVATE CONST TEXTILE_DATA_EXPORT = '';
    PRIVATE CONST LEATHER_DATA_EXPORT = '';

    public $dataExport = [
        'check-list'=>'checkList',
        'leather-measurement'=>'leatherMeasurement',
        'material-info-form'=>'materialInfoForm',
        'skin-component'=>'skinComponent',
        'quality-control-system'=>'qualityControlSystem'
    ];

    function index(Request $request)
    {

    }

    function audit(Request $request, $type)
    {
        return 
    }
}

