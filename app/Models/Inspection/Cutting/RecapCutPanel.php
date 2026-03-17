<?php

namespace App\Models\Inspector\Cutting;

use App\Models\Configure\Cutting\Panel;
use App\Models\Configure\Size;
use App\Models\Inspector\Cutting\Panel AS InspectorCuttingCheckPanel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecapCutPanel extends Model
{
    use HasFactory;
    protected $table = 'cutting_recap_panel';
    protected $fillable = [
        'stack_position',
        'cutting_panel_id',
        'size_id',
        'cutting_check_cutPanel_id',
        'cutting_recap_id'
    ];
    public $timestamps = false;

    public function checkCutPanel(){
        return $this->belongsTo(InspectorCuttingCheckPanel::class,'cutting_check_cutPanel_id');
    }
    public function panel(){
        return $this->belongsTo(Panel::class,'cutting_panel_id');
    }
    public function size(){
        return $this->belongsTo(Size::class,'size_id');
    }
    public function recapHeader(){
        return $this->belongsTo(Recap::class,'cutting_recap_id');
    }
}
