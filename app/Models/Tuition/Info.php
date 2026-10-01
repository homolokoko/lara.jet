<?php

namespace App\Models\Tuition;

use App\Models\Course\Header as Course;
use App\Models\Staff\User as Staff;
use App\Models\Student\Profile as Student;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Info extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'tuition_info';
    protected $fillable = ['off','user_id','course_id','staff_id','student_id','phonenumber'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staff_id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function list()
    {
        return $this->hasMany(Detail::class, 'tuition_info_id');
    }
}
