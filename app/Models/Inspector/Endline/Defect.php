<?php

namespace App\Models\Inspector\Endline;

use App\Models\Configure\CheckPoints;
use App\Models\Configure\Defects;
use App\Models\Configure\DefectsCategoryTitle;
use App\Models\Configure\DefectsTypeCategoryTopic;
use App\Models\Configure\Defect\Cause as DefectCause;
use App\Models\Configure\Style\Profile as StyleProfile;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

class Defect extends Model
{
    use HasFactory;
    use softDeletes;
    use HasRelationships;

    public $table = 'insp_endline_defect';
    protected $fillable = [
        'defects_id',
        'check_points_id',
        'insp_measure_endline_item_id',
        'image',
        'style_profile_id',
        'style_profile_apperal_id',
        'defect_category_id',
        'defect_cause_id',
        'operator_id',
        'transaction_id',
    ];
    //protected $appends = ['imageName'];

    public function styleProfile()
    {
        return $this->belongsTo(StyleProfile::class, 'style_profile_id');
    }

    public function defectname()
    {
        return $this->belongsTo(Defects::class, 'defects_id');
    }

    public function checkpoint()
    {
        return $this->belongsTo(CheckPoints::class, 'check_points_id');
    }
    public function checkpointName()
    {
        return $this->belongsTo(CheckPoints::class, 'check_points_id');
    }
    public function defectCategory()
    {
        return $this->belongsTo(DefectsCategoryTitle::class, 'defect_category_id');
    }

    public function category()
    {
        return $this->belongsTo(DefectsCategoryTitle::class, 'defect_category_id');
    }

    public function getImageAttribute($value)
    {
        if (!$value) {
            return '/noimage.png';
        }
        $exists = Storage::disk('endline')->exists($value);
        if (!$exists) {
            return '/noimage.png';
        }
        return  Storage::disk('endline')->url($value);
    }

    public function defectsList()
    {
        return $this->belongsTo(DefectsTypeCategoryTopic::class, 'defects_id', 'defects_id');
    }
    public function defectCause()
    {
        return $this->belongsTo(DefectCause::class, 'defect_cause_id');
    }
    public function item()
    {
        return $this->belongsTo(Item::class, 'insp_measure_endline_item_id', 'id');
    }
    public function workstation()
    {
        return $this->hasManyDeepFromRelations(
            $this->item(),
            (new Item)->workstation()
        );
    }
    public function operator()
    {
        return $this->belongsTo(User::class, 'operator_id');
    }

    public function scopePersonInCharge($query, $user_id)
    {
        return $query->where('operator_id', $user_id);
    }
    public function locate()
    {
        return $this->hasOneDeepFromRelations(
            $this->item(),
            (new Item())->workstation()
        );
    }
    public function header()
    {
        return $this->hasOneDeepFromRelations(
            $this->item(),
            (new Item())->profile()
        );
    }
    public function case()
    {
        return $this->hasOneDeepFromRelations(
            $this->item(),
            (new Item())->repair()
        );
    }

    public function itemRepair()
    {
        return $this->hasOne(Repair::class, 'insp_endline_defect_id', 'id');
    }
}
