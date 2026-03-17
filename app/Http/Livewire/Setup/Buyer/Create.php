<?php

namespace App\Http\Livewire\Setup\Buyer;

use Livewire\Component;

class Create extends Component
{
    public function render()
    {
        return view('livewire.setup.buyer.create');
    }

    public function submit($name)
    {
        return \App\Models\Configure\Buyers::create(compact('name'));
    }
}
