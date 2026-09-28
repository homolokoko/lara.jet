<?php

namespace App\Models\Student;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Relative extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'student_relative';
    protected $fillable = ['name','job','main_number','subs_number'];
}
