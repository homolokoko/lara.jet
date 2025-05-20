<?php

namespace Modules\ComplianceAndProductSafety\Http\Controllers\Safety;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class HumidityController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('complianceandproductsafety::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('complianceandproductsafety::create');
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
        return view('complianceandproductsafety::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('complianceandproductsafety::edit');
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
        return view('complianceandproductsafety::templates.safety.humidity.setup');
    }

    public function report()
    {
        return response()->json(
            \Modules\ComplianceAndProductSafety\Entities\Humidity\RootEntity::with([
                'style',
                'location',
                'timePeriod'
            ])->get()
        );
        return view('complianceandproductsafety::templates.safety.humidity.report');
    }

    public function inspector()
    {
        return view('complianceandproductsafety::templates.safety.humidity.inspector');
    }

}
