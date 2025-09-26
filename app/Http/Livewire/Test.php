<?php

namespace App\Http\Livewire;

use App\Models\Configure\Styles;
use Livewire\Component;
use Livewire\Request;
use Livewire\WithPagination;

class Test extends Component
{
//    use WithPagination;

    public function render()
    {
        return view('livewire.test');
    }

    public function load($page)
    {
        $source = Styles::class;
        return $source::with('buyer')->paginate(15, ['*'], 'page', $page)->toArray();
    }
}
