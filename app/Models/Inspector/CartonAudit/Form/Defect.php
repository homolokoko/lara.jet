<?php

namespace App\Models\Inspector\CartonAudit\Form;

use App\Models\Configure\Defect\Cause;
use App\Models\Configure\Defect\CauseTranslation;
use App\Models\Configure\Defects;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOneOrMany;
use Illuminate\Support\Facades\Storage;

class Defect extends Model
{
    use HasFactory;
    use \Staudenmeir\EloquentHasManyDeep\HasRelationships;

    public $table="carton_audit_form_defect";
    protected $fillable = [
        'carton_audit_form_detail_id',
        'defect_id',
        'image',
        'defect_cause_id',
        'defect_id',
    ];


    public function header(){
        return $this->hasOneThrough(Header::class,Detail::class,
        'id',
        'id',
        'carton_audit_form_detail_id',
        'carton_audit_form_header_id'
        );
     //$this->belongsTo(Detail::class,'carton_audit_form_detail_id');
    }
    
    public function cause(){
        return $this->belongsTo(Cause::class,'defect_cause_id');
    }
    public function defect(){
        return $this->belongsTo(Defects::class,'defect_id');
    }
    public function defectName(){
        return $this->hasManyDeepFromRelations(
            $this->defect(), (new Defects)->translations()
        );
    }
    public function causeName(){
        return $this->hasManyDeepFromRelations(
            $this->cause(), (new Cause)->translations()
        );
    }
    
    public function getImageAttribute($value){
        /*if (Storage::disk('defect')->exists($value)) {
           $result = Storage::url('storage/defect/'.$value);
        }*/
        //return  ($result)? $result : '' ;
    }
    
}
