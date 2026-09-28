<?php

namespace Modules\ProcessQCModule\Http\Controllers\AssemblySewingOnline\EndlineAudit;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Arr;
use Modules\ProcessQCModule\Entities\Inspection;

class InlineInspectionController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $query = Inspection\LocationEntity::with([
            'transactions.garment',
            'endlineProfiles.items'
        ])
        ->where(['workstation_locates_type_id'=>'1','is_day_shift'=>true])
        ->whereBetween('updated_at',[\Carbon\Carbon::parse('2025-05-26')->startOfDay(),\Carbon\Carbon::parse('2025-05-30')->endOfDay()]);
        return response()->json($query->get());
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return response()->json([]);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('processqcmodule::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('processqcmodule::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }

    public function setup()
    {
        return view('processqcmodule::templates.assembly-sewing-online.endline-audit.inline-inspection.setup');
    }

    public function report()
    {
        // $query = Inspection\LocationEntity::with([
        //     'transactions'=>fn($q)
        //         =>$q->whereBetween('created_at',[\Carbon\Carbon::parse('2025-05-26')->startOfDay(),\Carbon\Carbon::parse('2025-06-01')->endOfDay()]),
        //     'transactions.garment',
        //     ])->where(['is_day_shift'=>true,'workstation_locates_type_id'=>1]);
        // $mapped = $query->where('id','13')->get()->map(function($lines){
        //     return $lines;
        // });
        // return response()->json($mapped);
        return view('processqcmodule::templates.assembly-sewing-online.endline-audit.inline-inspection.report');
    }

    public function inspector()
    {
        return view('processqcmodule::templates.assembly-sewing-online.endline-audit.inline-inspection.inspector');
    }

}
