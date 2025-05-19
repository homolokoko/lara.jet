<?php

namespace Modules\ProcessQCModule\Http\Controllers\AssemblySewingOnline\EndlineAudit;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class InlineInspectionController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('processqcmodule::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('processqcmodule::create');
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
        return view('processqcmodule::templates.assembly-sewing-online.endline-audit.inline-inspection.report');
    }

    public function inspector()
    {
        return view('processqcmodule::templates.assembly-sewing-online.endline-audit.inline-inspection.inspector');
    }

}
