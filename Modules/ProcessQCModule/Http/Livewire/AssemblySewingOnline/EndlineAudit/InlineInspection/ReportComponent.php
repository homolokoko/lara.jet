<?php

namespace Modules\ProcessQCModule\Http\Livewire\AssemblySewingOnline\EndlineAudit\InlineInspection;

use Modules\ProcessQCModule\Entities\Inspection\LocationEntity;
use Livewire\Component;

class ReportComponent extends Component
{

    public function fetch()
    {
        $query = LocationEntity::with([
            'transactions'=>fn($q)=>$q
                ->whereBetween('created_at',[
                    \Carbon\Carbon::parse('2025-05-26')->startOfDay(),
                    \Carbon\Carbon::parse('2025-06-01')->endOfDay()
                ]),
            'transactions.garment',
            'transactions.inspector'
            ])->where(['is_day_shift'=>true,'workstation_locates_type_id'=>1]);
        return $query->get()->toArray();
    }

    public function render()
    {
        return view('processqcmodule::livewire.assembly-sewing-online.endline-audit.inline-inspection.report-component');
    }
}
