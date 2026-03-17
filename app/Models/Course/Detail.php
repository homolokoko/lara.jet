<?php

namespace App\Models\Course;

use App\Models\Staff;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'course_detail';
    protected $fillable = ['name','course_id','staff_id','class_room','status','kh_lvl','en_lvl','monthly_payment','enroll_date','start_course','finish_course','start_session','finish_session'];

    public function staff()
    {
        return $this->belongsTo(Staff::class,'staff_id');
    }
}
