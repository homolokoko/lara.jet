<?php

namespace App\Models;

use App\Models\Staff\Position;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Staff extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'staff';
    protected $fillable = ['user_id','position_id','name_kh','name_en','edu_lvl','is_female','is_married','level','dob'];
    public $appends = ['date_of_birth','education_level'];


    public function position()
    {
        return $this
            ->belongsTo(Position::class,'position_id');
    }

    public function getDateOfBirthAttribute()
    {
        return \Carbon\Carbon::parse($this->dob)->format('F jS ,Y');
    }

    public function getEducationLevelAttribute()
    {
        switch($this->edu_lvl):
            case 'i':
                return 'Secondary Education (Grades 7-9)';
                break;
            case 'ii':
                return 'Upper Secondary (Grades 10-12)';
                break;
            case 'iii':
                return 'Diploma';
                break;
            case 'iv':
                return 'Associate Degree';
                break;
            case 'v':
                return 'Bachelor\'s Degree';
                break;
            case 'vi':
                return 'Master\'s Degree';
                break;
            case 'vii':
                return 'Doctorate/Ph.D.';
                break;
        endswitch;
    }
}
