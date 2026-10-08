<?php

namespace App\Models;

use App\Library\Helper;
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
        return Helper::getEducationLevel($this->edu_lvl);
    }
}
