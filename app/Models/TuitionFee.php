<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TuitionFee extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'tuition_fee';
    protected $fillable = ['student_id','course_id','is_paid','is_by_bus'];
    public $appends = ['last_time','next_time'];

    public function student()
    {
        return $this->belongsTo(Student\Profile::class,'student_id');
    }

    public function course()
    {
        return $this->belongsTo(Course\Header::class, 'course_id');
    }

    public function getLastTimeAttribute()
    {
        return \Carbon\Carbon::parse($this->created_at)->format('F jS, Y');
    }

    public function getNextTimeAttribute()
    {
        return \Carbon\Carbon::parse($this->created_at)->addMonth()->format('F jS, Y');
    }
}
