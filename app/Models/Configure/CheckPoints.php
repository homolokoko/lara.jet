<?php

namespace App\Models\Configure;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckPoints extends Model
{
    use HasFactory;
    protected $table = "check_points";
    protected $fillable = ['name'];
}
