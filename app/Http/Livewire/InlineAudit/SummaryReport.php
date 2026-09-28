<?php

namespace App\Http\Livewire\InlineAudit;

use App\Library\DateRange;
use App\Models\Inspector\Inline\Profile;
use Illuminate\Support\Arr;
use Livewire\Component;

class SummaryReport extends Component
{
    public function render()
    {
        return view('livewire.inline-audit.summary-report');
    }

    public function load($date)
    {
        $profile = Profile::query();
        if(Arr::get($date,'mode')==='single') {
            $profile = $profile->whereDate('created_at', Arr::get($date, 'value'));
        }
        if(Arr::get($date,'mode')==='range') {
            $explode = explode('to',Arr::get($date,'value'));
            if(count($explode)<2) {
                $profile->whereDate('created_at',Arr::get($date,'value'));
            }else {
                list($start,$end) = $explode;
                $end = DateRange::end($end);
                $start = DateRange::start($start);
                $profile = $profile->whereBetween('created_at',[$start,$end]);
            }
        }
        return $profile->get()->map(fn($profile)=>$profile)->toArray();
    }
}
