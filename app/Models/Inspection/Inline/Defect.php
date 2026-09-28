<?php

namespace App\Models\Inspector\Inline;

use App\Models\Configure\CheckPoints;
use App\Models\Configure\Defects;
use App\Models\Configure\DefectsCategoryTitle;
use App\Models\Configure\JobSeqs;
use App\Models\Configure\Defect\Cause AS DefectCause;
use App\Models\Configure\DefectsTypeCategoryTopic;



use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Storage;
use Staudenmeir\EloquentHasManyDeep\HasManyDeep;
use Staudenmeir\EloquentHasManyDeep\HasOneDeep;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

class Defect extends Model
{
    use HasFactory;
    use HasRelationships;

    public $table = 'insp_inline_defect';
    protected $fillable = [
    'defects_id',
    'job_seqs_id',
    'check_points_id',
    'defect_category_id',
    'insp_inline_item_id',
    'image',
    'style_profile_id',
    'style_profile_apperal_id',
    'defect_cause_id'
    ];
    protected $appends = ['happen'];


    public function defectName(){
        return $this->belongsTo(Defects::class,'defects_id');
    }
    public function jobseqs(){
        return $this->belongTo(JobSeqs::class,'job_seqs_id');
    }
    public function defectCategory(){
        return $this->belongsTo(DefectsCategoryTitle::class,'defect_category_id');
    }
    public function checkpointName(){
        return $this->belongsTo(CheckPoints::class,'check_points_id');
    }
    public function defectCause(){
        return $this->belongsTo(DefectCause::class,'defect_cause_id');
    }
    function defectsList(): BelongsTo
    {
        return $this->belongsTo(DefectsTypeCategoryTopic::class,'defects_id','defects_id');
    }
    function repair(): HasOne
    {
        return $this->hasOne(Repair::class,'insp_inline_defect_id');
    }
    function getImageAttribute($value): string
    {
        return  ($value)? Storage::disk('inline')->url($value) : '';
    }
    public function item(){
        return $this->belongsTo(Item::class,'insp_inline_item_id');
    }
    public function profile(): HasOneDeep
    {
        return $this->hasOneDeepFromRelations(
            $this->item(), (new Item)->profile()
        );
    }
    public function color(): HasOneDeep
    {
        return $this->hasOneDeepFromRelations(
            $this->item(), (new Item)->color()
        );
    }
    public function size(): HasOneDeep
    {
        return $this->hasOneDeepFromRelations(
            $this->item(), (new Item)->sizes()
        );
    }
    public function operationCode(): HasManyDeep
    {
        return $this->hasManyDeepFromRelations(
            $this->profile(),
            (new Profile)->InlineJobSeq()
        );
    }
    public function style(): HasOneDeep
    {
        return $this->hasOneDeepFromRelations(
          $this->profile(), (new Profile)->style()
        );
    }

    public function purchaseOrder(): HasOneDeep
    {
        return $this->hasOneDeepFromRelations(
            $this->profile(), (new Profile)->purchaseOrder()
        );
    }
    public function getHappenAttribute(){
        return $this->created_at->format('Y-m-d H:i:s');
    }
}
