<?php

namespace App\Models\Inspector\MeasureAudit;

use App\Models\Configure\Measure\Profile\Detail;
use App\Models\Configure\Measure\Profile\Chart as ConfigureMeasureChart;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Staudenmeir\EloquentHasManyDeep\HasOneDeep;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

class Chart extends Model
{
    use HasFactory;
    use HasRelationships;

    protected $table = 'measure_audit_charts';

    protected $fillable = [
        'item_id',
        'chart_id',
        'actual',
        'actual_in_decimal',
        'different',
        'is_positive',
        'is_tally',
        'is_within_tolerance',
    ];

    protected $casts = [
        'is_positive' => 'boolean',
        'is_tally' => 'boolean',
        'is_within_tolerance' => 'boolean',
    ];
    public function buyerExpectation(): HasOne
    {
        return $this->hasOne(ConfigureMeasureChart::class, 'id', 'chart_id');
    }
    public function checkpoint(): HasOneDeep
    {
        return $this->hasOneDeepFromRelations(
            $this->buyerExpectation(),
            (new ConfigureMeasureChart)->checkpoint()->withTrashed()
        );
    }



}
