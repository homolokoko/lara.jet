<?php

namespace App\Http\Livewire\Inspector\FullQc;

use App\Library\GetValueTextList;
use App\Models\Configure\Styles;
use App\Models\Configure\WorkstationLocate;
use App\Models\User;
use Livewire\Component;

class Report extends Component
{
    public $mode,$report_view;

    public function render()
    {
        return view('livewire.inspector.full-qc.report');
    }

    public function load()
    {
        $styles = GetValueTextList::convert(Styles::get());
        $inspectors = GetValueTextList::convert(User::get());
        $locations = GetValueTextList::convert(WorkstationLocate::sewLineShiftType(true)->get());
        return compact('styles','locations','inspectors');
    }
}
