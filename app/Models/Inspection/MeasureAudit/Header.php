<?php

namespace App\Models\Inspector\MeasureAudit;

use App\Models\Configure\Color;
use App\Models\Configure\Size;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Staudenmeir\EloquentHasManyDeep\HasManyDeep;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

class Header extends Model
{
    use HasFactory, SoftDeletes, HasRelationships;
    CONST TYPE_SEW_ONLINE = 1;
    CONST TYPE_FINISHING = 2;
    CONST TYPE_AFTERWASH = 3;
    CONST TYPE_OFFLINE = 4;

    CONST VIEW_FACTORY = 1;
    CONST VIEW_PD = 2; //Product Developement

    protected $table = 'measure_audit_headers';

    protected $fillable = [
        'styles_id',
        'purchase_order_id',
        'measurement_profile_id',
        'mode',
        'report_view',
    ];
    protected $appends = ['module','reportView'];

    public function item(): HasMany
    {
        return $this->hasMany(Item::class,'header_id','id');
    }

    public function getModuleAttribute(): string
    {
        if($this->mode === self::TYPE_AFTERWASH){
            return 'afterwash';
        }
        if ($this->mode === self::TYPE_FINISHING){
            return 'finishing';
        }
        if($this->mode == self::TYPE_SEW_ONLINE){
            return 'sewing-online';
        }
        if ($this->mode == self::TYPE_OFFLINE){
            return 'offline';
        }
        return 'other';
    }
    public function getReportViewAttribute()
    {
        if($this->report_view === self::VIEW_FACTORY){
            return 'factory';
        }
        return 'pd';
    }

    public function sizes()
    {
        return $this->hasManyDeep(Size::class,
            [
                Item::class,
            ],
            ['header_id', 'id'],
            ['id', 'size_id']
        )->select('sizes.id', 'sizes.name')->distinct();
    }
    public function colors()
    {
        return $this->hasManyDeep(Color::class,
            [
                Item::class,
            ],
            ['header_id', 'id'],
            ['id', 'color_id']
        )->select('color.id', 'color.name')->distinct();
    }
    public function records(): HasManyDeep
    {
        return $this->hasManyDeepFromRelations(
            $this->item(),
            (new Item())->record()
        );
    }
    public function scopeAuditTypeWithViewType($q, $auditType, $viewType)
    {
        return $q->where('mode', $auditType)->where('report_view', $viewType);
    }

}
