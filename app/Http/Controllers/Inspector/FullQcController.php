<?php

namespace App\Http\Controllers\Inspector;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Library\Fullqc\Inspection\Base;
use Illuminate\Support\Arr;

class FullQcController extends Controller
{
    public function packing(Request $request, $page)
    {
        if($page=='form')
            return view('Inspector.FullQc.Form',['module'=>'packing']);
        if($page=='report')
            return view('Inspector.FullQc.Report',['module'=>'packing']);
    }

    public function afterwash(Request $request, $page)
    {
        if($page=='form')
            return view('Inspector.FullQc.Form',['module'=>'afterwash']);
        if($page=='report')
            return view('Inspector.FullQc.Report',['module'=>'afterwash']);
    }

    public function finishing(Request $request, $page)
    {
        if($page=='form')
            return view('Inspector.FullQc.Form',['module'=>'finishing']);
        if($page=='report')
            return view('Inspector.FullQc.Report',['module'=>'finishing']);
    }

    public function defectAnalysis(Request $request, $module)
    {
        $base = new Base($module);
        return response()->json($base
            ->list(
                $request->style,
                $request->location,
                $request->date,
                $request->inspector
        )->map(function($profile){
            $profile->item_repair = $profile->items->where('is_repair',true);
            $profile->item_pcs = $profile->items->count();
            $profile->repair_pcs = $profile->item_repair->count();
            $profile->pass_pcs = $profile->item_pcs - $profile->repair_pcs;
            return $profile;
        }));
    }

    public function defectAnalysisTransaction(Request $request,$module)
    {
        $base = new Base($module);
        return response()->json($base->transaction(
            $request->style,
            $request->location,
            $request->date,
            $request->inspector
        )->paginate(10));
    }
}
