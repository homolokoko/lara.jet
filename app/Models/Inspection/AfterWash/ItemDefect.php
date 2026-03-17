<?php

namespace App\Models\Inspector\AfterWash;

use App\Models\Configure\CheckPoints;
use App\Models\Configure\Defect\Cause;
use App\Models\Configure\Defects;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App\Models\Inspector\AfterWash\Item;

class ItemDefect extends Model
{
    use HasFactory;
    public $table = 'insp_afterwash_defect';
    protected $fillable = [
        'insp_item_id',
        'defects_id',
        'check_points_id',
        'image',
        'style_profile_id',
        'style_profile_apperal_id',
        'defect_category_id',
        'defect_cause_id',
        'operator_id'
    ];
    protected $appends = ['ImageUrl','garmentDefectImage'];


    public function defect()
    {
        return $this->belongsTo(Defects::class, 'defects_id');
    }
    public function checkpoint()
    {
        return $this->belongsTo(CheckPoints::class, 'check_points_id');
    }
    public function cause()
    {
        return $this->belongsTo(Cause::class, 'defect_cause_id');
    }
    public function item()
    {
        return $this->belongsTo(Item::class, 'insp_item_id', 'id');
    }
    public function getImageUrlAttribute()
    {
        return ($this->image) ? Storage::disk('afterWash')->url($this->image) : '';
    }

    public function getGarmentDefectImageAttribute()
    {
        return !($this->image) ? '': Storage::url($this->image);
    }

    public function itemRepair()
    {
        return $this
            ->hasOne(Repair::class,'insp_item_defect_id','id');
    }
    public function header()
    {
        return $this->hasOneDeepFromRelations(
            $this->item(),
            (new Item())->profile()
        );
    }
    public function scopePersonInCharge($query, $user_id)
    {
        return $query->where('operator_id', $user_id);
    }

}
