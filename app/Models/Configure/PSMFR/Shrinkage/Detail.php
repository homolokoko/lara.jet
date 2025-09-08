<?php

namespace App\Models\Configure\PSMFR\Shrinkage;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Configure\Measure\Profile;
use Illuminate\Database\Eloquent\SoftDeletes;

class Detail extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'psmfr_shrinkage_detail';
    protected $fillable = [
        'measure_profile_detail_id', 'shrinkage','header_id'
    ];

    public function checkpoint(){
        return $this->belongsTo(Profile\Detail::class, 'measure_profile_detail_id');
    }
    public function header(){
        return $this->belongsTo(Header::class, 'header_id');
    }

}
