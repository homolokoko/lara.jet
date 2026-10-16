<?php

namespace App\Http\Livewire\Management\Attendance;
use App\Library\Helper;
use App\Models\Staff\User;
use Carbon\Carbon;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.management.attendance.index');
    }

    public function getRelatedData($filter)
    {
        $day = Carbon::today()->day;
        $years = Helper::getYear();
        $months = Helper::getMonth();
        $years = Helper::getYear();
        if(empty($filter['year']) || empty($filter['month'])){
            $year = Carbon::today()->year;
            $month = Carbon::today()->month;
            $end_of_month = Carbon::today()->endOfMonth()->day;
        }else{
            $year = $filter['year'];
            $month = $filter['month'];
            $end_of_month = Carbon::create($filter['year'], $filter['month'], 1)->endOfMonth()->day;
        }
        return ['filter'=>compact('year','month','day'),'data'=>compact('years','months','end_of_month')];
    }

    public function fetchdata()
    {
        return [];
    }
}
