<?php

namespace App\Models\Inspector\HeatSealMachine;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actual extends Model
{
    use HasFactory;

    protected $table = 'heat_seal_machine_actual';
    protected $fillable = ['time','pressure','temperature','heat_seal_machine_id'];
    public $timestamps = false;

}
