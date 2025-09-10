<?php

namespace App\Models\Inspector\Cutting\Measure;

use App\Models\Configure\Cutting\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

class Header extends Model
{
    use HasFactory;
    use HasRelationships;
    protected $table = 'cutting_panel_measure_header';

    protected $fillable = [
        'panel_id'
    ];
    public $timestamps = false;
    function checkpoint(){
        return $this->hasMany(Checkpoint::class,'header_id');
    }
    function panelName()
    {
        return $this->belongsTo(
            \App\Models\Configure\Cutting\Panel::class,
            'panel_id');
    }

    function checkpointList()
    {
        return $this->hasManyDeepFromRelations(
            $this->checkpoint(),
            (new Checkpoint())->name()
        );
    }
    function sizeList()
    {
        return $this->hasManyDeepFromRelations(
            $this->checkpoint(),
            (new Checkpoint())->sizeList()
        );
    }
    function recordList(){
        return $this->hasManyDeepFromRelations(
          $this->checkpoint(),
          (new Checkpoint())->recordList()
        );
    }
    public function patternMeasure()
    {
        return $this->hasMany(PanelPattern::class, 'cutting_panel_id','panel_id');
    }

}
