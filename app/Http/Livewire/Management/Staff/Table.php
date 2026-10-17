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
        return \App\Models\Member\Profile::with(
            'detail',
            'roles',
            'phonenumbers',
            'addresses.street',
            'addresses.city',
            'addresses.state',
            'addresses.zip',
            'photograph',
            'relatives.phonenumbers'
        )->orderBy('id','asc')->paginate($per_page,['*'],'page',$page)->toArray();
    }

    public function remove($id)
    {
        return \App\Models\Member\Profile::where('id',$id)->delete();
    }
}
