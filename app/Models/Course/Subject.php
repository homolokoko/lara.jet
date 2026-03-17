<?php

namespace App\Models\Course;

use App\Models\Configure\SubjectTitle;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'course_subject';
    protected $fillable = ['course_id','subject_id','max_score'];

    public function title()
    {
        return $this->belongsTo(SubjectTitle::class,'subject_id');
    }

}
