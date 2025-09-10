<?php

namespace App\Models\Inspector\Endline;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Configure\CheckPoints;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

class Measure extends Model
{
    use HasFactory;
    use HasRelationships;
    public $table = 'insp_endline_measure';
    protected $fillable = [
        'is_reject',
        'insp_measure_endline_item_id',
        'style_profile_id',
        'style_profile_apperal_id',
        'check_points_id'
    ];
    public $timestamps = true;

    public function checkpoint(){
        return $this->belongsTo( CheckPoints::class,'check_points_id');
    }
    public function styleProfile() {
        return $this->belongsTo( \App\Models\Configure\Style\Profile::class, 'style_profile_id');
    }
    public function style(){
        return $this->hasOneDeepFromRelations(
            $this->styleProfile(),
            (new \App\Models\Configure\Style\Profile())->styles()
        );
    }
}
