<?php

namespace App\Models\Member;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Detail extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $timestamps = false;
    protected $table = 'users_detail';
    protected $fillable = ['user_id','dob','room','shift','lvl','edu_lvl','position','is_female','is_married','other'];
}
