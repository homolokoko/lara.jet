<?php

namespace App\Models\Configure;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App\Models\Configure\CheckPoints;
use Illuminate\Database\Eloquent\SoftDeletes;

class StylesApperalsCheckPoint extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table='styles_apperals_check_points';
    protected $fillable =['styles_apperals_id','check_points_id','number'];

    public function name(){
       return  $this->belongsTo(CheckPoints::class,'check_points_id');
    }

}
