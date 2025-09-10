<?php

namespace App\Models\Configure\CLFB;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;
    protected $table='clfb_type';
    protected $fillable = ['name'];
}