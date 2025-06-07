<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkstaionLocate extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'workstation_locates';
    protected $fillable = ['name'];

}
