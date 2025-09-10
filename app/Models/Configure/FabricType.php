<?php

namespace App\Models\Configure;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FabricType extends Model
{
    use HasFactory;
    public $table='fabric_type';
    protected $fillable = ['name'];

}
