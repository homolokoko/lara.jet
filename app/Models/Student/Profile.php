<?php

namespace App\Models\Student;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profile extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'student_profile';
    protected $fillable = ['name_kh','name_en','gender','date_of_birth','shift','staff_id','room','other','mother_id','father_id','birth_address_id','current_address_id'];
}
