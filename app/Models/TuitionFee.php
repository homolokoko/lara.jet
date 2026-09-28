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
    protected $fillable = ['student_id','course_id','is_paid','is_by_bus','fee_date'];
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
        return $this->fee_date ? \Carbon\Carbon::parse($this->fee_date)->format('F jS, Y'):'Undecided';
    }

    public function getNextTimeAttribute()
    {
        return $this->fee_date ? \Carbon\Carbon::parse($this->fee_date)->addMonth()->format('F jS, Y'):'Undecided';
    }
}
