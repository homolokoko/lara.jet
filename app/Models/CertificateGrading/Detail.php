<?php

namespace App\Models\CertificateGrading;

use App\Models\Student\Profile as Student;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'certificate_grading_detail';
    protected $fillable = ['student_id','header_id','is_absent'];

    public function header()
    {
        return $this->belongsTo(Header::class, 'header_id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}
