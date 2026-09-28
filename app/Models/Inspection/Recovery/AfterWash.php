<?php

namespace App\Models\Inspector\Recovery;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Inspector\AfterWash as InspectorAfterWash;

class AfterWash extends Model
{
    use HasFactory;
    public $table = "recovery_afterwash";
    protected $fillable = [
        'repair_id'
    ];
    public $timestamps = false;

    function repair()
    {
        return $this->belongsTo(InspectorAfterWash\Repair::class, 'repair_id');
    }
    function defect()
    {
        return $this->hasOneDeepFromRelations(
            $this->repair(),
            (new InspectorAfterWash\Repair)->defects()
        );
    }
    function checkpoint()
    {
        return $this->hasOneDeepFromRelations(
            $this->repair(),
            (new InspectorAfterWash\Repair)->checkpoint()
        );
    }
    function defectImage()
    {
        return $this->hasOneDeepFromRelations(
            $this->repair(),
            (new InspectorAfterWash\Repair)->garmentIssue()
        );
    }
    function locate()
    {
        return $this->hasOneDeepFromRelations(
            $this->repair(),
            (new InspectorAfterWash\Repair)->locate()
        );
    }
}
