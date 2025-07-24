<?php

namespace Modules\ConstructionMachinary\Http\Livewire;

use Livewire\Component;
use Modules\ConstructionMachinary\Entities\Category as CategoryEntity;

class Category extends Component
{
    public function render()
    {
        $categories = CategoryEntity::get();
        return view('constructionmachinary::livewire.category', compact('categories') );
    }
}
