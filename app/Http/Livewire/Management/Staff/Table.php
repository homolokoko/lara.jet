<?php

namespace App\Http\Livewire\Management\Staff;

use Livewire\Component;

class Table extends Component
{
    public function render()
    {
        return view('livewire.management.staff.table');
    }

    public function datatable($page,$per_page,$filter)
    {
        return \App\Models\Staff\User::with('staff.position')
            ->orderBy('id','desc')->paginate($per_page,['*'],'page',$page)->toArray();
    }

    public function remove($id)
    {
        return \App\Models\User::where('id',$id)->delete();
    }
}
