<?php

namespace Modules\ConstructionMachinary\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $table = 'const_machine_category';
    protected $fillable = ['name'];

    protected static function newFactory()
    {
        return \Modules\ConstructionMachinary\Database\factories\CategoryFactory::new();
    }
}
