<?php

namespace App\Http\Livewire\Inspector\FullQc;

use App\Library\GetValueTextList;
use App\Models\Location;
use App\Models\Style;
use App\Models\User;
use Livewire\Component;

class Report extends Component
{
    public $module;

    public function render()
    {
        return view('livewire.inspector.full-qc.report');
    }

    public function load()
    {
        $styles = GetValueTextList::convert(Style::get());
        $locations = GetValueTextList::convert(Location::get());
        $inspectors = GetValueTextList::convert(User::get());
        return compact('styles','locations','inspectors');
    }
}
