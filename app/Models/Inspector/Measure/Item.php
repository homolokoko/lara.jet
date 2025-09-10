<?php

namespace App\Models\Inspector\Measure;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Configure\Size;
use App\Models\Inspector\Measure\Chart;
use Illuminate\Support\Carbon;

class Item extends Model
{
    use HasFactory;
    use \Staudenmeir\EloquentHasManyDeep\HasRelationships;

    public $table = "insp_measure_item";
    protected $fillable = [
        'insp_measure_header_id',
        'item_number',
        'sizes_id',
        'total_checked',
        'total_more',
        'total_tally',
        'total_less',
        'total_acceptable'
    ];
    protected $hidden = ['total_checked', 'total_more', 'total_tally', 'total_less', 'total_acceptable'];
    protected $sequences = ['item_number'];
    protected $appends = ['weekOfYears'];

    public function size()
    {
        return $this->belongsTo(Size::class, 'sizes_id');
    }
    public function header()
    {
        return $this->belongsTo(Header::class, 'insp_measure_header_id');
    }
    public function chart()
    {
        return $this->hasMany(Chart::class, 'insp_measure_item_id');
    }
    public function getWeekOfYearsAttribute()
    {
        return Carbon::parse($this->created_at)->weekOfYear;
    }
    public function headerProfile()
    {
        return $this->hasOneDeepFromRelations(
            $this->header(),
            (new header)->configureMeasureProfileHeader()
        );
    }
}
