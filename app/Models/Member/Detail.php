<?php

namespace App\Models\Member;

use App\Library\Helper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Detail extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $timestamps = false;
    protected $table = 'users_detail';
    protected $fillable = ['user_id','dob','room','shift','lvl','edu_lvl','position','is_female','is_married','other'];
    protected $appends = ['shift_period','edu_label'];

    public function getShiftPeriodAttribute()
    {
        return Helper::getShift($this->shift);
    }

    public function getEduLabelAttribute()
    {
        return Helper::getEducationLevel($this->edu_lvl);
    }
}
