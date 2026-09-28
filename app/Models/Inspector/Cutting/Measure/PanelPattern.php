<?php

namespace App\Models\Inspector\Cutting\Measure;

use App\Models\Configure\Cutting\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Configure\Measurement\Checkpoints;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class PanelPattern extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'cutting_panel_pattern';
    protected $fillable = ['measure_detail_id','cutting_panel_id','size_id','pattern','shrinkage'];
    protected $casts = [
        'pattern' => 'float'
    ];
    function checkpoints(): BelongsTo
    {
        return $this->belongsTo(Checkpoints::class,'measure_detail_id' );
    }
    function panels(): BelongsTo
    {
        return $this->belongsTo(Panel::class, 'cutting_panel_id');
    }
    function size(): BelongsTo
    {
        return $this->belongsTo(Size::class, 'size_id');
    }
    function scopeCheck($query, $param)
    {
        return $query->where($param);
    }
}
