<?php

namespace App\Models\Inspector\Recovery;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Inspector\Endline as InspectorEndline;

class Endline extends Model
{
    use HasFactory;
    use \Staudenmeir\EloquentHasManyDeep\HasRelationships;

    public $table = "recovery_endline";
    protected $fillable = [
        'repair_id',
        'header_id'
    ];
    public $timestamps = false;

    function repair()
    {
        return $this->belongsTo(InspectorEndline\Repair::class, 'repair_id');
    }

    function style()
    {
        return $this->hasOneDeepFromRelations(
            $this->repair(),
            (new InspectorEndline\Repair)->style()
        );
    }
    function defect()
    {
        return $this->hasOneDeepFromRelations(
            $this->repair(),
            (new InspectorEndline\Repair)->defects()
        );
    }
    function checkpoint()
    {
        return $this->hasOneDeepFromRelations(
            $this->repair(),
            (new InspectorEndline\Repair)->checkpoint()
        );
    }
    function defectImage()
    {
        return $this->hasOneDeepFromRelations(
            $this->repair(),
            (new InspectorEndline\Repair)->defectEndlineRecord()
        );
    }
    function locate()
    {
        return $this->hasOneDeepFromRelations(
            $this->repair(),
            (new InspectorEndline\Repair)->locate()
        );
    }
}
