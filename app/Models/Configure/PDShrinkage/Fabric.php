<?php

namespace App\Models\Configure\PDShrinkage;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fabric extends Model
{
    use HasFactory;

    protected $table = 'pd_shrinkage_fabric';
    protected $fillable = ['name'];
    public $timestamps = false;
}
