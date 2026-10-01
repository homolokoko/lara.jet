<?php

namespace App\Http\Livewire\Management\ScoreBulletin;

use App\Models\ScoreBullet\Header;
use Livewire\Component;

class Datatable extends Component
{
    public function render()
    {
        return view('livewire.management.score-bulletin.datatable');
    }

    public function retrievedata($page,$perpage,$filter)
    {
        return Header::with('student','course')->paginate($perpage,['*'],'page',$page)->toArray();
    }
}
