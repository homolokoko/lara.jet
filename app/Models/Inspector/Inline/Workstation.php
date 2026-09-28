<?php

namespace App\Models\Inspector\Inline;

use App\Models\Configure\WorkstationJobSeqs;
use App\Models\Configure\WorkstationLocate;
use App\Models\Configure\Workstations;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

class Workstation extends Model
{
    use HasFactory;
    use HasRelationships;
    public $table = 'insp_inline_workstation';
    protected $fillable = ['insp_inline_profile_id','workstation_id'];
    public $timestamps = false;

    public function profile(){
        return $this->belongsTo(Profile::class,'insp_inline_profile_id');
    }
    public function locate(){
        return $this->hasOneThrough(
            WorkstationLocate::class,
            Workstations::class,'id','id','workstation_id','workstation_locate_id');
    }
    public function number(){
        return $this->belongsTo(Workstations::class,'workstation_id');
    }
    public function operator(){
        return $this->hasManyDeepFromRelations(
            $this->profile(),
            (new Profile)->operator()
        );
    }
    public function problem() {
        return $this->hasManyDeepFromRelations($this->profile(), (new Profile)->problem());
    }
    public function operation() {
        return $this->hasManyDeepFromRelations($this->profile(), (new Profile)->InlineJobSeq());
    }


}
