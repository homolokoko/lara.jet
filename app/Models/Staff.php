<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Staff extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'staff';
    protected $fillable = [
        'user_id',
        'position_id',
        'name_kh',
        'name_en',
        'edu_lvl',
        'is_female',
        'is_married',
        'is_female',
        'level',
        'dob'
    ];
}
