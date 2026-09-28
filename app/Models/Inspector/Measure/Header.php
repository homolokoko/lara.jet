<?php

namespace App\Models\Inspector\Measure;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Configure\Measure\Profile\Header as configureMeasureHeader;
use App\Models\Configure\Measure\Profile\Chart as configureMeasureChart;
use App\Models\Inspector\Measure\Item as inspectorMeasureItem ;
use App\Models\Configure\InspectProfile;
use App\Models\Configure\Styles;
use App\Models\Configure\Version;

class Header extends Model
{
    use HasFactory;
    use \Staudenmeir\EloquentHasManyDeep\HasRelationships;

    public $table = "insp_measure_header";
    protected $fillable = [
    'measure_profile_header_id',
    'doc_no','inspector_id',
    'styles_id',
    'inspection_profile_id',
    'inspected_garment_qty',
    'inspected_sizes_qty',
    'total_checked','total_acceptable','total_less','total_more','total_tally',
    'should_inspect_size_qty',
    'is_complete','is_ignore_incomplete'];
    protected $hidden = ['inspected_garment_qty','inspected_sizes_qty','total_checked','total_acceptable','total_less','total_more','total_tally'];
    protected $sequences = ['doc_no'];

    public function configureMeasureProfileHeader(){
        return $this->belongsTo(configureMeasureHeader::class,'measure_profile_header_id');
    }
    public function inspectItem(){
        return $this->hasMany(inspectorMeasureItem::class,'insp_measure_header_id');
    }
    public function style(){
        return $this->belongsTo(Styles::class, 'styles_id');
    }
    public function inspectionReportType(){
        return $this->belongsTo(InspectProfile::class,'inspection_profile_id');
    }
   
    public function inspectItemCharts(){
        return $this->hasManyDeep(
            Chart::class,
            [ Item::class ],
            [
                'insp_measure_header_id', // Foreign key on the "item" table.
                'id',      // Foreign key on the "header" table (local key).
                'insp_measure_item_id'  // Foreign key on the "charts" table.
             ],
        );
    }

}
