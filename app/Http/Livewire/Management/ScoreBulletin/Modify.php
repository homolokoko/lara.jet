<?php

namespace App\Http\Livewire\Management\ScoreBulletin;

use App\Models\ScoreBullet\Header;
use App\Models\ScoreBullet\Subjects;
use Illuminate\Support\Arr;
use Livewire\Component;

class Modify extends Component
{
    public function render()
    {
        return view('livewire.management.score-bulletin.modify');
    }

    public function chosenMark($id)
    {
        return Header::with('student','course','subjects')->where('id',$id)->first()->toArray();
    }

    public function submitItems($deletedItems,$id,$subjects)
    {
        foreach($subjects as $subject):
            $where = ['id'=>Arr::get($subject,'id')];
            $item = [
                'score_bullet_header_id'=>$id,
                'subject'=>Arr::get($subject,'subject'),
                'full_marks'=>Arr::get($subject,'full_marks'),
                'actual_marks'=>Arr::get($subject,'actual_marks')
            ];
            Subjects::updateOrCreate($where,$item);
        endforeach;
        Subjects::whereIn('id',$deletedItems)->delete();
    }
}
