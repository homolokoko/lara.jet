<?php

namespace Modules\TestDependency\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TblOrderEntity extends Model
{
    use HasFactory;

    protected $fillable = [];
    
    protected static function newFactory()
    {
        return \Modules\TestDependency\Database\factories\TblOrderEntityFactory::new();
    }
}
