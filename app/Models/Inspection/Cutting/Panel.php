<?php

namespace App\Models\Inspector\Cutting;

use App\Models\Configure\Cutting\Panel as ConfigureCuttingPanel;
use App\Models\Configure\Size;
use App\Models\Configure\Style;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

class Panel extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasRelationships;
    public $table="cutting_check_cutPanel";
    protected $fillable = [
        'cutting_panel_id',
        'size_id',
        'top_is_correct',
        'middle_is_correct',
        'bottom_is_correct',
        'cutting_header_id'
    ];
    public function size(){
        return $this->belongsTo(Size::class,'size_id');
    }
    public function panel(){
        return $this->belongsTo(ConfigureCuttingPanel::class,'cutting_panel_id');
    }
    public function header(){
        return $this->belongsTo(Header::class,'cutting_header_id');
    }
    public function image(){
        return $this->hasMany(PanelImage::class,'cutting_check_cutPanel_id');
    }
    public function recapDetail(){
        return $this->hasMany(RecapCutPanel::class,'cutting_check_cutPanel_id');
    }
    public function recap(){
        return $this->hasOneDeepFromRelations($this->recapDetail(),
            (new RecapCutPanel())->recapHeader()
        );
    }

}
