<?php

namespace App\Models\Inspector\Inline;

use App\Models\Configure\CheckPoints;
use App\Models\Configure\Defects as ConfigureDefects;
use App\Models\Configure\Size;
use App\Models\Configure\Color;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Item extends Model
{
    use HasFactory;
    use \Staudenmeir\EloquentHasManyDeep\HasRelationships;

    public $table = "insp_inline_item";
    protected $fillable = ['insp_inline_profile_id', 'color_id', 'item_no', 'sizes_id',  'is_accept', 'is_repair', 'is_damage'];
    protected $sequences = ['item_no'];
    public $timestamps = false;

    public function profile()
    {
        return $this->belongsTo(Profile::class, 'insp_inline_profile_id');
    }
    public function Repair()
    {
        return $this->hasMany(Repair::class, 'insp_inline_item_id');
    }
    public function Measure()
    {
        return $this->hasMany(Measure::class, 'insp_inline_item_id');
    }
    public function Defect()
    {
        return $this->hasMany(Defect::class, 'insp_inline_item_id');
    }
    public function Color()
    {
        return $this->belongsTo(Color::class, 'color_id');
    }
    public function DefectList()
    {
        return $this->hasManyThrough(
            ConfigureDefects::class,
            Defect::class,
            'insp_inline_item_id',
            'id',
            'id',
            'defects_id'
        );
        //return $this->hasMany(Defect::class,'insp_measure_inline_item_id');
    }

    public function MeasureCheckpointList()
    {
        return $this->hasManyThrough(
            CheckPoints::class,
            Measure::class,
            'insp_inline_item_id',
            'id',
            'id',
            'check_points_id'
        );
    }
    public function CheckpointList()
    {
        return $this->hasManyThrough(
            CheckPoints::class,
            Defect::class,
            'insp_inline_item_id',
            'id',
            'id',
            'check_points_id'
        );
    }

    public function Sizes()
    {
        return $this->belongsTo(Size::class);
    }
    public function Comment()
    {
        return $this->hasMany(Comment::class, 'insp_inline_item_id');
    }
    public function ProfilePurchaseOrder()
    {
        return $this->hasOneDeepFromRelations(
            $this->profile(),
            (new Profile)->purchaseOrder()
        );
    }
    public function ProfileStyle()
    {
        return $this->hasOneDeepFromRelations(
            $this->profile(),
            (new Profile)->style()
        );
    }
    public function ProfileOperator()
    {
        return $this->hasOneDeepFromRelations(
            $this->profile(),
            (new Profile)->operator()
        );
    }
    public function ProfileJobSeqs()
    {
        return $this->hasOneDeepFromRelations(
            $this->profile(),
            (new Profile)->InlineJobSeq()
        );
    }
}
