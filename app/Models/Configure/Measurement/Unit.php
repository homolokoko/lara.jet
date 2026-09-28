<?php

namespace App\Models\Configure\Measurement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;
    protected $table='measurement_unit';
    protected $fillable = ['name'];
}
