<?php

namespace App\Http\Controllers\Api\LineGuru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inspection\Endline;

class GarmentTrackingController extends Controller
{

    public function index()
    {
        $query = Endline\ProfileEntity::with([
            'style',
            'items.garmentTracking.ticket',
            'items.garmentTracking.transactions',
            ])->whereDate('updated_at','2025-05-26');
        return response()->json($query->get());

    }

}
