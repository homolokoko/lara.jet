<?php

namespace App\Models\Student;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profile extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'student_profile';
    protected $fillable = ['name_kh','name_en','gender','date_of_birth','shift','staff_id','room','other','mother_id','father_id','birth_address_id','current_address_id'];
    protected $appends = ['birth_address','current_adrress','mother_info','father_info'];

    public function getMotherInfoAttribute()
    {
        return $this->belongsTo(Relative::class,'mother_id');
    }

    public function getFatherInfoAttribute()
    {
        return $this->belongsTo(Relative::class,'father_id');
    }

    public function getBirthAddressAttribute()
    {
        return [];
    }

    public function getCurrentAdrressAttribute()
    {
        return [];
    }
}
