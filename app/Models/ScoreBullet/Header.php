<?php

namespace App\Models\ScoreBullet;

use App\Models\Course\Header as Course;
use App\Models\Student\Profile as Student;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Library\Helper;

class Header extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'score_bullet_header';
    protected $fillable = ['user_id','student_id','course_id','shift','type','month','year','time_of_leave','time_of_absence'];

    public $appends = ['shift_label','type_label','month_label'];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class,'student_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class,'course_id');
    }

    public function subjects()
    {
        return $this->hasMany(Subjects::class,'score_bullet_header_id');
    }

    public function getShiftLabelAttribute()
    {
        return Helper::getShift($this->shift);
    }

    public function getTypeLabelAttribute()
    {
        $types = ['-','Monthly','Semester','Final'];
        return $types[$this->type];
    }

    public function getMonthLabelAttribute()
    {
        return Helper::getMonth($this->month);
    }

}
