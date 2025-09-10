<?php

namespace App\Models\Inspector\FusingMachine;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Given extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'fusing_machine_given';
    protected $fillable = ['time','pressure','temperature','fusing_machine_id'];

}
