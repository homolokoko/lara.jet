<?php

namespace App\Http\Livewire\Management\ScoreBulletin;

use App\Models\ScoreBullet\Header;
use Livewire\Component;

class View extends Component
{
    public function render()
    {
        return view('livewire.management.score-bulletin.view');
    }

    public function chosenMark($id)
    {
        return Header::with('student','course','subjects')->where('id',$id)->first()->toArray();
    }
}
