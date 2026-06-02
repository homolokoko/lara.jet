<?php

namespace App\Models\Student;

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
    protected $fillable = ['name_kh','name_en','gender','date_of_birth','shift','staff_id','room','other','mother_id','father_id','birth_address_id','current_address_id'];
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
        switch($this->shift):
            case 'i':
                return '07:30-10:30';
                break;
            case 'ii':
                return '01:30-04:30';
                break;
            case 'iii':
                return '05:30-06:30';
                break;
            case 'iv':
                return '06:30-07:30';
                break;
            default :
                return 'Undecided';
                break;
        endswitch;
    }
}
