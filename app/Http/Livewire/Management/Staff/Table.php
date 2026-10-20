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
        return \App\Models\User::with(
            'detail',
            'roles',
            'phonenumbers',
            'addresses.street',
            'addresses.city',
            'addresses.state',
            'addresses.zip',
            'photograph',
            'relatives.phonenumbers'
        )->where('id','!=',auth()->user()->id)->orderBy('id','asc')->paginate($per_page,['*'],'page',$page)->toArray();
    }

    public function remove($id)
    {
        return \App\Models\User::where('id',$id)->delete();
    }
}
