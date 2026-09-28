<?php

namespace App\Models\Inspector\Endline\Measure;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Configure\Color;
use App\Models\Configure\Size;
use App\Models\Inspector\Endline\Measure\Item\Cases as MeasureItemCase;
use App\Models\Configure\Measure\Profile;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

class Item extends Model
{
    use HasFactory;
    use HasRelationships;

    use HasRelationships;
    public $table = "endline_measure_item";
    protected $fillable = [
        'header_id',
        'color_id',
        'size_id',
        'total_checkpoint_checked',
        'total_checkpoint_less',
        'total_checkpoint_tally',
        'total_checkpoint_more',
        'total_check_acceptable',
        'created_at',
    ];
    public $timestamps = false;
    protected $appends = ['item_fail'];

    public function chart()
    {
        return $this->hasMany(Chart::class, 'inspection_measure_item_id', 'id');
    }
    public function color()
    {
        return $this->belongsTo(Color::class, 'color_id');
    }
    public function size()
    {
        return $this->belongsTo(Size::class, 'size_id');
    }

    public function cases()
    {
        return $this->hasOne(MeasureItemCase::class, 'item_id');
    }

    public function header()
    {
        return $this->belongsTo(Header::class, 'header_id');
    }

    public function measureProfileChart()
    {
        return $this->hasManyThrough(
            Profile\Chart::class,
            Chart::class,
            'inspection_measure_item_id',
            'id',
            'id',
            'measure_profile_chart_id'
        );
    }
    public function checkpoint()
    {
        return $this->hasManyDeepFromRelations(
            $this->chart(),
            (new Chart)->checkpoint()
        );
    }

    public function style()
    {
        return $this->hasOneDeepFromRelations(
            $this->header(),
            (new Header)->style()
        );
    }

    public function getItemFailAttribute(): bool
    {
        $isFail = $this->chart->pluck('is_fail')->sum(function ($result) {
            return ( ! $result) ? 0 : 1;
        });
        return $isFail > 0;
    }

    public function scopeItemPass($query)
    {
        return $this->itemIsFail;
    }
}
