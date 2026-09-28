<?php

namespace App\Models\Configure;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkstationLocateType extends Model
{
    use HasFactory;
    public $table = 'workstation_locate_type';
    protected $fillable = ['name'];

}
