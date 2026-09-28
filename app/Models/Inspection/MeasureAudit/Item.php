<?php

namespace App\Models\Inspector\MeasureAudit;

use App\Models\Configure\Color;
use App\Models\Configure\Size;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Item extends Model
{
    use HasFactory;
    protected $table = 'measure_audit_items';

    protected $fillable = [
        'header_id',
        'size_id',
        'color_id',
        'inspector_id',
        'is_pass',
    ];

    protected $casts = [
        'is_pass' => 'boolean',
    ];

    public function records()
    {
        return $this->hasMany(Chart::class, 'item_id');
    }
    public function size(): BelongsTo
    {
        return $this->belongsTo(Size::class,'size_id');
    }
    public function color(): BelongsTo
    {
        return $this->belongsTo(Color::class, 'color_id');
    }
    public function record(): HasMany
    {
        return $this->hasMany(Chart::class,'item_id');
    }

}
