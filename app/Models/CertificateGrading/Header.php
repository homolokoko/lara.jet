<?php

namespace App\Models\CertificateGrading;

use App\Library\Helper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Header extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'certificate_grading_header';
    protected $fillable = ['year','month','shift','final_at','lvl'];

    public $appends = ['lbl_month','lbl_shift','lbl_final_at'];

    public function details()
    {
        return $this->hasMany(Detail::class,'header_id');
    }

    public function getLblMonthAttribute()
    {
        return Helper::getMonth($this->month);
    }

    public function getLblShiftAttribute()
    {
        return Helper::getMonth($this->shift);
    }

    public function getLblFinalAtAttribute()
    {
        return Helper::getMonth($this->month);
    }
}
