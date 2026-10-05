<?php

namespace App\Http\Livewire\Management;

use App\Library\Helper;
use Livewire\Component;

class CertificateScoring extends Component
{
    public function render()
    {
        return view('livewire.management.certificate-scoring');
    }

    public function getSourceData()
    {
        $types = Helper::getType();
        $years = Helper::getYear();
        $months = Helper::getMonth();
        $studyPeriods = Helper::getStudyPeriod();
        return ['type'=>$types,'years'=>$years,'months'=>$months,'style_periods'=>$studyPeriods];
    }
}
