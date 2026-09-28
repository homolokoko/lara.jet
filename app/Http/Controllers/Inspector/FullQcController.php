<?php

namespace App\Http\Controllers\Inspector;

use App\Http\Controllers\Controller;
use App\Models\FullQc;
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

    public function form($mode,$report_view)
    {
        return view('Inspector.FullQc.Form',compact('mode','report_view'));
    }


    public function report($mode,$report_view)
    {
        return view('Inspector.FullQc.Report',compact('mode','report_view'));
    }

    public function defectAnalysisTransaction(Request $request, $mode,$report_view)
    {
        $base = new Base($mode,$report_view);
        $resource = $base->transaction(
            $request->style,
            $request->location,
            $request->date,
            $request->inspector
        )->where('mode',$base->mode_type)->where('report_view',$base->view_type);


        $listConvertor = \App\Library\GetValueTextList::class;
        $styles = $listConvertor::convert(collect($resource->get())->pluck('style')->unique('id')->values());
        $locations = $listConvertor::convert(collect($resource->get())->pluck('location')->unique('id')->values());
        $inspectors = $listConvertor::convert(collect($resource->get())->pluck('inspector')->unique('id')->values());
        $flatItem = collect(collect($resource->get())->pluck('items')->flatten(1));
        $flat_item = $flatItem->map(fn($item)=>[
            'id'=>$item->id,
            'date'=>$item->date,
            'color'=>$item->color,
            'size'=>$item->size,
            'garment'=>$item->garment,
            'accept_qty'=>$item->accept_qty,
            'reject_qty'=>$item->reject_qty,
            'style'=>$item->profile->style,
            'location'=>$item->profile->location,
            'inspector'=>$item->profile->inspector,
        ]);
        $sizes = $listConvertor::convert($flatItem->pluck('size')->unique('id')->values());
        $colors = $listConvertor::convert($flatItem->pluck('color')->unique('id')->values());
        $inspected = $flatItem->count();
        $pass_pcs = $flatItem->where('is_pass',true)->count();
        $repair_pcs = $flatItem->where('is_repair',true)->count();

        $profile_idx = $resource->get()->pluck('id')->toArray();


        $items = FullQc\Item::with('size','color','style','location','inspector','repairs','garment')
            ->whereIn('fullqc_profile_id',$profile_idx)->orderBy('id','desc')->paginate();

        return response()->json(compact('inspected','pass_pcs','repair_pcs','styles','locations','inspectors','flat_item','items','sizes','colors'));
    }
}
