<?php

namespace App\Models\Student;

use App\Models\TuitionFee;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\CountryCatalog\Entities\Street;

class Profile extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'student_profile';
    protected $fillable = ['name_kh','name_en','is_female','date_of_birth','shift','staff_id','room','other','mother_id','father_id','birth_address_id','current_address_id','identity'];
    protected $appends = ['shift_period','official_dob'];

    public function staff()
    {
        return $this->belongsTo(User::class,'staff_id');
    }

    public function motherInfo()
    {
        return $this->belongsTo(Relative::class,'mother_id');
    }

    public function fatherInfo()
    {
        return $this->belongsTo(Relative::class,'father_id');
    }

    public function tuitionFee()
    {
        return $this->hasOne(TuitionFee::class,'student_id');
    }

    public function birthAddress()
    {
        return $this->belongsTo(Street::class,'birth_address_id');
    }

    public function currentAddress()
    {
        return $this->belongsTo(Street::class,'current_address_id');
    }

    public function getOfficialDobAttribute()
    {
        return \Carbon\Carbon::parse($this->date_of_birth)->format('jS F,Y');
    }

    public function getShiftPeriodAttribute()
    {
        return \App\Library\Helper::getShift($this->shift);
    }
}
